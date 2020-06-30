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
      <el-tab-pane label="班课成员信息">
        <p>课程名称：{{ClassName}}</p>
        <p>成员总数：{{UserCount}}</p>
        <el-table :data="tableData" style="width: 100%">
      <el-table-column prop="UserId" label="编号" width="180">
      </el-table-column>
      <el-table-column prop="UserName" label="名称" width="180">
      </el-table-column>
      <el-table-column prop="UserCode" label="学号">
      </el-table-column>
    </el-table>
      </el-tab-pane>
      <el-tab-pane label="发起签到">
        <el-button type="primary" @click=startCheckin()>发起签到</el-button>
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
      ClassName: '',
      UserCount: '',
      tableData: [{
        UserId: '111',
        UserName: '王小虎',
        UserCode: '11111'
      }, {
        UserId: '222',
        UserName: '王小虎',
        UserCode: '22222'
      }, {
        UserId: '333',
        UserName: '王小虎',
        UserCode: '33333'
      }]
    }
  },
  methods: {
    startCheckin () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/startcheckin', qs.stringify({
        ui: localStorage.getItem('userid'),
        ukey: localStorage.getItem('ukey'),
        classid: localStorage.getItem('classid'),
        longitude: localStorage.getItem('longitude'),
        latitude: localStorage.getItem('latitude'),
        duration: localStorage.getItem('duration'),
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
            t.code = response.data.data.code
            t.message = response.data.data.message
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
    }
  }
}
</script>

<style scoped>

</style>
