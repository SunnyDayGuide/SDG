<section id="show-schedule" class="panel">
	<div class="container">
		<div class="">
			<h2 class="text-center font-weight-bold">See the Latest Branson Show Schedules</h2>
			<p>Bacon ipsum dolor amet kielbasa pancetta beef ribs bacon doner leberkas, tenderloin short loin corned beef venison ball tip pork loin flank. Beef ribs kevin burgdoggen, pork belly beef boudin biltong shank pastrami landjaeger. Tenderloin salami jerky porchetta, tongue swine ball tip cupim ground round. Corned beef jerky shankle, flank ball tip burgdoggen venison ham hock kevin doner. Ham hock chuck ball tip filet mignon, salami flank shoulder.</p>
		</div>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="list-group list-group-flush show-list mt-5">
					@foreach($shows as $show)  
					<a href="{{ $show->path() }}" class="list-group-item list-group-item-action show-item {{ $show->advertiser ? 'bg-advertisers-lt' : '' }}">
						<span class="{{ $show->advertiser ? 'font-weight-bold' : '' }}">{{ $show->name }}</span>
						<span class="small">@if($show->theater) - {{ $show->theater->name }}, @endif
							{{ $show->local_phone }}</span>
							@if($show->advertiser && $show->advertiser()->has('coupons'))
							<div class="coupon-icon">
								<span class="fa-stack fa-xs">
									<i class="fas fa-certificate fa-stack-2x"></i>
									<i class="fas fa-dollar-sign fa-stack-1x fa-inverse"></i>
								</span>
							</div>
							@endif
						</a>
						@if($loop->iteration % 20 == 0)
						<div class="col-md-12 my-md-4 my-3 px-md-0">
							<div class="banner-ad">
								I AM A BANNER AD
							</div>
						</div>
						@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>