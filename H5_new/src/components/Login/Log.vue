<template>
  <div>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page">
      <div class="card">
        <div class="card-body">
          <h3 class="text-center m-0">
            <a href="index.html" class="logo logo-admin"
              ><img src="assets/images/DaoYun-Logo.png" height="80" alt="logo"
            /></a>
          </h3>

          <div class="p-3">
            <h4 class="font-18 m-b-5 text-center">欢迎回来 !</h4>
            <p class="text-muted text-center">请登录以继续</p>

            <form class="form-horizontal m-t-30" action="index.html">
              <div class="form-group">
                <label for="username">用户名</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  placeholder="输入用户名"
                  v-model="account"
                />
              </div>

              <div class="form-group">
                <label for="userpassword">密码</label>
                <input
                  type="password"
                  class="form-control"
                  id="userpassword"
                  placeholder="输入密码"
                  v-model="password"
                />
              </div>
              <div>
                <label v-show = isShow>用户名或密码不正确</label>
              </div>
              <div class="form-group row m-t-20">
                <div class="col-sm-6">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      id="customControlInline"
                    />
                    <label
                      class="custom-control-label"
                      for="customControlInline"
                      >记住密码</label
                    >
                  </div>
                </div>
                <div class="col-sm-6 text-right">
                  <button
                    class="btn btn-primary w-md waves-effect waves-light" type="button"
                    @click="login()"
                  >
                    登录
                  </button>
                </div>
              </div>

              <div class="form-group m-t-10 mb-0 row">
                <div class="col-12 m-t-20">
                  <router-link to = "Recoverpw" replace><i class="mdi mdi-lock"></i>忘记密码？</router-link>
                  <!-- <a href="pages-recoverpw.html" class="text-muted"
                    ><i class="mdi mdi-lock    "></i>忘记密码？</a
                  > -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="m-t-40 text-center">
        <p class="text-white">
          还没有账号?
          <a
            href="pages-register.html"
            class="font-500 font-14 text-white font-secondary"
          >
            现在注册
          </a>
        </p>
        <p class="text-white">
          © 2020 工程实践28组 <i class="mdi mdi-heart text-danger"></i>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Log',
  data () {
    return {
      isShow: false,
      // username: '',
      // userpassword: '',
      account: '',
      password: '',
      restult: ''
    }
  },
  created () {
    // 定时函数，看载入效果，等之后后台完善了要删掉。进入页面两秒后自动消失
    setTimeout(this.showPreloader, 2000)
  },
  methods: {
    // getAccount () {
    //   this.$axios.get('/Employee/getEmployee?Employee_id=1')
    //     .then(function (response) {
    //       console.log(response.data)
    //     })
    //     .catch(function (error) {
    //       console.log(error)
    //     })
    // },
    login () {
      var t = this
      var myDate = new Date()
      // 这个代码检查真严格
      /**
       * 你就这样写
       * post就是 $axios.post('xx/xx', ........)
       * get就是 $axios.get('xxxx/xxx', xxxxxx)
       */
      var qs = require('qs')
      this.$axios.post('/api/user-login', qs.stringify({
        u: t.account,
        p: t.password,
        TimeStamp: myDate
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
        .then(function (response) {
          console.log(response.data)
          if (response.data.code === 1) {
            t.restult = '登录成功'
            t.$router.push({path: 'Homepage'})// 可是他还是没有跳转
          } else if (response.data.code === 1002) { // 他返回的打他是null
            t.restult = '账户或密码错误'
            t.isShow = true
          } else if (response.data.code === 1001) {
            t.restult = '请求错误'
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  },
  mounted () {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .login-container{
    margin-top: 200px;
  }
  .login-card{
    width: 480px;
  }
  .input-contianer{
    margin-top: 40px;
  }
</style>
