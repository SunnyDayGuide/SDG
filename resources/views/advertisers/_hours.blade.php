<div class="tab">
	<h4>Opening Hours</h4>
	<ul> 
		@if($openingHours->isOpen())
		<li class="text-primary font-weight-bold">NOW OPEN</li>
		@endif
		@foreach($openingHours->forWeek() as $day => $hours)
		<li>
			@if($openingHours->isOpenOn($day))
				{{ ucfirst(trans($day)) }}: 
				@foreach($openingHours->forDay($day) as $time) 
				{{ $time->start()->format('g:ia') }} - {{ $time->end()->format('g:ia') }}
				@endforeach
				<span class="ml-3">{{ $advertiser->hours[$day]['data'] }}</span>
			@else {{ ucfirst(trans($day)) }}: Closed 
			@endif 
		</li>	
		@endforeach
	</ul> 
</div>