import VueSweetalert2 from 'vue-sweetalert2';
import ptBr from 'vuejs-datepicker/src/locale/translations/pt-BR';
import Vue from 'vue'
import money from 'v-money'

require('./bootstrap');
require('./commons');

window.Vue = Vue;
require('@/components');

Vue.use(money, {precision: 4})

const app = new Vue({
  el: '#app',

  data() {
    return {
      ptBr: ptBr,
    }
  },
});

Vue.use(VueSweetalert2);