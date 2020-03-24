<template>
	<div class="bucket-btn" v-bind:class="location == 'desktop' ? 'bucket-btn-lg' : 'bucket-btn-sm'">
		<span class="icon-bucket position-relative" v-bind:class="location == 'desktop' ? 'text-primary' : 'text-advertiser'">
			<span class="bucket-items" v-bind:class="location == 'desktop' ? 'text-white' : 'text-primary'" v-if="hasCount">{{ counter }}</span>
			<span class="bucket-items" v-bind:class="location == 'desktop' ? 'text-white' : 'text-primary'" v-else><font-awesome-icon :icon="'plus-circle'" /></span>
		</span>
	</div>
</template>

<script>
import {eventBus} from "../app";

export default {
	props: {
		bucketId: String,
		location: String,
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