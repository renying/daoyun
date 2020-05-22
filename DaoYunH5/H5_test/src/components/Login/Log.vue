<template>
  <div>
    <div id="preloader" v-show="preloader">
      <div id="status"><div class="spinner"></div></div>
    </div>

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
                    class="btn btn-primary w-md waves-effect waves-light"
                    type="submit" onclick="login()"
                  >
                    登录
                  </button>
                </div>
              </div>

              <div class="form-group m-t-10 mb-0 row">
                <div class="col-12 m-t-20">
                  <router-link to = "Recoverpw" replace><i class="mdi mdi-lock    "></i>忘记密码？</router-link>
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
      radio: '1',
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
    getAccount () {
      this.$axios.get('/Employee/getEmployee?Employee_id=1')
        .then(function (response) {
          console.log(response.data)
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    login () {
      var t = this
      var myDate = new Date()
      this.$axios({
        method: 'post',
        url: '/api/user-login',
        data: {
          account: t.account,
          password: t.password,
          TimeStamp: myDate,
          CheckCode: t.CheckCode
        }
      })
        .then(function (response) {
          console.log(response.data)
          if (response.data === 1) {
            if (t.radio === 1) {
              t.restult = '登陆成功'
              t.$router.push({path: '/Cure/input'})
            } else if (t.radio === 2) {
              t.restult = '登陆成功'
              t.$router.push({path: '/HospitalManager'})
            } else {
              t.result = '未选择管理员登录或医生登录'
            }
          } else if (response.data === 0) {
            t.restult = '账户或密码错误'
          } else if (response.data === -1) {
            t.restult = '内部错误'
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    goPLogin () {
      this.$router.push({path: '/PLogin'})
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
