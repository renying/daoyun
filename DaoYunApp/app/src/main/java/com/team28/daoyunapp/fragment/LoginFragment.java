package com.team28.daoyunapp.fragment;

import android.graphics.Color;
import android.view.View;

import com.team28.daoyunapp.utils.PrivacyUtils;
import com.team28.daoyunapp.utils.SettingSPUtils;
import com.team28.daoyunapp.utils.TokenUtils;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.utils.CountDownButtonHelper;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.button.roundbutton.RoundButton;
import com.xuexiang.xui.widget.edittext.materialedittext.MaterialEditText;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.activity.MainActivity;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xutil.app.ActivityUtils;
import com.xuexiang.xutil.common.RandomUtils;
import com.team28.daoyunapp.utils.XToastUtils;

import butterknife.BindView;
import butterknife.OnClick;

/**
 * 登录页面
 *
 */
@Page(anim = CoreAnim.none)
public class LoginFragment extends BaseFragment {

    @BindView(R.id.et_phone_number)
    MaterialEditText etPhoneNumber;
    @BindView(R.id.et_verify_code)
    MaterialEditText etVerifyCode;
    @BindView(R.id.btn_get_verify_code)
    RoundButton btnGetVerifyCode;

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
        mCountDownHelper = new CountDownButtonHelper (btnGetVerifyCode, 60);

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
    @OnClick({R.id.btn_get_verify_code, R.id.btn_login, R.id.tv_other_login, R.id.tv_forget_password, R.id.tv_user_protocol, R.id.tv_privacy_protocol})
    public void onViewClicked ( View view ) {
        switch (view.getId ()) {
            case R.id.btn_get_verify_code:
                if (etPhoneNumber.validate ()) {
                    getVerifyCode (etPhoneNumber.getEditValue ());
                }
                break;
            case R.id.btn_login:
                if (etPhoneNumber.validate ()) {
                    if (etVerifyCode.validate ()) {
                        loginByVerifyCode (etPhoneNumber.getEditValue (), etVerifyCode.getEditValue ());
                    }
                }
                break;
            case R.id.tv_other_login:
                XToastUtils.info ("其他登录方式");
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

    /**
     * 获取验证码
     */
    private void getVerifyCode ( String phoneNumber ) {
        // 这里只是界面演示而已
        XToastUtils.warning ("只是演示，验证码请随便输");
        mCountDownHelper.start ();
    }

    /**
     * 根据验证码登录
     *
     * @param phoneNumber 手机号
     * @param verifyCode  验证码
     */
    private void loginByVerifyCode ( String phoneNumber, String verifyCode ) {
        // 这里只是界面演示而已
        String token = RandomUtils.getRandomNumbersAndLetters (16);
        if (TokenUtils.handleLoginSuccess (token)) {
            popToBack ();
            ActivityUtils.startActivity (MainActivity.class);
        }
    }


    @Override
    public void onDestroyView () {
        if (mCountDownHelper != null) {
            mCountDownHelper.recycle ();
        }
        super.onDestroyView ();
    }
}
