<h4>Hours</h4>
<ul class="list-unstyled mb-0"> 
	@if($openingHours->isOpen())
	<li class="font-weight-bold text-highlight">NOW OPEN</li>
	@endif
	@foreach($openingHours->forWeek() as $day => $hours)
	<li>
		@if($openingHours->isOpenOn($day))
			<span class="day">{{ ucfirst(trans($day)) }}</span>
			@foreach($openingHours->forDay($day) as $time) 
			{{ $time->start()->format('g:ia') }} - {{ $time->end()->format('g:ia') }}
			@endforeach 
			<span class="ml-3">{{ $advertiser->hours[$day]['data'] }}</span>
		@else <span class="day">{{ ucfirst(trans($day)) }}</span> Closed 
		@endif 
	</li>	
	@endforeach
</ul> 
