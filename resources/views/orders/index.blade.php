@extends('layouts.app')

@section('content')

			<div class="panel panel-default">
				<div class="panel-heading">Orders</div>
				<div class="panel-body">
					<div class="col-md-12 no-padding">
						<a href="{{url('/orders/create') }}" class="btn btn-success btn-sm" title="Add New Order">
							<i class="fa fa-plus" aria-hidden="true"></i>Add New
						</a>

						{!!Form::open(['method' => 'GET', 'url' => '/orders', 'class' => 'navbar-form navbar-right', 'style' => 'margin-top: -2px', 'role' => 'search'])  !!}

						<div class="input-group">
							<input type="text" class="form-control" data-date-picker="1" placeholder="From Date" name="from" id="from" value="{{$from}}" />
							<span class="input-group-addon">
							<i class="glyphicon glyphicon-calendar"></i>
						</span>
						</div>
						<div class="input-group">
							<input type="text" class="form-control" data-date-picker="1" placeholder="To Date" name="to" id="to" value="{{$to}}" />
							<span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
						</div>
						<div class="input-group">
							<input type="text" class="form-control" value="{{$search}}" name="search" placeholder="Search..." />
							<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</span>
						</div>
						{!!Form::close() !!}
					</div>
					<div class="col-md-12 no-padding">
						<div class="table-responsive">
							<table class="table table-borderless">
								<thead>
								<tr>
									<th>{{HtmlHelper::sortCell('devices.returnOrderId', 'Order ID', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('devices.IMEI1', 'Device', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('orders.status', 'Status', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('orders.saleOrderId', 'Sale Order ID', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('orders.created_at', 'Created At', ['class' => 'sort-cell'])}}</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								@foreach($orders as $item)
									<tr>
										<td>{{$item->device->returnOrderId }}</td>
										<td>{{$item->device->IMEI1 }}</td>
										<td>{{$item->status }}</td>
										<td>{{$item->saleOrderId }}</td>
										<td>{{$item->created_at}}</td>
										<td>
											<a href="{{url('/orders/' . $item->id) }}" title="View Order">
												<button class="btn btn-info btn-xs">
													<i class="fa fa-eye" aria-hidden="true"></i>View
												</button>
											</a>
											<a href="{{url('/orders/' . $item->id . '/edit') }}" title="Edit Order">
												<button class="btn btn-primary btn-xs">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
												</button>
											</a>
											{!!Form::open([
                                                   'method'=>'DELETE',
                                                   'url' => ['/orders', $item->id],
                                                   'style' => 'display:inline'
                                               ]) !!}
											{!!Form::button('
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>Delete', array(
                                                   'type' => 'submit',
                                                   'class' => 'btn btn-danger btn-xs',
                                                   'title' => 'Delete Order',
                                                   'onclick'=>'return confirm("Confirm delete?")'
                                           )) !!}
											{!!Form::close() !!}
											<a href="{{url('/orders/invoice/'.$item->id) }}" title="Generate Invoice">
												<button class="btn btn-success btn-xs">
													<i class="fa fa-pdf-o" aria-hidden="true"></i>Invoice
												</button>
											</a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							<div class="pagination-wrapper">{!!$orders->appends(['search' => Request::get('search')])->render() !!} </div>
						</div>
					</div>
				</div>
			</div>

@endsection
