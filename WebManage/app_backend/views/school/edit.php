<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
<script type="text/javascript" src="/js/menu/menu.js"></script>
EOF;
?>

<form class="layui-form" action="<?php echo Html::encode(Url::to(['school/edit', 'menuid' => $menu_data['menuid']])); ?>" onsubmit="return false;">
    <input type="hidden" name="<?php echo Html::encode(Yii::$app->request->csrfParam); ?>" value="<?php echo Html::encode(Yii::$app->request->getCsrfToken()); ?>">
    <div class="layui-form-item">
        <label class="layui-form-label">菜单 ID</label>
        <div class="layui-form-mid layui-word-aux"><?php echo Html::encode($menu_data['menuid']); ?></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">父级</label>
        <?php foreach($menu_parents_datas as $k => $sub_datas): ?>
        <div class="layui-input-inline">
            <select name="EditForm[parent_id][<?php echo Html::encode($k); ?>]" lay-filter="menu_level" data-url="<?php echo Html::encode(Url::to(['school/get-sub-menu-data', 'except_menuid' => $menu_data['menuid']])); ?>" data-level="<?php echo Html::encode($k); ?>" data-form="EditForm">
                <option value="">请选择父级</option>
                <?php foreach($sub_datas as $data): ?>
                <?php if($data['menuid'] != $menu_data['menuid']): ?>
                <option value="<?php echo Html::encode($data['menuid']); ?>"<?php if(!empty($data['selected'])): ?> selected="selected"<?php endif;?>><?php echo Html::encode($data['name']); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">信息</label>
        <div class="layui-input-inline">
            <input type="text" name="EditForm[name]" lay-verify="required" lay-verType="tips" placeholder="请输入信息" class="layui-input" value="<?php echo Html::encode($menu_data['name']); ?>">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" name="EditForm[sort]" lay-verify="required|number" lay-verType="tips" placeholder="请输入排序" class="layui-input" value="<?php echo Html::encode($menu_data['sort']); ?>">
        </div>
        <div class="layui-form-mid layui-word-aux">建议填写 10 的倍数值</div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-form-submit">确认提交</button>
        </div>
    </div>
</form>