@extends('layouts.app')

@section('content')
			<div class="panel panel-default">
				<div class="panel-heading">Device {{$device->id }}</div>
				<div class="panel-body">

					<a href="{{url('/devices') }}" title="Back">
						<button class="btn btn-warning btn-xs">
							<i class="fa fa-arrow-left" aria-hidden="true"></i>Back
						</button>
					</a>
					<a href="{{url('/devices/' . $device->id . '/edit') }}" title="Edit Device">
						<button class="btn btn-primary btn-xs">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
						</button>
					</a>
					{!!Form::open([
						   'method'=>'DELETE',
						   'url' => ['devices', $device->id],
						   'style' => 'display:inline'
					   ]) !!}
                            {!!Form::button('
					<i class="fa fa-trash-o" aria-hidden="true"></i>Delete', array(
								   'type' => 'submit',
								   'class' => 'btn btn-danger btn-xs',
								   'title' => 'Delete Device',
								   'onclick'=>'return confirm("Confirm delete?")'
						   ))!!}
                        {!!Form::close() !!}
					<br />
					<br />

					<div class="table-responsive">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<th>ID</th>
									<td>{{$device->id }}</td>
								</tr>
                                <tr>
                                    <th>Shop </th>
                                    <td>{{$device->shop->name }} </td>
                                </tr>
                                <tr>
                                    <th>Name </th>
                                    <td>{{$device->name }} </td>
                                </tr>
								<tr>
									<th>IMEI1 </th>
									<td>{{$device->IMEI1 }} </td>
								</tr>
								<tr>
									<th>IMEI2 </th>
									<td>{{$device->IMEI2 }} </td>
								</tr>
								<tr>
									<th>EAN </th>
									<td>{{$device->EAN }} </td>
								</tr>
								<tr>
									<th>Condtion </th>
									<td>{{$device->condition }} </td>
								</tr>
								<tr>
									<th>Description </th>
									<td>{{$device->description }} </td>
								</tr>
                                <tr>
                                    <th>Return Order No </th>
                                    <td>{{$device->returnOrderId }} </td>
                                </tr>
								<tr>
									<th>Images </th>
									<td>
										@if (count($device->images))
											@include ('devices.images', ['images' => $device->images])
										@endif
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>
@endsection
