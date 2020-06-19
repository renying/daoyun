package com.team28.daoyunapp.fragment;

import android.content.SharedPreferences;
import android.graphics.Color;
import android.view.View;

import com.alibaba.fastjson.JSONObject;
import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.activity.RegisterActivity;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xaop.util.MD5Utils;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.utils.CountDownButtonHelper;
import com.xuexiang.xui.utils.ResUtils;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xui.widget.edittext.materialedittext.MaterialEditText;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.activity.MainActivity;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.PrivacyUtils;
import com.team28.daoyunapp.utils.SettingSPUtils;
import com.team28.daoyunapp.utils.TokenUtils;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xutil.app.ActivityUtils;
import com.xuexiang.xutil.data.SPUtils;

import butterknife.BindView;
import butterknife.OnClick;

/**
 * 登录页面
 *
 * @author zengjun
 * @since 2020-04-17 22:15
 */
@Page(anim = CoreAnim.slide)
public class LoginFragment extends BaseFragment {

    @BindView(R.id.et_account)
    MaterialEditText etAccount;
    @BindView(R.id.et_password)
    MaterialEditText etPassword;

    private SharedPreferences spf;

    private CountDownButtonHelper mCountDownHelper;

    private LoadingDialog mLoadingDialog;

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

        spf = SPUtils.getSharedPreferences ("user_info");
        mLoadingDialog = WidgetUtils.getLoadingDialog(getContext())
                .setIconScale(0.4F)
                .setLoadingSpeed(8);
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
                        mLoadingDialog.show();
                        loginByPassword (etAccount.getEditValue (), etPassword.getEditValue ());
                    }
                }
                break;
            case R.id.tv_register:
                popToBack ();
                ActivityUtils.startActivity (RegisterActivity.class);
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

    private void loginByPassword ( String account, String password ) {
        XHttp.post (Api.LOGIN)
                .params ("u", account)
                .params ("p", password)
                .execute (new CallBackProxy<CustomApiResult<JSONObject>, JSONObject> (new TipCallBack<JSONObject> () {
                    @Override
                    public void onSuccess ( JSONObject response ) {
                        Logger.json (response.toJSONString ());
                        String ukey = response.getString ("ukey");
                        String ui = response.getString ("userid");
                        SPUtils.put (spf,Api.param_ui,ui);
                        SPUtils.put (spf,Api.param_ukey,response.getString (Api.param_ukey));

                        getUserInfo (ui,ukey);

                        if (TokenUtils.handleLoginSuccess (ukey)) {
                            mLoadingDialog.dismiss ();
                            popToBack ();
                            ActivityUtils.startActivity (MainActivity.class);
                        }
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        mLoadingDialog.dismiss ();
                        Logger.d(e);
                        super.onError (e);
                    }

                    @Override
                    public void onCompleted () {

                        mLoadingDialog.dismiss ();
                    }
                }) {
                });
    }

    private void getUserInfo(String ui,String ukey){
        XHttp.post (Api.USERINFO)
                .params ("ui", MD5Utils.encode (ui))
                .params ("ukey",ukey)
                .execute (new CallBackProxy<CustomApiResult<JSONObject>,JSONObject> (new TipCallBack<JSONObject> () {
                    @Override
                    public void onSuccess ( JSONObject response ) {
                        Logger.json (response.toJSONString ());

                        SPUtils.put (spf,"UserName",response.getString ("UserName"));
                        SPUtils.put (spf,"NickName",response.getString ("NickName"));
                        SPUtils.put (spf,"BornDate",response.getString ("BornDate"));
                        SPUtils.put (spf,"UserSex",response.getString ("UserSex"));
                        SPUtils.put (spf,"UserType",response.getString ("UserType"));
                        SPUtils.put (spf,"CountryId",response.getString ("CountryId"));
                        SPUtils.put (spf,"Address",response.getString ("Address"));
                        SPUtils.put (spf,"SchoolId",response.getString ("SchoolId"));
                        SPUtils.put (spf,"UserCode",response.getString ("UserCode"));
                        SPUtils.put (spf,"RealName",response.getString ("RealName"));
                        SPUtils.put (spf,"Phone",response.getString ("Phone"));
                        mLoadingDialog.dismiss ();
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        mLoadingDialog.dismiss ();
                        Logger.d (e);
                        super.onError (e);
                    }

                    @Override
                    public void onCompleted () {
                        mLoadingDialog.dismiss ();
                    }
                }){});
    }

    @Override
    public void onDestroyView () {
        if (mCountDownHelper != null) {
            mCountDownHelper.recycle ();
        }
        mLoadingDialog.recycle();
        super.onDestroyView ();
    }
}
