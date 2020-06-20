package com.team28.daoyunapp.core.webview;

import android.app.Activity;
import android.view.LayoutInflater;
import android.view.ViewGroup;
import android.webkit.WebView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.just.agentweb.widget.IWebLayout;
import com.scwang.smartrefresh.layout.SmartRefreshLayout;
import com.team28.daoyunapp.R;

/**
 * 定义支持下来回弹的WebView
 *
 */
public class WebLayout implements IWebLayout {

    private final SmartRefreshLayout mSmartRefreshLayout;
    private WebView mWebView;

    public WebLayout(Activity activity) {
        mSmartRefreshLayout = (SmartRefreshLayout) LayoutInflater.from(activity).inflate(R.layout.fragment_pulldown_web, null);
        mWebView = mSmartRefreshLayout.findViewById(R.id.webView);
    }

    @NonNull
    @Override
    public ViewGroup getLayout() {
        return mSmartRefreshLayout;
    }

    @Nullable
    @Override
    public WebView getWebView() {
        return mWebView;
    }


}
