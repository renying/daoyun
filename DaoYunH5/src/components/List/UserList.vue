
<template>

  <div>

    <ul v-loading="loadingUser">

    </ul>

    <el-row>

      <el-button type="success" @click="addEmployee">添加新员工</el-button>

    </el-row>

    <div style="height: 30px;"></div>

    <el-row>

      <el-table :data="message.filter(data => !search || data.e_name.toLowerCase().includes(search.toLowerCase()))" style="width: 100%">

        <el-table-column prop="e_name" label="姓名"></el-table-column>

        <el-table-column prop="account" label="账号"></el-table-column>

        <el-table-column prop="e_sex" :formatter="formatRole" label="性别"></el-table-column>

        <el-table-column prop="department.de_name" label="部门"></el-table-column>

        <el-table-column fixed="right" width="250px">

          <template slot="header">

            <el-input v-model="search" size="mini" placeholder="输入关键字搜索"/>

          </template>

          <template slot-scope="scope">

            <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>

            <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>

          </template>

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

    <el-dialog title="添加新用户" :visible.sync="saveDialogVisible">

      <el-form ref="from" :model="userInfo" label-width="80px">

        <el-form-item label="账户名称">

          <el-input v-model="userInfo.account"></el-input>

        </el-form-item>

        <el-form-item label="密码">

          <el-input v-model="userInfo.password"></el-input>

        </el-form-item>

        <el-form-item label="姓名">

          <el-input v-model="userInfo.name"></el-input>

        </el-form-item>

        <el-form-item label="出生年月">

          <el-input v-model="userInfo.department_id"></el-input>

        </el-form-item>

        <el-form-item label="性别">

          <el-radio-group v-model="userInfo.e_sex" size="medium">

            <el-radio border label="1">男</el-radio>

            <el-radio border label="0">女</el-radio>

          </el-radio-group>

        </el-form-item>

        <el-form-item label="position">

          <el-input v-model="userInfo.position"></el-input>

        </el-form-item>

        <el-form-item label="title">

          <el-input v-model="userInfo.title"></el-input>

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

  name: 'UserList',

  data () {
    return {

      loadingEmployee: true,

      totalPages: 0,

      currentPage: 0,

      size: 5,

      message: [],

      search: '',

      employeeInfo: {

        e_id: '',

        account: '',

        department_id: '',

        e_code: '',

        e_name: '',

        e_sex: '',

        position: '',

        title: ''

      },

      saveDialogVisible: false

    }
  },

  mounted () {
    this.getAllEmployee()
  },

  methods: {

    // formatRole (row, column) { // 表格数据转换 性别

    //   return row.e_sex === '1' ? '男' : row.e_sex === '0' ? '女' : '未知'

    // },
    getAllUser () {
      console.log('getAllUser')

      var t = this

      this.$axios({

        method: 'get',

        url: 'api/get-userinfo'

      })

        .then(function (response) {
          t.message = response.data.content

          //   t.totalPages = response.data.totalPages * t.size

          console.log(t.message)

        //   t.loadingUser= false
        })

        .catch(function (error) {
          console.log(error)
        })
    },

    // getEmployeePage (currentPage) {

    //   console.log('getEmployeePage')

    //   var t = this

    //   this.$axios({

    //     method: 'get',

    //     url: '/Employee/GetAllEmployee?currentPage=' + (currentPage - 1) + '&size=' + t.size

    //   })

    //     .then(function (response) {

    //       t.message = response.data.content

    //       t.totalPages = response.data.totalPages * t.size

    //       console.log(t.message)

    //       t.loadingEmployee = false

    //     })

    //     .catch(function (error) {

    //       console.log(error)

    //     })

    // },

    onSubmit () {
      console.log(this.userInfo)

      this.saveDialogVisible = false

      this.saveUser()

      this.userInfo.account = ''

      this.userInfo.password = ''

      this.userInfo.name = ''

      this.userInfo.sex = ''

      this.userInfo.NickName = ''

      this.userInfo.BornDate = ''
    }
    // saveUser () {

    //   var t = this
    //   var myDate = Date()
    //   this.$axios({

    //     method: 'post',

    //     url: 'api/get-userinfo',

    //     data: {

    //       ui: t.userid,

    //       p: t.password,

    //       TimeStamp: myDate,

    //       CheckCode: t.CheckCode

    //     }

    //   })

    //     .then(function (response) {

    //       console.log(response)

    //       t.$notify({

    //         title: '成功',

    //         message: '成功保存用户' + response.data.e_name,

    //         type: 'success'

    //       })

    //       t.getAllEmployee()

    //     })

    //     .catch(function (error) {

    //       console.log(error)

    //     })

    // },

    // handleEdit (index, row) {

    //   console.log(index, row)

    //   this.employeeInfo = row

    //   this.employeeInfo.department_id = row.department.de_id

    //   console.log(this.employeeInfo)

    //   this.saveDialogVisible = true

    // },

    // addEmployee () {

    //   this.saveDialogVisible = true

    //   this.employeeInfo.account = ''

    //   this.employeeInfo.department_id = ''

    //   this.employeeInfo.e_code = ''

    //   this.employeeInfo.e_name = ''

    //   this.employeeInfo.e_sex = ''

    //   this.employeeInfo.position = ''

    //   this.employeeInfo.title = ''

    // },

    // handleDelete (index, row) {

    //   console.log(index, row)

    //   var t = this

    //   this.$axios({

    //     method: 'get',

    //     url: '/Employee/deleteEmployee?id=' + row.e_id

    //   })

    //     .then(function (response) {

    //       console.log(response)

    //       t.$notify({

    //         title: '成功',

    //         message: '成功删除员工' + row.e_name,

    //         type: 'success'

    //       })

    //       t.getAllEmployee()

    //     })

    //     .catch(function (error) {

    //       console.log(error)

    //       t.$notify({

    //         title: '警告',

    //         message: '删除员工' + row.e_name + '失败',

    //         type: 'warning'

    //       })

    //     })

    // }

  }

}
</script>
