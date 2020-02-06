<template>
	<div class="card card-advertiser overlay mb-4 border-0" v-show="true">
	<div class="row no-gutters">
		<div class="col-md-5">
			<div class="card-img" v-if="image">
				<a v-bind:href="route">
					<vueImage></vueImage>
				</a>
			</div>
		</div>
		<div class="col-md-7">
			<div class="card-body py-0">
				<a v-bind:href="route" class="text-reset text-decoration-none">
					<h5 class="card-title">{{ name }}</h5>
				</a>
				
				<!-- <div class="locations">
					<div v-for="location in locations" class="d-md-flex justify-content-between my-4">
						<div class="flex-grow-1 py-1"> :aria-label="'Get directions to ' + location.full_address"
							<a v-bind:href="location.directions" target="_blank" :aria-label="'Get directions to ' + location.full_address">
								<i class="fas fa-map-marker-alt fa-lg fa-fw mr-2" :title="'Get directions to ' + location.full_address"></i>{{ location.full_address }}
							</a>
						</div>
						<div v-if="location.telephone" class="py-1">
							<a v-bind:href="'tel:' + location.telephone" :aria-label="'Call ' + name" >
								<i class="fas fa-phone fa-lg fa-fw mr-2" :title="'Call ' + name"></i>{{ location.telephone }}
							</a>
						</div>
					</div>
				</div> -->

			</div>
		</div>
	</div>
</div>
</template>

<script>
	export default {
		props: {
			bucketItem: Object,
	        route: String,
	        name: String,
	        image: String,
	        locations: String,
		},

		data() {
			return {

			};
		},

		components: {
			vueImage: {
				template: 
				`
					<img srcset="https://sunnyday.test/media/1406/responsive-images/Fudgery-insert1-BR19___card_558_297.jpg 558w, https://sunnyday.test/media/1406/responsive-images/Fudgery-insert1-BR19___card_466_248.jpg 466w, https://sunnyday.test/media/1406/responsive-images/Fudgery-insert1-BR19___card_390_207.jpg 390w, https://sunnyday.test/media/1406/responsive-images/Fudgery-insert1-BR19___card_326_173.jpg 326w" src="/media/1406/conversions/Fudgery-insert1-BR19-card.jpg" class="img-fluid">
				`
			}
		}
	};
</script>