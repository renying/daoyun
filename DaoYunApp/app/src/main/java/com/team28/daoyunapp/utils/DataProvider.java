package com.team28.daoyunapp.utils;

import com.alibaba.fastjson.JSONArray;
import com.alibaba.fastjson.JSONObject;
import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.adapter.entity.Course;
import com.team28.daoyunapp.adapter.entity.Member;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.xuexiang.xaop.annotation.MemoryCache;
import com.xuexiang.xaop.util.MD5Utils;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xui.adapter.simple.AdapterItem;

import java.util.ArrayList;
import java.util.List;

/**
 * 演示数据
 *
 * @author zengjun
 */
public class DataProvider {
    private static boolean checkAble = false;
    private static int course_id = 0;
    private static int userCount = 0;
    private static int checkCount = 0;
    private static int point = 0;
    private static List<Member> members = new ArrayList<> ();

    private static List<Course> createdCourses = new ArrayList<> ();
    private static List<Course> joinedCourses = new ArrayList<> ();

    private static List<Course> emptyCourse = new ArrayList<> ();
    private static List<Member> emptyMember = new ArrayList<> ();

    public static void getCourses () {
        XHttp.post (Api.CLASSINFO)
                .params (Api.param_ukey, SPProvider.getData (Api.param_ukey))
                .params (Api.param_ui, MD5Utils.encode (SPProvider.getData (Api.param_ui)))
                .execute (new CallBackProxy<CustomApiResult<JSONObject>, JSONObject> (new TipCallBack<JSONObject> () {
                    @Override
                    public void onSuccess ( JSONObject response ) {
                        Logger.json (response.toJSONString ());

                        if (!createdCourses.isEmpty ()){
                            createdCourses.clear ();
                        }
                        if (!joinedCourses.isEmpty ()){
                            joinedCourses.clear ();
                        }

                        //得到创建班课的信息
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

                        //得到加入班课的信息
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
                        TokenUtils.handleLogoutSuccess ();
                        XToastUtils.error ("Token已过期，请重新登录");
                        ActivityCollectorUtil.finishAllActivity ();
                    }

                    @Override
                    public void onStart () {
                        Logger.d ("开始得到班课数据");
                    }
                }) {
                });
    }

    public static void getClassMembers () {
        XHttp.post (Api.CLASSUSERLIST)
                .params (Api.param_ukey, SPProvider.getData (Api.param_ukey))
                .params (Api.param_ui, MD5Utils.encode (SPProvider.getData (Api.param_ui)))
                .params (Api.param_classid, getCourse_id ())
                .execute (new CallBackProxy<CustomApiResult<JSONObject>, JSONObject> (new TipCallBack<JSONObject> () {

                    @Override
                    public void onSuccess ( JSONObject response ) throws Throwable {
                        Logger.json (response.toJSONString ());
                        if (response.getIntValue ("UserCount") != 0) {

                            JSONArray remembers = response.getJSONArray ("UserList");
                            userCount = remembers.size ();
                            if (members.size () < remembers.size ()) {
                                for (Object item : remembers) {
                                    JSONObject member = (JSONObject) item;
                                    members.add (new Member (member.getString ("UserId"), member.getString ("UserName"), member.getString ("UserCode")));
                                }
                            }
                        }

                        if (isCheckAble ()) {
                            try {
                                checkCount = response.getInteger ("CheckCount");
                                point = checkCount * 2;
                            } catch (NullPointerException e) {
                                Logger.d ("CheckCount不存在");
                            }
                        }
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d (e.getDetailMessage ());
                    }
                }) {
                });
    }

    public static AdapterItem[] menuItems = new AdapterItem[]{
            new AdapterItem ("创建班课", R.drawable.createc),
            new AdapterItem ("加入班课", R.drawable.joinc)
    };

    public static void clearMembers () {
        members.clear ();
    }

    public static void initCourse () {
        getCourses ();
    }

    public static void initMember(){
        getClassMembers ();

    }

    /**
     * @return list “我创建的”课程列表
     */
    @MemoryCache
    public static List<Course> getCreatedClassInfos ( int begin ) {
        if (createdCourses.isEmpty ()){
            Logger.d ("createdCourses.isEmpty");
            return emptyCourse;
        }
        else {
            return createdCourses;
        }
    }

    /**
     * @return list “我加入的”课程列表
     */
    @MemoryCache
    public static List<Course> getJoinedClassInfos ( int begin ) {
        if (joinedCourses.isEmpty ()){
            Logger.d ("joinedCourses.isEmpty");
            return emptyCourse;
        }
        else {
            return joinedCourses;
        }
    }

    /**
     * @return list 成员列表
     */
    @MemoryCache
    public static List<Member> getMembers ( int begin ) {
        if (members.isEmpty ()){
            Logger.d ("members.isEmpty");
            return emptyMember;
        }
        else {
            return members;
        }
    }

    public static Course getChoosedCourse () {
        int pos = findPos (createdCourses, course_id);
        if (pos != - 1) {
            return createdCourses.get (pos);
        } else {
            return joinedCourses.get (findPos (joinedCourses, course_id));
        }
    }

    private static int findPos ( List<Course> courses, int id ) {
        for (int i = 0; i < courses.size (); i++) {
            if (courses.get (i).getID () == id) {
                return i;
            }
        }
        return - 1;
    }

    public static void clearCourseData () {
        checkAble = false;
        course_id = 0;
        userCount = 0;
        checkCount = 0;
        point = 0;
        members.clear ();
    }

    public static void clearAllData () {
        checkAble = false;
        course_id = 0;
        userCount = 0;
        checkCount = 0;
        point = 0;
        members.clear ();
        createdCourses.clear ();
        joinedCourses.clear ();
    }

    public static int getCourse_id () {
        return course_id;
    }

    public static void setCourse_id ( int course_id ) {
        DataProvider.course_id = course_id;
    }

    public static int getUserCount () {
        return userCount;
    }

    public static void setUserCount ( int userCount ) {
        DataProvider.userCount = userCount;
    }

    public static int getCheckCount () {
        return checkCount;
    }

    public static void setCheckCount ( int checkCount ) {
        DataProvider.checkCount = checkCount;
    }

    public static boolean isCheckAble () {
        return checkAble;
    }

    public static void setCheckAble ( boolean checkAble ) {
        DataProvider.checkAble = checkAble;
    }

    public static int getPoint () {
        return point;
    }

    public static void setPoint ( int point ) {
        DataProvider.point = point;
    }
}
