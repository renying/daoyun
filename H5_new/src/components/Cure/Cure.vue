<template>
  <div>
    <el-row :gutter="60">
      <el-col :span="5" :offset="2">
        <div>
          <el-row>
            <p>添加症状：<el-input type="textarea" :rows="3" v-model="symptom" placeholder="请输入症状"></el-input></p>
          </el-row>
          <el-row>
            <p>病症：<el-input type="textarea" :rows="3" v-model="disease" placeholder="请输入病症名称"></el-input></p>
          </el-row>
          <el-row>
            <p>治疗方案：
              <el-select v-model="selectedCureItem" placeholder="治疗项目">
                <el-option v-for="item in cureItem" :key="item.value" :label="item.label" :value="item.value"></el-option>
              </el-select>
            </p>
            <p>治疗药物：
              <el-select v-model="drugs" multiple filterable remote reserve-keyword placeholder="请输入关键词" :remote-method="remoteMethod" :loading="loading">
                <el-option v-for="item in drugInfo" :key="item.value" :label="item.label" :value="item.value"></el-option>
              </el-select>
            </p>
            <p>数量：
              <el-input v-model="num" placeholder="请输入药品数量"></el-input>
            </p>
          </el-row>
          <el-row>
            <el-button type="primary" @click="dialogVisible = true">确认</el-button>
            <el-dialog title="提示" :visible.sync="dialogVisible" width="30%" :before-close="handleClose">
              <span>确定提交吗？</span>
              <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="dialogVisible = false;goInput()">确 定</el-button>
              </span>
            </el-dialog>
          </el-row>
        </div>
      </el-col>
      <el-col :span="14">
        <div>
          <el-card>
            <router-view/>
          </el-card>
        </div>
      </el-col>
  </el-row>
  </div>
</template>
<script>
export default {
  data () {
    return {
      cardid: this.$route.query.cardid,
      loadingHistory: true,
      size: 5,
      currentPage: 0,
      message: '',
      drugInfo: [ // 后台实时找到的数据
        {
          drug_id: '',
          dr_name: '',
          dr_num: ''
        }
      ],
      drugs: [], // 选中用于治疗的药物
      symptom: '',
      disease: '',
      num: '',
      dialogVisible: false,
      dialogVisible1: false,
      cureItem: [
        {
          value: '无',
          label: '无'
        }, {
          value: 'CT',
          label: 'CT'
        }, {
          value: '心电图',
          label: '心电图'
        }, {
          value: '胃镜',
          label: '胃镜'
        }
      ],
      selectedCureItem: '', // 选中的医疗项目
      loading: false
    }
  },
  mounted () {
    this.getAllDrugs()
    this.$router.push({path: '/Cure/Advice', query: {cardid: this.cardid}})
  },
  methods: {
    remoteMethod (query) {
      if (query !== '') {
        this.loading = true
        this.getAllDrugInfo(query)
        setTimeout(() => {
          this.loading = false
          this.drugInfo = this.list.filter(item => {
            return item.label.toLowerCase()
              .indexOf(query.toLowerCase()) > -1
          })
        }, 200)
      } else {
        this.drugInfo = []
      }
    },
    formatRole (row, column) { // 表格数据转换 性别
      return row.e_sex === '1' ? '男' : row.e_sex === '0' ? '女' : '未知'
    },
    handleClose () {
      this.dialogVisible = false
    },
    getAllDrugInfo (query) {
      var t = this
      this.$axios({
        method: 'get',
        url: '/Drug/findDrugByName?query=' + query
      })
        .then(function (response) {
          t.message = response.data
          t.drugInfo = t.message.map(item => {
            return { value: item.drug_id, label: item.dr_name }
          })
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getAllDrugs () {
      var t = this
      this.$axios({
        method: 'get',
        url: '/Drug/getAllDrug'
      })
        .then(function (response) {
          t.message = response.data
          t.drugInfo = t.message.map(item => {
            return { value: item.drug_id, label: item.dr_name }
          })
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    goInput () {
      console.log(this.selectedCureItem + '=====' + this.drugs + this.cardid)
      var t = this
      this.$axios({
        method: 'post', // 这个是存就诊记录的吗？对 不要用get
        url: '/HistoryCure/saveHistoryCure',
        data: {
          cardid: t.cardid,
          cure_method: '',
          p_time: new Date(),
          symptom: t.symptom,
          disease: t.disease,
          cureItem: t.selectedCureItem,
          drug: t.drugs[0]
        }
      })
        .then(function (response) {
          console.log(response)
          // this.$router.push({path: '/Cure/Input'})
          t.$router.push({path: '/Cure/Advice', query: {cardid: this.cardid}})
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    goAdvice () {
      // this.$router.push({path: '/Cure/HistoryCure'})
    }
  }
}
</script>

<style>
.el-aside {
    background-color: rgb(255, 255, 255);
    color: #333;
    height: 600px
  }
</style>
