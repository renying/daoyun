<template>
  <div>
    <el-dialog title="添加新药品" :visible.sync="saveDialogVisible">
      <el-form ref="from" :model="drug" label-width="80px">
        <el-form-item label="药品id">
          <el-input v-model="drug.drug_id"></el-input>
        </el-form-item>
        <el-form-item label="药品名称">
          <el-input type="textarea" :rows="4" v-model="drug.dr_name"></el-input>
        </el-form-item>
        <el-form-item label="药品数量">
          <el-input type="textarea" :rows="4" v-model="drug.dr_num"></el-input>
        </el-form-item>
        <el-form-item size="large">
          <el-button type="primary" @click="onSubmit()">保 存</el-button>
          <el-button @click="saveDialogVisible = false">取 消</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <el-row>
      <el-button type="success" @click="addDrug">添加新药品</el-button>
    </el-row>
    <div style="height: 30px;"></div>
    <el-row>
      <el-table :data="message" style="width: 100%">
        <el-table-column prop="drug_id" label="药品Id"></el-table-column>
        <el-table-column prop="dr_name" label="药品名称"></el-table-column>
        <el-table-column prop="dr_num" label="药品数量"></el-table-column>
        <el-table-column fixed="right" width="250px" label="操作">
          <template slot-scope="scope">
            <el-button size="mini" type="danger" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
            <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-row>
    <el-row type="flex" justify="center">
        <el-col :span="14">
            <div>
                <el-pagination @current-change="getDrugPage" background layout="sizes, prev, pager, next" :current-page="currentPage" :page-size="size" :total="totalPages">
                </el-pagination>
            </div>
        </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'Drug',
  data () {
    return {
      saveDialogVisible: false,
      currentPage: 0,
      size: 10,
      totalPages: 0,
      message: [],
      drug: {
        drug_id: '',
        dr_name: '',
        dr_num: ''
      }
    }
  },
  methods: {
    addDrug () {
      this.saveDialogVisible = true
    },
    onSubmit () {
      var t = this
      this.$axios({
        method: 'post',
        url: '/Drug/saveDrug',
        data: {
          id: t.drug.drug_id,
          name: t.drug.dr_name,
          num: t.drug.dr_num
        }
      })
        .then(function (response) {
          console.log(response)
          t.$notify({
            title: '成功',
            message: '成功保存药品' + response.data.dr_name,
            type: 'success'
          })
          t.getFirstDrugPage()
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getDrugPage (currentPage) {
      console.log('getDrugPage')
      var t = this
      this.$axios({
        method: 'get',
        url: '/Drug/getDrug?currentPage=' + (currentPage - 1) + '&size=' + t.size
      })
        .then(function (response) {
          t.message = response.data.content
          t.totalPages = response.data.totalPages * t.size
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getFirstDrugPage () {
      console.log('getFirstDru')
      var t = this
      this.$axios({
        method: 'get',
        url: '/Drug/getDrug?currentPage=' + t.currentPage + '&size=' + t.size
      })
        .then(function (response) {
          t.message = response.data.content
          t.totalPages = response.data.totalPages * t.size
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    handleEdit (index, row) {
      console.log(index, row)
      this.drug = row
      this.saveDialogVisible = true
    },
    handleDelete (index, row) {
      console.log(index, row)
      var t = this
      this.$axios({
        method: 'get',
        url: '/Drug/deleteDrugById?id=' + row.drug_id
      })
        .then(function (response) {
          console.log(response)
          t.$notify({
            title: '成功',
            message: '成功删除记录' + row.dr_name,
            type: 'success'
          })
          t.getFirstDrugPage()
        })
        .catch(function (error) {
          console.log(error)
          t.$notify({
            title: '警告',
            message: '删除记录' + row.dr_name + '失败',
            type: 'warning'
          })
        })
    }
  },
  mounted () {
    this.getFirstDrugPage()
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
