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
import com.xuexiang.xui.widget.dialog.materialdialog.MaterialDialog;
import com.xuexiang.xutil.data.SPUtils;
import com.xuexiang.xutil.tip.ToastUtils;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

import static com.xuexiang.xutil.XUtil.getContext;

/**
 * 演示数据
 *
 * @author xuexiang
 * @since 2018/11/23 下午5:52
 */
public class DemoDataProvider {

    private static SharedPreferences spf = SPUtils.getSharedPreferences (Api.SPFNAME);

    private static List<Course> createdCourses = new ArrayList<> ();
    private static List<Course> joinedCourses = new ArrayList<> ();
    int queryLimit = 10;

    public static void getCourses () {
        XHttp.post (Api.CLASSINFO)
                .params (Api.param_ukey, SPUtils.getString (spf, Api.param_ukey, ""))
                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf, Api.param_ui, "")))
                .execute (new CallBackProxy<CustomApiResult<JSONObject>, JSONObject> (new TipCallBack<JSONObject> () {
                    @Override
                    public void onSuccess ( JSONObject response ) {
                        Logger.json (response.toJSONString ());
                        JSONArray courses = response.getJSONArray ("Created");
                        if (createdCourses.size () < courses.size ()) {
                            for (Object item : courses) {
                                JSONObject course = (JSONObject) item;
                                createdCourses.add (new Course (Integer.parseInt (course.getString ("ClassId")), course.getString ("ClassName"),
                                        course.getString ("ClassCode"), course.getString ("ClassDesc"),
                                        course.getDate ("CreateTime"), course.getString ("UserName"),
                                        course.getString ("UserCode"), course.getString ("SchoolInfo")));
                            }
                        }
                        JSONArray coursesJoin = response.getJSONArray ("Joined");
                        if (joinedCourses.size () < coursesJoin.size ()) {
                            for (Object item : coursesJoin) {
                                JSONObject course = (JSONObject) item;
                                joinedCourses.add (new Course (Integer.parseInt (course.getString ("ClassId")), course.getString ("ClassName"),
                                        course.getString ("ClassCode"), course.getString ("ClassDesc"),
                                        course.getDate ("CreateTime"), course.getString ("UserName"),
                                        course.getString ("UserCode"), course.getString ("SchoolInfo")));
                            }
                        }
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d (e.getDetailMessage ());
                        super.onError (e);
                        new MaterialDialog.Builder (getContext ())
                                .iconRes (R.drawable.icon_tip)
                                .title ("注意")
                                .content ("Token已过期，请重新登录")
                                .positiveText (R.string.lab_submit)
                                .show ();
                        TokenUtils.handleLogoutSuccess ();
                        ActivityCollectorUtil.finishAllActivity ();
                    }

                    @Override
                    public void onStart () {
                        Logger.d ("开始得到班课数据");
                    }
                }) {
                });
    }


    /**
     * @return list “我创建的”课程列表
     */
    @MemoryCache
    public static List<Course> getCreatedClassInfos () {

        return createdCourses;
    }

    /**
     * @return list “我加入的”课程列表
     */
    @MemoryCache
    public static List<Course> getJoinedClassInfos () {

        return joinedCourses;
    }
}
