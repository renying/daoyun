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
      <el-tab-pane label="我加入的">
        <div class="row">
          <div v-for="(item, index) in JoinedList" v-bind:key="index" class="col-lg-3 col-md-6" @click="getClassId(item.ClassId)">
            <a href="/ClassInfo" class="gallery-popup" title="Open Imagination">
              <div class="project-item">
                <div class="overlay-container">
                  <img src="@/assets/images/gallery/work-1.jpg" alt="img" class="gallery-thumb-img">
                  <div class="project-item-overlay">
                    <h4>{{item.ClassName}}</h4>
                    <p>
                      <img src="@/assets/images/users/avatar-1.jpg" alt="user" class="thumb-sm rounded-circle" />
                      <span class="ml-2">{{item.UserName}}</span>
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <el-row class="controls controls-row">
          <div align="center">
            <el-input v-model="classid" size="medium" placeholder="输入课程编号" span="100"/>
            <el-button type="button" @click="addMyJoin()">加入新班课</el-button>
          </div>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="6">
            <div class="grid-content bg-purple"></div>
          </el-col>
        </el-row>
      </el-tab-pane>
      <el-tab-pane label="我创建的">
        <div class="row">
          <div v-for="(item, index) in CreatedList" v-bind:key="index" class="col-lg-3 col-md-6" @click="getClassId(item.ClassId)">
            <a href="/ClassInfo" class="gallery-popup" title="Open Imagination">
              <div class="project-item">
                <div class="overlay-container">
                  <img src="@/assets/images/gallery/work-1.jpg" alt="img" class="gallery-thumb-img">
                  <div class="project-item-overlay">
                    <h4>{{item.ClassName}}</h4>
                    <p>
                      <img src="@/assets/images/users/avatar-1.jpg" alt="user" class="thumb-sm rounded-circle" />
                      <span class="ml-2">{{item.UserName}}</span>
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div>
        <el-button type="primary" @click="dialogFormVisible4=true">创建班课</el-button>
      <el-dialog title="创建班课" :visible.sync="dialogFormVisible4">
        <el-form>
          <el-form-item label="班课名称">
            <el-input v-model="classInfo.className"></el-input>
          </el-form-item>
          <el-form-item label="课程简介">
            <el-input v-model="classInfo.classDesc"></el-input>
          </el-form-item>
          <el-form-item label="课程编号">
            <el-input v-model="classInfo.classCode"></el-input>
          </el-form-item>
          <el-form-item size="large">
            <el-button type="primary" @click="onCreate()">立即创建</el-button>
            <el-button @click="dialogFormVisible4 = false">取消</el-button>
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
    <button class="btn btn-primary w-md waves-effect waves-light" type="button"
                    @click="exit()">
                    注销
                    </button>
  </div>
</template>

<script>
export default {
  name: 'Homepage',
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
      classid: '',
      c_uname: '',
      c_name: '',
      c_school: '',
      dialogFormVisible4: false,
      JoinedList: [],
      CreatedList: [],
      classInfo: {
        ui: '',
        ukey: '',
        className: '',
        classDesc: '',
        classCode: ''
      }
    }
  },
  methods: {
    getAllClass () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/get-classinfo', qs.stringify({
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
            t.JoinedList = response.data.data.Joined
            t.CreatedList = response.data.data.Created
            console.log(t.JoinedList[0].UserName)
            // t.c_uname = response.data.data.UserName
            // t.c_name = response.data.data.ClassName
            // t.c_school = response.data.data.SchoolInfo
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
    getClassId (ClassId) {
      localStorage.setItem('classid', ClassId)
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
          ClassCode: t.classid,
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
              t.$router.push({path: 'ClassInfo'})
            } else if (response.data.code === 9999) {
              t.restult = '系统错误'
              t.isShow = true
            } else if (response.data.code === 1001) {
              t.restult = '请求错误'
            } else if (response.data.code === 1004) {
              t.$message('课程编号不存在')
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      }
    },
    onCreate () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      if (t.classInfo.className === '' || t.classInfo.classDesc === '' || t.classInfo.classCode === '') {
        t.$message('所有信息都必填!')
      } else {
        this.$axios.post('api/add-classinfo', qs.stringify({
          ui: localStorage.getItem('userid'),
          ukey: localStorage.getItem('ukey'),
          className: t.classInfo.className,
          classDesc: t.classInfo.classDesc,
          classCode: t.classInfo.classCode,
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
              t.$message('创建成功！')
              t.dialogFormVisible4 = false
              t.reload()
            } else if (response.data.code === 9999) {
              t.restult = '系统错误'
              t.isShow = true
            } else if (response.data.code === 1001) {
              t.restult = '请求错误'
            } else if (response.data.code === 1004) {
              t.$message('课程编号不存在')
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
    this.getAllClass()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
