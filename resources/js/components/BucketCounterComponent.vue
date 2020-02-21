<template>
	<div class="bucket-btn bucket-btn-lg">
		<span class="icon-bucket position-relative text-primary">
			<span class="bucket-items text-white" v-if="hasCount">{{ counter }}</span>
			<span class="bucket-items text-white" v-else><font-awesome-icon :icon="'plus-circle'" /></span>
		</span>
	</div>
</template>

<script>
export default {
	props: {
		bucketId: String,
		initialCount: '',
	},

	data() {
		return {
			hasCount: false,
			counter: this.initialCount,
		};
	},

	created() {
		if (this.counter > 0) {
			this.hasCount = true;
		}
	},
};
</script>