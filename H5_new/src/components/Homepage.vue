<template>
  <div>
    <el-container>
    <el-header id="topnav">
            <!-- MENU Start -->
      <div>
        <a>
          <img src="" alt="" height="50">
        </a>
      </div>
      <div class="topbar-main">
        <div class="container-fluid">
          <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">
              <li>
                <a href="/Homepage"><i class="mdi mdi-view-dashboard"></i>我的班课</a>
              </li>
              <li class="has-submenu">
                <a href="/MyInfo/MyInfo"><i class="mdi mdi-view-dashboard"></i>我的信息</a>
              </li>
            </ul>
            <!-- End navigation menu -->
          </div> <!-- end #navigation -->
        </div> <!-- end container -->
      </div> <!-- end navbar-custom -->
    </el-header>
    <el-main>
    <el-tabs type="border-card">
      <el-tab-pane label="我加入的">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <a href="#" class="gallery-popup" title="Open Imagination">
              <div class="project-item">
                <div class="overlay-container">
                  <img src="@/assets/images/gallery/work-1.jpg" alt="img" class="gallery-thumb-img">
                  <div class="project-item-overlay">
                    <h4>这里放课程名称</h4>
                    <p>
                      <img src="@/assets/images/users/avatar-1.jpg" alt="user" class="thumb-sm rounded-circle" />
                      <span class="ml-2">这里放任课教师</span>
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6">
            <a href="#" class="gallery-popup" title="Open Imagination">
              <div class="project-item">
                <div class="overlay-container">
                  <img src="@/assets/images/gallery/work-2.jpg" alt="img" class="gallery-thumb-img">
                  <div class="project-item-overlay">
                    <h4>这里放课程名称</h4>
                    <p>
                      <img src="@/assets/images/users/avatar-2.jpg" alt="user" class="thumb-sm rounded-circle" />
                      <span class="ml-2">这里放任课教师</span>
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <el-row class="controls controls-row">
          <div style="float:right">
            <el-input v-model="classid" size="medium" placeholder="输入课程编号" span="100"/>
            <el-button type="button" @click="addMyJoin()">加入新班课</el-button>
          </div>
          <ul>
            <li prop="c_name" label="课程名称"></li>
            <li prop="c_uname" label="创建人用户名"></li>
            <li prop="c_school" label="院系信息"></li>
          </ul>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="6">
            <div class="grid-content bg-purple"></div>
          </el-col>
        </el-row>
      </el-tab-pane>
      <el-tab-pane label="我创建的">
        配置管理
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <a href="assets/images/gallery/work-1.jpg" class="gallery-popup" title="Open Imagination">
              <div class="project-item">
                <div class="overlay-container">
                  <img src="@/assets/images/gallery/work-1.jpg" alt="img" class="gallery-thumb-img">
                  <div class="project-item-overlay">
                    <h4>这里放课程名称</h4>
                    <p>
                      <img src="@/assets/images/users/avatar-1.jpg" alt="user" class="thumb-sm rounded-circle" />
                      <span class="ml-2">这里放任课教师</span>
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6">
            <a href="assets/images/gallery/work-2.jpg" class="gallery-popup" title="Open Imagination">
              <div class="project-item">
                <div class="overlay-container">
                  <img src="@/assets/images/gallery/work-2.jpg" alt="img" class="gallery-thumb-img">
                  <div class="project-item-overlay">
                    <h4>这里放课程名称</h4>
                    <p>
                      <img src="@/assets/images/users/avatar-2.jpg" alt="user" class="thumb-sm rounded-circle" />
                      <span class="ml-2">这里放任课教师</span>
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </el-tab-pane>
    </el-tabs>
    </el-main>
    <div style="height: 30px; witdh: 100%"></div>
    <router-view/>
  </el-container>
    <button class="btn btn-primary w-md waves-effect waves-light" type="button"
                    @click="exit()">
                    注销
                    </button>
  </div>
</template>

<script>
export default {
  name: 'Homepage',
  data () {
    return {
      classid: '',
      c_uname: '',
      c_name: '',
      c_school: ''
    }
  },
  methods: {
    getJoinClass () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.get('api/get-classinfo', qs.stringify({
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
            t.c_uname = response.data.data.UserName
            t.c_name = response.data.data.ClassName
            t.c_school = response.data.data.SchoolInfo
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
    handleSelect (val, valkey) {
      console.log(val, valkey)
      if (val === '1') {
        this.$router.push({path: '/Homepage/Myclass'})
      } else if (val === '2') {
        this.$router.push({path: '/Homepage/Myjoin'})
      }
      console.log(val, valkey)
    },
    addMyJoin () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      if (t.classid === '') {
        this.$message('课程编号不能为空')
      } else {
        this.$axios.post('api/choose-class', qs.stringify({
          ui: localStorage.getItem('userid'),
          ukey: localStorage.getItem('ukey'),
          classId: t.classid,
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
              t.$router.push({path: 'Myjoin'})
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
    exit () {
      console.log('注销')
      localStorage.removeItem('ukey')
      localStorage.removeItem('account')
      localStorage.removeItem('userid')
      this.$router.push({path: '/'})
    }
  },
  mounted () {
    // this.$router.push({path: '/HospitalManager/Employee'})
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
