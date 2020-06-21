package com.team28.daoyunapp.fragment.creating;

import android.content.SharedPreferences;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.alibaba.android.vlayout.DelegateAdapter;
import com.alibaba.android.vlayout.VirtualLayoutManager;
import com.alibaba.android.vlayout.layout.LinearLayoutHelper;
import com.scwang.smartrefresh.layout.SmartRefreshLayout;
import com.team28.daoyunapp.activity.CourseDetailActivity;
import com.team28.daoyunapp.adapter.entity.Course;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.adapter.base.delegate.SimpleDelegateAdapter;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.utils.DataProvider;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.adapter.recyclerview.RecyclerViewHolder;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xutil.app.ActivityUtils;
import com.xuexiang.xutil.data.SPUtils;

import java.util.Objects;

import butterknife.BindView;

/**
 * 班课
 */
@Page(anim = CoreAnim.none)
public class ClassesFragment extends BaseFragment {

    @BindView(R.id.recyclerView)
    RecyclerView recyclerView;

    @BindView(R.id.refreshLayout)
    SmartRefreshLayout refreshLayout;

    private SimpleDelegateAdapter<Course> mNewsAdapter;

    private LoadingDialog mLoadingDialog;

    private SharedPreferences spf;
    /**
     * @return 返回为 null意为不需要导航栏
     */
    @Override
    protected TitleBar initTitle() {
        return null;
    }

    /**
     * 布局的资源id
     *
     * @return 布局
     */
    @Override
    protected int getLayoutId() {
        return R.layout.fragment_classes;
    }

    /**
     * 初始化控件
     */
    @Override
    protected void initViews() {

        spf = SPUtils.getSharedPreferences (Api.SPFNAME);
        mLoadingDialog = WidgetUtils.getLoadingDialog (getContext ())
                .setIconScale (0.4F)
                .setLoadingSpeed (8);
        mLoadingDialog.show ();

        VirtualLayoutManager virtualLayoutManager = new VirtualLayoutManager(Objects.requireNonNull (getContext ()));
        recyclerView.setLayoutManager(virtualLayoutManager);
        RecyclerView.RecycledViewPool viewPool = new RecyclerView.RecycledViewPool();
        recyclerView.setRecycledViewPool(viewPool);
        viewPool.setMaxRecycledViews(0, 10);

        //资讯
        mNewsAdapter = new SimpleDelegateAdapter<Course>(R.layout.adapter_news_card_view_list_item, new LinearLayoutHelper()) {
            @Override
            protected void bindData(@NonNull RecyclerViewHolder holder, int position, Course item) {
                if (item != null) {
                    holder.text(R.id.tv_title, item.getName ());
                    holder.text(R.id.tv_summary, item.getDesc ());

                    holder.click (R.id.card_view,v -> {
                        DataProvider.clearCourseData ();
                        DataProvider.setCheckAble (false);
                        DataProvider.setCourse_id (item.getID ());
                        DataProvider.getClassMembers ();
                        ActivityUtils.startActivityWithBundle (CourseDetailActivity.class,"key",item);
                    });
                }
            }
        };

        DelegateAdapter delegateAdapter = new DelegateAdapter(virtualLayoutManager);
        delegateAdapter.addAdapter(mNewsAdapter);

        recyclerView.setAdapter(delegateAdapter);
        mLoadingDialog.dismiss ();
    }

    @Override
    protected void initListeners() {
        //下拉刷新
        refreshLayout.setOnRefreshListener(refreshLayout -> refreshLayout.getLayout().postDelayed(() -> {
            mNewsAdapter.refresh(DataProvider.getCreatedClassInfos ());
            refreshLayout.finishRefresh();
        }, 1000));
        //上拉加载
        refreshLayout.setOnLoadMoreListener(refreshLayout -> refreshLayout.getLayout().postDelayed(() -> {
            mNewsAdapter.loadMore(DataProvider.getCreatedClassInfos ());
            refreshLayout.finishLoadMore();
        }, 1000));
        refreshLayout.autoRefresh();//第一次进入触发自动刷新，演示效果
    }
}