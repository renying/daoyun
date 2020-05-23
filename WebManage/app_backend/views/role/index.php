<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_js'] = <<< EOF
<script type="text/javascript" src="/js/table.js"></script>
EOF;
?>

<form class="layui-form layui-form-pane" onsubmit="return false;">
    <div class="layui-form-item mos-common-margin-bottom10">
        <div class="layui-inline mos-common-margin-bottom0 mos-common-margin-right0">
            <label class="layui-form-label">角色 ID</label>
            <div class="layui-input-inline">
                <input type="text" name="search[roleid]" class="layui-input">
            </div>
            <label class="layui-form-label">角色名</label>
            <div class="layui-input-inline">
                <input type="text" name="search[rolename]" class="layui-input">
            </div>

        </div>
    </div>
    <div class="layui-form-item mos-common-margin-bottom0">
        <div class="layui-input-block mos-common-margin-left0">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-table-search" data-tableid="mos-table-role">搜索</button>
            <button class="layui-btn mos-common-btn-layer-open" data-title="添加角色" data-url="<?php echo Html::encode(Url::to(['role/role-add'])); ?>">添加角色</button>
            <button class="layui-btn layui-btn-primary mos-common-btn-table-refresh" data-tableid="mos-table-role" data-page="current" title="刷新"><i class="layui-icon layui-icon-refresh-3"></i></button>
        </div>
    </div>
</form>

<!-- 数据列表 -->
<table id="mos-table-role" lay-filter="mos-table" data-url="<?php echo Html::encode(Url::to(['role/index'])); ?>"></table>

<!-- 是否系统默认角色处理 -->
<script type="text/html" id="mos-table-role-disabled">
    {{# if(d.disabled === '1'){ }}
    <span style="color: #FF5722;">{{ d.disabled_desc }}</span>
    {{# } else if(d.disabled === '0') { }}
    <span style="color: #5FB878;">{{ d.disabled_desc }}</span>
    {{# } }}
</script>

<!-- 操作按钮 -->
<script type="text/html" id="mos-table-bar">
    {{# if(d.roleid !== '0'){ }}<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="mos-common-btn-layer-open" data-title="编辑角色" data-url="<?php echo Html::encode(Url::to(['role/role-edit'])); ?>" data-parameters="roleid={{ d.roleid }}" data-width="800" data-height="600" title="编辑"><i class="layui-icon layui-icon-edit"></i></a>{{# if(d.disabled === '0'){ }}<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="mos-common-btn-layer-confirm" data-title="确定删除角色 ID = {{ d.roleid }} 的记录吗？" data-url="<?php echo Html::encode(Url::to(['role/role-del'])); ?>" data-parameters="roleid={{ d.roleid }}" data-result="refresh" title="删除"><i class="layui-icon layui-icon-delete"></i></a>{{# } }}{{# } }}
</script>