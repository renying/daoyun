<template>
<div>
  <el-row>
    <el-col :span="8" v-for="(doc, index) in message" :key="index" :offset="index%2 === 1 ? 1 : 0">
      <el-card :body-style="{ padding: '0px' }">
        <img src="\logo.png" class="image">
        <div style="padding: 14px;">
          <span>{{doc.e_name}}</span>
          <span>{{doc.title}}</span>
          <div class="bottom clearfix">
            <el-button type="text" class="button" @click="dialogFormVisible2 = true,getState()">预约</el-button>
          </div>
        </div>
      </el-card>
    </el-col>
    <el-dialog title="预约挂号" :visible.sync="dialogFormVisible2">
      <el-form>
        <el-form-item label="用户卡号：">
          <el-input v-model="cardid"></el-input>
        </el-form-item>
        <el-form-item label="预约时间">
          <div class="block">
            <span class="demonstration">默认</span>
            <el-date-picker v-model="yuyuedate" type="date" placeholder="选择日期" readonly>
            </el-date-picker>
          </div>
        </el-form-item>
        <el-form-item>
            <el-select v-model="date2" placeholder="请选择预约详细时间">
              <el-option label="8:00~8:10" value="1" v-if="Timestate[0].state == 1"></el-option>
              <el-option label="8:10~8:20" value="2"  v-if="Timestate[1].state == 1"></el-option>
              <el-option label="8:20~8:30" value="3"  v-if="Timestate[2].state == 1"></el-option>
              <el-option label="8:30~8:40" value="4"  v-if="Timestate[3].state == 1"></el-option>
              <el-option label="8:40~8:50" value="5"  v-if="Timestate[4].state == 1"></el-option>
              <el-option label="8:50~9:00" value="6"  v-if="Timestate[5].state == 1"></el-option>
              <el-option label="9:00~9:10" value="7"  v-if="Timestate[6].state == 1"></el-option>
              <el-option label="9:10~9:20" value="8"  v-if="Timestate[7].state == 1"></el-option>
              <el-option label="9:20~9:30" value="9"  v-if="Timestate[8].state == 1"></el-option>
              <el-option label="9:30~9:40" value="10"  v-if="Timestate[9].state == 1"></el-option>
              <el-option label="9:40~9:50" value="11"  v-if="Timestate[10].state == 1"></el-option>
              <el-option label="9:50~10:00" value="12"  v-if="Timestate[11].state == 1"></el-option>
              <el-option label="10:00~10:10" value="13"  v-if="Timestate[12].state == 1"></el-option>
              <el-option label="10:10~10:20" value="14"  v-if="Timestate[13].state == 1"></el-option>
              <el-option label="10:20~10:30" value="15"  v-if="Timestate[14].state == 1"></el-option>
              <el-option label="10:30~10:40" value="16"  v-if="Timestate[15].state == 1"></el-option>
              <el-option label="10:40~10:50" value="17"  v-if="Timestate[16].state == 1"></el-option>
              <el-option label="10:50~11:00" value="18"  v-if="Timestate[17].state == 1"></el-option>
              <el-option label="11:00~11:10" value="19"  v-if="Timestate[18].state == 1"></el-option>
              <el-option label="11:10~11:20" value="20"  v-if="Timestate[19].state == 1"></el-option>
              <el-option label="11:20~11:30" value="21"  v-if="Timestate[20].state == 1"></el-option>
              <el-option label="11:30~11:40" value="22"  v-if="Timestate[21].state == 1"></el-option>
              <el-option label="11:40~11:50" value="23"  v-if="Timestate[22].state == 1"></el-option>
              <el-option label="11:50~12:00" value="24"  v-if="Timestate[23].state == 1"></el-option>
              <el-option label="14:00~14:10" value="25"  v-if="Timestate[24].state == 1"></el-option>
              <el-option label="14:10~14:20" value="26"  v-if="Timestate[25].state == 1"></el-option>
              <el-option label="14:20~14:30" value="27"  v-if="Timestate[26].state == 1"></el-option>
              <el-option label="14:30~14:40" value="28"  v-if="Timestate[27].state == 1"></el-option>
              <el-option label="14:40~14:50" value="29"  v-if="Timestate[28].state == 1"></el-option>
              <el-option label="14:50~15:00" value="30"  v-if="Timestate[29].state == 1"></el-option>
              <el-option label="15:00~15:10" value="31"  v-if="Timestate[30].state == 1"></el-option>
              <el-option label="15:10~15:20" value="32"  v-if="Timestate[31].state == 1"></el-option>
              <el-option label="15:20~15:30" value="33"  v-if="Timestate[32].state == 1"></el-option>
              <el-option label="15:30~15:40" value="34"  v-if="Timestate[33].state == 1"></el-option>
              <el-option label="15:40~15:50" value="35"  v-if="Timestate[34].state == 1"></el-option>
              <el-option label="15:50~16:00" value="36"  v-if="Timestate[35].state == 1"></el-option>
              <el-option label="16:00~16:10" value="37"  v-if="Timestate[36].state == 1"></el-option>
              <el-option label="16:10~16:20" value="38"  v-if="Timestate[37].state == 1"></el-option>
              <el-option label="16:20~16:30" value="39"  v-if="Timestate[38].state == 1"></el-option>
              <el-option label="16:30~16:40" value="40"  v-if="Timestate[39].state == 1"></el-option>
              <el-option label="16:40~16:50" value="41"  v-if="Timestate[40].state == 1"></el-option>
              <el-option label="16:50~17:00" value="42"  v-if="Timestate[41].state == 1"></el-option>
              <el-option label="17:00~17:10" value="43"  v-if="Timestate[42].state == 1"></el-option>
              <el-option label="17:10~17:20" value="44"  v-if="Timestate[43].state == 1"></el-option>
              <el-option label="17:20~17:30" value="45"  v-if="Timestate[44].state == 1"></el-option>
              <el-option label="17:30~17:40" value="46"  v-if="Timestate[45].state == 1"></el-option>
              <el-option label="17:40~17:50" value="47"  v-if="Timestate[46].state == 1"></el-option>
              <el-option label="17:50~18:00" value="48"  v-if="Timestate[47].state == 1"></el-option>
            </el-select>
        </el-form-item>
        </el-form>
        <div slot="footer" class="dialog-footer">
          <el-button @click="dialogFormVisible2 = false">取 消</el-button>
          <el-button type="primary" @click="goAppointment()">确 定</el-button>
        </div>
    </el-dialog>
  </el-row>
</div>
</template>

<script>
export default {
  created () {
    console.log('get State')
    this.getState()
  },
  data () {
    return {
      yuyuedate: new Date(),
      date2: '',
      totalPages: 0,
      currentPage: 0,
      size: 5,
      message: this.$route.query.message,
      de_id: this.$route.query.de_id,
      dialogFormVisible2: false,
      cardid: '',
      period: '1',
      Timestate: ''
    }
  },
  methods: {
    goAppointment () {
      this.dialogFormVisible2 = false
      console.log(this.de_id)
      var t = this
      this.$axios({
        method: 'post',
        url: '/Queue/saveAppointment',
        data: {
          cardid: t.cardid,
          n_time: t.yuyuedate,
          during: t.date2,
          department_id: t.de_id
        }
      })
        .then(function (response) {
          console.log(response)
          // this.$router.push({path: '/Cure/Advice'})
          t.cardid = ''
          t.yuyuedate = ''
          t.date2 = ''
          t.$notify({
            title: '成功',
            message: '成功预约！',
            type: 'success'
          })
        })
        .catch(function (error) {
          console.log(error)
          t.$notify({
            title: '警告',
            message: '预约失败',
            type: 'warning'
          })
        })
    },
    judge () {
      this.$axios({
        method: 'get',
        url: '/Queue/judge?period=' + this.period
      })
        .then(function (response) {
          console.log(response)
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    getState () {
      var t = this
      this.$axios({
        method: 'get',
        url: '/Appointment/getState'
      })
        .then(function (response) {
          console.log(response)
          t.Timestate = response.data
          console.log(t.Timestate)
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    mounted () {
      console.log('get State')
      // console.log(this.message)
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
