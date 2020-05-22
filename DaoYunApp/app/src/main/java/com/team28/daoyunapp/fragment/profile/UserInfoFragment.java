package com.team28.daoyunapp.fragment.profile;

import android.content.SharedPreferences;

import android.util.Log;
import android.view.View;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.activity.LoginActivity;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xui.utils.Utils;
import com.xuexiang.xui.widget.picker.widget.OptionsPickerView;
import com.xuexiang.xui.widget.picker.widget.TimePickerView;
import com.xuexiang.xui.widget.picker.widget.builder.OptionsPickerBuilder;
import com.xuexiang.xui.widget.picker.widget.builder.TimePickerBuilder;
import com.xuexiang.xui.widget.picker.widget.listener.OnOptionsSelectListener;
import com.xuexiang.xui.widget.picker.widget.listener.OnTimeSelectChangeListener;
import com.xuexiang.xui.widget.picker.widget.listener.OnTimeSelectListener;
import com.xuexiang.xui.widget.textview.supertextview.SuperTextView;
import com.xuexiang.xutil.app.ActivityUtils;
import com.xuexiang.xutil.common.StringUtils;
import com.xuexiang.xutil.data.DateUtils;
import com.xuexiang.xutil.data.SPUtils;

import java.text.DateFormat;
import java.util.Date;
import java.util.Objects;

import butterknife.BindView;
import butterknife.OnClick;

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

    @BindView(R.id.tv_info_username)
    SuperTextView userName;
    @BindView(R.id.tv_info_realname)
    SuperTextView realName;
    @BindView(R.id.tv_info_nickname)
    SuperTextView nickName;
    @BindView(R.id.tv_info_bornDate)
    SuperTextView bornDate;
    @BindView(R.id.tv_info_sex)
    SuperTextView userSex;
    @BindView(R.id.tv_info_address)
    SuperTextView address;


    private String[] mSexOption;
    private int sexSelectOption = 0;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_user_info;
    }

    @Override
    protected void initViews () {

        spf = SPUtils.getSharedPreferences ("user_info");
        mSexOption = ResUtils.getStringArray(R.array.sex_option);

        userName.setRightString (spf.getString ("UserName", ""));
        realName.setCenterEditString (spf.getString ("RealName", ""));
        nickName.setCenterEditString (spf.getString ("NickName", ""));
        bornDate.setCenterString (spf.getString ("BornDate", ""));
        userSex.setCenterString(mSexOption[StringUtils.toInt (spf.getString ("UserSex","1"))]);
        address.setCenterEditString (spf.getString ("Address", ""));

    }

    @SingleClick
    @OnClick({R.id.tv_info_bornDate, R.id.tv_info_sex})
    public void onViewClicked ( View view ) {
        switch ((view.getId ())) {
            case R.id.tv_info_bornDate:
                showDatePicker ();
                break;
            case R.id.tv_info_sex:
                showSexPickerView ();
                break;
            default:
                break;
        }
    }

    private void showDatePicker () {
        mDatePicker = new TimePickerBuilder (getContext (), ( date, v ) -> bornDate.setCenterString (DateUtils.date2String (date, DateUtils.yyyyMMdd.get ())))
                .setTimeSelectChangeListener (date -> Logger.d ("pvTime", "onTimeSelectChanged"))
                .setTitleText ("日期选择")
                .build ();
        mDatePicker.show ();
    }

    /**
     * 性别选择
     */
    private void showSexPickerView() {
        OptionsPickerView pvOptions = new OptionsPickerBuilder (getContext(), new OnOptionsSelectListener () {
            @Override
            public boolean onOptionsSelect(View v, int options1, int options2, int options3) {
                userSex.setCenterString(mSexOption[options1]);
                sexSelectOption = options1;
                return false;
            }
        })
                .setTitleText("请选择性别")
                .setSelectOptions(sexSelectOption)
                .build();
        pvOptions.setPicker(mSexOption);
        pvOptions.show();
    }
}
