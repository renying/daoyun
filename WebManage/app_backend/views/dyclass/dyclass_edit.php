<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
EOF;
?>

<form class="layui-form" action="<?php echo Html::encode(Url::to(['dyclass/dyclass-edit', 'id' => $dyclass_data['ClassId']])); ?>" onsubmit="return false;">
    <input type="hidden" name="<?php echo Html::encode(Yii::$app->request->csrfParam); ?>" value="<?php echo Html::encode(Yii::$app->request->getCsrfToken()); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">编号</label>
        <div class="layui-form-mid layui-word-aux"><?php echo Html::encode($dyclass_data['ClassId']); ?></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">课程名称</label>
        <div class="layui-input-inline">
            <input type="text" name="DyClassEditForm[ClassName]" lay-verify="DyClassEditForm[ClassName]" value=<?php echo Html::encode($dyclass_data['ClassName']); ?> lay-verType="tips" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">课程编码</label>
        <div class="layui-input-inline">
            <input type="text" name="DyClassEditForm[ClassNum]" lay-verify="DyClassEditForm[ClassNum]" value=<?php echo Html::encode($dyclass_data['ClassNum']); ?> lay-verType="tips" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">课程简介</label>
        <div class="layui-input-inline">
            <input type="text" name="DyClassEditForm[ClassDiscription]" lay-verify="DyClassEditForm[ClassDiscription]" value=<?php echo Html::encode($dyclass_data['ClassDiscription']); ?> lay-verType="tips" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-form-submit" data-result="reload">确认提交</button>
        </div>
    </div>
</form>