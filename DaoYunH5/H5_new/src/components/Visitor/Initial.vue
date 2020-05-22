<template>
<div>
  <div>
    <p>Welcome</p>

  </div>
</div>

</template>

<script>
export default {
  name: 'Initial',
  data () {
    return {
    }
  },
  methods: {
    goUpdate () {
      this.$rooter.push({path: '/Visitor/Setting'})
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
