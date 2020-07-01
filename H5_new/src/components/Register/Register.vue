<template>
<div>
  <div class="accountbg"></div>
    <!-- Begin page -->
    <div class="wrapper-page">
      <div class="card">
        <div class="card-body">
          <img src="@/assets/images/DaoYun-Logo.png" width="200">
          <div class="p-3">
            <h4 class="font-18 m-b-5 text-center">免费注册</h4>
            <p class="text-muted text-center">现在免费注册你的到云账号吧 !</p>

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
                <div class="col-sm-12 text-right">
                  <button
                    class="btn btn-primary w-md waves-effect waves-light" type="button"
                    @click="register()"
                  >
                    注册
                  </button>
                </div>
              </div>

              <div class="form-group m-t-10 mb-0 row">
                <div class="col-12 m-t-20">
                  <router-link to = "/RecoverPassword" replace><i class="mdi mdi-lock"></i>忘记密码？</router-link>
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
          已有帐号？
          <router-link to = "/" replace><i class="mdi mdi-lock"></i>点击登录</router-link>
        </p>
        <p class="text-white">
          © 2020 工程实践28组 <i class="mdi mdi-heart text-danger"></i>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'
export default {
  computed: {
    count () {
      return this.$store.state.ukey
    },
    ...mapGetters([
      'getToken'
    ])
  },
  name: 'Register',
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
    register () {
      var t = this
      var myDate = new Date()
      // 这个代码检查真严格
      /**
       * 你就这样写
       * post就是 $axios.post('xx/xx', ........)
       * get就是 $axios.get('xxxx/xxx', xxxxxx)
       */
      var qs = require('qs')
      this.$axios.post('/api/user-register', qs.stringify({
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
            t.restult = '注册成功'
            // this.$store.commit('setToken', JSON.stringify(response.data.data.ukey))
            // this.$store.commit('setAccount', JSON.stringify(response.data.data.ui))
            t.$message('注册成功！')
            t.$router.push({path: '/'})
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

<style scoped>

</style>
