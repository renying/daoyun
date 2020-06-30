var table_active = null;

layui.use(['table'], function (){
    var $ = layui.jquery;
    var table = layui.table;
    var form = layui.form;

    // 公共表格，高度计算默认需要减去 144
    table.set({
        request: {
            pageName: 'page',
            limitName: 'limit'
        },
        response: {
            statusName: 'status',
            statusCode: 1000,
            msgName: 'msg',
            countName: 'count',
            dataName: 'data'
        },
        page: true,
        limits: [30, 60, 90],
        limit: 30,
        height: 'full-88'
    });

    // 公共表格处理 bar
    table.on('tool(mos-table)', function (obj){
        var data = obj.data;
        var event = obj.event;
        var obj_this = $(this);

        // 数据
        var title = obj_this.data('title');
        var url = obj_this.data('url');
        var parameters = obj_this.data('parameters');
        var w = obj_this.data('width') > 0 ? obj_this.data('width') : 770;
        var h = obj_this.data('height') > 0 ? obj_this.data('height') : 530;
        var result = obj_this.data('result');

        // 额外数据处理
        var windows = window.parent;
        var format_url = url + (parameters ? (url.indexOf('?') != -1 ? '&' : '?') + parameters : '');

        // 处理事件
        if(event == 'mos-common-btn-layer-open')
        {
            windows.layer.open({
                type: 2,
                title: title,
                area: [w + 'px', h + 'px'],
                maxmin: true,
                content: format_url
            });
        } else if(event == 'mos-common-btn-layer-confirm') {
            windows.layer.confirm(title, {
                btn: ['确定', '取消']
            }, function (index){
                windows.layer.close(index);
                windows.layer.load();
                $.get(format_url, {}, function (response, status){
                    windows.layer.closeAll('loading');
                    if(status == 'success')
                    {
                        if(response.status == 1000)
                        {
                            windows.layer.msg(response.msg, {icon: 1}, function (){
                                if(result == 'reload')
                                {
                                    window.location.reload();
                                } else if(result == 'remove') {
                                    obj.del();
                                } else if(result == 'refresh') {
                                    $('.mos-common-btn-table-refresh').click();
                                }
                            });
                        } else {
                            windows.layer.msg(response.msg, {icon: 2});
                        }
                    } else {
                        windows.layer.msg('请求失败', {icon: 2});
                    }
                }, 'json');
            }, function (){

            });
        }
    });

    // 公共表格搜索提交
    table_active = {
        reload: function (table_id, fileds, page){
            var params = {where: fileds};
            if(typeof page == 'undefined' || page == 'true')
            {
                params['page'] = {curr: 1};
            } else if(page == 'false') {
                params['page'] = false;
            }
            // 若 page 是 current 值，则为当前页刷新
            table.reload(table_id, params);
        }
    };
    form.on('submit(mos-common-btn-table-search)', function (data){
        table_active.reload($(data.elem).data('tableid'), data.field, $(data.elem).data('page'));
        return false;
    });
    $('.mos-common-btn-table-refresh').on('click', function (){
        table_active.reload($(this).data('tableid'), {}, $(this).data('page'));
        return false;
    });

    /* ------------------------------ 华丽的分割线 ------------------------------ */
    //签到列表
    table.render({
        elem: '#mos-table-checkin',
        url: $('#mos-table-checkin').data('url'),
        cols: [[
            {title: 'ID', width: 110, fixed: 'left', field: 'id'},
            {title: '课程名', width: 200, fixed: 'left', field: 'ClassName'},
            {title: '用户', width: 200, fixed: 'left', field: 'UserName'},
            {title: '签到时间', width: 200, fixed: 'left', field: 'CheckDate'},
            {title: '经度', width: 170, field: 'Longitude'},
            {title: '纬度', width: 140, field: 'Latitude'}
        ]],
        height: 'full-136'
    });
    //班课列表
    table.render({
        elem: '#mos-table-dyclass',
        url: $('#mos-table-dyclass').data('url'),
        cols: [[
            {title: 'ID', width: 110, fixed: 'left', field: 'ClassId'},
            {title: '课程名', width: 200, fixed: 'left', field: 'ClassName'},
            {title: '课程编号', width: 200, fixed: 'left', field: 'ClassNum'},
            {title: '课程简介', width: 200, fixed: 'left', field: 'ClassDiscription'},
            {title: '创建时间', width: 170, field: 'CreateTime'},
            {title: '创建者', width: 140, field: 'UserId'},
            {title: '操作', width: 100, fixed: 'right', toolbar: '#mos-table-bar'}
        ]],
        height: 'full-136'
    });
    //系统参数列表
    table.render({
        elem: '#mos-table-config',
        url: $('#mos-table-config').data('url'),
        cols: [[
            {title: 'ID', width: 110, fixed: 'left', field: 'id'},
            {title: '键名', width: 200, fixed: 'left', field: 'pkey'},
            {title: '键值', width: 200, fixed: 'left', field: 'pvalue'},
            {title: '备注', width: 200, fixed: 'left', field: 'remark'},
            {title: '创建时间', width: 170, field: 'created_at'},
            {title: '创建者', width: 140, field: 'creator'},
            {title: '操作', width: 100, fixed: 'right', toolbar: '#mos-table-bar'}
        ]],
        height: 'full-136'
    });
    //角色列表
    table.render({
        elem: '#mos-table-role',
        url: $('#mos-table-role').data('url'),
        cols: [[
            {title: '角色 ID', width: 110, fixed: 'left', field: 'roleid'},
            {title: '角色名', width: 200, fixed: 'left', field: 'rolename'},
            {title: '创建时间', width: 170, field: 'created_at'},
            {title: '创建者', width: 140, field: 'creator'},
            {title: '状态', width: 80, templet: '#mos-table-role-disabled'},
            {title: '操作', width: 100, fixed: 'right', toolbar: '#mos-table-bar'}
        ]],
        height: 'full-136'
    });
    // 登录日志
    table.render({
        elem: '#mos-table-login-log',
        url: $('#mos-table-login-log').data('url'),
        cols: [[
            {title: '日志 ID', width: 110, fixed: 'left', field: 'logid'},
            {title: '登录名', width: 200, fixed: 'left', field: 'userid_desc'},
            {title: '登陆 IP', width: 140, field: 'ip'},
            {title: '登陆情况', width: 90, templet: '#mos-table-login-log-col-succeed'},
            {title: '登陆时间', width: 170, field: 'created_at_desc'}
        ]],
        height: 'full-136'
    });

    // 操作日志
    table.render({
        elem: '#mos-table-operate-log',
        url: $('#mos-table-operate-log').data('url'),
        cols: [[
            {title: '日志 ID', width: 110, fixed: 'left', field: 'logid'},
            {title: '操作人', width: 200, fixed: 'left', field: 'userid_desc'},
            {title: '链接地址', width: 300, field: 'url'},
            {title: '操作 IP', width: 140, field: 'ip'},
            {title: '操作时间', width: 170, field: 'created_at_desc'}
        ]],
        height: 'full-184'
    });

    // 系统日志
    table.render({
        elem: '#mos-table-log',
        url: $('#mos-table-log').data('url'),
        cols: [[
            {title: 'id', width: 110, fixed: 'left', field: 'id'},
            {title: 'level', width: 110, field: 'level'},
            {title: 'category', width: 170, field: 'category'},
            {title: 'log_time', width: 170, field: 'log_time_desc'},
            {title: 'prefix', width: 170, field: 'prefix'},
            {title: 'message', width: 300, field: 'message'}
        ]],
        height: 'full-50'
    });

    // 管理员
    table.render({
        elem: '#mos-table-admin',
        url: $('#mos-table-admin').data('url'),
        cols: [[
            {title: '用户 ID', width: 110, fixed: 'left', field: 'userid'},
            {title: '用户名', width: 200, fixed: 'left', field: 'username'},
            {title: '姓名', width: 200, field: 'name'},
            {title: '状态', width: 80, templet: '#mos-table-admin-col-disabled'},
            {title: '操作', width: 100, fixed: 'right', toolbar: '#mos-table-bar'}
        ]],
        height: 'full-184'
    });

    // 菜单列表
    table.render({
        elem: '#mos-table-menu',
        url: $('#mos-table-menu').data('url'),
        cols: [[
            {title: '菜单 ID', width: 110, fixed: 'left', field: 'menuid'},
            {title: '菜单名', width: 350, templet: '#mos-table-menu-col-name'},
            {title: '访问地址', width: 250, templet: '#mos-table-menu-col-url'},
            {title: '状态', width: 60, templet: '#mos-table-menu-col-enabled'},
            {title: '显示', width: 60, templet: '#mos-table-menu-col-is-show'},
            {title: '排序', width: 110, field: 'sort'},
            {title: '操作', width: 130, fixed: 'right', toolbar: '#mos-table-bar'}
        ]],
        page: false
    });

    // 菜单列表
    table.render({
        elem: '#mos-table-school',
        url: $('#mos-table-school').data('url'),
        cols: [[
            {title: '信息 ID', width: 110, fixed: 'left', field: 'menuid'},
            {title: '信息', width: 350, templet: '#mos-table-school-col-name'},
            {title: '排序', width: 110, field: 'sort'},
            {title: '操作', width: 130, fixed: 'right', toolbar: '#mos-table-bar'}
        ]],
        page: false
    });
});