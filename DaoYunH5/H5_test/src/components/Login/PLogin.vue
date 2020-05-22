<template>
  <div>
      <div class="login-container">
        <el-row :gutter="20">
          <el-col :span="6" :offset="14">
            <el-card class="login-card" shadow="hover">
              <div slot="header" class="clearfix">
                <span>病人登录</span>
                <el-button style="float: right; padding: 3px 0" type="text" @click="goLogin()">员工登录</el-button>
              </div>
              <div class="login-body">
                <div class="input-contianer">
                  <el-input placeholder="请输入卡号" v-model="cardid">
                    <template slot="prepend">卡号：</template>
                  </el-input>
                </div>
                <div class="input-contianer">
                  <el-input placeholder="请输入密码" v-model="p_code" type="password">
                    <template slot="prepend">密码：</template>
                  </el-input>
                </div>
                <div style="float:left;margin: 50px;">
                  <p>{{result}}</p>
                </div>
                <div style="margin: 50px;float:right;" size="medium">
                  <el-button type="primary" @click="login()">登陆</el-button>
                </div>
              </div>
            </el-card>
          </el-col>
        </el-row>
      </div>
    </div>
</template>

<script>
export default {
  name: 'PLogin',
  data () {
    return {
      cardid: '',
      p_code: '',
      result: '',
      pid: ''
    }
  },
  methods: {
    goLogin () {
      this.$router.push({path: '/'})
    },
    login () {
      var t = this
      this.$axios({
        method: 'post',
        url: '/Patient/pLogin',
        data: {
          cardid: t.cardid,
          p_code: t.p_code
        }
      })
        .then(function (response) {
          console.log(response.data)
          if (response.data === 0) {
            t.result = '账户或密码错误'
          } else {
            t.result = '登陆成功'
            t.pid = response.data
            console.log(response)
            t.$router.replace({name: 'Visitor', query: {pid: t.pid}})
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    }
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
