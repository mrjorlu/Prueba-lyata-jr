import Main from "@/views/main.vue";
import Problema01 from "@/views/problema01.vue";
import Problema02 from "@/views/problema02.vue";
import { createRouter, createWebHistory } from "vue-router";

//definicion de rutas
const routes = [
    {path: '/', component: Main},
    {path: '/ip-validas', component: Problema01 },
    {path: '/siesta-felina', component: Problema02}
]

//redireccionamiento
const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router