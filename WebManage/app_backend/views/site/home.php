<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = $title;
$this->params['view_css'] = <<< EOF
<link type="text/css" rel="stylesheet" href="/css/home.css">
EOF;
$this->params['view_js'] = <<< EOF
<script type="text/javascript" src="/js/home.js"></script>
EOF;
?>

<div class="layui-row layui-col-space15">
    <div class="layui-col-md6">
        <table class="layui-table mos-common-margin-top0 mos-common-margin-bottom0">
            <colgroup>
                <col width="100">
                <col width="280">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th colspan="3">我的信息</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td rowspan="4" class="mos-common-text-align-center">
                    <a href="javascript:;" class="mos-common-btn-create-iframe-tab" data-url="<?php echo Html::encode(Url::to(['my/info'])); ?>" data-title="个人资料">
                    <?php if($admin_data['avatar']): ?>
                    <img src="<?php echo Html::encode($admin_data['avatar']); ?>" class="layui-circle" id="mos-site-home-avatar">
                    <?php else: ?>
                    <img src="/lib/img/avatar.png" class="layui-circle" id="mos-site-home-avatar">
                    <?php endif; ?>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="2">账号：<a href="javascript:;" class="mos-common-btn-create-iframe-tab" data-url="<?php echo Html::encode(Url::to(['my/info'])); ?>" data-title="个人资料"><?php echo Html::encode($admin_data['user']['username']); ?><?php if($admin_data['name']): ?>（<?php echo Html::encode($admin_data['name']); ?>）<?php endif; ?></a></td>
            </tr>
            <tr>
                <td colspan="2">上次登录时间：<?php echo Html::encode($last_login_log_data ? $last_login_log_data['created_at_desc'] : '无'); ?></td>
            </tr>
            <tr>
                <td>上次登录 IP：<?php echo Html::encode($last_login_log_data ? $last_login_log_data['ip'] : '无'); ?></td>
                <td>登陆次数：<?php echo Html::encode($admin_login_log_count); ?> 次</td>
            </tr>
            </tbody>
        </table>
    </div>

    <?php if($admin_data['userid'] == 1): ?>
        <div class="layui-col-md12">
            <table class="layui-table mos-common-margin-top0 mos-common-margin-bottom0">
                <colgroup>
                    <col>
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th colspan="2">系统信息</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Yii 程序版本：<?php echo Html::encode($system_info['yii_version']); ?></td>

                </tr>
                <tr>
                    <td>Layui 程序版本：<span class="mos-site-home-layui"></span></td>

                </tr>
                <tr>
                    <td colspan="2">操作系统：<?php echo Html::encode($system_info['os']); ?></td>
                </tr>
                <tr>
                    <td>服务器软件：<?php echo Html::encode($system_info['web_server']); ?></td>
                    <td>系统时间：<?php echo Html::encode($system_info['time']); ?></td>
                </tr>
                <tr>
                    <td>MySQL 版本：<?php echo Html::encode($system_info['mysql_version']); ?></td>
                    <td>上传文件大小：<?php echo Html::encode($system_info['file_upload_max_size']); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>