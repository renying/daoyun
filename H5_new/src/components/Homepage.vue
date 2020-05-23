<template>
  <div>
    <el-menu :default-active="activeIndex" mode="horizontal" @select="handleSelect">
        <el-menu-item index="1">我加入的</el-menu-item>
        <el-menu-item index="2">我创建的</el-menu-item>
    </el-menu>
    <div style="height: 30px; witdh: 100%"></div>
    <button class="btn btn-primary w-md waves-effect waves-light" type="button"
                    @click="exit()">
                    注销
                    </button>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'Homepage',
  data () {
    return {
      activeIndex: '1'
    }
  },
  methods: {
    handleSelect (val, valkey) {
      console.log(val, valkey)
      if (val === '1') {
        this.$router.push({path: '/Homepage/Myclass'})
      } else if (val === '2') {
        this.$router.push({path: '/Homepage/Myjoin'})
      }
      console.log(val, valkey)
    },
    exit () {
      console.log('注销')
      localStorage.removeItem('ukey')
      localStorage.removeItem('account')
      localStorage.removeItem('userid')
      this.$router.push({path: '/'})
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
