<template>
	<div>
		<div class="position-relative">

			<div v-if="loading" class="zi-10 position-absolute r-0">
				<div class="">
					<i class="fa fa-spinner fa-pulse fa-fw"></i>
				</div>
			</div>

	        <div class="position-relative p-1 pt-4 mt-4 setting_container col-sm-12">
	          <span class="px-2 py-1 position-absolute setting_title l-1">Other</span>
	          <div class="animated-checkbox px-1">
	            <label class="cursor-pointer d-block mb-0 py-1">
	              <input @click="customScroll(local_custom_scroll_route)" v-model="local_custom_scroll" type="checkbox"> <span class="label-text">Custom Scroll</span>
	            </label>
	          </div>
	          <div class="animated-checkbox px-1">
	            <label class="cursor-pointer d-block mb-0 py-1">
	              <input @click="showUserData(local_show_user_data_route)" v-model="local_show_user_data" type="checkbox"> <span class="label-text">Show Profile</span>
	            </label>
	          </div>
	          <div class="animated-checkbox px-1">
	            <label class="cursor-pointer d-block mb-0 py-1">
	              <input @click="showBackgroundImage(local_show_background_image_route)" v-model="local_show_background_image" type="checkbox"> <span class="label-text">Show Background Image</span>
	            </label>
	          </div>
	          <div class="animated-checkbox px-1">
	            <label class="cursor-pointer d-block mb-0 py-1">
	              <input @click="applySchemeOnCard(local_apply_scheme_on_card_route)" v-model="local_apply_scheme_on_card" type="checkbox"> <span class="label-text">Apply Scheme on Card</span>
	            </label>
	          </div>
	        </div>
		</div>
	</div>
</template>
<script>
	import { store } from '../../store'
	import { isLoggedMixin } from '../../myMixins'
	export default {
		name: 'SettingCheckboxes',
    	mixins:[isLoggedMixin],
		props: [
			'custom_scroll', 'custom_scroll_route',
			'show_user_data', 'show_user_data_route',
			'show_background_image', 'show_background_image_route',
			'apply_scheme_on_card', 'apply_scheme_on_card_route'
		],
		data(){
			return {
				isLoggedIn: true, base_url: '', get_guards_url: '', loading: 0,
				local_custom_scroll: '', local_custom_scroll_route: '',
				local_show_user_data: '', local_show_user_data_route: '',
				local_show_background_image: '', local_show_background_image_route: '',
				local_apply_scheme_on_card: '', local_apply_scheme_on_card_route: '',
			}
		},
		mounted(){
	        this.base_url = store.state.my_url;
	        this.get_guards_url = this.base_url+'/sessionStatus/guards';

			this.local_custom_scroll = parseInt(this.custom_scroll);
			this.local_custom_scroll_route = this.custom_scroll_route;

			this.local_show_user_data = parseInt(this.show_user_data);
			this.local_show_user_data_route = this.show_user_data_route;

			this.local_show_background_image = parseInt(this.show_background_image);
			this.local_show_background_image_route = this.show_background_image_route;

			this.local_apply_scheme_on_card = parseInt(this.apply_scheme_on_card);
			this.local_apply_scheme_on_card_route = this.apply_scheme_on_card_route;
		},
		methods: {
			customScroll: function (route) {
				this.checkIfLogged(this.get_guards_url);
				this.loading = 1;
	            axios.get(route)
	            .then((response) => {
	            	this.local_custom_scroll = response.data.new_custom_scroll_bol == 1 ? 0:1;
					this.local_custom_scroll_route = response.data.new_custom_scroll_route;
					this.loading = 0;
					toastr.success("<strong class='h5'>Success!</strong></br><a class='alert alert-primary px-1 py-0 font-weight-normal br-2' href=''>Reload...</a> to get effective action");
	            })
	            .catch((exception) => {
	            	this.local_custom_scroll = this.local_custom_scroll == 1 ? 0:1;
					this.loading = 0;
					toastr.error("<strong class='h5'>Error!</strong></br>Something went worng");
	                console.log(exception);
	            });
				// window.location.href = route;
			},
			showUserData: function (route) {
				this.checkIfLogged(this.get_guards_url);
				this.loading = 1;
	            axios.get(route)
	            .then((response) => {
	            	this.local_show_user_data = response.data.new_show_user_data_bol == 1 ? 0:1;
					this.local_show_user_data_route = response.data.new_show_user_data_route;
					this.loading = 0;
					toastr.success("<strong class='h5'>Success!</strong></br><a class='alert alert-primary px-1 py-0 font-weight-normal br-2' href=''>Reload...</a> to get effective action");
	            })
	            .catch((exception) => {
	            	this.local_show_user_data = this.local_show_user_data == 1 ? 0:1;
					this.loading = 0;
					toastr.error("<strong class='h5'>Error!</strong></br>Something went worng");
	                console.log(exception);
	            });
				// window.location.href = route;
			},
			showBackgroundImage: function (route) {
				this.checkIfLogged(this.get_guards_url);
				this.loading = 1;
	            axios.get(route)
	            .then((response) => {
	            	this.local_show_background_image = response.data.new_show_background_image_bol == 1 ? 0:1;
					this.local_show_background_image_route = response.data.new_show_background_image_route;
					this.loading = 0;
					toastr.success("<strong class='h5'>Success!</strong></br><a class='alert alert-primary px-1 py-0 font-weight-normal br-2' href=''>Reload...</a> to get effective action");
	            })
	            .catch((exception) => {
	            	this.local_show_background_image = this.local_show_background_image == 1 ? 0:1;
					this.loading = 0;
					toastr.error("<strong class='h5'>Error!</strong></br>Something went worng");
	                console.log(exception);
	            });
				// window.location.href = route;
			},
			applySchemeOnCard: function (route) {
				this.checkIfLogged(this.get_guards_url);
				this.loading = 1;
	            axios.get(route)
	            .then((response) => {
	            	this.local_apply_scheme_on_card = response.data.new_apply_scheme_on_card_bol == 1 ? 0:1;
					this.local_apply_scheme_on_card_route = response.data.new_apply_scheme_on_card_route;
					this.loading = 0;
					toastr.success("<strong class='h5'>Success!</strong></br><a class='alert alert-primary px-1 py-0 font-weight-normal br-2' href=''>Reload...</a> to get effective action");
	            })
	            .catch((exception) => {
	            	this.local_apply_scheme_on_card = this.local_apply_scheme_on_card == 1 ? 0:1;
					this.loading = 0;
					toastr.error("<strong class='h5'>Error!</strong></br>Something went worng");
	                console.log(exception);
	            });
				// window.location.href = route;
			},
			/*loginCheck: function (get_guards_url) {
		        this.checkIfLogged(get_guards_url) 
	            .then(response => {
	                    this.isLoggedIn = response.admin ? true : false;
	            		if(!this.isLoggedIn) {
							window.location.href = this.base_url+'/admin/login';
	            		}
	            		console.log('isLoggedIn: '+this.isLoggedIn);
	                })
	            .catch(error => console.log(error));
			},*/
		}
	};
</script>