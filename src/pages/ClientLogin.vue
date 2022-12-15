<template>
  <div class="container">
    <login-form/>
  </div>
</template>

<script>
import LoginForm from "@/components/LoginForm.vue";
export default {
  name: "ClientLogin",
  components: {LoginForm}
}
</script>

<style scoped>
  .container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
</style>