import { createWebHistory, createRouter } from "vue-router";
import AdminPanel from "@/pages/AdminPanel";
import WorkerPage from "@/pages/WorkerPage";
import LoginPage from "@/pages/LoginPage";

const routes = [
    {
        path: "/client/login",
        name: "ClientLogin",
        component: LoginPage,
    },
    {
        path: "/admin/login",
        name: "AdminLogn",
        component: LoginPage,
        props: {type: 0}
    },
    {
        path: "/worker/login",
        name: "WorkerLogin",
        component: LoginPage,
        props: {type: 1}
    },
    {
        path: "/admin/panel",
        name: "AdminPanel",
        component: AdminPanel,
    },
    {
        path: "/worker/panel",
        name: "WorkerPage",
        component: WorkerPage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;