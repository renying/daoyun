package com.team28.daoyunapp.activity;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;

import com.google.android.material.bottomnavigation.BottomNavigationView;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.core.BaseActivity;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.fragment.detail.DetailFragment;
import com.team28.daoyunapp.fragment.informs.InformsFragment;
import com.team28.daoyunapp.fragment.members.MembersFragment;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xui.adapter.FragmentAdapter;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xutil.common.CollectionUtils;
import com.xuexiang.xutil.data.SPUtils;

import androidx.annotation.NonNull;
import androidx.appcompat.widget.Toolbar;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.viewpager.widget.ViewPager;

import butterknife.BindView;

/**
 * 班课页面
 */
public class CourseDetailActivity extends BaseActivity implements View.OnClickListener, ViewPager.OnPageChangeListener, BottomNavigationView.OnNavigationItemSelectedListener, Toolbar.OnMenuItemClickListener {

    @BindView(R.id.view_pager_course)
    ViewPager viewPager;
    /**
     * 底部导航栏
     */
    @BindView(R.id.bottom_navigation_course)
    BottomNavigationView bottomNavigation;

    @BindView(R.id.drawer_layout_course)
    DrawerLayout drawerLayout;

    SharedPreferences spf;

    private String[] mTitles;

    @Override
    protected int getLayoutId() {
        return R.layout.activity_course_detail;
    }

    @Override
    protected void onCreate ( Bundle savedInstanceState ) {
        super.onCreate(savedInstanceState);

        spf = SPUtils.getSharedPreferences (Api.SPFNAME);
//        Logger.json (JSON.toJSONString (spf.getAll ()));
        initViews();
        initListeners();
    }

    @Override
    protected boolean isSupportSlideBack() {
        return false;
    }

    private void initViews() {
        mTitles = ResUtils.getStringArray(R.array.course_titles);

        //主页内容填充
        BaseFragment[] fragments = new BaseFragment[]{
                new MembersFragment (),
                new InformsFragment (),
                new DetailFragment ()
        };
        FragmentAdapter<BaseFragment> adapter = new FragmentAdapter<>(getSupportFragmentManager(), fragments);
        viewPager.setOffscreenPageLimit(mTitles.length - 1);
        viewPager.setAdapter(adapter);
    }

    protected void initListeners() {
        //主页事件监听
        viewPager.addOnPageChangeListener(this);
        bottomNavigation.setOnNavigationItemSelectedListener(this);
    }

    @Override
    public boolean onMenuItemClick( MenuItem item) {
//        switch (item.getItemId()) {
//            case R.id.action_privacy:
////                Utils.showPrivacyDialog(this, null);
//                break;
//            default:
//                break;
//        }
        return false;
    }

    @SingleClick
    @Override
    public void onClick(View v) {
//        switch (v.getId()) {
//            case R.id.nav_header:
//                XToastUtils.toast("点击头部！");
//                break;
//            default:
//                break;
//        }
    }

    //=============ViewPager===================//

    @Override
    public void onPageScrolled(int i, float v, int i1) {

    }

    @Override
    public void onPageSelected(int position) {
        MenuItem item = bottomNavigation.getMenu().getItem(position);
        item.setChecked(true);
    }

    @Override
    public void onPageScrollStateChanged(int i) {

    }

    //================Navigation================//

    /**
     * 底部导航栏点击事件
     *
     * @param menuItem 菜单组件
     * @return Boolean
     */
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {

        int index = CollectionUtils.arrayIndexOf(mTitles, menuItem.getTitle());
        if (index != -1) {
            viewPager.setCurrentItem(index, false);

            return true;
        }
        return false;
    }
}
