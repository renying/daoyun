package com.team28.daoyunapp.fragment.members;

import android.Manifest;
import android.content.SharedPreferences;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.alibaba.android.vlayout.DelegateAdapter;
import com.alibaba.android.vlayout.VirtualLayoutManager;
import com.alibaba.android.vlayout.layout.LinearLayoutHelper;
import com.orhanobut.logger.Logger;
import com.scwang.smartrefresh.layout.SmartRefreshLayout;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.adapter.base.delegate.SimpleDelegateAdapter;
import com.team28.daoyunapp.adapter.entity.Member;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.team28.daoyunapp.utils.DataProvider;
import com.team28.daoyunapp.utils.LocationService;
import com.team28.daoyunapp.utils.MyLocationListener;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xaop.annotation.Permission;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xaop.util.MD5Utils;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.adapter.recyclerview.RecyclerViewHolder;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xui.widget.dialog.materialdialog.MaterialDialog;
import com.xuexiang.xui.widget.layout.ExpandableLayout;
import com.xuexiang.xui.widget.textview.supertextview.SuperTextView;
import com.xuexiang.xutil.data.SPUtils;

import butterknife.BindView;
import butterknife.OnClick;

@Page(anim = CoreAnim.none)
public class MembersFragment extends BaseFragment {

    private SharedPreferences spf;
    @BindView(R.id.recyclerView_member)
    RecyclerView recyclerView;

    @BindView(R.id.refreshLayout_member)
    SmartRefreshLayout refreshLayout;
    @BindView(R.id.layout_exe)
    ExpandableLayout layoutExe;

    @BindView(R.id.tv_exe)
    TextView checkExe;
    @BindView(R.id.tv_user_count)
    SuperTextView userCount;
    @BindView(R.id.checkOn)
    ExpandableLayout checkOn;
    @BindView(R.id.image_check)
    ImageView imageCheck;
    @BindView(R.id.exe_sign_in)
    SuperTextView exeSignIn;

    private SimpleDelegateAdapter<Member> mMemberAdapter;

    private MyLocationListener myLocationListener = new MyLocationListener ();

    private LoadingDialog mLoadingDialog;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_members;
    }

    @Override
    protected void initViews () {
        checkExe.setClickable (false);
        mLoadingDialog = WidgetUtils.getLoadingDialog (getContext ())
                .setIconScale (0.4F)
                .setLoadingSpeed (8);
        mLoadingDialog.show ();

        spf = SPUtils.getSharedPreferences (Api.SPFNAME);

        LocationService.start (myLocationListener);

        if (DataProvider.isCheckAble ()) {
            layoutExe.setExpanded (true);
            checkOn.setClickable (true);
            exeSignIn.setCenterString ("点击签到");
        } else {
            layoutExe.setExpanded (false);
            imageCheck.setImageDrawable (getResources ().getDrawable (R.drawable.initiate_check));
            imageCheck.setPadding (10, 10, 10, 10);
            exeSignIn.setCenterString ("发起签到");
        }


        VirtualLayoutManager virtualLayoutManager = new VirtualLayoutManager (getContext ());
        recyclerView.setLayoutManager (virtualLayoutManager);
        RecyclerView.RecycledViewPool viewPool = new RecyclerView.RecycledViewPool ();
        recyclerView.setRecycledViewPool (viewPool);
        viewPool.setMaxRecycledViews (0, 10);

        //成员
        mMemberAdapter = new SimpleDelegateAdapter<Member> (R.layout.adapter_member_card_view_list_item, new LinearLayoutHelper ()) {
            @Override
            protected void bindData ( @NonNull RecyclerViewHolder holder, int position, Member item ) {
                if (item != null) {
                    holder.text (R.id.tv_member_name, item.getUserName ());
                    holder.text (R.id.tv_member_code, item.getUserCode ());
                }
            }
        };

        DelegateAdapter delegateAdapter = new DelegateAdapter (virtualLayoutManager);
        delegateAdapter.addAdapter (mMemberAdapter);

        recyclerView.setAdapter (delegateAdapter);
        checkExe.setText ("当前获得 " + DataProvider.getCheckCount () * 2 + "积分");
    }
    @Override

    protected TitleBar initTitle () {
        return super.initTitle ().setTitle ("成员");
    }

    @SingleClick
    @OnClick({R.id.checkOn})
    public void onViewClicked ( View view ) {
        switch (view.getId ()) {
            case R.id.checkOn:
                if (DataProvider.isCheckAble ())
                    signIn ();
                else
                    initSignIn ();
                break;
            default:
                break;
        }
    }

    @Override
    @Permission(Manifest.permission_group.LOCATION)
    protected void initListeners () {
        //下拉刷新
        refreshLayout.setOnRefreshListener (refreshLayout -> refreshLayout.getLayout ().postDelayed (() -> {
            checkExe.setText ("当前获得 " + DataProvider.getPoint () + " 积分");
            if (DataProvider.isCheckAble ())
                exeSignIn.setCenterString ("签到次数：" + DataProvider.getCheckCount ());
            userCount.setRightString (DataProvider.getUserCount () + "人");
            mMemberAdapter.refresh (DataProvider.getMembers (0));
            refreshLayout.finishRefresh ();
        }, 1000));
        //上拉加载
        refreshLayout.setOnLoadMoreListener (refreshLayout -> refreshLayout.getLayout ().postDelayed (() -> {
            mMemberAdapter.loadMore (DataProvider.getMembers (0));

            refreshLayout.finishLoadMore ();
        }, 1000));
        refreshLayout.autoRefresh ();//第一次进入触发自动刷新，演示效果
        mLoadingDialog.dismiss ();
    }

    private void signIn () {
        XHttp.post (Api.CHECKIN)
                .params (Api.param_ukey, SPUtils.getString (spf, Api.param_ukey, ""))
                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf, Api.param_ui, "")))
                .params (Api.param_classid, DataProvider.getCourse_id ())
                .params (Api.param_longitude, myLocationListener.getLongitude ())
                .params (Api.param_latitude, myLocationListener.getLatitude ())
                .execute (new CallBackProxy<CustomApiResult<String>, String> (new TipCallBack<String> () {
                    @Override
                    public void onSuccess ( String response ) throws Throwable {
                        DataProvider.setCheckCount (DataProvider.getCheckCount () + 1);
                        checkExe.setText ("当前获得 " + response + " 积分");
                        exeSignIn.setCenterString ("签到次数：" + DataProvider.getCheckCount ());
                        XToastUtils.success ("签到成功");
                        checkOn.setClickable (false);
                        mLoadingDialog.dismiss ();
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        mLoadingDialog.dismiss ();
                        Logger.d (e.getDetailMessage ());
                        super.onError (e);
                    }

                    @Override
                    public void onStart () {
                        mLoadingDialog.show ();
                    }

                    @Override
                    public void onCompleted () {
                        mLoadingDialog.dismiss ();
                    }
                }) {
                });

    }


    private void initSignIn () {
        final int[] duration = {1};
        new MaterialDialog.Builder(getContext())
                .title("请选择限时签到的时长")
                .items(R.array.check_time)
                .itemsCallback(new MaterialDialog.ListCallback() {
                    @Override
                    public void onSelection(MaterialDialog dialog, View itemView, int position, CharSequence text) {
                        switch (position){
                            case 0: duration[0] = 1;
                            case 1: duration[0] = 2;
                            case 2: duration[0] = 5;
                            case 3: duration[0] = 60;
                        }

                        XHttp.post (Api.STARTCHECKIN)
                                .params (Api.param_ukey, SPUtils.getString (spf, Api.param_ukey, ""))
                                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf, Api.param_ui, "")))
                                .params (Api.param_classid, DataProvider.getCourse_id ())
                                .params (Api.param_longitude, myLocationListener.getLongitude ())
                                .params (Api.param_latitude, myLocationListener.getLatitude ())
                                .params (Api.param_duration, duration[0])
                                .execute (new CallBackProxy<CustomApiResult<String>, String> (new TipCallBack<String> () {
                                    @Override
                                    public void onSuccess ( String response ) throws Throwable {
                                        XToastUtils.success ("发起签到成功");
                                        checkOn.setClickable (false);
                                        mLoadingDialog.dismiss ();
                                    }

                                    @Override
                                    public void onError ( ApiException e ) {
                                        super.onError (e);
                                        Logger.d (e.getDetailMessage ());
                                        mLoadingDialog.dismiss ();
                                    }

                                    @Override
                                    public void onStart () {
                                        mLoadingDialog.show ();
                                    }

                                    @Override
                                    public void onCompleted () {
                                        mLoadingDialog.dismiss ();
                                    }
                                }) {
                                });
                    }
                })
                .show();


    }
}
