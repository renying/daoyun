package com.team28.daoyunapp.fragment.profile;

import android.content.SharedPreferences;

import com.alibaba.fastjson.JSON;
import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.ActivityCollectorUtil;
import com.team28.daoyunapp.utils.DataProvider;
import com.team28.daoyunapp.utils.SPProvider;
import com.team28.daoyunapp.utils.TokenUtils;
import com.team28.daoyunapp.utils.XToastUtils;
import com.team28.daoyunapp.R;
import com.xuexiang.xaop.annotation.SingleClick;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xui.widget.dialog.materialdialog.DialogAction;
import com.xuexiang.xui.widget.dialog.materialdialog.MaterialDialog;
import com.xuexiang.xui.widget.textview.supertextview.SuperTextView;
import com.xuexiang.xutil.data.SPUtils;

import java.util.Objects;

import butterknife.BindView;

@Page(name = "设置")
public class SettingsFragment extends BaseFragment implements SuperTextView.OnSuperTextViewClickListener {

    @BindView(R.id.menu_common)
    SuperTextView menuCommon;
    @BindView(R.id.menu_privacy)
    SuperTextView menuPrivacy;
    @BindView(R.id.menu_accountSafety)
    SuperTextView menuChangePwd;
    @BindView(R.id.menu_helper)
    SuperTextView menuHelper;
    @BindView(R.id.menu_logout)
    SuperTextView menuLogout;

    private SharedPreferences spf;

    @Override
    protected int getLayoutId() {
        return R.layout.fragment_settings;
    }

    @Override
    protected void initViews() {
        menuCommon.setOnSuperTextViewClickListener(this);
        menuPrivacy.setOnSuperTextViewClickListener(this);
        menuChangePwd.setOnSuperTextViewClickListener(this);
        menuHelper.setOnSuperTextViewClickListener(this);
        menuLogout.setOnSuperTextViewClickListener(this);

        spf = SPUtils.getSharedPreferences ("user_info");
    }

    @SingleClick
    @Override
    public void onClick(SuperTextView superTextView) {
        switch(superTextView.getId()) {
            case R.id.menu_common:
            case R.id.menu_helper:
                XToastUtils.toast(superTextView.getLeftString());
                Logger.json (JSON.toJSONString (spf.getAll ()));
                Logger.d (TokenUtils.getToken ());
                break;
            case R.id.menu_privacy:
                XToastUtils.toast(superTextView.getLeftString());
                break;
            case R.id.menu_accountSafety:
                openNewPage (ChangePwdFragment.class);
                break;
            case R.id.menu_logout:
                new MaterialDialog.Builder(getContext())
                        .content(R.string.lab_logout_confirm)
                        .positiveText(R.string.lab_yes)
                        .onPositive(new MaterialDialog.SingleButtonCallback() {
                            @Override
                            public void onClick(MaterialDialog dialog, DialogAction which) {
                                dialog.dismiss ();
                                TokenUtils.handleLogoutSuccess ();
                                Objects.requireNonNull (getActivity ()).finish ();
                                ActivityCollectorUtil.finishAllActivity ();
                                SPProvider.clear ();
                                DataProvider.clearAllData ();
                            }
                        })
                        .negativeText(R.string.lab_no)
                        .onNegative(new MaterialDialog.SingleButtonCallback() {
                            @Override
                            public void onClick(MaterialDialog dialog, DialogAction which) {
                                dialog.dismiss ();
                            }
                        })
                        .show();
                break;
            default:
                break;
        }
    }
}
