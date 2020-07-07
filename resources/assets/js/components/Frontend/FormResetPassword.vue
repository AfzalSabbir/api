<template>
	<div class="position-relative">
		<div v-if="loading" class="position-absolute w-100 h-100" style="z-index: 100; background: #f3f3f399;">
			<i class="fad fa-spinner fa-3x fa-pulse justify-content-center d-flex text-primary" style="margin-top: 45%;"></i>
		</div>
		<form :action="mail_password_reset" @submit.prevent="check_and_send_recovery_code" method="POST" class="auth-form auth-form-reflow">
			<slot></slot>
			<div class="text-center mb-4">
				<div class="mb-4">
					<a :href="home" title="Home"><img width="168" :src="base_url+'/'+'public/images/icon/jpg/boinaw-white-primary.jpg'" alt=""></a>
				</div>
				<h1 class="h3 text-primary"> {{ lang.reset_your_password }} </h1>
			</div>
			<p class="mb-4 list-group-item-action list-group-item-info pl-3 bg-light py-1 pr-1"> If you can't remember your username please try with your <a :href="user_show_recover_form" title="Username Recovery" class="font-weight-bold">email here</a> to recover your username and then come here again to reset your password. </p><!-- .form-group -->

			<p v-if="no_user" class="alert alert-danger alert-dismissible fade show">
				<!-- <button type="button" class="close" data-dismiss="alert">×</button> -->
				<span v-html="no_user_message"></span>
			</p>

			<div v-if="!result" class="form-group mb-4">
				<label class="d-block text-left h6" for="inputUser">{{ lang.username }}</label> <input type="text" id="inputUser" class="form-control form-control-lg" @keydown.enter.prevent="" v-model="model_username" name="username" required="" autofocus="">
				<p class="text-muted">
					<small v-html="lang.we_ll_send_password_reset"></small>
				</p>
			</div>
			<div v-else class="form-group mb-4">
				<label class="d-block text-left h6 d-flex justify-content-between" for="inputCode">
					<span>{{ lang.verification_code }}</span>
					<small @click="check_and_send_recovery_code" class="btn btn-xs p-0 m-0 btn-outline-primary cursor-pointer px-1" style="border-radius: 2px;">Resend</small>
				</label>
				<input type="text" id="inputCode" class="form-control form-control-lg" @keydown.enter.prevent v-model="model_code" name="code" autofocus="" />
				<p class="text-muted">
					<small>{{ lang.we_have_send_password_reset }}</small>
				</p>
			</div>

			<!-- actions -->
			<div class="d-block d-md-inline-block mb-2">
				<button v-if="result" class="btn btn-lg btn-block btn-primary" type="button" @click.prevent="check_code($event)">{{ lang.submit }}</button>
				<button v-else class="btn btn-lg btn-block btn-primary" type="submit">{{ lang.reset_password }}</button>
			</div>
			<div class="d-block d-md-inline-block">
				<a :href="login" class="btn btn-block btn-light">{{ lang.return_to_signin }}</a>
			</div>
			<div class="d-block d-md-inline-block">
				<a :href="home" class="btn btn-block btn-light">{{ lang.home }}</a>
			</div>
		</form>
	</div>
</template>
<script>
	import { store } from '../../store'

	export default {
		name: 'FormResetPassword',
		props: ['mail_password_reset', 'user_show_recover_form', 'home', 'login'],
		data(){
			return {
				base_url: '',
				lang: {},
				model_username: '',
				model_code: '',
				result: false,

				no_user: false,
				no_user_message: '',

				loading: false
			}
		},
		mounted(){
			this.base_url = this.$store.state.my_url;
			this.lang = this.$store.state.file_default;
		},
		methods: {
			check_code: function(e){
				this.loading = true;
				e.preventDefault();
				axios.post(this.base_url+'/axios/check-reset-code', {
				  code: this.model_code,
				  username: this.model_username
				}).then((response) => {
					this.loading = false;

					if(response.data) window.location.href=this.base_url+'/set-password/'+response.data.token;
					else alert('This code has expired or invalid!\nTry resend and verify before 3hrs.');
				}).catch((error) => {
				  	console.error(error);
					this.no_user_message = this.lang.something_went_wrong+"!";
				}).finally(() => {
					this.loading = false;
				});
			},
			check_and_send_recovery_code: function(){
				this.loading = true;
				this.no_user = false;

				axios.post(this.mail_password_reset, {
				  username: this.model_username,
				}).then((response) => {
					if(response.data == 0){
						this.no_user = true;
						this.no_user_message = 'Unsername not found!';
					} else {
						// alert('Check your email...');
						this.result = true;
					}
				}).catch((error) => {
					// this.loading = false;
				  	console.error(error);
					this.no_user = true;
					this.no_user_message = this.lang.something_went_wrong+"!";
				}).finally(() => {
					this.loading = false;
				});
			}
		}
	};
</script>