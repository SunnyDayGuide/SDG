<div class="mx-auto text-center mt-5">
	<form method="GET" action="#">
		<div class="form-row">
			<div class="form-group form-row col-5">
				<div class="col-6 input-group date">
					<input type="text" class="form-control event_date" name="start_date" placeholder="From" value="{{ old('start_date') }}">
					<div class="input-group-append">
						<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
					</div>
				</div>
				<div class="col-6 input-group date">
					<input type="text" class="form-control event_date" name="end_date" placeholder="To" value="{{ old('end_date') }}">
					<div class="input-group-append">
						<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
					</div>
				</div>
			</div>
			<div class="form-group col-md-5">
			  <input type="text" class="form-control" id="keyword" name="q" placeholder="Enter Keyword">
			</div>
			<div class="form-group col-md-2"><button type="submit" class="btn btn-primary btn-block">Search</button></div>
		</div>
	</form>
</div>