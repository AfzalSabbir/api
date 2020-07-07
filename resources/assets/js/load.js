/*
  toast
 */
window.Toast = Swal.mixin({
  toast: true,
  position: 'bottom-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});


/*
  vue2-perfect-scrollbar
 */
import PerfectScrollbar from 'vue2-perfect-scrollbar';
import 'vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css';
Vue.use(PerfectScrollbar);


/*
  lodash.escaperegexp
 */
const escapeRE = require('lodash.escaperegexp')
window.strtr = (str, pairs) => {
  const substrs = Object.keys(pairs).map(escapeRE)
  return str.split(RegExp(`(${substrs.join('|')})`))
            .map(part => pairs[part] || part)
            .join('')
}


/*
  moment.js
 */
window.moment = require('moment');


/*
  bootbox.js
 */
window.bootbox = require('bootbox');


/*
  toastr.js
 */
window.toastr = require('toastr');
toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "4000",
  "extendedTimeOut": "100",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
};


/*
  css
 */
require('./css');