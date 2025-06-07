import Main from "@/views/main.vue";
import Problema01 from "@/views/problema01.vue";
import { createRouter, createWebHistory } from "vue-router";

//definicion de rutas
const routes = [
    {path: '/', component: Main},
    { path: '/ip-validas', component: Problema01 },
]

//redireccionamiento
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router