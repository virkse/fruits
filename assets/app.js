/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import Vue from 'vue';
import store from './store/index'
import VueRouter from 'vue-router'

import {routes} from './routes'
import Home from './components/Home'


Vue.use(VueRouter)
Vue.component('App', Home)

const router = new VueRouter({
  mode: 'history',
  routes,
  scrollBehavior (to, from, savedPosition) {
    return { x: 0, y: 0}
  }
})


new Vue({
    el: '#app',
    router,
    store,
});
