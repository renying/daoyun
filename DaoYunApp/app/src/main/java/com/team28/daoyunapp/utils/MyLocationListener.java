package com.team28.daoyunapp.utils;

import com.baidu.location.BDAbstractLocationListener;
import com.baidu.location.BDLocation;

public class MyLocationListener extends BDAbstractLocationListener {
    private double latitude;
    private double longitude;
    private float radius;
    private String coorType;
    private int errorCode;

    @Override
    public void onReceiveLocation ( BDLocation bdLocation ) {
        //此处的BDLocation为定位结果信息类，通过它的各种get方法可获取定位相关的全部结果

        if (bdLocation != null){
            //获取纬度信息
            latitude = bdLocation.getLatitude();
            //获取经度信息
            longitude = bdLocation.getLongitude();
            //获取定位精度，默认值为0.0f
            radius = bdLocation.getRadius();
            //获取经纬度坐标类型，以LocationClientOption中设置过的坐标类型为准
            coorType = bdLocation.getCoorType();
            //获取定位类型、定位错误返回码，具体信息可参照类参考中BDLocation类中的说明
            errorCode = bdLocation.getLocType();
        }
    }

    public double getLatitude () {
        return latitude;
    }

    public double getLongitude () {
        return longitude;
    }

    public float getRadius () {
        return radius;
    }

    public String getCoorType () {
        return coorType;
    }

    public int getErrorCode () {
        return errorCode;
    }
}
