<template>
  <div class="container">
      <img :src=notAvailable alt="">
  </div>
</template>

<script>
export default {
    name: "About",
    data() {
      return {
        notAvailable: require("../../img/not-available.jpeg")
      }
    }
}
</script>

<style>
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
  }
</style>