<template>
  <div>
    <el-row :gutter="20">
      <el-col :span="5" :offset="2">
        <h5>欢迎使用医疗管理系统</h5>
      </el-col>
    </el-row>
    <el-row :gutter="20">
      <el-col :span="5" :offset="2">
        <el-menu default-active="2" class="el-menu-vertical-demo">
          <el-submenu index="1">
            <template slot="title">
              <i class="el-icon-location"></i>
              <span>查询医院科室信息</span>
            </template>
            <el-menu-item-group>
              <template slot="title">外科</template>
              <el-menu-item index="1-1 " @click="goPifu()">皮肤科</el-menu-item>
              <el-menu-item index="1-2" @click="goEar()">耳鼻喉科</el-menu-item>
            </el-menu-item-group>
            <el-menu-item-group title="内科">
              <el-menu-item index="1-3" @click="goChild()">儿科</el-menu-item>
            </el-menu-item-group>
            <el-menu-item-group>
              <template slot="title">其它</template>
              <el-menu-item index="1-4-1">其它</el-menu-item>
            </el-menu-item-group>
          </el-submenu>
          <el-menu-item @click="goQueue()" index="2">
            <i class="el-icon-menu"></i>
            <span slot="title">预约挂号</span>
          </el-menu-item>
          <el-menu-item @click="goSetting()" index="3">
            <i class="el-icon-setting"></i>
            <span slot="title" >修改信息</span>
          </el-menu-item>
        </el-menu>
      </el-col>
      <el-col :span="15">
        <router-view/>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'Visitor',
  data () {
    return {
      pid: this.$route.query.pid
    }
  },
  methods: {
    goSetting () {
      this.$router.push({path: '/Visitor/Setting', query: {pid: this.pid}})
    },
    goQueue () {
      this.$router.push({path: '/Visitor/Queue'})
    },
    goPifu () {
      this.$router.push({path: '/Visitor/Pifu'})
    },
    goEar () {
      this.$router.push({path: '/Visitor/Ear'})
    },
    goChild () {
      this.$router.push({path: '/Visitor/Child'})
    }
  },
  mounted () {
    this.$router.push({path: '/Visitor/Initial'})
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
