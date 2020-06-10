package com.team28.daoyunapp.fragment;

import android.content.SharedPreferences;
import android.graphics.Color;
import android.view.View;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.activity.LoginActivity;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.team28.daoyunapp.utils.PrivacyUtils;
import com.team28.daoyunapp.utils.SettingSPUtils;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.utils.CountDownButtonHelper;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.edittext.materialedittext.MaterialEditText;
import com.xuexiang.xutil.app.ActivityUtils;
import com.xuexiang.xutil.data.SPUtils;

import butterknife.BindView;
import butterknife.OnClick;


/**
 * 注册页面
 *
 * @author wing
 * @since 2020-05-15
 */
@Page(anim = CoreAnim.slide)
public class RegisterFragment extends BaseFragment {

    @BindView(R.id.et_register_account)
    MaterialEditText etAccount;
    @BindView(R.id.et_register_password)
    MaterialEditText etPassword;
    @BindView(R.id.et_confirm_password)
    MaterialEditText etPasswordConfirm;

    private CountDownButtonHelper mCountDownHelper;

    SharedPreferences spf;

    @Override
    protected TitleBar initTitle () {
        TitleBar titleBar = super.initTitle ()
                .setImmersive (true);
        titleBar.setBackgroundColor (Color.TRANSPARENT);
        titleBar.setTitle ("");
        titleBar.setLeftImageDrawable (ResUtils.getVectorDrawable (getContext (), R.drawable.ic_login_close));
        return titleBar;
    }

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_register;
    }

    @Override
    protected void initViews () {
        spf = SPUtils.getSharedPreferences ("user_info");

        //隐私政策弹窗
        SettingSPUtils spUtils = SettingSPUtils.getInstance ();
        if (! spUtils.isAgreePrivacy ()) {
            PrivacyUtils.showPrivacyDialog (getContext (), ( dialog, which ) -> {
                dialog.dismiss ();
                spUtils.setIsAgreePrivacy (true);
            });
        }
    }

    @SingleClick
    @OnClick({R.id.btn_register, R.id.tv_returnToLogin, R.id.tv_register_forget_password, R.id.tv_register_user_protocol, R.id.tv_register_privacy_protocol})
    public void onViewClicked ( View view ) {
        switch ((view.getId ())) {
            case R.id.btn_register:
                if (etAccount.validate ()) {
                    if (etPassword.validate ()) {
                        if (etPassword.getEditValue ().equals (etPasswordConfirm.getEditValue ()))
                            registerByPassword (etAccount.getEditValue (), etPassword.getEditValue ());
                        else {
                            Logger.d (etAccount.getEditValue () + "\n" + etPassword.getEditValue ());
                            XToastUtils.error ("两次密码不一样");
                        }
                    }
                }
                break;
            case R.id.tv_returnToLogin:
                popToBack ();
                ActivityUtils.startActivity (LoginActivity.class);
                break;
            case R.id.tv_register_forget_password:
                XToastUtils.info ("忘记密码");
                break;
            case R.id.tv_register_user_protocol:
                XToastUtils.info ("用户协议");
                break;
            case R.id.tv_register_privacy_protocol:
                XToastUtils.info ("隐私政策");
                break;
            default:
                break;
        }
    }

    private void registerByPassword ( String account, String password ) {

        XHttp.post (Api.REGISTER)
                .params ("u", account)
                .params ("p", password)
                .execute (new CallBackProxy<CustomApiResult<String>, String> (new TipCallBack<String> () {
                    @Override
                    public void onSuccess ( String response ) throws Throwable {
                        Logger.d (response);
                        XToastUtils.success ("注册成功");
                        popToBack ();
                        openNewPage (LoginFragment.class);
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d (e);
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
