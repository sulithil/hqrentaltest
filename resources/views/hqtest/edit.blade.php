@extends('layout.admin')
@section('content')
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<h3>Edit Message: {{ $message->idmessage }}</h3>

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

	{!! Form::model($message, ['method' => 'PATCH', 'route' => ['hqtest.update', $message->idmessage]]) !!}
	
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<div class="form-group">
				<div class="form-group">
					{!! Form::label('subject', 'Subject:', ['class' => 'font-weight-bold']) !!}
					{!! Form::text('subject', $message->subject, ['class' => 'form-control', 'placeholder' => 'Subject...', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('message', 'Message:', ['class' => 'font-weight-bold']) !!}
					{!! Form::textarea('message', $message->message, ['class' => 'form-control rounded-0', 'placeholder' => 'Your Message...', 'required', 'rows' => '10']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
					{!! Form::reset('Cancel', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
	</div>
	{!! Form::close() !!}
		
@endsection