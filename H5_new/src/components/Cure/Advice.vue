<template>
<div>
    <div style="background-color: white">
        <el-row>
          <el-col>
            <h1>病人信息</h1>
              <el-row>
                卡号：<el-input v-model="message.cardid" :disabled="true"></el-input>
              </el-row>
              <el-row>
                姓名：<el-input v-model="message.name" :disabled="true"></el-input>
              </el-row>
          </el-col>
        </el-row>
        <h1>病史</h1>
        <el-row>
          <el-col>
            <el-container>
              <el-table :data="HistoryCure">
                <el-table-column prop="p_time" label="日期"></el-table-column>
                <el-table-column prop="symptom" label="症状"></el-table-column>
                <el-table-column prop="disease" label="病症"></el-table-column>
                <el-table-column prop="cureItem" label="治疗方案"></el-table-column>
                <el-table-column prop="drugs.dr_name" label="治疗药物"></el-table-column>
                <el-table-column prop="drugs.dr_num" label="剂量"></el-table-column>
              </el-table>
            </el-container>
          </el-col>
         </el-row>
    </div>
</div>
</template>

<script>
export default {
  name: 'Advice',
  mounted () {
    this.getHistoryCure(this.$route.query.cardid)
    this.getPatient(this.$route.query.cardid)
  },
  data () {
    return {
      HistoryCure: [],
      message: [],
      cardid: this.$route.query.cardid
    }
  },
  methods: {
    getPatient (input) {
      console.log(input + 'getPatient ' + '/Patient/getPatient?cardid=' + input)
      var t = this
      this.$axios({
        method: 'get',
        url: '/Patient/getPatient?cardid=' + input
      })
        .then(function (response) {
          console.log(response)
          t.message = response.data
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getHistoryCure (input) {
      console.log(input + 'getHistoryCure')
      var t = this
      this.$axios({
        method: 'get',
        url: '/HistoryCure/getHisCureByPatient?cardid=' + input
      })
        .then(function (response) {
          console.log(response)
          t.HistoryCure = response.data
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
