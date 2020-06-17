package com.team28.daoyunapp.adapter.entity;

public class Member {
    private String UserId;
    private String UserName;
    private String UserCode;

    public Member ( String userId, String userName, String userCode ) {
        UserId = userId;
        UserName = userName;
        UserCode = userCode;
    }

    public String getUserId () {
        return UserId;
    }

    public void setUserId ( String userId ) {
        UserId = userId;
    }

    public String getUserName () {
        return UserName;
    }

    public void setUserName ( String userName ) {
        UserName = userName;
    }

    public String getUserCode () {
        return UserCode;
    }

    public void setUserCode ( String userCode ) {
        UserCode = userCode;
    }

    @Override
    public String toString () {
        return "Member{" +
                "UserId='" + UserId + '\'' +
                ", UserName='" + UserName + '\'' +
                ", UserCode='" + UserCode + '\'' +
                '}';
    }
}
