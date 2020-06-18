package com.team28.daoyunapp.fragment.members;

import android.content.SharedPreferences;
import android.provider.ContactsContract;
import android.view.View;
import android.widget.LinearLayout;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.alibaba.android.vlayout.DelegateAdapter;
import com.alibaba.android.vlayout.VirtualLayoutManager;
import com.alibaba.android.vlayout.layout.LinearLayoutHelper;
import com.orhanobut.logger.Logger;
import com.scwang.smartrefresh.layout.SmartRefreshLayout;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.activity.RegisterActivity;
import com.team28.daoyunapp.adapter.base.delegate.SimpleDelegateAdapter;
import com.team28.daoyunapp.adapter.entity.Member;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.team28.daoyunapp.utils.DataProvider;
import com.team28.daoyunapp.utils.XToastUtils;
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
import com.xuexiang.xui.widget.layout.XUILinearLayout;
import com.xuexiang.xui.widget.textview.label.LabelTextView;
import com.xuexiang.xui.widget.textview.supertextview.SuperTextView;
import com.xuexiang.xutil.app.ActivityUtils;
import com.xuexiang.xutil.data.SPUtils;

import java.util.Objects;

import butterknife.BindView;
import butterknife.OnClick;

@Page(anim = CoreAnim.none)
public class MembersFragment extends BaseFragment{

    private SharedPreferences spf;
    @BindView(R.id.recyclerView_member)
    RecyclerView recyclerView;

    @BindView(R.id.refreshLayout_member)
    SmartRefreshLayout refreshLayout;

    @BindView(R.id.tv_check_count)
    SuperTextView checkCount;
    @BindView(R.id.tv_user_count)
    SuperTextView userCount;
    @BindView(R.id.checkOn)
    XUILinearLayout checkOn;
    @BindView(R.id.exe_sign_in)
    LabelTextView exeSignIn;


    private SimpleDelegateAdapter<Member> mMemberAdapter;

    private LoadingDialog mLoadingDialog;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_members;
    }

    @Override
    protected void initViews () {
        mLoadingDialog = WidgetUtils.getLoadingDialog (getContext ())
                .setIconScale (0.4F)
                .setLoadingSpeed (8);
        mLoadingDialog.show ();

        spf = SPUtils.getSharedPreferences (Api.SPFNAME);

        if (DataProvider.isCheckAble ()){
            checkOn.setClickable (true);
        }else {
            checkOn.setClickable (false);
        }

        VirtualLayoutManager virtualLayoutManager = new VirtualLayoutManager (Objects.requireNonNull (getContext ()));
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
        checkCount.setRightString (DataProvider.getCheckCount () + "次");
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
                signIn ();
                break;
            default:
                break;
        }
    }

    @Override
    protected void initListeners () {
        //下拉刷新
        refreshLayout.setOnRefreshListener (refreshLayout -> refreshLayout.getLayout ().postDelayed (() -> {
            checkCount.setRightString (DataProvider.getCheckCount () + "次");
            userCount.setRightString (DataProvider.getUserCount () + "人");
            mMemberAdapter.refresh (DataProvider.getMembers ());
            refreshLayout.finishRefresh ();
        }, 1000));
        //上拉加载
        refreshLayout.setOnLoadMoreListener (refreshLayout -> refreshLayout.getLayout ().postDelayed (() -> {
            mMemberAdapter.loadMore (DataProvider.getMembers ());

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
                .execute (new CallBackProxy<CustomApiResult<Boolean>, Boolean> (new TipCallBack<Boolean> () {
                    @Override
                    public void onSuccess ( Boolean response ) throws Throwable {
                        Logger.d (response);
                        XToastUtils.success ("签到成功");
                        checkOn.setClickable (false);
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        mLoadingDialog.dismiss ();
                        Logger.d (e);
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
}
