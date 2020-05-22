<template>
  <div>
    <el-menu :default-active="activeIndex" mode="horizontal" @select="handleSelect">
        <el-menu-item index="1">员工管理</el-menu-item>
        <el-menu-item index="2">药品管理</el-menu-item>
        <el-menu-item index="3">病人管理</el-menu-item>
        <el-menu-item index="4">其他</el-menu-item>
    </el-menu>
    <div style="height: 30px; witdh: 100%"></div>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'HospitalManager',
  data () {
    return {
      activeIndex: '1'
    }
  },
  methods: {
    handleSelect (val, valkey) {
      console.log(val, valkey)
      if (val === '1') {
        this.$router.push({path: '/HospitalManager/Employee'})
      } else if (val === '2') {
        this.$router.push({path: '/HospitalManager/Drug'})
      } else if (val === '3') {
        this.$router.push({path: '/HospitalManager/Patient'})
      } else if (val === '4') {
        this.$router.push({path: '/HospitalManager/Employee'})
      }
      console.log(val, valkey)
    }
  },
  mounted () {
    // this.$router.push({path: '/HospitalManager/Employee'})
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
