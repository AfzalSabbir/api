<template>
	<div>
    <!-- form -->
    <form class="auth-form need-validation" @submit.prevent="submit()" method="POST" :action="url_register" enctype="multipart/form-data" style="width: 420px !important;">

      <!-- error message -->
      <div v-if="this_errors" class="alert alert-danger px-0 alert-dismissible fade show" role="alert">
        <ul class="list-group border-0 box-shadow-none">
          <li class="list-group-item bg-transparent" v-for="error in this_errors">{{ _n2l(error) }}</li>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div><!-- /error message -->

      <slot></slot>
      <!-- .form-group -->
      <div class="form-group">
        <div class="form-label-group">
          <input type="text" id="inputName" v-model='model_name' name='name' class="form-control" :placeholder="lang.full_name" required="" autofocus="" autocomplete="off"> <label for="inputName">{{ lang.name }}</label>
        </div>
      </div><!-- /.form-group -->
      <!-- .form-group -->
      <div class="form-group">
        <div class="form-label-group has-spinner">
          <input type="email" id="inputEmail" v-model='model_email' name='email' class="form-control" placeholder="Email" required=""> <label for="inputEmail">{{ lang.email }}</label>
        </div>
      </div><!-- /.form-group -->
      <!-- .form-group -->
      <div class="form-group">
        <div class="form-label-group has-spinner">
          <input type="mobile" id="inputMobile" v-model='model_mobile' name='mobile' class="form-control" placeholder="Mobile" required="" maxlength="15"> <label for="inputMobile">{{ lang.mobile }}</label>
        </div>
      </div><!-- /.form-group -->
      <!-- .form-group -->
      <div class="form-group">
        <div class="form-label-group has-spinner">
          <input type="text" id="inputUser" v-model='model_username' name='username' class="form-control" placeholder="Username" required=""> <label for="inputUser">{{ lang.username }}</label>
        </div>
      </div><!-- /.form-group -->
      <!-- .form-group -->
      <div class="form-group">
        <div class="form-label-group has-spinner">
          <select class="form-control" name="country" @change="change_country()" v-model="model_country">
            <option v-for="country in countries" :value="country">{{ country }}</option>
          </select>
        </div>
      </div><!-- /.form-group -->
      <!-- .form-group -->
      <div class="form-group">
        <div class="form-label-group has-spinner">
          <select class="form-control" name="division" v-model="model_division">
            <option v-for="division in divisions" :value="division">{{ division }}</option>
          </select>
        </div>
      </div><!-- /.form-group -->

      <!-- .form-group -->
      <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ lang.sign_up }}</button>
      </div><!-- /.form-group -->
    </form><!-- /.auth-form -->
	</div>
</template>
<script>
	import { store } from '../../store';

	export default {
		name: 'FormRegister',
		props: ['url_register', 'url_validate', 'old_inputs', 'form_errors'],
		data(){
			return {
				model_name      : '',
				model_email     : '',
        model_mobile    : '',
				model_username  : '',
        model_password  : '',
        model_division  : '',
        model_country  : 'bangladesh',

        country_data    : {},
        countries   : [],
        divisions   : [],

        this_errors     : JSON.parse(this.form_errors),

        error_reserve_username  : false,
        error_exist_email       : false,
        error_exist_mobile       : false,
        error_exist_username    : false,

        lang          : {},
				locale	 		  : '',
				base_url		  : '',

        reg_exp_email     : /\S+@\S+\.\S+/,
        // reg_exp_name   : /[^\w\s\_]/gi,
        reg_exp_name      : /[^a-zA-Z\.\-\_\s]/g,
        reg_exp_username  : /[^a-zA-Z0-9\_]/g,

        invalid           : true,
        loading_email     : false,
        loading_mobile     : false,
        loading_username  : false,
        disabled          : true
			}
		},
		mounted(){

      if(parseInt(this.old_inputs)) {
        let this_model = this;
        Object.keys(localStorage).forEach( function(element, index) {
          if (_.startsWith(element, 'model_')) {
            this_model[element] = localStorage.getItem(element);
            localStorage.removeItem(element);
          }
        });
      }
      // localStorage.clear();

			this.countries = ['bangladesh', 'india'];
      this.divisions = [
          'Barisal',
          'Chittagong',
          'Dhaka',
          'Khulna',
          'Mymensingh',
          'Rajshahi',
          'Rangpur',
          'Sylhet'
        ];
      this.country_data = {
        "bangladesh" : this.divisions,
        "india": [
        'div1', 'div2', 'div3', 'div11', 'div12', 'div13'
        ]
      };

      this.locale     = store.state.locale;
			this.base_url 		= store.state.my_url;
			this.admin_id 		= store.state.admin_id;
			this.lang 			= store.state.file_default;
			this.lang.author_ 	= { _1: store.state.file_default.author_1, _2: store.state.file_default.author_2, _3: store.state.file_default.author_3};
			this.place_author 	= this.lang.author_._1 + '; '+ this.lang.author_._2 + '; '+ this.lang.author_._3 + '; ...';
		},
		methods: {
      change_country: function () {
        this.divisions = this.country_data[this.model_country];
      },
      submit: function(e, is_valid) {
        axios.post(this.base_url+'/api/register', {
          name: this.model_name,
          email: this.model_email,
          mobile: this.model_mobile,
          username: this.model_username,
          division: this.model_division,
          country: this.model_country
        }).then((response) => {
          console.log(response.data);
          if(response.data == 0) {
            alert('Error!');
          } else {
            alert('Success and your password is 12345678!');
          }
        }).catch((error) => {
          console.error(error);
        });
      }
		}
	};
</script>
<style>
	.rounded-0 {border-radius: 0 !important;}
</style>