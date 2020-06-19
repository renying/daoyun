package com.team28.daoyunapp.fragment.profile;

import android.content.SharedPreferences;
import android.graphics.Color;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;

import androidx.annotation.NonNull;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
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
import com.xuexiang.xui.utils.CountDownButtonHelper;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xui.widget.edittext.PasswordEditText;
import com.xuexiang.xui.widget.edittext.materialedittext.MaterialEditText;
import com.xuexiang.xui.widget.edittext.materialedittext.validation.METValidator;
import com.xuexiang.xui.widget.edittext.materialedittext.validation.RegexpValidator;
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
    MaterialEditText etOldPassword;
    @BindView(R.id.et_new_password)
    MaterialEditText etNewPassword;
    @BindView(R.id.et_confirm_new_password)
    MaterialEditText etConfirmPassword;
    private LoadingDialog mLoadingDialog;
    private SharedPreferences spf;

    private CountDownButtonHelper mCountDownHelper;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_change_pwd;
    }

    @Override
    protected void initViews () {
        mLoadingDialog = WidgetUtils.getLoadingDialog (getContext ())
                .setIconScale (0.4F)
                .setLoadingSpeed (8);
        spf = SPUtils.getSharedPreferences (Api.SPFNAME);
        etConfirmPassword.validateWith (new METValidator ("两次输入密码必须保持一致") {
            @Override
            public boolean isValid ( @NonNull CharSequence text, boolean isEmpty ) {
                if (! isEmpty) {
                    return etNewPassword.getEditValue ().equals (etConfirmPassword.getEditValue ());
                }
                return false;
            }
        });
    }

    @SingleClick
    @OnClick({R.id.btn_change_password})
    public void onViewClicked ( View view ) {
        switch (view.getId ()) {
            case R.id.btn_change_password:
                changePassword (etOldPassword.getEditValue (),etNewPassword.getEditValue ());
                break;
            default:
                break;
        }
    }
    private void changePassword ( String oldPwd, String newPwd ) {
        XHttp.post (Api.CHANGEPASSWORD)
                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf, Api.param_ui, "")))
                .params (Api.param_ukey, SPUtils.getString (spf,Api.param_ukey,""))
                .params ("oldpass", oldPwd)
                .params ("newpass", newPwd)
                .execute (new CallBackProxy<CustomApiResult<String>, String> (new TipCallBack<String> () {
                    @Override
                    public void onSuccess ( String response ) throws Throwable {
                        Logger.d (response);
                        XToastUtils.toast ("修改成功");
                        mLoadingDialog.dismiss ();
                    }
                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d(e.getDetailMessage ()  );
                        super.onError (e);
                        mLoadingDialog.dismiss ();
                    }

                    @Override
                    public void onStart () {
                        mLoadingDialog.show ();
                    }

                    @Override
                    public void onCompleted () {
                        mLoadingDialog.dismiss ();
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
