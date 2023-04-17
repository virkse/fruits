import Home from './components/Home.vue'
import Favorite from './components/Favorite'

import Vue from 'vue'
import VueX from 'vuex'


Vue.use(VueX)

export const routes = [
    {
        name: 'fruits',
        path: '/fruits',
        component: Home,
    },
    {
        name: 'favorite',
        path: '/favorite',
        component: Favorite
    }
];
