<template>
	<div>
    	<form class="form-control py-3 alert-secondary mb-2" method="post" :action="url" @submit.prevent="axiosPostComment">
    		<slot></slot>
    		<div class="form-group">
    			<label class="h5">{{ locale.write_comment }}</label>
    			<input type="hidden" name="book_id" v-model="book_id">
    			<textarea name="comment_body" v-model="comment_body" class="form-control" :class="avro" rows="3" placeholder=""></textarea>
    		</div>
    		<button v-if="!loading" type="submit" class="btn btn-primary" id="comment_buttom">{{ locale.comment }}</button>
    		<button v-else class="btn btn-primary cursor-wait">{{ locale.comment }}</button>
    		<!-- <button class="btn btn-primary"><i class="fa fa-spinner fa-spin"></i></button> -->
    		<span class="btn btn-primary float-right" @click="commentRefresh" title="Update Comments"><i class="fa fa-refresh" :class="refreshSpin"></i></span>
    	</form>
    	<div class="form-row">
        	<div class="col-12 my-1" v-for="comment in all_comments">
        		<div class="card h-100 alert-light">
        			<div class="card-header alert-secondary d-flex" style="padding: 4px 8px !important;">
            			<h4 class="mb-0 col-8 p-0 d-flex" :class="book.admin_id == comment.admin_id ? 'text-primary':''"><img class="img-comment" :src="base_url+'/'+comment.photo" alt="">{{ comment.name }}</h4>
            			<p class="mb-0 col-4 p-0 text-right my-auto small">{{ comment.created_at_human }} <span v-if="auth_id == comment.admin_id" @click="axiosDeleteComment(comment.id)" class="h5 cursor-pointer btn alert-danger py-0 px-1 mb-0" style="line-height: 13px!important" title="Click twice to delete!"><span>&times;</span></span></p>
        			</div>
        			<div class="card-body">
            			<p class="mb-0 text-dark">{{ comment.comment_body }}</p>
            		</div>
        		</div>
        	</div>
    	</div>
	</div>
</template>
<script>
	import { store } from '../../store'
	export default {
		name: 'Comment',
		props: ['url', 'post_url', 'book_id', 'book_detail', 'comments'],
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
				delete_comment: {}
			}
		},
		mounted(){
			this.auth_id = decode_base64(store.state.auth_id);
			console.log(this.auth_id);
			this.base_url = store.state.my_url;

			this.language = store.state.locale;
			this.locale = store.state.file_default;

			this.avro = (this.language == 'bn' ? 'avro_bn':'');
		},
		methods: {
			commentRefresh: function () {
				this.refreshSpin = 'fa-spin';

				axios.get(this.post_url)
				.then((response) => {
					this.all_comments  = response.data;
					toastr.success("Comments updated!");
					this.refreshSpin = '';
				})
				.catch((exception) => {
				    console.log(exception);
					this.refreshSpin = '';
					toastr.error("Something went worng!");
				});
			},
			axiosDeleteComment: function (id) {
				if (this.delete_comment.id == id) {
					this.refreshSpin = 'fa-spin';

					axios.get(this.post_url+'/'+id)
					.then((response) => {
						this.all_comments  = response.data;
						toastr.success("Comment deleted successfully!");
						this.delete_comment = {};
						this.refreshSpin = '';
					})
					.catch((exception) => {
						this.refreshSpin = '';
						toastr.error("Something went worng!");
					    console.log(exception);
					});

				} else {
					this.delete_comment.id = id;
					this.delete_comment.count = 1;
					Toast.fire({
					  icon: 'warning',
					  title: '<small class="m-0 pl-2">Click again...</small>'
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
						toastr.error("Something went worng!");
					    console.log(exception);
					});
				} else {
					toastr.warning("Write something in the text area");
					this.loading = 0;
				}
			}
		}
	};
</script>