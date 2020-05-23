layui.use(['form'], function (){
    var $ = layui.jquery;
    var common = layui.common;
    var form = layui.form;

    form.verify({
        'RoleAddForm[username]': function (username){
            if(!common.validateRolename(username))
            {
                return common.get_verify_username_desc();
            }
        }
    });
});