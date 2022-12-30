<template>
    <div class="login-container">
        <p class="logo">Не сбербанк</p>
        <div class="item-input">
            <p>Логин</p>
            <input placeholder="Ваш логин" v-model="login">
        </div>
        <div class="item-input">
            <p>Пароль</p>
            <input placeholder="Ваш пароль" v-model="password" v-bind:type="passwordInputType">
            <i class="fa-solid fa-eye" @click="showPassword()"></i>
        </div>
        <div class="login-btn" @click="onLoginClick()">Вход</div>
    </div>
</template>

<script>
export default {
    name: "LoginForm",
    data: function () {
        return {
            login: "",
            password: "",
            passwordInputType: "password"
        }
    },
    methods: {
        onLoginClick() {
            this.$emit("login", {login: this.login, password: this.password})
        },
        showPassword() {
            if (this.passwordInputType === "password") {
                this.passwordInputType = "none"
            } else {
                this.passwordInputType = "password"
            }
        }
    }

}

</script>

<style scoped>
.login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    box-shadow: 0 12px 24px 0 #94929259;
    width: 30%;
    border-radius: 20px;
}

.logo {
    font-size: var(--large-text);
    padding: 20px 0;
}

.item-input {
    position: relative;
    text-align: left;
    margin: 20px 0;
}

.item-input i {
    position: absolute;
    top: 60%;
    left: 89%;
    cursor: pointer;
}

input {
    height: 40px;
    font-size: var(--medium-text);
    border: 1px solid #d6d6d6;
    border-radius: 7px;
    padding: 0 10px;
    margin-top: 10px;
}

.login-btn {
    background-color: #42b983;
    font-size: var(--medium-text);
    color: white;
    padding: 10px 20px;
    border-radius: 7px;
    cursor: pointer;
    margin-bottom: 20px;
    transition-duration: 300ms;
}

.login-btn:hover {
    transition-duration: 300ms;
    background-color: #16e780;
}
</style>