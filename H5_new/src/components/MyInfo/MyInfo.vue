<template>
    <div>
    <el-container>
    <el-header id="topnav">
            <!-- MENU Start -->
      <div class="topbar-main">
        <div class="container-fluid">
          <div class="logo">
            <a href="index.html" class="logo">
              <img src="@/assets/images/DaoYun-Logo.png" alt="" height="45">
            </a>
          </div>
          <div class="menu-extras topbar-custom">
            <ul class="navigation-menu">
              <li>
                <a href="/Homepage"><i class="mdi mdi-view-dashboard"></i>我的班课</a>
              </li>
              <li>
                <a href="/MyInfo/MyInfo"><i class="mdi mdi-view-dashboard"></i>我的信息</a>
              </li>
              <li class="has-submenu">
                <a href="/Notice"><i class="mdi mdi-view-dashboard"></i>消息通知</a>
              </li>
            </ul>
            <!-- Navigation Menu-->
            <!-- End navigation menu -->
          </div> <!-- end #navigation -->
        </div> <!-- end container -->
        <div class="clearfix"></div>
      </div> <!-- end navbar-custom -->
    </el-header>
    <el-main>
    <el-tabs type="border-card">
      <el-tab-pane label="用户信息">
        <div class="update" height="800px">
      <div>
        <p>账号：{{ui}}</p>
        <p>昵称：{{nickname}}</p>
        <p>用户名：{{username}}</p>
        <p>真实姓名：{{realname}}</p>
        <p>出生年份：{{year}}</p>
        <p>性别：{{sex}}</p>
        <p>学号：{{number}}</p>
        <p>所在学校：{{school}}</p>
        <p>住址：{{address}}</p>
        <p>所在城市：{{country}}</p>
        <p>联系电话：{{phone}}</p>
      </div>
      <el-button type="primary" @click="dialogFormVisible1=true">修改信息</el-button>
      <el-dialog title="修改信息" :visible.sync="dialogFormVisible1">
        <el-form ref="from" :model="studentInfo" label-width="80px">
          <el-form-item label="昵称">
            <el-input v-model="studentInfo.nickname"></el-input>
          </el-form-item>
          <el-form-item label="用户名">
            <el-input v-model="studentInfo.username"></el-input>
          </el-form-item>
          <el-form-item label="真实姓名">
            <el-input v-model="studentInfo.realname"></el-input>
          </el-form-item>
          <el-form-item label="出生年份">
            <el-input v-model="studentInfo.year"></el-input>
          </el-form-item>
          <el-form-item label="性别">
            <el-radio-group v-model="studentInfo.sex" size="medium">
              <el-radio border label="1">男</el-radio>
              <el-radio border label="0">女</el-radio>
            </el-radio-group>
          </el-form-item>
          <el-form-item label="学号">
            <el-input v-model="studentInfo.number"></el-input>
          </el-form-item>
          <el-form-item label="所在学校">
            <el-input v-model="studentInfo.school"></el-input>
          </el-form-item>
          <el-form-item label="住址">
            <el-input v-model="studentInfo.address"></el-input>
          </el-form-item>
          <el-form-item label="所在城市">
            <el-input v-model="studentInfo.country"></el-input>
          </el-form-item>
          <el-form-item label="联系电话">
            <el-input v-model="studentInfo.phone"></el-input>
          </el-form-item>
          <el-form-item size="large">
            <el-button type="primary" @click="onSubmit()">立即修改</el-button>
            <el-button @click="dialogFormVisible1 = false">取消</el-button>
          </el-form-item>
        </el-form>
      </el-dialog>
        </div>
      </el-tab-pane>
    </el-tabs>
    </el-main>
    <div style="height: 30px; witdh: 100%"></div>
    <router-view/>
  </el-container>
    <button class="btn btn-primary w-md waves-effect waves-light" type="button" @click="exit()">注销</button>
  </div>
</template>

<script>
export default {
  beforeCreate () {
    // 添加背景色
    document.querySelector('body').setAttribute('style', 'background-color:######')
  },
  beforeDestroy () {
    document.querySelector('body').setAttribute('style', '')
  },
  data () {
    return {
      pid: this.$route.query.pid, // 可以设置一个变量存id
      dialogFormVisible1: false,
      dialogFormVisible2: false,
      loadingEmployee: true,
      totalPages: 0,
      currentPage: 0,
      size: 5,
      dialogVisible3: false,
      ui: localStorage.getItem('userid'),
      nickname: '',
      year: '',
      username: '',
      sex: '',
      number: '',
      school: '',
      phone: '',
      type: '',
      country: '',
      realname: '',
      address: '',
      search: '',
      studentInfo: {
        nickname: this.nickname,
        year: this.year,
        username: this.name,
        sex: this.sex,
        number: this.number,
        school: this.school,
        type: this.type,
        country: this.country,
        realname: this.realname,
        address: this.address,
        phone: this.phone
      }
    }
  },
  methods: {
    formatRole (sex) { // 表格数据转换 性别
      return sex === 1 ? '男' : sex === 0 ? '女' : '未知'
    },
    getMyInfo () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/get-userinfo', qs.stringify({
        ui: localStorage.getItem('userid'),
        ukey: localStorage.getItem('ukey'),
        TimeStamp: myDate
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
        .then(function (response) {
          console.log(response.data)
          if (response.data.code === 1) {
            t.restult = '获取成功'
            // this.$store.commit('setToken', JSON.stringify(response.data.data.ukey))
            // this.$store.commit('setAccount', JSON.stringify(response.data.data.ui))
            t.username = response.data.data.UserName
            t.nickname = response.data.data.NickName
            t.year = response.data.data.BornDate
            t.sex = t.formatRole(response.data.data.UserSex)
            t.phone = response.data.data.Phone
            t.number = response.data.data.UserCode
            t.school = response.data.data.SchoolId
            t.type = response.data.data.UserType
            t.country = response.data.data.CountryId
            t.realname = response.data.data.RealName
            t.address = response.data.data.Address
          } else if (response.data.code === 9999) {
            t.restult = '系统错误'
            t.isShow = true
          } else if (response.data.code === 1001) {
            t.restult = '请求错误'
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    // getUserInfo () {
    //   console.log('getUser')
    //   var t = this
    //   var myDate = new Date()
    //   var qs = require('qs')
    //   this.$axios.post('api/get-userinfo', qs.stringify({
    //     ui: t.account,
    //     ukey: t.$root.ukey,
    //     TimeStamp: myDate
    //   }), {
    //     headers: {
    //       'Content-Type': 'application/x-www-form-urlencoded'
    //     }
    //   })
    //     .then(function (response) {
    //       console.log(response.data)
    //       if (response.data.code === 1) {
    //         t.restult = '获取成功'
    //         t.username = response.data.username
    //         t.NickName = response.data.NickName
    //         t.year = response.data.BornDate
    //         t.UserSex = t.formatRole(response.data.UserSex)
    //         t.UserType = response.data.UserType
    //         t.Address = response.data.Address
    //         t.Phone = response.data.Phone
    //         t.$router.push({path: 'Homepage'})
    //       } else if (response.data.code === 1002) {
    //         t.restult = '用户账号错误'
    //         t.isShow = true
    //       } else if (response.data.code === 1001) {
    //         t.restult = '请求错误'
    //       }
    //     })
    //     .catch(function (error) {
    //       console.log(error)
    //     })
    // },
    // gotoMyInfo () {
    //   this.$router.replace('/MyInfo/MyInfo')
    // },
    gotoHomepage () {
      this.$router.replace('/Homepage')
    },
    onSubmit () {
      console.log('onSubmit')
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/user-updateinfo', qs.stringify({
        ui: localStorage.getItem('userid'),
        ukey: localStorage.getItem('ukey'),
        NickName: t.studentInfo.nickname,
        BornDate: t.studentInfo.year,
        Address: t.studentInfo.contry,
        Phone: t.studentInfo.phone,
        UserCode: t.studentInfo.code,
        RealName: t.studentInfo.realname,
        UserSex: t.studentInfo.sex,
        TimeStamp: myDate
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
        .then(function (response) {
          if (response.data.code === 1) {
            t.dialogFormVisible1 = false
            t.$notify({
              title: '成功',
              message: '修改成功！',
              type: 'success'
            })
          }
        })
        .catch(function (error) {
          console.log(error)
          t.$notify({
            title: '警告',
            message: '修改失败',
            type: 'warning'
          })
        })
    }
    // checkCode () {
    //   console.log(this.patientInfo)
    //   var t = this
    //   this.$axios({
    //     method: 'post',
    //     url: '/Patient/checkCode',
    //     data: {
    //       cardid: t.message.cardid,
    //       p_code_old: t.changeCode.p_code_old, //  对象名 . 成员
    //       p_code_new: t.changeCode.p_code_new
    //     }
    //   })
    //     .then(function (response) {
    //       t.message = response.data
    //       console.log(t.message)//
    //       t.loadingPatient = false
    //       t.dialogFormVisible2 = false
    //     })
    //     .catch(function (error) {
    //       console.log(error)
    //     })
    // }
  },
  mounted () {
    this.getMyInfo()
  }
}
</script>

<style scoped>

</style>
