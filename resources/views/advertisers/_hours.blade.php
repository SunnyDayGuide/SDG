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
			<time>{{ $time->start()->format('g:iA') }}</time> - <time>{{ $time->end()->format('g:iA') }}</time>{{ $loop->last ? '' : '; ' }}
			@endforeach 
		@else <span class="day">{{ ucfirst(trans($day)) }}</span> Closed 
		@endif
	</li>	
	@endforeach
</ul>
<p><small>*Hours may be seasonal or vary on holidays.</small></p>