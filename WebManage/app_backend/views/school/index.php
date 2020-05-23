<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
<script type="text/javascript" src="/js/table.js"></script>
EOF;
?>

<div>
    <div class="mos-common-float-left">
        <button class="layui-btn mos-common-btn-layer-open" data-title="添加信息" data-url="<?php echo Html::encode(Url::to(['school/add'])); ?>">添加信息</button><button class="layui-btn layui-btn-primary mos-common-btn-table-refresh" data-tableid="mos-table-school" data-page="false" title="刷新"><i class="layui-icon layui-icon-refresh-3"></i></button>
    </div>
    <div class="layui-clear"></div>
</div>

<!-- 数据列表 -->
<table id="mos-table-school" lay-filter="mos-table" data-url="<?php echo Html::encode(Url::to(['school/index'])); ?>"></table>

<!-- 菜单名处理 -->
<script type="text/html" id="mos-table-school-col-name">
    <span style="margin-left: {{ d.level * 30 }}px;">{{ d.name }}</span>
</script>


<!-- 操作按钮 -->
<script type="text/html" id="mos-table-bar">
    {{# if(d.level < 3){ }}<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="mos-common-btn-layer-open" data-title="添加子项" data-url="<?php echo Html::encode(Url::to(['school/add'])); ?>" data-parameters="menuid={{ d.menuid }}" title="添加子项"><i class="layui-icon layui-icon-add-1"></i></a>{{# } }}<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="mos-common-btn-layer-open" data-title="编辑" data-url="<?php echo Html::encode(Url::to(['school/edit'])); ?>" data-parameters="menuid={{ d.menuid }}" data-width="800" data-height="630" title="编辑"><i class="layui-icon layui-icon-edit"></i></a><a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="mos-common-btn-layer-confirm" data-title="确定删除 ID = {{ d.menuid }} 及其下属所有项的记录吗？" data-url="<?php echo Html::encode(Url::to(['school/del'])); ?>" data-parameters="menuid={{ d.menuid }}" data-result="reload" title="删除"><i class="layui-icon layui-icon-delete"></i></a>
</script>