package com.team28.daoyunapp.fragment.members;

import android.content.SharedPreferences;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.alibaba.android.vlayout.DelegateAdapter;
import com.alibaba.android.vlayout.VirtualLayoutManager;
import com.alibaba.android.vlayout.layout.LinearLayoutHelper;
import com.scwang.smartrefresh.layout.SmartRefreshLayout;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.adapter.base.delegate.SimpleDelegateAdapter;
import com.team28.daoyunapp.adapter.entity.Member;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.DataProvider;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.adapter.recyclerview.RecyclerViewHolder;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xui.widget.textview.supertextview.SuperTextView;

import java.util.Objects;

import butterknife.BindView;

@Page(anim = CoreAnim.none)
public class MembersFragment extends BaseFragment {

    private SharedPreferences spf;
    @BindView(R.id.recyclerView_member)
    RecyclerView recyclerView;

    @BindView(R.id.refreshLayout_member)
    SmartRefreshLayout refreshLayout;

    @BindView(R.id.tv_check_count)
    SuperTextView checkCount;
    @BindView(R.id.tv_user_count)
    SuperTextView userCount;

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
        mLoadingDialog.dismiss ();
    }

    @Override
    protected TitleBar initTitle () {
        return super.initTitle ().setTitle ("成员");
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
    }
}
