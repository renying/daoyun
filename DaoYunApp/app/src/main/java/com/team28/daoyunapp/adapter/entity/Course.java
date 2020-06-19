package com.team28.daoyunapp.adapter.entity;

import java.util.Date;

public class Course {
    private int ID;
    private String name;
    private String code;
    private String desc;
    private Date createTime;
    private String creator;
    private String creatorCode;
    private String schoolInfo;

    public Course ( int ID, String name, String code, String desc, Date createTime, String creator, String creatorCode, String schoolInfo ) {
        this.ID = ID;
        this.name = name;
        this.code = code;
        this.desc = desc;
        this.createTime = createTime;
        this.creator = creator;
        this.creatorCode = creatorCode;
        this.schoolInfo = schoolInfo;
    }

    public Course () {
    }

    public int getID () {
        return ID;
    }

    public void setID ( int ID ) {
        this.ID = ID;
    }

    public String getName () {
        return name;
    }

    public void setName ( String name ) {
        this.name = name;
    }

    public String getCode () {
        return code;
    }

    public void setCode ( String code ) {
        this.code = code;
    }

    public String getDesc () {
        return desc;
    }

    public void setDesc ( String desc ) {
        this.desc = desc;
    }

    public Date getCreateTime () {
        return createTime;
    }

    public void setCreateTime ( Date createTime ) {
        this.createTime = createTime;
    }

    public String getCreator () {
        return creator;
    }

    public void setCreator ( String creator ) {
        this.creator = creator;
    }

    public String getCreatorCode () {
        return creatorCode;
    }

    public void setCreatorCode ( String creatorCode ) {
        this.creatorCode = creatorCode;
    }

    public String getSchoolInfo () {
        return schoolInfo;
    }

    public void setSchoolInfo ( String schoolInfo ) {
        this.schoolInfo = schoolInfo;
    }

    @Override
    public String toString () {
        return "Course{" +
                "ID=" + ID +
                ", name='" + name + '\'' +
                ", code='" + code + '\'' +
                ", desc='" + desc + '\'' +
                ", createTime=" + createTime +
                ", creator='" + creator + '\'' +
                ", creatorCode='" + creatorCode + '\'' +
                ", schoolInfo='" + schoolInfo + '\'' +
                '}';
    }
}
