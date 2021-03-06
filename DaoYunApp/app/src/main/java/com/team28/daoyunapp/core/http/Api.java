package com.team28.daoyunapp.core.http;

public class Api {

    private static final String BASE_URL="http://47.94.234.206/";
    //登录接口
    public static String LOGIN = BASE_URL +"api/user-login";
    //注册接口
    public static String REGISTER = BASE_URL +"api/user-register";
    //用户信息修改接口
    public static String UPDATEINFO = BASE_URL +"api/user-updateinfo";
    //用户信息获取接口
    public static String USERINFO = BASE_URL +"api/get-userinfo";
    //班课信息获取接口
    public static String CLASSINFO = BASE_URL +"api/get-classinfo";
    //班课成员信息获取
    public static String CLASSUSERLIST = BASE_URL +"api/get-classuserlist";
    //消息通知列表获取
    public static String USERNOTICELIST = BASE_URL +"api/get-usernoticelist";
    //消息通知详情
    public static String NOTICEINFOLIST = BASE_URL +"api/get-noticeinfolist";
    //创建班课
    public static String CREATECLASS = BASE_URL +"api/add-classinfo";
    //修改密码
    public static String CHANGEPASSWORD = BASE_URL +"api/change-pass";
    //签到
    public static String CHECKIN = BASE_URL +"api/checkin";
    //加入班课接口
    public static String CHOOSECLASS = BASE_URL +"api/choose-class";
    //发起签到接口
    public static String STARTCHECKIN = BASE_URL +"api/startcheckin";

    public static String param_ui = "ui";
    public static String param_ukey = "ukey";
    public static String param_nickName = "NickName";
    public static String param_bornDate = "BornDate";
    public static String param_address = "Address";
    public static String param_phone = "Phone";
    public static String param_userCode = "UserCode";
    public static String param_realName = "RealName";
    public static String param_userSex = "UserSex";
    public static String param_classid = "classid";
    public static String param_classCode = "ClassCode";
    public static String SPFNAME = "user_info";
    public static String param_duration = "duration";
    public static String param_longitude = "longitude";
    public static String param_latitude = "latitude";
}
