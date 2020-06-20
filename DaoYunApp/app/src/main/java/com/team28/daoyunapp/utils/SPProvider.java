package com.team28.daoyunapp.utils;

import android.content.SharedPreferences;

import com.team28.daoyunapp.core.http.Api;
import com.xuexiang.xutil.data.SPUtils;

public class SPProvider {
    private static SharedPreferences spf = SPUtils.getSharedPreferences (Api.SPFNAME);

    public static void putData(String key,String value){
        SPUtils.put (spf,key,value);
    }

    public static String getData(String key){
        return spf.getString (key, "");
    }

    public static String getDate(String key){
        return spf.getString (key, "1970-01-01");
    }

    public static String getSex(String key){
        return spf.getString (key, "1");
    }

    public static void clear(){
        SPUtils.clear (spf);
    }
}
