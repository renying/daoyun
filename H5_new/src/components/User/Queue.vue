<template>
<el-tabs type="border-card">
  <el-button type="primary" @click="selectDepartment()">开始预约挂号</el-button>
  <el-tab-pane>
    <span slot="label"><i class="el-icon-date"></i>门诊挂号</span>
    <el-row>
      <el-col :span="8" v-for="(o, index) in message" :key="index" :offset="index%2 > 0 ? 1 : 0">
        <el-card :body-style="{ padding: '0px' }">
          <img src="D:/project/yunhe/hospitalmanager/hospitalmanager-web/src/assets/logo.png" />
          <div style="padding: 14px;">
            <span>科室{{index+1}}</span>
            <div class="bottom clearfix">
              {{o.de_name}}
              <el-button type="text" class="button" @click="goDoctor(index+1)">进入</el-button>
             </div>
           </div>
         </el-card>
       </el-col>
     </el-row>
   </el-tab-pane>
</el-tabs>
</template>

<script>
export default {
  name: 'Queue',
  data () {
    return {
      cardid: '',
      message: [],
      totalPages: 0,
      currentPage: 0,
      size: 5,
      index: 1,
      imageURL: ''
    }
  },
  methods: {
    goDoctor (index) {
      // 这个index可以是后台传过来的部门id 然后点击后就能通过id获得部门信息了
      var t = this
      this.$axios({
        method: 'get',
        url: '/Employee/getDocByDeid?de_id=' + index
      })
        .then(function (response) {
          console.log(response)
          t.$router.push({path: '/Visitor/Doctor', query: {message: response.data, de_id: index}})
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    selectDepartment () {
      var t = this
      this.$axios({
        method: 'get',
        url: '/Department/getAllDepartment?currentPage=' + t.currentPage + '&size=' + t.size
      })
        .then(function (response) {
          t.message = response.data.content
          t.totalPages = response.data.totalPages * t.size
          console.log(t.message)
          t.loadingEmployee = false
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    mounted () {
      this.selectDepartment()
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .time {
    font-size: 13px;
    color: #999;
  }
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
  }

  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  .clearfix:after {
      clear: both
  }
</style>
