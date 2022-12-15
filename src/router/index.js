import { createWebHistory, createRouter } from "vue-router";
import ClientLogin from "@/pages/ClientLogin.vue";
import AdminPanel from "@/pages/AdminPanel";

const routes = [
    {
        path: "/client/login",
        name: "ClientLogin",
        component: ClientLogin,
    },
    {
        path: "/admin/panel",
        name: "AdminPanel",
        component: AdminPanel,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;