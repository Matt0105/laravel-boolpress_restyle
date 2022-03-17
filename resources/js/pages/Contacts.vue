<template>
  <div class="container">
    <img :src=notAvailable alt="">
  </div>
</template>

<script>
export default {
    name: "Contacts",
    data() {
      return {
        notAvailable: require("../../img/not-available.jpeg")
      }
    }
}
</script>

<style>

</style>