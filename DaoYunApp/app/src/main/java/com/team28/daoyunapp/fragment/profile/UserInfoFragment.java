package com.team28.daoyunapp.fragment.profile;

import android.content.SharedPreferences;

import android.util.Log;
import android.view.View;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.activity.LoginActivity;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.team28.daoyunapp.utils.TokenUtils;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xaop.util.MD5Utils;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xui.utils.Utils;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xui.widget.picker.widget.OptionsPickerView;
import com.xuexiang.xui.widget.picker.widget.TimePickerView;
import com.xuexiang.xui.widget.picker.widget.builder.OptionsPickerBuilder;
import com.xuexiang.xui.widget.picker.widget.builder.TimePickerBuilder;
import com.xuexiang.xui.widget.picker.widget.listener.OnOptionsSelectListener;
import com.xuexiang.xui.widget.picker.widget.listener.OnTimeSelectChangeListener;
import com.xuexiang.xui.widget.picker.widget.listener.OnTimeSelectListener;
import com.xuexiang.xui.widget.textview.supertextview.SuperTextView;
import com.xuexiang.xutil.app.ActivityUtils;
import com.xuexiang.xutil.app.FragmentUtils;
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

    private SharedPreferences spf;

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

    private LoadingDialog mLoadingDialog;

    private String[] mSexOption;
    private int sexSelectOption = 0;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_user_info;
    }

    @Override
    protected void initViews () {
        mLoadingDialog = WidgetUtils.getLoadingDialog (getContext ())
                .setIconScale (0.4F)
                .setLoadingSpeed (8);
        mLoadingDialog.show ();
        spf = SPUtils.getSharedPreferences (Api.SPFNAME);
        mSexOption = ResUtils.getStringArray(R.array.sex_option);

        userName.setRightString (spf.getString ("UserName", ""));
        realName.setCenterEditString (spf.getString ("RealName", ""));
//        realName.setCenterTextColor (111111);
        nickName.setCenterEditString (spf.getString ("NickName", ""));
        bornDate.setCenterString (spf.getString ("BornDate", ""));
        userSex.setCenterString(mSexOption[StringUtils.toInt (spf.getString ("UserSex","1"))]);
        address.setCenterEditString (spf.getString ("Address", ""));
        mLoadingDialog.dismiss ();
    }

    @SingleClick
    @OnClick({R.id.tv_info_bornDate, R.id.tv_info_sex, R.id.btn_update_userInfo})
    public void onViewClicked ( View view ) {
        switch ((view.getId ())) {
            case R.id.tv_info_bornDate:
                showDatePicker ();
                break;
            case R.id.tv_info_sex:
                showSexPickerView ();
                break;
            case R.id.btn_update_userInfo:
                updateUserInfo ();
            default:
                break;
        }
    }

    private void showDatePicker () {
        TimePickerView mDatePicker = new TimePickerBuilder (getContext (), ( date, v ) -> bornDate.setCenterString (DateUtils.date2String (date, DateUtils.yyyyMMdd.get ())))
                .setTimeSelectChangeListener (date -> Logger.d ("TimeSelecting"))
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

    private void updateUserInfo(){
        XHttp.post (Api.UPDATEINFO)
                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf, Api.param_ui, "")))
                .params (Api.param_ukey, SPUtils.getString (spf,Api.param_ukey,""))
                .params (Api.param_nickName,nickName.getCenterEditValue ())
                .params (Api.param_bornDate,bornDate.getCenterEditValue ())
                .params (Api.param_realName,realName.getCenterEditValue ())
                .params (Api.param_address,address.getCenterEditValue ())
                .params (Api.param_userSex,userSex.getCenterEditValue ())
                .execute (new CallBackProxy<CustomApiResult<String>,String> (new TipCallBack<String> () {
                    @Override
                    public void onSuccess ( String response ) throws Throwable {
                        SPUtils.putString (spf, Api.param_nickName, nickName.getCenterEditValue ());
                        SPUtils.putString (spf, Api.param_bornDate,bornDate.getCenterEditValue ());
                        SPUtils.putString (spf, Api.param_realName,realName.getCenterEditValue ());
                        SPUtils.putString (spf, Api.param_address,address.getCenterEditValue ());
                        SPUtils.putString (spf, Api.param_userSex,userSex.getCenterEditValue ());
                        XToastUtils.success ("修改成功");
                        mLoadingDialog.dismiss ();
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d(e);
                        mLoadingDialog.dismiss ();
                        super.onError (e);
                    }

                    @Override
                    public void onStart () {
                        mLoadingDialog.show ();
                    }

                    @Override
                    public void onCompleted () {
                        mLoadingDialog.dismiss ();
                    }
                }){});
    }
}
