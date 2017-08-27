@extends('layouts.app')

@section('content')

			<div class="panel panel-default">
				<div class="panel-heading">Devices</div>
				<div class="panel-body">
					<a href="{{url('/devices/create') }}" class="btn btn-success btn-sm" title="Add New Device">
						<i class="fa fa-plus" aria-hidden="true"></i>Add New
					</a>

					{!!Form::open(['method' => 'GET', 'url' => '/devices', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
					<div class="input-group">
						<input type="text" class="form-control" name="search" value="{{$search}}" placeholder="Search..." />
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
					{!!Form::close() !!}

					<br />
					<br />
					<div class="table-responsive">
						<table class="table table-borderless">
							<thead>
								<tr>
									<th>{{HtmlHelper::sortCell('returnOrderId', 'Order No', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('name', 'Name', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('IMEI1', 'IMEI1', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('IMEI2', 'IMEI2', ['class' => 'sort-cell'])}}</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($devices as $item)
								<tr>
									<td>{{$item->returnOrderId }}</td>
                                    <td>{{$item->name }}</td>
									<td>{{$item->IMEI1 }}</td>
									<td>{{$item->IMEI2 }}</td>
									<td>
										<a href="{{url('/devices/' . $item->id) }}" title="View Device">
											<button class="btn btn-info btn-xs">
												<i class="fa fa-eye" aria-hidden="true"></i>View
											</button>
										</a>
										<a href="{{url('/devices/' . $item->id . '/edit') }}" title="Edit Device">
											<button class="btn btn-primary btn-xs">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
											</button>
										</a>
										{!!Form::open([
											   'method'=>'DELETE',
											   'url' => ['/devices', $item->id],
											   'style' => 'display:inline'
										   ]) !!}
                                                {!!Form::button('
										<i class="fa fa-trash-o" aria-hidden="true"></i>Delete', array(
													   'type' => 'submit',
													   'class' => 'btn btn-danger btn-xs',
													   'title' => 'Delete Device',
													   'onclick'=>'return confirm("Confirm delete?")'
											   )) !!}
                                            {!!Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="pagination-wrapper">{!!$devices->appends(['search' => Request::get('search')])->render() !!} </div>
					</div>

				</div>
			</div>
@endsection
