package com.team28.daoyunapp.utils;

import android.content.Context;
import android.content.SharedPreferences;
import android.graphics.drawable.Drawable;

import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONObject;
import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.adapter.entity.Course;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.xuexiang.xaop.annotation.MemoryCache;
import com.xuexiang.xaop.util.MD5Utils;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xui.adapter.simple.AdapterItem;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xutil.data.SPUtils;
import com.xuexiang.xutil.tip.ToastUtils;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

/**
 * 演示数据
 *
 * @author xuexiang
 * @since 2018/11/23 下午5:52
 */
public class DemoDataProvider {

    private static SharedPreferences spf = SPUtils.getSharedPreferences (Api.SPFNAME);

    private static List<Course> createdCourses = new ArrayList<> ();
    static List<Course> joinedCourses = new ArrayList<> ();
    int queryLimit = 10;

    /**
     * @return list “我创建的”课程列表
     */
    @MemoryCache
    public static List<Course> getCreatedClassInfos () {
        XHttp.post (Api.CLASSINFO)
                .params (Api.param_ukey,SPUtils.getString (spf,Api.param_ukey, ""))
                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf,Api.param_ui,"")))
                .execute (new CallBackProxy<CustomApiResult<JSONObject>,JSONObject> (new TipCallBack<JSONObject> () {
                    @Override
                    public void onSuccess ( JSONObject response ) throws Throwable {
                        Logger.json (response.toJSONString ());
                        JSONArray courses = response.getJSONArray ("Created");
                        if (createdCourses.size () < courses.size ()){
                            for (Object item: courses) {
                                JSONObject course = (JSONObject)item;
                                createdCourses.add (new Course (Integer.parseInt (course.getString ("ClassId")),course.getString ("ClassName"),
                                        course.getString ("ClassCode"),course.getString ("ClassDesc"),
                                        course.getDate ("CreateTime"),course.getString ("UserName"),
                                        course.getString ("UserCode"),course.getString ("SchoolInfo")));
                            }
                        }
                    }
                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d (e.getDetailMessage ());
                        super.onError (e);
                        ToastUtils.toast ("Token已过期，请重新登录");
                        TokenUtils.handleLogoutSuccess ();
                        ActivityCollectorUtil.finishAllActivity ();
                    }
                }){});
        return createdCourses;
    }

    /**
     * @return list “我加入的”课程列表
     */
    @MemoryCache
    public static List<Course> getJoinedClassInfos () {
        XHttp.post (Api.CLASSINFO)
                .params (Api.param_ukey,SPUtils.getString (spf,Api.param_ukey, ""))
                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf,Api.param_ui,"")))
                .execute (new CallBackProxy<CustomApiResult<JSONObject>,JSONObject> (new TipCallBack<JSONObject> () {
                    @Override
                    public void onSuccess ( JSONObject response ) throws Throwable {
                        Logger.json (response.toJSONString ());
                        JSONArray courses = response.getJSONArray ("Joined");
                        if(joinedCourses.size ()<courses.size ()){
                            for (Object item: courses) {
                                JSONObject course = (JSONObject)item;
                                joinedCourses.add (new Course (Integer.parseInt (course.getString ("ClassId")),course.getString ("ClassName"),
                                        course.getString ("ClassCode"),course.getString ("ClassDesc"),
                                        course.getDate ("CreateTime"),course.getString ("UserName"),
                                        course.getString ("UserCode"),course.getString ("SchoolInfo")));
                            }
                        }
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d (e.getDetailMessage ());
                        super.onError (e);
                        ToastUtils.toast ("Token已过期，请重新登录");
                        TokenUtils.handleLogoutSuccess ();
                        ActivityCollectorUtil.finishAllActivity ();
                    }
                }){});
        return joinedCourses;
    }

    public static List<AdapterItem> getGridItems(Context context) {
        return getGridItems(context, R.array.grid_titles_entry, R.array.grid_icons_entry);
    }


    private static List<AdapterItem> getGridItems(Context context, int titleArrayId, int iconArrayId) {
        List<AdapterItem> list = new ArrayList<>();
        String[] titles = ResUtils.getStringArray(titleArrayId);
        Drawable[] icons = ResUtils.getDrawableArray(context, iconArrayId);
        for (int i = 0; i < titles.length; i++) {
            list.add(new AdapterItem(titles[i], icons[i]));
        }
        return list;
    }

}
