package com.team28.daoyunapp.fragment.news;

import android.content.SharedPreferences;
import android.view.Gravity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import androidx.viewpager.widget.PagerAdapter;
import androidx.viewpager.widget.ViewPager;

import com.alibaba.android.vlayout.DelegateAdapter;
import com.alibaba.android.vlayout.VirtualLayoutManager;
import com.alibaba.android.vlayout.layout.LinearLayoutHelper;
import com.scwang.smartrefresh.layout.SmartRefreshLayout;
import com.team28.daoyunapp.adapter.entity.Course;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.adapter.base.delegate.SimpleDelegateAdapter;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.utils.DemoDataProvider;
import com.team28.daoyunapp.widget.ContentPage;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.adapter.recyclerview.RecyclerViewHolder;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xui.widget.tabbar.EasyIndicator;
import com.xuexiang.xutil.data.SPUtils;

import java.util.HashMap;
import java.util.Map;

import butterknife.BindView;

/**
 * 班课
 */
@Page(anim = CoreAnim.none)
public class ClassesFragment extends BaseFragment {

    @BindView(R.id.easy_indicator)
    EasyIndicator mEasyIndicator;
    @BindView(R.id.news_view_pager)
    ViewPager mViewPager;

    private Map<ContentPage, View> mPageMap = new HashMap<> ();

    @BindView(R.id.recyclerView)
    RecyclerView recyclerViewCreated;

    @BindView(R.id.refreshLayout)
    SmartRefreshLayout refreshLayout;

    private LoadingDialog mLoadingDialog;
    private SimpleDelegateAdapter<Course> mNewsAdapter;

    private SharedPreferences spf;

    private View getPageView(ContentPage page) {
        View view = mPageMap.get(page);
        if (view == null) {

            TextView textView = new TextView(getContext());
//            textView.setTextAppearance(getContext(), R.style.TextStyle_Content_Match);
            textView.setGravity(Gravity.CENTER);
            textView.setText(String.format("这个是%s页面的内容", page.name()));
            view = refreshLayout;
            mPageMap.put(page, view);
        }
        return view;
    }
    private PagerAdapter mPagerAdapter = new PagerAdapter() {
        @Override
        public boolean isViewFromObject(View view, Object object) {
            return view == object;
        }

        @Override
        public int getCount() {
            return ContentPage.size();
        }


        @Override
        public Object instantiateItem( final ViewGroup container, int position) {
            ContentPage page = ContentPage.getPage(position);
            View view = getPageView(page);
            ViewGroup.LayoutParams params = new ViewGroup.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.MATCH_PARENT);
            container.addView(view, params);
            return view;
        }

        @Override
        public void destroyItem(ViewGroup container, int position, Object object) {
            container.removeView((View) object);
        }
    };

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
        mLoadingDialog = WidgetUtils.getLoadingDialog(getContext())
                .setIconScale(0.4F)
                .setLoadingSpeed(8);

        VirtualLayoutManager virtualLayoutManager = new VirtualLayoutManager(getContext());
        recyclerViewCreated.setLayoutManager(virtualLayoutManager);
        RecyclerView.RecycledViewPool viewPool = new RecyclerView.RecycledViewPool();
        recyclerViewCreated.setRecycledViewPool(viewPool);
        viewPool.setMaxRecycledViews(0, 10);

        //资讯
        mNewsAdapter = new SimpleDelegateAdapter<Course>(R.layout.adapter_news_card_view_list_item, new LinearLayoutHelper()) {
            @Override
            protected void bindData(@NonNull RecyclerViewHolder holder, int position, Course item) {
                if (item != null) {
                    holder.text(R.id.tv_title, item.getName ());
                    holder.text(R.id.tv_summary, item.getDesc ());
                    holder.text(R.id.tv_praise, "签到");
                    holder.text(R.id.tv_comment, "举手");
                    holder.text(R.id.tv_read, "抢答");

                }
            }
        };

        DelegateAdapter delegateAdapter = new DelegateAdapter(virtualLayoutManager);
        delegateAdapter.addAdapter(mNewsAdapter);

        recyclerViewCreated.setAdapter(delegateAdapter);

        mEasyIndicator.setTabTitles(ContentPage.getPageNames());
        mEasyIndicator.setViewPager(mViewPager, mPagerAdapter);
        mViewPager.setOffscreenPageLimit(ContentPage.size() - 1);
        mViewPager.setCurrentItem(1);
    }

    @Override
    protected void initListeners() {
        //下拉刷新
        refreshLayout.setOnRefreshListener(refreshLayout -> {
            refreshLayout.getLayout().postDelayed(() -> {
                mNewsAdapter.refresh(DemoDataProvider.getCreatedClassInfos ());
                refreshLayout.finishRefresh();
            }, 1000);
        });
        //上拉加载
        refreshLayout.setOnLoadMoreListener(refreshLayout -> {
            refreshLayout.getLayout().postDelayed(() -> {
                mNewsAdapter.loadMore(DemoDataProvider.getCreatedClassInfos ());
                refreshLayout.finishLoadMore();
            }, 1000);
        });
        refreshLayout.autoRefresh();//第一次进入触发自动刷新，演示效果
    }
}
