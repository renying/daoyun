package com.team28.daoyunapp.fragment.profile;

import android.content.SharedPreferences;
import android.graphics.Color;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.team28.daoyunapp.utils.TokenUtils;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xui.utils.CountDownButtonHelper;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.edittext.PasswordEditText;
import com.xuexiang.xui.widget.edittext.materialedittext.MaterialEditText;
import com.xuexiang.xutil.data.SPUtils;
import com.xuexiang.xutil.tip.ToastUtils;

import butterknife.BindView;
import butterknife.OnClick;

/**
 * 修改密码页面
 *
 * @author wing
 * @since 2020-05-21
 */
@Page(name = "修改密码")
public class ChangePwdFragment extends BaseFragment {

    @BindView(R.id.et_old_password)
    PasswordEditText etOldPassword;
    @BindView(R.id.et_new_password)
    PasswordEditText etNewPassword;
    @BindView(R.id.et_confirm_new_password)
    PasswordEditText etConfirmPassword;

    SharedPreferences spf;

    private CountDownButtonHelper mCountDownHelper;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_change_pwd;
    }

    @Override
    protected void initViews () {
        spf = SPUtils.getSharedPreferences ("user_info");
    }

    @SingleClick
    @OnClick({R.id.btn_change_password})
    public void onViewClicked ( View view ) {
        switch (view.getId ()) {
            case R.id.btn_change_password:
//                if (etOldPassword.validate ()) {
//                    if (etNewPassword.validate ()) {
//                        if (etConfirmPassword.validate ()) {
//                            if (etNewPassword.getEditValue ().equals (etConfirmPassword.getEditValue ())) {
//                                changePassword (etOldPassword.getEditValue (), etNewPassword.getEditValue ());
//                            } else {
//                                ToastUtils.toast ("新密码与确认密码不一致");
//                            }
//                        }
//                    }
//                }
                break;
            default:
                break;
        }
    }

    private void changePassword(String oldPwd, String newPwd){
        XHttp.post (Api.LOGIN)
                .params ("ui", spf.getString ("ui",""))
                .params ("ukey", TokenUtils.getToken ())
                .params ("oldpass",oldPwd)
                .params ("newpass",newPwd)
                .execute (new CallBackProxy<CustomApiResult<Boolean>, Boolean> (new TipCallBack<Boolean> () {
                    @Override
                    public void onSuccess ( Boolean response ) throws Throwable {
                        Logger.d (response);
                        ToastUtils.toast ("修改成功");
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        super.onError (e);
                    }

                }) {
                });
    }


    @Override
    public void onDestroyView () {
        if (mCountDownHelper != null) {
            mCountDownHelper.recycle ();
        }
        super.onDestroyView ();
    }
}
