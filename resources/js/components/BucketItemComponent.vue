<template>
	<div :class="divClass" :id="itemId" v-if="shouldDisplay">
		<slot v-bind:removeItem="removeItem"></slot>
	</div>
</template>

<script>
	export default {
		props: {
			itemId: String,
			itemClass: String,
			divClass: String,
		},

		data() {
			return {
				shouldDisplay: true,
			};
		},

		methods: {
			async removeItem() {
				await axios.post('/bucket-list/remove', {
				    id: this.itemId,
				    class: this.itemClass
				});
				this.shouldDisplay = false;
				this.$emit('removed');
			},
		}
	};
</script>