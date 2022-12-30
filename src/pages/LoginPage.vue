<template>
    <div class="container">
        <login-form @login="login"/>
    </div>
</template>

<script>
import LoginForm from "@/components/LoginForm.vue";

export default {
    name: "LoginPage",
    props: ['type'],
    inject: ['apiUrl'],
    components: {LoginForm},
    methods: {
        login(event) {
            this.axios.get(this.apiUrl + "auth", {
                params: {
                    login: event.login,
                    password: event.password
                },
                withCredentials: true,
            }).then((response) => {
                this.$router.push('panel')
                console.log(response.data)
            })
        }
    }
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