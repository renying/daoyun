<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
<script type="text/javascript" src="/js/role/role_add.js"></script>
EOF;
?>

<form class="layui-form" action="<?php echo Html::encode(Url::to(['config/config-add'])); ?>" onsubmit="return false;">
    <input type="hidden" name="<?php echo Html::encode(Yii::$app->request->csrfParam); ?>" value="<?php echo Html::encode(Yii::$app->request->getCsrfToken()); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">键名</label>
        <div class="layui-input-inline">
            <input type="text" name="ConfigAddForm[pkey]" lay-verify="required|ConfigAddForm[pkey]" lay-verType="tips" placeholder="请输入键名" class="layui-input">
        </div>
    </div>
     <div class="layui-form-item">
        <label class="layui-form-label">键值</label>
        <div class="layui-input-inline">
            <input type="text" name="ConfigAddForm[pvalue]" lay-verify="required|ConfigAddForm[pvalue]" lay-verType="tips" placeholder="请输入键值" class="layui-input">
        </div>
    </div>
     <div class="layui-form-item">
        <label class="layui-form-label">键名备注</label>
        <div class="layui-input-inline">
            <input type="text" name="ConfigAddForm[remark]" lay-verify="required|ConfigAddForm[remark]" lay-verType="tips" placeholder="请输入备注" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-form-submit" data-result="reload">确认提交</button>
        </div>
    </div>
</form>