<template>
  <div id="app">
    <nav>
      <router-link to="/vuetest">Vai a Vuetest</router-link>
    </nav>
    <main>
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
export default {
  name: 'App'
};
</script>

<style>
</style>
