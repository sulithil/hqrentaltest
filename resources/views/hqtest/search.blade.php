{!! Form::open(['url'=>'hqtest', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search']) !!}

<div class="form-group">
	<div class="input-group">
		<form class="form-control">
			<label for="searchText">Subject</label>
			<input type="text" name="searchText" value="{{ $searchText }}" class="form-control" placeholder="Search...">

			<span class="input-group-btn">
				<button type="submit" class="btn btn-primary">Search</button>
			</span>
		</form>
	</div>
</div>

{!! Form::close() !!}