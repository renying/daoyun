<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
<script type="text/javascript" src="/js/role/role_add.js"></script>
EOF;
?>

<form class="layui-form" action="<?php echo Html::encode(Url::to(['role/role-add'])); ?>" onsubmit="return false;">
    <input type="hidden" name="<?php echo Html::encode(Yii::$app->request->csrfParam); ?>" value="<?php echo Html::encode(Yii::$app->request->getCsrfToken()); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">角色名</label>
        <div class="layui-input-inline">
            <input type="text" name="RoleAddForm[rolename]" lay-verify="required|RoleAddForm[rolename]" lay-verType="tips" placeholder="请输入角色名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline mos-common-width300">
            <?php foreach($disabled_k_v as $k => $v): ?>
            <input type="radio" name="RoleAddForm[disabled]" value="<?php echo Html::encode($k); ?>" title="<?php echo Html::encode($v); ?>"<?php if(!$k): ?> checked="checked"<?php endif; ?>>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-form-submit" data-result="reload">确认提交</button>
        </div>
    </div>
</form>