@extends('layout.admin')
@section('content')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>List of Messages <a href="hqtest/create"><button class="btn btn-success">New Message</button></a></h3>
			@include('hqtest.search')						
		</div>						
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th>Subject</th>
						</tr>
					</thead>
					<tbody>
						@foreach($messages as $msg)
							<tr>
								<td>{{ $msg->idmessage }}</td>
								<td>{{ $msg->subject }}</td>
								<td>
									<a href="{{ URL::action('HqtestController@edit', $msg->idmessage)}}" title=""><button class="btn btn-info">Edit</button> </a>
									<a href="" title="" data-target="#modal-delete-{{$msg->idmessage}}" data-toggle="modal"><button class="btn btn-danger">Delete</button></a>
								</td>
							</tr>
						@include('hqtest.modal')
						@endforeach
					</tbody>
				</table>
			</div>
			{{$messages->render()}}
		</div>
	</div>	
@endsection