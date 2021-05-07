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

  methods: {
    flashMessage(type, message) {
      this.$swal({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        type: type,
        title: message
      });
    },
  }
});

Vue.use(VueSweetalert2);