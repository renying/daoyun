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
            <label class="layui-form-label">键名</label>
            <div class="layui-input-inline">
                <input type="text" name="search[pkey]" class="layui-input">
            </div>
            <label class="layui-form-label">键值</label>
            <div class="layui-input-inline">
                <input type="text" name="search[pvalue]" class="layui-input">
            </div>

        </div>
    </div>
    <div class="layui-form-item mos-common-margin-bottom0">
        <div class="layui-input-block mos-common-margin-left0">
            <button class="layui-btn" lay-submit="" lay-filter="mos-common-btn-table-search" data-tableid="mos-table-config">搜索</button>
            <button class="layui-btn mos-common-btn-layer-open" data-title="添加系统参数" data-url="<?php echo Html::encode(Url::to(['config/config-add'])); ?>">添加系统参数</button>
            <button class="layui-btn layui-btn-primary mos-common-btn-table-refresh" data-tableid="mos-table-config" data-page="current" title="刷新"><i class="layui-icon layui-icon-refresh-3"></i></button>
        </div>
    </div>
</form>

<!-- 数据列表 -->
<table id="mos-table-config" lay-filter="mos-table" data-url="<?php echo Html::encode(Url::to(['config/index'])); ?>"></table>



<!-- 操作按钮 -->
<script type="text/html" id="mos-table-bar">
    {{# if(d.id !== '0'){ }}
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="mos-common-btn-layer-open" data-title="编辑参数" data-url="<?php echo Html::encode(Url::to(['config/config-edit'])); ?>" data-parameters="id={{ d.id }}" data-width="800" data-height="600" title="编辑"><i class="layui-icon layui-icon-edit"></i></a>
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="mos-common-btn-layer-confirm" data-title="确定删除参数 键名 = {{ d.pkey }} 的记录吗？" data-url="<?php echo Html::encode(Url::to(['config/config-del'])); ?>" data-parameters="id={{ d.id }}" data-result="refresh" title="删除"><i class="layui-icon layui-icon-delete"></i></a>
    {{# } }}
</script>