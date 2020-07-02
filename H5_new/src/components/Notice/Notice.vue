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
                <a><i class="mdi mdi-view-dashboard"></i>消息通知</a>
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
      <!-- --------------------------------这里是消息列表-------------------------------------------- -->
      <el-tab-pane label="消息列表">
        <div class="wrapper">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="email-leftbar">
                    <div class="m-t-20" v-for="(item, index) in NoticeList" v-bind:key="index" @click="readMessage(item.FromUserId)">
                                <a href="#" class="media">
                                    <img class="d-flex mr-3 rounded-circle" src="@/assets/images/users/avatar-2.jpg" alt="Generic placeholder image" height="36">
                                    <div class="media-body chat-user-box">
                                      <el-badge :is-dot="item.HasNew" class="item">{{item.FromName}}</el-badge>
                                      <p class="user-title m-0">{{formatType(item.NoticeType)}}</p>
                                      <p class="text-muted"></p>
                                    </div>
                                </a>
                            </div>
                  </div>
                  <div class="email-rightbar mb-3">
                    <div class="card m-t-20">
                      <ul class="message-list" v-for="(item, index) in NoticeInfoList" v-bind:key="index">
                        <li>
                                        <a>
                                            <div class="col-mail col-mail-1">
                                              <div class="checkbox-wrapper-mail">
                                                    <input type="checkbox" id="chk20">
                                                    <label for="chk20" class="toggle"></label>
                                                </div>
                                                <p class="title">{{item.FromName}}</p><span class="star-toggle fa fa-star-o"></span>
                                            </div>
                                            <div class="col-mail col-mail-2">
                                                <div class="subject"><span class="teaser">{{item.InfoContent}}</span>
                                                </div>
                                                <div class="date">{{item.InfoDate}}</div>
<!--                                                <div class="noticetype">{{formatType(item.NoticeType)}}</div>-->
                                            </div>
                                          <div class="col-mail col-mail-3">
                                          <el-dialog title="消息详情" :visible.sync="dialogVisible" width="30%" :before-close="handleClose">
                                            <div class="card m-t-20">
                                              <div class="card-body" v-for="(item, index) in NoticeInfoList" v-bind:key="index">
                                                <div class="media m-b-30">
                                                  <img class="d-flex mr-3 rounded-circle thumb-md" src="@/assets/images/users/avatar-1.jpg" alt="Generic placeholder image">
                                                  <div class="media-body">
                                                    <h4 class="font-14 m-0">{{item.FromName}}</h4>
                                                    <small class="text-muted">{{item.InfoDate}}</small>
                                                  </div>
                                                </div>
                                                <!-- <h4 class="mt-0 font-18">这里是发消息的用户FromName</h4> -->
                                                <p>{{item.InfoContent}}</p>
                                                <hr>
                                              </div>
                                            </div>
                                            <span slot="footer" class="dialog-footer">
                                              <el-button @click="dialogVisible = false">取 消</el-button>
                                              <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
                                            </span>
                                          </el-dialog>
                                          </div>
                                        </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
  name: 'notice',
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
      cla_tea: '',
      c_name: '',
      content: '',
      not_type: '',
      isShow: false,
      dialogVisible: false,
      NoticeList: [],
      NoticeInfoList: []
    }
  },
  methods: {
    handleClose (done) {
      this.$confirm('确认关闭？')
        .then(_ => {
          done()
        })
        .catch(_ => {})
    },
    formatType (nottype) { // 表格数据转换 消息类别
      return nottype === '1' ? '班课通知' : nottype === '2' ? '用户消息' : '未知类型'
    },
    getAllNotice () {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/get-usernoticelist', qs.stringify({
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
            t.NoticeList = response.data.data.NoticeList
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
    readMessage (id) {
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      console.log(t.$md5(id))
      console.log(localStorage.getItem('userid'))
      this.$axios.post('api/get-noticeinfolist', qs.stringify({
        ToUserId: localStorage.getItem('userid'),
        ukey: localStorage.getItem('ukey'),
        FromUserId: t.$md5(id),
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
            t.dialogVisible = true
            t.NoticeInfoList = response.data.data.NoticeList
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
    exit () {
      console.log('注销')
      localStorage.removeItem('ukey')
      localStorage.removeItem('account')
      localStorage.removeItem('userid')
      this.$router.push({path: '/'})
    }
  },
  mounted () {
    this.getAllNotice()
  }
}
</script>

<style scoped>

</style>
