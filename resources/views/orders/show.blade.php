@extends('layouts.app')

@section('content')

			<div class="panel panel-default">
				<div class="panel-heading">Order {{$order->id }}</div>
				<div class="panel-body">

					<a href="{{url('/orders') }}" title="Back">
						<button class="btn btn-warning btn-xs">
							<i class="fa fa-arrow-left" aria-hidden="true"></i>Back
						</button>
					</a>
					<a href="{{url('/orders/' . $order->id . '/edit') }}" title="Edit Order">
						<button class="btn btn-primary btn-xs">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
						</button>
					</a>
					{!!Form::open([
						   'method'=>'DELETE',
						   'url' => ['orders', $order->id],
						   'style' => 'display:inline'
					   ]) !!}
                            {!!Form::button('
					<i class="fa fa-trash-o" aria-hidden="true"></i>Delete', array(
								   'type' => 'submit',
								   'class' => 'btn btn-danger btn-xs',
								   'title' => 'Delete Order',
								   'onclick'=>'return confirm("Confirm delete?")'
						   ))!!}
                        {!!Form::close() !!}
					<br />
					<br />

					<div class="table-responsive">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<th>Entry ID</th>
									<td>{{$order->id }}</td>
								</tr>
                                <tr>
                                    <th>Order ID</th>
                                    <td>{{$order->device->returnOrderId }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{$order->device->name }} </td>
                                </tr>
								<tr>
									<th>IMEI1</th>
									<td>{{$order->device->IMEI1 }} </td>
								</tr>
                                <tr>
                                    <th>Device Condition</th>
                                    <td>{{$order->device->condition }} </td>
                                </tr>
								<tr>
									<th>Order Status </th>
									<td>{{$order->status }} </td>
								</tr>
								<tr>
									<th>Sale Order ID</th>
									<td>{{$order->saleOrderId }} </td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>

@endsection
