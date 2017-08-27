@extends('layouts.app')

@section('content')

			<div class="panel panel-default">
				<div class="panel-heading">Shops</div>
				<div class="panel-body">
					<a href="{{url('/shops/create') }}" class="btn btn-success btn-sm" title="Add New Shop">
						<i class="fa fa-plus" aria-hidden="true"></i>Add New
					</a>

					{!!Form::open(['method' => 'GET', 'url' => '/shops', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
					<div class="input-group">
						<input type="text" class="form-control" value="{{$search}}" name="search" placeholder="Search..." />
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
									<th>{{HtmlHelper::sortCell('id', 'ID', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('name', 'Name', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('country', 'Country', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('city', 'City', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('active', 'Is Active', ['class' => 'sort-cell'])}}</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($shops as $item)
								<tr>
									<td>{{$item->id }}</td>
									<td>{{$item->name }}</td>
									<td>{{$item->country }}</td>
									<td>{{$item->city }}</td>
									<td>{{$item->active ? 'Yes' : 'No' }}</td>
									<td>
										<a href="{{url('/shops/' . $item->id) }}" title="View Shop">
											<button class="btn btn-info btn-xs">
												<i class="fa fa-eye" aria-hidden="true"></i>View
											</button>
										</a>
										<a href="{{url('/shops/' . $item->id . '/edit') }}" title="Edit Shop">
											<button class="btn btn-primary btn-xs">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
											</button>
										</a>
										{!!Form::open([
											   'method'=>'DELETE',
											   'url' => ['/shops', $item->id],
											   'style' => 'display:inline'
										   ]) !!}
                                                {!!Form::button('
										<i class="fa fa-trash-o" aria-hidden="true"></i>Delete', array(
													   'type' => 'submit',
													   'class' => 'btn btn-danger btn-xs',
													   'title' => 'Delete Shop',
													   'onclick'=>'return confirm("Confirm delete?")'
											   )) !!}
                                            {!!Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="pagination-wrapper">{!!$shops->appends(['search' => Request::get('search')])->render() !!} </div>
					</div>

				</div>
			</div>

@endsection
