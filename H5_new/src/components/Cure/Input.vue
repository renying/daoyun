<template>
  <div>
    <el-row type="flex" justify="center">
      <el-col :span="6">
        <el-card>
          <p>病人账号：<el-input v-model="input" placeholder="请输入病人账号"></el-input></p>
          <el-button type="primary" @click="selectPatient(input)">确认</el-button><el-button type="primary">清空</el-button>
      </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'Input',
  data () {
    return {
      input: '',
      patientInfo: [],
      HistoryCure: ''
    }
  },
  methods: {
    selectPatient (input) {
      console.log(input)
      var t = this
      this.$axios({
        method: 'get',
        url: '/Patient/getPatient?cardid=' + input
      })
        .then(function (response) {
          console.log(response)
          t.$router.push({path: '/Cure/Cure', query: {cardid: response.data.cardid}})
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
