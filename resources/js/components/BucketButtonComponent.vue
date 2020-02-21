<template>
	<div>
		<button class="d-flex align-items-center btn btn-advertiser mr-4" @click="updateBucket" v-if="buttonStyle == 'button'">
			<div class="bucket-instructions text-primary font-weight-bold mr-3" v-text="added ? 'Remove from your Bucket' : 'Add to your Bucket'"></div>
			<div class="bucket-btn bucket-btn-sm">
				<span class="icon-bucket position-relative text-primary">
					<span class="bucket-items text-white">
						<font-awesome-icon :icon="added ? 'minus-circle' : 'plus-circle'" />
					</span>
				</span>
			</div>
		</button>

		<div class="bucket-btn bucket-btn-sm mr-4" @click="updateBucket" v-else>
			<span class="icon-bucket position-relative text-primary">
				<span class="bucket-items text-white">
					<font-awesome-icon :icon="added ? 'minus-circle' : 'plus-circle'" />
				</span>
			</span>
		</div>

	</div>
</template>

<script>
export default {
	props: {
		itemId: String,
		itemClass: String,
		buttonStyle: String,
		inBucket: ''
	},

	data() {
		return {
			added: this.inBucket,
		};
	},

	methods: {
		updateBucket() {
			if(!this.added) {
				this.addToBucket();
			} else this.removeFromBucket();
		},

		async addToBucket() {
			await axios.post('/bucket-list/add', {
			    id: this.itemId,
			    class: this.itemClass
			});
			this.added = true;
			this.$emit('added');
		},

		async removeFromBucket() {
			await axios.post('/bucket-list/remove', {
			    id: this.itemId,
			    class: this.itemClass
			});
			this.added = false;
			this.$emit('removed');
		},

	}
};

</script>