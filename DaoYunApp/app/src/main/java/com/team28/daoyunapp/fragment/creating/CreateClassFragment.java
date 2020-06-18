package com.team28.daoyunapp.fragment.creating;

import android.content.SharedPreferences;
import android.view.View;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.core.http.Api;
import com.team28.daoyunapp.core.http.CustomApiResult;
import com.team28.daoyunapp.core.http.callback.TipCallBack;
import com.team28.daoyunapp.utils.XToastUtils;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xaop.util.MD5Utils;
import com.xuexiang.xhttp2.XHttp;
import com.xuexiang.xhttp2.callback.CallBackProxy;
import com.xuexiang.xhttp2.exception.ApiException;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.utils.WidgetUtils;
import com.xuexiang.xui.widget.actionbar.TitleBar;
import com.xuexiang.xui.widget.dialog.LoadingDialog;
import com.xuexiang.xui.widget.edittext.MultiLineEditText;
import com.xuexiang.xui.widget.edittext.materialedittext.MaterialEditText;
import com.xuexiang.xutil.data.SPUtils;

import butterknife.BindView;
import butterknife.OnClick;

@Page(anim = CoreAnim.none)
public class CreateClassFragment extends BaseFragment {

    @BindView(R.id.et_class_code)
    MaterialEditText classCode;
    @BindView(R.id.et_class_name)
    MaterialEditText className;
    @BindView(R.id.et_class_desc)
    MultiLineEditText class_desc;

    private SharedPreferences spf;
    private LoadingDialog mLoadingDialog;


    @Override
    protected int getLayoutId () {
        return R.layout.fragment_create_class;
    }

    @Override
    protected TitleBar initTitle () {
        return super.initTitle ().setTitle ("创建班课");
    }

    @Override
    protected void initViews () {
        spf = SPUtils.getSharedPreferences (Api.SPFNAME);
        mLoadingDialog = WidgetUtils.getLoadingDialog (getContext ())
                .setIconScale (0.4F)
                .setLoadingSpeed (8);
    }

    @SingleClick
    @OnClick({R.id.btn_create_class})
    public void onViewClicked ( View view ) {
        switch ((view.getId ())) {
            case R.id.btn_create_class:
                createRequest ();
                break;
            default:
                break;
        }
    }

    private void createRequest () {
        XHttp.post (Api.CREATECLASS)
                .params (Api.param_ukey, SPUtils.getString (spf, Api.param_ukey, ""))
                .params (Api.param_ui, MD5Utils.encode (SPUtils.getString (spf, Api.param_ui, "")))
                .params ("className", className.getEditValue ())
                .params ("classDesc", class_desc.getContentText ())
                .params ("classCode", classCode.getEditValue ())
                .execute (new CallBackProxy<CustomApiResult<Boolean>, Boolean> (new TipCallBack<Boolean> () {
                    @Override
                    public void onSuccess ( Boolean response ) {
                        Logger.d ("创建班课成功");
                        XToastUtils.success ("创建成功");
                        mLoadingDialog.dismiss ();
                        popToBack ();
                    }

                    @Override
                    public void onError ( ApiException e ) {
                        Logger.d (e.getDetailMessage ());
                        super.onError (e);
                        mLoadingDialog.dismiss ();
                    }

                    @Override
                    public void onStart () {
                        mLoadingDialog.show ();
                        super.onStart ();
                    }

                    @Override
                    public void onCompleted () {
                        mLoadingDialog.dismiss ();
                    }
                }) {
                });
    }
}
