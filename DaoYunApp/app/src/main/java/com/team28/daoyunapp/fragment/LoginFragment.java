package com.team28.daoyunapp.fragment;

import android.graphics.Color;
import android.view.View;

import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
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
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.activity.MainActivity;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.PrivacyUtils;
import com.team28.daoyunapp.utils.SettingSPUtils;
import com.team28.daoyunapp.utils.TokenUtils;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xutil.app.ActivityUtils;

import org.json.JSONException;
import org.json.JSONObject;

import butterknife.BindView;
import butterknife.OnClick;


/**
 * 登录页面
 *
 * @author xuexiang
 * @since 2019-11-17 22:15
 */
@Page(anim = CoreAnim.none)
public class LoginFragment extends BaseFragment {

    @BindView(R.id.et_account)
    MaterialEditText etAccount;
    @BindView(R.id.et_password)
    MaterialEditText etPassword;

    private CountDownButtonHelper mCountDownHelper;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_login;
    }

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
    protected void initViews () {

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
    @OnClick({R.id.btn_login, R.id.tv_register, R.id.tv_forget_password, R.id.tv_user_protocol, R.id.tv_privacy_protocol})
    public void onViewClicked ( View view ) {
        switch (view.getId ()) {
            case R.id.btn_login:
                if (etAccount.validate ()) {
                    if (etPassword.validate ()) {
                        loginByPassword (etAccount.getEditValue (), etPassword.getEditValue ());
                    }
                }
                break;
            case R.id.tv_register:
                XToastUtils.info ("注册");
                break;
            case R.id.tv_forget_password:
                XToastUtils.info ("忘记密码");
                break;
            case R.id.tv_user_protocol:
                XToastUtils.info ("用户协议");
                break;
            case R.id.tv_privacy_protocol:
                XToastUtils.info ("隐私政策");
                break;
            default:
                break;
        }
    }

//    /**
//     * 获取验证码
//     */
//    private void getVerifyCode ( String phoneNumber ) {
//        // TODO: 2019-11-18 这里只是界面演示而已
//        XToastUtils.warning ("只是演示，验证码请随便输");
//        mCountDownHelper.start ();
//    }
//
//    /**
//     * 根据验证码登录
//     *
//     * @param phoneNumber 手机号
//     * @param verifyCode  验证码
//     */
//    private void loginByVerifyCode ( String phoneNumber, String verifyCode ) {
//        // TODO: 2019-11-18 这里只是界面演示而已
//        String token = RandomUtils.getRandomNumbersAndLetters (16);
//        if (TokenUtils.handleLoginSuccess (token)) {
//            popToBack ();
//            ActivityUtils.startActivity (MainActivity.class);
//        }
//    }

    private void loginByPassword ( String account, String password ) {
        //获取当前时间
//        SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyyMMddHHmmss", Locale.getDefault());// HH:mm:ss//获取当前时间
//        Date date = new Date(System.currentTimeMillis());
//        String timeStamp = "Date获取当前日期时间"+simpleDateFormat.format(date);
        //通信
        JSONObject loginJson = new JSONObject ();
        try {
            loginJson.put ("u",account);
            loginJson.put ("p",password);
        } catch (JSONException e) {
            e.printStackTrace ();
        }
//        String loginJson = "{\"u\":\"" + account + "\",\"p\":\"" + password + "\"}";
        XHttp.post (Api.LOGIN)
                .upJson (loginJson.toString ())
                .execute (new CallBackProxy<CustomApiResult<Boolean>, Boolean> (new TipCallBack<Boolean> () {
                    @Override
                    public void onSuccess ( Boolean response ) throws Throwable {
                        if (TokenUtils.handleLoginSuccess (account)) {
                            popToBack ();
                            ActivityUtils.startActivity (MainActivity.class);
                        }
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
