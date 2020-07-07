import { store } from './store';
import moment from 'moment';


window.check_locale = (lang) => {return store.state.locale == lang;}
window.get_locale = () => {return store.state.locale;}
window.locale = () => {return store.state.locale;}
window.lang = () => {return store.state.locale;}

window.n2l = (str) => {
  if (locale() == 'bn') {
    return strtr(str, ['০','১','২','৩','৪','৫','৬','৭','৮','৯']);
  }
  else {
    return str;
  }
}
window.num2local = (str) => {
  if (locale() == 'bn') {
    return strtr(str, ['০','১','২','৩','৪','৫','৬','৭','৮','৯']);
  }
  else {
    return str;
  }
}
window.num2bn = (str) => {return strtr(str, ['০','১','২','৩','৪','৫','৬','৭','৮','৯']);}
window.n2b = (str) => {return strtr(str, ['০','১','২','৩','৪','৫','৬','৭','৮','৯']);}

window.diffForHumans = (date) => {
  if (locale() == 'bn') {
    let localization = require('moment/locale/bn');
    moment.updateLocale('bn', localization);
  }
  return moment(new Date(date)).fromNow();
}

window.deleteConfirm = (url, base64_id, redirect='', refresh=false) => {
  let lang_default = store.state.file_default;
  bootbox.confirm({
    title: lang_default.are_you_sure+'?',
    message: lang_default.data_will_be_deleted_permently+lang_default['_.']+" "+lang_default.this_cannot_be_undone+'!',
    buttons: {
      cancel: {
        label: '<i class="fa fa-times"></i> '+lang_default.cancel
      },
      confirm: {
        label: '<i class="fa fa-check"></i> '+lang_default.confirm
      }
    },
    callback: function (result) {
      if (result) {

        axios.get(url+'/'+base64_id)
        .then((response) => {
          if (response.data == 1) {
            if (redirect != '') {
              var dialog = bootbox.dialog({
                message: '<p class="text-center mb-0 py-3"><span class="h3 d-block mb-3 text-success">'+lang_default.success+'!</span><i class="fa fa-spin fa-cog"></i> '+lang_default.redirecting+'...</p>',
                closeButton: false
              });
              dialog.modal('hide');
              window.location.replace(redirect);
            }
            else if (refresh) {
              var dialog = bootbox.dialog({
                message: '<p class="text-center mb-0 py-3"><span class="h3 d-block mb-3 text-success">'+lang_default.success+'!</span><i class="fa fa-spin fa-cog"></i> '+lang_default.refreshing+'...</p>',
                closeButton: false
              });
              dialog.modal('hide');
              window.location.replace(redirect);
            }
            else {
              toastr.success(lang_default.deleted_successfully+'!');
            }
          }
          else {
            toastr.error(lang_default.access_unauthorized);
          }

        })
        .catch((exception) => {
          toastr.error(lang_default.something_went_wrong);
          console.log(exception);
        });
      }
    }
  });
}

window.bellConfirm = (url, base64_id, view=false) => {
  let lang_default = store.state.file_default;
  let message_ = '';
  if (view) {
    message_ = lang_default.we_ll_let_him_her_know_your_contact_number+lang_default['.']+'<br/>'+lang_default.or+', '+lang_default.left_comment_below+lang_default['.'];
  } else {
    message_ = lang_default.we_ll_let_him_her_know_your_contact_number+lang_default['.'];
  }
  bootbox.confirm({
    title: lang_default.are_you_sure+'?',
    message: message_,
    buttons: {
      cancel: {
        label: '<i class="fa fa-times"></i> '+lang_default.cancel
      },
      confirm: {
        label: '<i class="fa fa-check"></i> '+lang_default.confirm
      }
    },
    callback: function (result) {
      if (result) {
        let admin_mobile = decode_base64(store.state.auth_mobile);
        // let locale = store.state.file_default;

        if (admin_mobile.length > 0) {
          axios.get(url+'/'+base64_id)
          .then((response) => {
            if (response.data == 1) {
              toastr.success(lang_default.notified_successfully+'!');
            }
            else if (response.data == 2) {
              toastr.info(lang_default.already_belled+'!');
            }
            else {
              toastr.error(lang_default.access_unauthorized+'.');
            }

          })
          .catch((exception) => {
            toastr.error(lang_default.something_went_wrong);
            console.log(exception);
          });
        } else {
          toastr.error(lang_default.set_mobile_first+"! <a class='bg-light text-primary rounded px-1 py-0 font-weight-normal br-2' href='"+store.state.my_url+"/profile/setting?red=bell&ref=mobile'>"+lang_default.click_here_to_set_mobile+"</a>");
        }

      }
    }
  });
}

window.reportConfirm = (url, base64_id) => {
  let lang_default = store.state.file_default;
  bootbox.confirm({
    title: lang_default.are_you_sure+"?",
    message: lang_default.reporting_to_superadmin+lang_default['.'],
    buttons: {
      cancel: {
        label: '<i class="fa fa-times"></i> '+lang_default.cancel
      },
      confirm: {
        label: '<i class="fa fa-check"></i> '+lang_default.confirm
      }
    },
    callback: function (result) {
      if (result) {

        axios.get(url+'/'+base64_id)
        .then((response) => {
          if (response.data == 1) {
            toastr.success(lang_default.reported_successfully+'!');
            // window.location.reload();
          }
          else {
            toastr.error(lang_default.access_unauthorized);
          }

        })
        .catch((exception) => {
          toastr.error(lang_default.something_went_wrong);
          console.log(exception);
        });
      }
    }
  });
}

window.acceptBellConfirm = (url, base64_id, base64_admin_id, name) => {
  let lang_default = store.state.file_default;
  bootbox.confirm({
    title: lang_default.are_you_sure+"?",
    message: lang_default.we_ll_notify+' <strong>'+name+'</strong> '+lang_default.that_you_ve_chosen_him_for_this_book+lang_default['.'],
    buttons: {
      cancel: {
        label: '<i class="fa fa-times"></i> '+lang_default.cancel
      },
      confirm: {
        label: '<i class="fa fa-check"></i> '+lang_default.confirm
      }
    },
    callback: function (result) {
      if (result) {

        axios.get(url+'/'+base64_id+'/'+base64_admin_id)
        .then((response) => {
          if (response.data == 1) {
            toastr.success(lang_default.success+'!');
          }
          else {
            toastr.error(lang_default.access_unauthorized);
          }

        })
        .catch((exception) => {
          toastr.error(lang_default.something_went_wrong);
          console.log(exception);
        });
      }
    }
  });
}

window.encrypt_me = (decrypted)  => {
  let a = decrypted;
  let x = '';
  let b = [];
  let s = "12345ASDFGHJKLqwertyuiopZXCVBNMasdfghjklQWERTYUIOzxcvbnm67890";
  let l = 0;
  let c = [];
  let d = 0;
  let p = '';
  function encrypt_(ax) {
    let r1 = generateRandomString(3);
    let r2 = generateRandomString(2);
    p = r1+ax+r2;
    x = btoa(p);
    b = x.split('').reverse();
    l = s.length;
    c = [];
    d = 0;
    b.forEach((e, i)=>{
      d = parseInt((Math.random()*10000))%l;
      c[2*i] = e;
      c[2*i+1] = s[d];
    });
    return c;
  }
  let y = encrypt_(encrypt_(a).join('')).join('');
  return y;
}
window.decrypt_me = (encrypted)  => {
  let a = encrypted;
  let b = a.split('');
  function decrypt_(bx) {
    let c = [];
    bx.forEach((e, i)=> {
      c[i/2] = bx[i]
    });
    let r = c.reverse();
    let j = r.join('');
    let x = atob(j);
    let m = x.substr(3); // left salt
    let n = m.substr(0, m.length-2); //right salt
    return n.split('');
  };
  let y = decrypt_(decrypt_(b)).join('');
  return y;
}
window.encode_base64 = (str, urlencode=true)  => {

  if (urlencode) {
    let left       = generateRandomString(3);
    let left_1     = generateRandomString(3);
    let mid        = str;
    let right      = generateRandomString(4);
    let right_1    = generateRandomString(4);

    let new_str_1  = left+''+mid+''+right;
    let base_1     = btoa(new_str_1);

    let new_str_2  = right_1+left_1+base_1;
    let base_2     = btoa(new_str_2);

    let base_3     = btoa(base_2);

    str            = encodeURIComponent(base_3);

    return str;
  }

}
window.decode_base64 = (str, urldecode=true)  => {

  if (urldecode) {
    str = decodeURIComponent(str);
    str = atob(str);
    str = atob(str);
    str = str.substr(7);
    // str = substr(str, 0, strlen(str)-3);
    str = atob(str);
    str = str.substr(3);
    str = str.substr(0, str.length-4);

    return str;
  }
} 

window.generateRandomString = (length=10) => {
  return Math.random().toString(12).substr(2, length);
}