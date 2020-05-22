package com.team28.daoyunapp.core.http;

import com.xuexiang.xhttp2.model.ApiResult;

public class CustomApiResult<T> extends ApiResult<T>{

    @Override
    public boolean isSuccess () {
        return super.getCode () == 1;
    }

}
