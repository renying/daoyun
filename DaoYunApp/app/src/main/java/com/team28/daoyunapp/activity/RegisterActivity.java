package com.team28.daoyunapp.activity;

import android.os.Bundle;
import android.view.KeyEvent;

import com.team28.daoyunapp.core.BaseActivity;
import com.team28.daoyunapp.fragment.RegisterFragment;
import com.xuexiang.xui.utils.KeyboardUtils;
import com.xuexiang.xui.utils.StatusBarUtils;
import com.xuexiang.xutil.display.Colors;

/**
 * 注册页面
 *
 */
public class RegisterActivity extends BaseActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        openPage(RegisterFragment.class, getIntent().getExtras());
    }

    @Override
    protected void initStatusBarStyle() {
        StatusBarUtils.initStatusBarStyle(this, false, Colors.TRANSPARENT);
    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        return KeyboardUtils.onDisableBackKeyDown(keyCode) && super.onKeyDown(keyCode, event);
    }
}
