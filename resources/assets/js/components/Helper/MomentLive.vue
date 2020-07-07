<template>
	<div>
		<form method="get">
    		<span v-model="interval_" class="d-none"></span>
		</form>
	</div>
</template>
<script>
	import { store } from '../../store';

	export default {
		name: 'MomentLive',
		props: [],
		data(){
			return {
				interval_: 0,
			}
		},
		mounted(){
			setInterval(()=>{
				this.interval_ += 0.1;
				console.log(this.interval_);
			}, 3000);
		}
	};
</script>