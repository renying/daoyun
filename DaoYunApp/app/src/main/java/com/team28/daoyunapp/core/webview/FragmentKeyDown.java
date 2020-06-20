package com.team28.daoyunapp.core.webview;

import android.view.KeyEvent;

/**
 *
 *
 */
public interface FragmentKeyDown {

    /**
     * fragment按键监听
     * @param keyCode
     * @param event
     * @return
     */
    boolean onFragmentKeyDown(int keyCode, KeyEvent event);
}
