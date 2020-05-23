<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
EOF;
?>

<form class="layui-form" action="<?php echo Html::encode(Url::to(['config/config-edit', 'id' => $config_data['id']])); ?>" onsubmit="return false;">
    <input type="hidden" name="<?php echo Html::encode(Yii::$app->request->csrfParam); ?>" value="<?php echo Html::encode(Yii::$app->request->getCsrfToken()); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">键名</label>
        <div class="layui-form-mid layui-word-aux"><?php echo Html::encode($config_data['pkey']); ?></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">键值</label>
        <div class="layui-input-inline">
            <input type="text" name="ConfigEditForm[pvalue]" lay-verify="ConfigEditForm[pvalue]" lay-verType="tips" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-inline">
            <input type="text" name="ConfigEditForm[remark]" lay-verify="ConfigEditForm[remark]" lay-verType="tips" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-form-submit" data-result="reload">确认提交</button>
        </div>
    </div>
</form>