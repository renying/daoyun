<template>
  <div>
    <ul v-loading="loadingEmployee">
    </ul>
    <div style="height: 30px;"></div>
    <el-row>
      <el-table style="width: 100%">
        <el-table-column prop="c_name" label="课程名称"></el-table-column>
        <el-table-column prop="c_id" label="课程编号"></el-table-column>
        <el-table-column prop="c_description" label="课程说明"></el-table-column>
        <el-table-column prop="c_creattime" label="创建时间"></el-table-column>
        <el-table-column prop="c_uname" label="创建人用户名"></el-table-column>
        <el-table-column prop="c_unum" label="创建人工号"></el-table-column>
        <el-table-column prop="c_school" label="院系信息"></el-table-column>
        <el-table-column fixed="right" width="250px">
          <template slot="header">
            <el-input v-model="search" size="mini" placeholder="输入关键字搜索"/>
          </template>
          <template slot-scope="scope">
            <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
            <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
          </template>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          zz
        </el-table-column>
      </el-table>
    </el-row>
    <el-row type="flex" justify="center">
        <el-col :span="14">
            <div>
                <el-pagination @current-change="getEmployeePage" background layout="sizes, prev, pager, next" :current-page="currentPage" :page-size="size" :total="totalPages">
                </el-pagination>
            </div>
        </el-col>
    </el-row>
    <el-dialog title="添加新员工" :visible.sync="saveDialogVisible">
      <el-form ref="from" :model="employeeInfo" label-width="80px">
        <el-form-item label="账户名称">
          <el-input v-model="employeeInfo.account"></el-input>
        </el-form-item>
        <el-form-item label="密码">
          <el-input v-model="employeeInfo.e_code"></el-input>
        </el-form-item>
        <el-form-item label="姓名">
          <el-input v-model="employeeInfo.e_name"></el-input>
        </el-form-item>
        <el-form-item label="部门">
          <el-input v-model="employeeInfo.department_id"></el-input>
        </el-form-item>
        <el-form-item label="性别">
          <el-radio-group v-model="employeeInfo.e_sex" size="medium">
            <el-radio border label="1">男</el-radio>
            <el-radio border label="0">女</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="position">
          <el-input v-model="employeeInfo.position"></el-input>
        </el-form-item>
        <el-form-item label="title">
          <el-input v-model="employeeInfo.title"></el-input>
        </el-form-item>
        <el-form-item size="large">
          <el-button type="primary" @click="onSubmit">立即创建</el-button>
          <el-button @click="saveDialogVisible = false">取消</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
  </div>
</template>

<script>
export default {
  name: 'Myjoin',
  data () {
    return {
      loadingEmployee: true,
      totalPages: 0,
      currentPage: 0,
      size: 5,
      message: [],
      search: '',
      classInfo: {
        c_name: '',
        c_id: '',
        c_description: '',
        c_creattime: '',
        c_uname: '',
        c_unum: '',
        c_school: ''
      },
      saveDialogVisible: false
    }
  },
  mounted () {
    this.getAllEmployee()
  },
  methods: {
    formatRole (row, column) { // 表格数据转换 性别
      return row.e_sex === '1' ? '男' : row.e_sex === '0' ? '女' : '未知'
    },
    getClassInfo () {
      console.log('getAllEmployee')
      var t = this
      this.$axios({
        method: 'get',
        url: '/Employee/GetAllEmployee?currentPage=' + t.currentPage + '&size=' + t.size
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
    onSubmit () {
      console.log(this.employeeInfo)
      this.saveDialogVisible = false
      this.saveEmployee()
      // this.employeeInfo.account = ''
      // this.employeeInfo.department_id = ''
      // this.employeeInfo.e_code = ''
      // this.employeeInfo.e_name = ''
      // this.employeeInfo.e_sex = ''
      // this.employeeInfo.position = ''
      // this.employeeInfo.title = ''
    },
    saveEmployee () {
      var t = this
      this.$axios({
        method: 'post',
        url: '/Employee/saveEmployee',
        data: {
          e_id: t.employeeInfo.e_id,
          account: t.employeeInfo.account,
          department_id: t.employeeInfo.department_id,
          e_code: t.employeeInfo.e_code,
          e_name: t.employeeInfo.e_name,
          e_sex: t.employeeInfo.e_sex,
          position: t.employeeInfo.position,
          title: t.employeeInfo.title
        }
      })
        .then(function (response) {
          console.log(response)
          t.$notify({
            title: '成功',
            message: '成功保存员工' + response.data.e_name,
            type: 'success'
          })
          t.getAllEmployee()
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    handleEdit (index, row) {
      console.log(index, row)
      this.employeeInfo = row
      this.employeeInfo.department_id = row.department.de_id
      console.log(this.employeeInfo)
      this.saveDialogVisible = true
    },
    addEmployee () {
      this.saveDialogVisible = true
      this.employeeInfo.account = ''
      this.employeeInfo.department_id = ''
      this.employeeInfo.e_code = ''
      this.employeeInfo.e_name = ''
      this.employeeInfo.e_sex = ''
      this.employeeInfo.position = ''
      this.employeeInfo.title = ''
    },
    handleDelete (index, row) {
      console.log(index, row)
      var t = this
      this.$axios({
        method: 'get',
        url: '/Employee/deleteEmployee?id=' + row.e_id
      })
        .then(function (response) {
          console.log(response)
          t.$notify({
            title: '成功',
            message: '成功删除员工' + row.e_name,
            type: 'success'
          })
          t.getAllEmployee()
        })
        .catch(function (error) {
          console.log(error)
          t.$notify({
            title: '警告',
            message: '删除员工' + row.e_name + '失败',
            type: 'warning'
          })
        })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.el-header, .el-footer {
    background-color: #B3C0D1;
    color: #333;
    text-align: center;
    line-height: 60px;
  }
</style>
