<template>
	<div>
    	<form v-if="auth_id > 0" class="alert-secondary mt-3 mb-2" method="POST" :action="url" @submit.prevent="axiosPostComment">
    		<slot></slot>
    		<span v-model="interval_" class="d-none"></span>
    		<div class="form-group mb-0">
    			<!-- <label class="h5">{{ locale.write_comment }}</label> -->
    			<input type="hidden" name="book_id" v-model="book_id">
	    		<div class="feed-publisher rounded mb-0">
	    			<!-- .media -->
	    			<div class="media">
	    				<figure class="user-avatar user-avatar-md">
	    					<img :src="base_url+'/'+this_admin.photo" alt="">
	    				</figure>
	    				<!-- .media-body -->
	    				<div class="media-body">
	    					<!-- .publisher -->
	    					<div class="publisher">
	    						<!-- .publisher-input -->
	    						<div class="publisher-input">
	    							<textarea name="comment_body" v-model="comment_body" class="form-control" :class="avro" rows="3" :placeholder="locale.write_comment"></textarea>
	    						</div><!-- /.publisher-input -->
	    						<!-- .publisher-actions -->
	    						<div class="publisher-actions">
	    							<div class="publisher-tools mr-auto"></div>
	    							<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    									<button v-if="!loading" type="submit" class="btn btn-primary" id="comment_buttom">{{ locale.comment }}</button>
    									<button v-else class="btn btn-primary cursor-wait">{{ locale.comment }}</button>
    									<span class="btn btn-primary px-1" @click="commentRefresh" title="Update Comments"><i class="fad fa-sync-alt" :class="refreshSpin"></i></span>
	    								<!-- <div class="btn-group" role="group">
	    									<button id="_btnGroupDropRF" type="button" class="btn btn-primary dropdown-toggle px-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
	    									<div class="dropdown-menu py-0" aria-labelledby="_btnGroupDropRF" style="min-width: 20px !important;">
	    										<div class="dropdown-arrow"></div>
    											<span class="btn btn-light float-right" @click="commentRefresh" title="Update Comments"><i class="fad fa-sync-alt text-info" :class="refreshSpin"></i></span>
	    									</div>
	    								</div> -->
	    							</div>
	    						</div><!-- /.publisher-actions -->
	    					</div><!-- /.publisher -->
	    				</div><!-- /.media-body -->
	    			</div><!-- /.media -->
	    		</div>
    		</div>
    		<!-- <button class="btn btn-primary"><i class="fa fa-spinner fa-spin"></i></button> -->
    	</form>
    	<div v-else class="mt-3"></div>
    	<div>
    		<div v-for="comment in all_comments" class="feed-post card w-100 mb-2 bg-transparent box-shadow-light" :id="get_id(decode_base64(book_id), comment.admin_id, comment.id)">
    			<!-- .card-header -->
    			<div class="card-header card-header-fluid">
    				<a class="btn-account" role="button">
    					<div class="user-avatar user-avatar-lg">
    						<img :src="base_url+'/'+comment.photo" alt="">
    					</div>
    					<div class="account-summary">
    						<p class="account-name" data-toggle="tooltip" :title="comment.name"> <!-- {{ comment.name }} --> <span class="btn btn-xs btn-secondary py-0 px-1 border-0" :class="{'text-primary': book.admin_id == comment.admin_id}">{{ '@'+comment.username }}</span></p>
    						<p class="account-description pl-1"> {{ diffForHumans(comment.created_at) }} </p>
    					</div>
    				</a>
    				<span
    				v-if="auth_id == comment.admin_id"
    				@click="axiosDeleteComment(comment.id)"
    				class="btn px-1 py-0 mb-0 mt-1 h-25"
    				style="line-height: 13px!important; "
    				:class="delete_comment_id == comment.id ? 'btn-subtle-danger':'btn-subtle-secondary'"
    				:title="delete_comment_id == comment.id ? 'Click again to delete!':'Click twice to delete!'"><i class="fas fa-times"></i></span>
    				<!-- .dropdown -->
    				<!-- <div class="dropdown align-self-start ml-auto">
    					<button class="btn btn-icon btn-light text-muted" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-fw fa-ellipsis-v"></i></button>
    					<div class="dropdown-menu dropdown-menu-right" style="">
    						<div class="dropdown-arrow"></div>
    						<span v-if="auth_id == comment.admin_id" @click="axiosDeleteComment(comment.id)" class="h5 cursor-pointer btn alert-danger py-0 px-1 mb-0" style="line-height: 13px!important" title="Click twice to delete!"><span>&times;</span></span>
    						<a href="#" class="dropdown-item">Get notified</a>
    						<a href="#" class="dropdown-item">Mute notified</a>
    						<a href="#" class="dropdown-item">Permalink</a>
    						<a href="#" class="dropdown-item">Block this user</a>
    						<a href="#" class="dropdown-item">Remove</a>
    					</div>
    				</div> --><!-- /.dropdown -->
    			</div><!-- /.card-header -->
    			<!-- .card-body -->
    			<div class="card-body">
    				<p class="m-0"> {{ comment.comment_body }} </p>
    			</div><!-- /.card-body -->
    		</div>
    	</div>
	</div>
</template>
<script>
	import { store } from '../../store';

	export default {
		name: 'FrontComment',
		props: ['url', 'post_url', 'book_id', 'book_detail', 'comments', 'admin'],
		data(){
			return {
				all_comments: JSON.parse(this.comments),
				locale: {},
				book: JSON.parse(this.book_detail),
				base_url: '',
				comment_body: '',
				loading: 0,
				avro: 'avro_bn',
				auth_id: 0,
				refreshSpin: '',
				language: '',
				interval_: 0,
				this_admin: JSON.parse(this.admin),
				delete_comment: {},
				delete_comment_id: 0
			}
		},
		mounted(){
			setInterval(()=>{
				this.interval_ += 0.0001;
			}, 300000);
			this.auth_id = decode_base64(store.state.auth_id);
			this.base_url = store.state.my_url;

			this.language = store.state.locale;
			this.locale = store.state.file_default;

			this.avro = (this.language == 'bn' ? 'avro_bn':'');
		},
		methods: {
			diffForHumans: (date) => {
				return diffForHumans(date);
			},
			encode_base64: (data) => {
				return encode_base64(data);
			},
			decode_base64: (data) => {
				return decode_base64(data);
			},
			reverse_me: (data) => {
				return _.split(data, "").reverse().join("");
			},
			get_id: (book, admin, comment) => {
				return '_'+_.split(book, "").reverse().join("")+admin+_.split(comment, "").reverse().join("");
			},
			commentRefresh: function () {
				this.refreshSpin = 'fa-spin';

				axios.get(this.post_url)
				.then((response) => {
					this.all_comments  = response.data;
					toastr.success(this.locale.comments_updated);
					this.refreshSpin = '';
				})
				.catch((exception) => {
				    console.log(exception);
					this.refreshSpin = '';
					toastr.error(this.locale.something_went_wrong);
				});
			},
			axiosDeleteComment: function (id) {
				if (this.delete_comment.id == id) {
					this.refreshSpin = 'fa-spin';

					axios.get(this.post_url+'/'+id)
					.then((response) => {
						this.all_comments  = response.data;
						toastr.success(this.locale.comment_deleted_successfully);
						this.delete_comment = {};
						this.refreshSpin = '';
					})
					.catch((exception) => {
						this.refreshSpin = '';
						toastr.error(this.locale.something_went_wrong);
					    console.log(exception);
					});

				} else {
					this.delete_comment.id = id;
					this.delete_comment_id = id;
					this.delete_comment.count = 1;
					Toast.fire({
					  icon: 'warning',
					  title: '<span class="m-0 pl-2">'+this.locale.click_again+'...</span>'
					});
				}
			},
			axiosPostComment: function () {
				this.loading = 1;
				let data = {
					book_id: this.book_id,
					comment_body: this.comment_body
				};
				if (this.comment_body.length > 0) {
					axios.post(this.post_url, data)
					.then((response) => {
						this.all_comments  = response.data;
						this.comment_body = '';
						this.loading = 0;
						// toastr.success("Comment");
					})
					.catch((exception) => {
						this.loading = 0;
						toastr.error(this.locale.something_went_wrong);
					    console.log(exception);
					});
				} else {
					toastr.warning(this.locale.write_something_in_the_text_area+'...');
					this.loading = 0;
				}
			}
		},
		created(){

		}
	};
</script>