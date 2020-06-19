package com.team28.daoyunapp.fragment.informs;

import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.team28.daoyunapp.R;
import com.team28.daoyunapp.core.BaseFragment;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.widget.actionbar.TitleBar;

@Page(anim = CoreAnim.none)
public class InformsFragment extends BaseFragment {
    @Override
    protected int getLayoutId () {
        return R.layout.fragment_informs;
    }

    @Override
    protected void initViews () {

    }
    @Override
    protected TitleBar initTitle () {
        return super.initTitle ().setTitle ("消息");
    }
}
