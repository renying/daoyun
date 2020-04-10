<template>
<div>
    <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center m-0">
                        <a href="index.html" class="logo logo-admin"><img src="assets/images/DaoYun-Logo.png" height="80" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                        <h4 class="font-18 m-b-5 text-center">重置密码</h4>
                        <p class="text-muted text-center">请输入邮箱以获取验证码</p>

                        <form class="form-horizontal m-t-30" action="index.html">

                            <div class="form-group">
                                <label for="useremail">邮箱</label>
                                <input type="email" class="form-control" id="useremail" placeholder="输入邮箱">
                            </div>

                            <div class="form-group row m-t-20">
                                <div class="col-12 text-right">
                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">重置</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <p class="text-white"> <router-link to= "/">点这里登录</router-link></p>
                <!-- <a href="@/components/Login/Login" class="font-500 font-14 text-white font-secondary">  </a> </p> -->
                <p class="text-white">© 2020 工程实践28组 <i class="mdi mdi-heart text-danger"></i> </p>
            </div>
        </div>
</div>
</template>
<script>

export default {
  name: 'Recoverpw',
  data () {
    return {
      preloader: true
    }
  },
  created () {
    // 定时函数，看载入效果，等之后后台完善了要删掉。进入页面两秒后自动消失
    setTimeout(this.showPreloader, 2000)
  },
  methods: {
    // 关闭载入动画的函数
    showPreloader () {
      this.preloader = false
    }
  }
}
</script>
