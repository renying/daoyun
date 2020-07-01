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
        <p>成员签到总次数：{{CheckCount}}</p>
        <el-table :data="tableData" style="width: 100%">
      <!-- <el-table-column prop="UserId" label="编号" width="180">
      </el-table-column>
      -->
      <el-table-column prop="UserName" label="名称" width="180">
      </el-table-column>
      <el-table-column prop="UserCode" label="学号">
      </el-table-column>
      <!-- <el-table-column><el-button type="primary" @click="getStuInfo(UserId)">查看信息</el-button></el-table-column> -->
    </el-table>
      </el-tab-pane>
      <el-tab-pane label="发起签到">

          <baidu-map class="map-contain map" :scroll-wheel-zoom="true" :center="center" :zoom="zoom" MapType="BMAP_SATELLITE_MAP" @ready="mapReady">
            <bm-geolocation anchor="BMAP_ANCHOR_BOTTOM_RIGHT" @locationSuccess="getMyLocation()" :showAddressBar="true" :autoLocation="true"></bm-geolocation>
            <bm-marker @dragend="markerDrag" :position="center" :dragging="true" animation="BMAP_ANIMATION_BOUNCE">
            </bm-marker>
          </baidu-map>

        <!--<el-button type="primary" @click=startCheckin()>发起签到</el-button>-->
        <el-button type="primary" @click="dialogFormVisible5 = true">发起签到</el-button>
        <el-dialog title="设置签到时间(分钟)" :visible.sync="dialogFormVisible5">
          <el-input v-model="duration" placeholder="请输入整数" type="number"></el-input>
          <el-dialog width="30%" title="提示" :visible.sync="innerVisible" append-to-body>
             <span>发起签到成功！</span>
            <el-button @click="innerVisible = false">确定</el-button>
          </el-dialog>
          <div slot="footer" class="dialog-footer">
            <el-button @click="dialogFormVisible5 = false">取 消</el-button>
            <el-button type="primary" @click="startCheckin()">确认发起签到</el-button>
          </div>
        </el-dialog>
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
  inject: ['reload'],
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
      CheckCount: '',
      tableData: [],
      longitude: '',
      latitude: '',
      duration: '',
      innerVisible: false,
      dialogFormVisible5: false,
      zoom: 18, // 地图相关设置
      center: {lng: 0, lat: 0}
    }
  },
  methods: {
    getClassInfo () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/get-classuserlist', qs.stringify({
        ui: localStorage.getItem('userid'),
        ukey: localStorage.getItem('ukey'),
        classid: localStorage.getItem('classid'),
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
            t.tableData = response.data.data.UserList
            t.ClassName = response.data.data.ClassName
            t.UserCount = response.data.data.UserCount
            t.CheckCount = response.data.data.CheckCount
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
    markerDrag (x) {
      console.log(x.point)
      this.center.lat = x.point.lat
      this.center.lng = x.point.lng
    },
    getStuInfo (Id) {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/get-classuserlist', qs.stringify({
        ui: localStorage.getItem('userid'),
        ukey: localStorage.getItem('ukey'),
        classid: localStorage.getItem('classid'),
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
            t.tableData = response.data.data.UserList
            t.ClassName = response.data.data.ClassName
            t.UserCount = response.data.data.UserCount
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
    mapReady ({BMap, map}) {
      let that = this
      var geolocation = new BMap.Geolocation()
      geolocation.enableSDKLocation()
      geolocation.getCurrentPosition(function (r) {
        console.log('d')
        console.log(r)
        // getStatus拿到的是状态信息，失败与否
        // eslint-disable-next-line no-undef
        if (this.getStatus() === BMAP_STATUS_SUCCESS) {
          that.center.lng = r.point.lng
          that.center.lat = r.point.lat
          that.latitude = r.point.lat
          that.longitude = r.point.lng
        } else {
          that.showToast('位置信息获取失败，' + this.getStatus())
        }
      }, {
        enableHighAccuracy: true// 要求浏览器获取最佳结果
      })
    },
    startCheckin () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      console.log('start')
      console.log(t.longitude)
      console.log(t.latitude)
      this.$axios.post('api/startcheckin', qs.stringify({
        ui: localStorage.getItem('userid'),
        ukey: localStorage.getItem('ukey'),
        classid: localStorage.getItem('classid'),
        longitude: t.longitude,
        latitude: t.latitude,
        duration: t.duration,
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
            t.innerVisible = true
            t.code = response.data.data.code
            t.message = response.data.data.message
            t.dialogFormVisible5 = false
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
  },
  mounted () {
    this.getClassInfo()
  }
}
</script>

<style scoped>
.map {
  width: 100%;
  height: 500px;
}
</style>
