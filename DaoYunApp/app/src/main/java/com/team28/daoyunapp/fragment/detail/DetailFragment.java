package com.team28.daoyunapp.fragment.detail;
import android.widget.TextView;

import com.orhanobut.logger.Logger;
import com.team28.daoyunapp.R;
import com.team28.daoyunapp.adapter.entity.Course;
import com.team28.daoyunapp.core.BaseFragment;
import com.team28.daoyunapp.utils.DataProvider;
import com.xuexiang.xpage.annotation.Page;
import com.xuexiang.xpage.enums.CoreAnim;
import com.xuexiang.xui.widget.actionbar.TitleBar;

import butterknife.BindView;

@Page(anim = CoreAnim.none)
public class DetailFragment extends BaseFragment {

    @BindView (R.id.tv_course_code)
    TextView classCode;
    @BindView (R.id.tv_course_creator)
    TextView classCreator;
    @BindView (R.id.tv_course_bornDate)
    TextView createTime;
    @BindView (R.id.tv_course_title)
    TextView className;
    @BindView (R.id.tv_course_summary)
    TextView classDesc;

    @Override
    protected int getLayoutId () {
        return R.layout.fragment_detail;
    }

    @Override
    protected void initViews () {
        Course course = DataProvider.getChoosedCourse ();
        if (course !=null){
            classCode.setText (course.getCode ());
            classCreator.setText (course.getCreator ());
            createTime.setText (course.getCreateTime ().toString ());
            className.setText (course.getName ());
            classDesc.setText (course.getDesc ());
        }
        else{
            Logger.d ("course is null!");
        }
    }
    @Override
    protected TitleBar initTitle () {
        return super.initTitle ().setTitle ("详情");
    }
}
