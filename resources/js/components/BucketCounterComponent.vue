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
	prop: {
		bucketId: String,
	},

	data() {
		return {
			hasCount: false,
			allBucketCookies: document.cookie.split(';').filter((item) => item.trim().startsWith('BUCKET_')),
			advCount: '',
			articleCount: '',
			couponCount: '',
			distCount: '',
			eventCount: '',
			showCount: '',
			counter: '',
		};
	},

	created() {
		this.getTotalCount();
	},

	methods: {
		getTotalCount() {
			this.advCount = this.advertisers();
			this.couponCount = this.coupons();
			this.articleCount = this.articles();
			this.eventCount = this.events();
			this.distCount = this.distributors();
			this.showCount = this.shows();

			this.counter = this.advCount + this.couponCount + this.articleCount + this.eventCount + this.distCount + this.showCount;

			if (this.counter > 0) {
				this.hasCount = true;
			}
		},

		advertisers() {
			var advCookieValue = this.$cookies.get("BUCKET_Advertiser");

			if (advCookieValue != null) {
				var idArray = advCookieValue.split('+');

				return idArray.length;
			} else return 0;
		},

		coupons() {
			var couponCookieValue = this.$cookies.get("BUCKET_Coupon");
			
			if (couponCookieValue != null) {
					var idArray = couponCookieValue.split('+');

					return idArray.length;
				} else return 0;
			},

		articles() {
			var articleCookieValue = this.$cookies.get("BUCKET_Article");

			if (articleCookieValue != null) {
				var idArray = articleCookieValue.split('+');

				return idArray.length;
			} else return 0;
		},

		events() {
			var eventCookieValue = this.$cookies.get("BUCKET_Event");

			if (eventCookieValue != null) {
				var idArray = eventCookieValue.split('+');

				return idArray.length;
			} else return 0;
		},

		distributors() {
			var distCookieValue = this.$cookies.get("BUCKET_Distributor");

			if (distCookieValue != null) {
				var idArray = distCookieValue.split('+');

				return idArray.length;
			} else return 0;
		},

		shows() {
			var showCookieValue = this.$cookies.get("BUCKET_Show");

			if (showCookieValue != null) {
				var idArray = showCookieValue.split('+');

				return idArray.length;
			} else return 0;
		},
	}
}
</script>