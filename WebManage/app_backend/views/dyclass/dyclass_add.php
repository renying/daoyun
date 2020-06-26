<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
<script type="text/javascript" src="/js/role/role_add.js"></script>
EOF;
?>

<form class="layui-form" action="<?php echo Html::encode(Url::to(['dyclass/dyclass-add'])); ?>" onsubmit="return false;">
    <input type="hidden" name="<?php echo Html::encode(Yii::$app->request->csrfParam); ?>" value="<?php echo Html::encode(Yii::$app->request->getCsrfToken()); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">课程名称</label>
        <div class="layui-input-inline">
            <input type="text" name="DyClassAddForm[ClassName]" lay-verify="required|DyClassAddForm[ClassName]" lay-verType="tips" placeholder="请输入键名" class="layui-input">
        </div>
    </div>
     <div class="layui-form-item">
        <label class="layui-form-label">课程编码</label>
        <div class="layui-input-inline">
            <input type="text" name="DyClassAddForm[ClassNum]" lay-verify="required|DyClassAddForm[ClassNum]" lay-verType="tips" placeholder="请输入键值" class="layui-input">
        </div>
    </div>
     <div class="layui-form-item">
        <label class="layui-form-label">课程简介</label>
        <div class="layui-input-inline">
            <input type="text" name="DyClassAddForm[ClassDiscription]" lay-verify="required|DyClassAddForm[ClassDiscription]" lay-verType="tips" placeholder="请输入备注" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-form-submit" data-result="reload">确认提交</button>
        </div>
    </div>
</form>