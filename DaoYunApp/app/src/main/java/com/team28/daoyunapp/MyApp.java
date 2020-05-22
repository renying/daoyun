package com.team28.daoyunapp;

import android.app.Application;
import android.content.Context;
import android.content.SharedPreferences;

import androidx.multidex.MultiDex;

import com.orhanobut.logger.AndroidLogAdapter;
import com.orhanobut.logger.BuildConfig;
import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.utils.sdkinit.ANRWatchDogInit;
import com.team28.daoyunapp.utils.sdkinit.UMengInit;
import com.team28.daoyunapp.utils.sdkinit.XBasicLibInit;
import com.team28.daoyunapp.utils.sdkinit.XUpdateInit;

public class MyApp extends Application {

    @Override
    protected void attachBaseContext ( Context base ) {
        super.attachBaseContext (base);
        //解决4.x运行崩溃的问题
        MultiDex.install (this);
    }

    @Override
    public void onCreate () {
        super.onCreate ();
        Logger.addLogAdapter (new AndroidLogAdapter ());
        initLibs ();
    }

    /**
     * 初始化基础库
     */
    private void initLibs () {
        XBasicLibInit.init (this);

        XUpdateInit.init (this);

        //运营统计数据运行时不初始化
        if (! MyApp.isDebug ()) {
            UMengInit.init (this);
        }

        //ANR监控
        ANRWatchDogInit.init ();
    }


    /**
     * @return 当前app是否是调试开发模式
     */
    public static boolean isDebug () {
        return BuildConfig.DEBUG;
    }

}
