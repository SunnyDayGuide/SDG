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
		styles: String,
		buttonStyle: String,
	},

	data() {
		return {
			user: {},
			errors: {},
			added: '',
			idArray: [],
			cookieDate: '',
			cookieValue: this.$cookies.get("BUCKET_"+this.itemClass),
		};
	},

	mounted() {
		this.idArray = [];
		if (this.cookieValue != null) {
			this.idArray = this.cookieValue.split('+');
		}

		this.isAdded();
	},

	methods: {
		isAdded() {
			this.added = false;

			if (this.cookieValue != null) {
				if (this.idArray.includes(this.itemId)) {
					this.added = true;
				} else this.added = false;
			} 
		},

		updateBucket() {
			if(!this.added) {
				this.addToBucket();
			} else this.removeFromBucket();
		},

		addToBucket() {			
			this.addToCookie();
			this.buttonMethod = this.removeFromBucket;
			this.added = true;
			this.$emit('added');
		},

		removeFromBucket() {
			this.removeFromCookie();
			this.buttonMethod = this.addToBucket;
			this.added = false;
			this.$emit('removed');
		},

		addToCookie() {
			if (this.cookieValue != null) {
				var idString = this.cookieValue + '+' + this.itemId;
			} else idString = this.itemId;

			// set new cookie
			this.$cookies.set("BUCKET_"+this.itemClass, idString, { expires: "1y" });

			this.cookieValue = this.$cookies.get("BUCKET_"+this.itemClass),
			this.idArray = this.cookieValue.split('+');
		},

		removeFromCookie() {
			var cookieValue = this.$cookies.get("BUCKET_"+this.itemClass);
			this.idArray = [];
			this.idArray = cookieValue.split('+');

			const index = this.idArray.indexOf(this.itemId);
			if (index > -1) {
				this.idArray.splice(index, 1);
			}

			var idString = this.idArray.join('+');

			this.$cookies.set("BUCKET_"+this.itemClass, idString, { expires: "1y" });

			this.cookieValue = this.$cookies.get("BUCKET_"+this.itemClass);

			if (this.cookieValue != null) {
				this.idArray = this.cookieValue.split('+');
			}
		},

	}
};

</script>