<template>
  <div class="total-container">
      <!-- <Header/> -->
      <!-- <Main/> -->
      <div class="sidebar-container">
        <Sidebar />
      </div>
      <div class="page-container">
        <router-view></router-view>
      </div>
  </div>
</template>

<script>

import Header from "../components/Header.vue";
import Main from "../components/Main.vue";
import Sidebar from "../components/Sidebar.vue";

export default {
    name: "App",
    components: {
        Main,
        Header,
        Sidebar
    }
}
</script>

<style lang="scss" scoped>

    .total-container {
        display: flex;

        .sidebar-container {
            width: 25%;

        }
        .page-container {
            width: 85%;
            
        }
    }
</style>