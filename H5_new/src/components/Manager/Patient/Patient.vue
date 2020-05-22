<template>
  <div>
    <el-dialog title="添加新病人" :visible.sync="saveDialogVisible">
      <el-form ref="from" :model="patientInfo" label-width="80px">
        <el-form-item label="账号">
          <el-input v-model="patientInfo.cardid"></el-input>
        </el-form-item>
        <el-form-item label="密码">
          <el-input v-model="patientInfo.p_code"></el-input>
        </el-form-item>
        <el-form-item label="姓名">
          <el-input v-model="patientInfo.name"></el-input>
        </el-form-item>
        <el-form-item label="性别">
          <el-radio-group v-model="patientInfo.sex" size="medium">
            <el-radio border label="1">男</el-radio>
            <el-radio border label="0">女</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-col class="HisCureList" v-for="(m, index) in HisList" :key="index">
          <el-card class="box-card">
            <div slot="header" class="clearfix">
              <span>治疗记录 {{index+1}}</span>
            </div>
            <div style="padding: 14px;">
              <p>治疗日期：{{m.p_time}}</p>
              <p>治疗内容：{{m.cure_method}}</p>
            </div>
          </el-card>
        </el-col>
        <el-form-item size="large">
          <el-button type="primary" @click="onSubmit()">修 改</el-button>
          <el-button @click="saveDialogVisible = false">取 消</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <el-row>
      <el-button type="success" @click="addPatient">添加新病人</el-button>
    </el-row>
    <div style="height: 30px;"></div>
    <el-row>
      <el-table :data="message.filter(data => !search || data.name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%">
        <el-table-column prop="cardid" label="卡号"></el-table-column>
        <el-table-column prop="name" label="姓名"></el-table-column>
        <el-table-column prop="sex" :formatter="formatRole" label="性别"></el-table-column>
        <el-table-column fixed="right" width="250px">
          <template slot="header" slot-scope="scope">
            <el-input v-model="search" size="mini" placeholder="输入关键字搜索"/>
          </template>
          <template slot-scope="scope">
            <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">查看详情</el-button>
            <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-row>
    <el-row type="flex" justify="center">
        <el-col :span="14">
            <div>
                <el-pagination @current-change="getPatientPage" background layout="sizes, prev, pager, next" :current-page="currentPage" :page-size="size" :total="totalPages">
                </el-pagination>
            </div>
        </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'Patient',
  data () {
    return {
      search: '',
      currentPage: 0,
      size: 10,
      saveDialogVisible: false,
      patientInfo: {
        pid: '',
        cardid: '',
        p_code: '',
        name: '',
        sex: '',
        hist_ill: '',
        hist_cure: ''
      },
      totalPages: 0,
      message: [],
      loadingPatient: false,
      HisList: []
    }
  },
  methods: {
    formatRole (row, column) { // 表格数据转换 性别
      return row.sex === '1' ? '男' : row.sex === '0' ? '女' : '未知'
    },
    getAllPatient () {
      console.log('getAllPatient')
      var t = this
      this.$axios({
        method: 'get',
        url: '/Patient/getAllPatient?currentPage=' + t.currentPage + '&size=' + t.size
      })
        .then(function (response) {
          t.message = response.data.content
          t.totalPages = response.data.totalPages * t.size
          console.log(t.message)
          t.loadingPatient = false
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getPatientPage (currentPage) {
      console.log('getPatientPage')
      var t = this
      this.$axios({
        method: 'get',
        url: '/Patient/getAllPatient?currentPage=' + (currentPage - 1) + '&size=' + t.size
      })
        .then(function (response) {
          t.message = response.data.content
          t.totalPages = response.data.totalPages * t.size
          console.log(t.message)
          t.loadingPatient = false
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    onSubmit () {
      var t = this
      if (t.patientInfo.cardid === '' || t.patientInfo.name === '' || t.patientInfo.sex === '' || t.patientInfo.p_code === '') {
        t.$notify({
          title: '警告',
          message: '内容不能为空',
          type: 'warning'
        })
      } else {
        this.$axios({
          method: 'post',
          url: '/Patient/addPatient',
          data: {
            pid: t.patientInfo.pid,
            cardid: t.patientInfo.cardid,
            name: t.patientInfo.name,
            sex: t.patientInfo.sex,
            p_code: t.patientInfo.p_code,
            hist_ill: t.patientInfo.hist_ill,
            hist_cure: t.patientInfo.hist_cure
          }
        })
          .then(function (response) {
            console.log(response)
            t.saveDialogVisible = false
            t.$notify({
              title: '成功',
              message: '成功保存病人' + response.data.name,
              type: 'success'
            })
            t.getAllPatient()
          })
          .catch(function (error) {
            console.log(error)
            t.$notify({
              title: '警告',
              message: '保存用户' + t.patientInfo.name + '失败',
              type: 'warning'
            })
          })
      }
    },
    addPatient () {
      this.saveDialogVisible = true
      this.patientInfo.pid = ''
      this.patientInfo.cardid = ''
      this.patientInfo.p_code = ''
      this.patientInfo.name = ''
      this.patientInfo.sex = ''
      this.patientInfo.hist_ill = ''
      this.patientInfo.hist_cure = ''
    },
    handleEdit (index, row) {
      console.log(index, row)
      this.patientInfo = row
      var t = this
      this.$axios({
        method: 'get',
        url: '/HistoryCure/getHisCureByPatient?cardid=' + row.cardid
      })
        .then(function (response) {
          console.log(response)
          t.HisList = response.data
        })
        .catch(function (error) {
          console.log(error)
        })
      this.saveDialogVisible = true
    },
    handleDelete (index, row) {
      console.log(index, row)
      var t = this
      this.$axios({
        method: 'get',
        url: '/Patient/deletePatient?card_id=' + row.pid
      })
        .then(function (response) {
          console.log(response)
          t.$notify({
            title: '成功',
            message: '成功删除用户' + row.name,
            type: 'success'
          })
          t.getAllPatient()
        })
        .catch(function (error) {
          console.log(error)
          t.$notify({
            title: '警告',
            message: '删除用户' + row.name + '失败',
            type: 'warning'
          })
        })
    }
  },
  mounted () {
    this.getAllPatient()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.HisCureList{
  margin-bottom: 20px;
}
</style>
