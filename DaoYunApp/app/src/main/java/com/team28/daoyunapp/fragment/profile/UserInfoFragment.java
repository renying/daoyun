package com.team28.daoyunapp.fragment.profile;

import android.content.SharedPreferences;

import android.util.Log;
import android.view.View;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xui.widget.picker.widget.TimePickerView;
import com.xuexiang.xui.widget.picker.widget.builder.TimePickerBuilder;
import com.xuexiang.xui.widget.picker.widget.listener.OnTimeSelectChangeListener;
import com.xuexiang.xui.widget.picker.widget.listener.OnTimeSelectListener;
import com.xuexiang.xui.widget.textview.supertextview.SuperTextView;
import com.xuexiang.xutil.data.DateUtils;
import com.xuexiang.xutil.data.SPUtils;

import java.util.Date;
import java.util.Objects;

import butterknife.BindView;

/**
 * 个人信息页面
 *
 * @author wing
 * @since 2020-05-21
 */
@Page(name = "个人信息")
public class UserInfoFragment extends BaseFragment {

    private TimePickerView mDatePicker;

    SharedPreferences spf;

    @BindView(R.id.tv_info_realname)
    SuperTextView realName;
    @BindView(R.id.tv_info_bornDate)
    SuperTextView bornDate;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_user_info;
    }

    @Override
    protected void initViews () {
        spf = SPUtils.getSharedPreferences ("user_info");

        realName.setLeftString ("真实姓名");
        bornDate.setLeftString ("出生日期");
        realName.setCenterEditString (spf.getString ("RealName", ""));
        bornDate.setCenterEditString (spf.getString ("BornDate", ""));
    }

    private void showDatePicker () {
        if (mDatePicker == null) {
            mDatePicker = new TimePickerBuilder (Objects.requireNonNull (getContext ()), new OnTimeSelectListener () {
                @Override
                public void onTimeSelected ( Date date, View v ) {
                    XToastUtils.toast (DateUtils.date2String (date, DateUtils.yyyyMMdd.get ()));
                }
            })
                    .setTimeSelectChangeListener (new OnTimeSelectChangeListener () {
                        @Override
                        public void onTimeSelectChanged ( Date date ) {
                            Logger.d (date);
                        }
                    })
                    .setTitleText ("日期选择")
                    .build ();
        }
        mDatePicker.show ();
    }
}
