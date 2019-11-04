@extends('layout.admin')
@section('content')
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<h3>New Record</h3>

			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>

{!! Form::open(['route' => 'hqtest.store', 'method' => 'POST']) !!}

	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="form-group">
				{!! Form::label('subject', 'Subject:', ['class' => 'font-weight-bold']) !!}
				{!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Subject...', 'required']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('message', 'Message:', ['class' => 'font-weight-bold']) !!}
				{!! Form::textarea('message', null, ['class' => 'form-control rounded-0', 'placeholder' => 'Your Message...', 'required', 'rows' => '10']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
				{!! Form::reset('Cancel', ['class' => 'btn btn-primary']) !!}
			</div>
		</div>
	</div>
{!! Form::close()!!}

@endsection