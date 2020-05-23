<template>
    <div class="update" height="800px">
      <div>
        <p>用户ID：{{pid}}</p>
        <p>用户名：{{message.name}}</p>
        <p>出生年份：{{message.year}}</p>
        <p>性别：{{message.sex}}</p>
      </div>
      <el-button type="primary" @click="dialogFormVisible1=true">修改信息</el-button>
      <el-dialog title="修改信息" :visible.sync="dialogFormVisible1">
        <el-form ref="from" :model="patientInfo" label-width="80px">
          <el-form-item label="姓名">
            <el-input v-model="patientInfo.name"></el-input>
          </el-form-item>
          <el-form-item label="性别">
            <el-radio-group v-model="patientInfo.sex" size="medium">
              <el-radio border label="1">男</el-radio>
              <el-radio border label="0">女</el-radio>
            </el-radio-group>
          </el-form-item>
          <el-form-item size="large">
            <el-button type="primary" @click="onSubmit()">立即修改</el-button>
            <el-button @click="dialogFormVisible1 = false">取消</el-button>
          </el-form-item>
        </el-form>
      </el-dialog>
     </div>
</template>

<script>
export default {
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
      message: {
        cardid: '',
        name: '',
        sex: ''
      },
      search: '',
      patientInfo: {
        pid: '',
        cardid: '',
        p_code: '',
        name: '',
        sex: ''
      },
      changeCode: { // 访问的时候要先写  对象名 . 成员
        p_code_old: '',
        p_code_new: ''
      }
    }
  },
  methods: {
    formatRole (sex) { // 表格数据转换 性别
      return sex === 1 ? '男' : sex === 0 ? '女' : '未知'
    },
    getPatientById () {
      console.log('getPatientById')
      var t = this
      this.$axios({
        method: 'get',
        url: '/Patient/getPatientById?pid=' + t.pid
      })
        .then(function (response) {
          t.message = response.data
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getUserInfo () {
      console.log('getUser')
      var t = this
      var myDate = new Date()
      var qs = require('qs')
      this.$axios.post('api/get-userinfo', qs.stringify({
        ui: t.account,
        ukey: t.$root.ukey,
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
            t.username = response.data.username
            t.NickName = response.data.NickName
            t.year = response.data.BornDate
            t.UserSex = response.data.UserSex
            t.UserType = response.data.UserType
            t.Address = response.data.Address
            t.Phone = response.data.Phone
            t.$router.push({path: 'Homepage'})
          } else if (response.data.code === 1002) {
            t.restult = '用户账号错误'
            t.isShow = true
          } else if (response.data.code === 1001) {
            t.restult = '请求错误'
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    }
    // onSubmit () {
    //   console.log('onSubmit')
    //   var t = this
    //   this.$axios({
    //     method: 'post',
    //     url: '/Patient/saveUserinfo',
    //     data: {
    //       pid: t.pid,
    //       cardid: t.message.cardid,
    //       name: t.patientInfo.name,
    //       sex: t.patientInfo.sex,
    //       p_code: t.message.p_code,
    //       hist_ill: t.message.hist_ill,
    //       hist_cure: t.message.hist_cure
    //     }
    //   })
    //     .then(function (response) {
    //       t.message = response.data
    //       console.log(t.message)
    //       t.patientInfo.name = t.message.name
    //       t.patientInfo.sex = t.message.sex
    //       t.dialogFormVisible1 = false
    //       t.$notify({
    //         title: '成功',
    //         message: '修改成功！',
    //         type: 'success'
    //       })
    //     })
    //     .catch(function (error) {
    //       console.log(error)
    //       t.$notify({
    //         title: '警告',
    //         message: '修改失败',
    //         type: 'warning'
    //       })
    //     })
    // },
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
    this.getUserInfo()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.update {
  background-color: rgb(255, 255, 255)
}
</style>
