
package com.team28.daoyunapp.utils.update;

import com.xuexiang.xupdate.entity.UpdateEntity;
import com.xuexiang.xupdate.proxy.impl.AbstractUpdateParser;

/**
 * 版本更新信息自定义json解析器
 *
 * @author xuexiang
 * @since 2020-02-18 13:01
 */
public class CustomUpdateParser extends AbstractUpdateParser {

    @Override
    public UpdateEntity parseJson(String json) throws Exception {
        // TODO: 2020-02-18 这里填写你需要自定义的json格式
        return null;
    }

}
