@extends('layouts.app')

@section('content')

			<div class="panel panel-default">
				<div class="panel-heading">Users</div>
				<div class="panel-body">
					<a href="{{url('/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
						<i class="fa fa-plus" aria-hidden="true"></i>Add New
					</a>

					{!!Form::open(['method' => 'GET', 'url' => '/users', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
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
									<th>{{HtmlHelper::sortCell('email', 'Email', ['class' => 'sort-cell'])}}</th>
									<th>{{HtmlHelper::sortCell('role', 'Role', ['class' => 'sort-cell'])}}</th>
									<th>Managing</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $item)
								<tr>
									<td>{{$item->id }}</td>
									<td>{{$item->name }}</td>
									<td>{{$item->email }}</td>
									<td>{{ucfirst($item->role) }}</td>
									<td>{{$item->managingShops()->count()}} Shops</td>
									<td>
										<a href="{{url('/users/' . $item->id) }}" title="View User">
											<button class="btn btn-info btn-xs">
												<i class="fa fa-eye" aria-hidden="true"></i>View
											</button>
										</a>
										{{--
										<a href="{{ url('/users/' . $item->id . '/edit') }}" title="Edit User">
											<button class="btn btn-primary btn-xs">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit
											</button>
										</a>--}}
                                            {!!Form::open([
											   'method'=>'DELETE',
											   'url' => ['/users', $item->id],
											   'style' => 'display:inline'
										   ]) !!}
                                            {!!Form::button('
										<i class="fa fa-trash-o" aria-hidden="true"></i>Delete', array(
												   'type' => 'submit',
												   'class' => 'btn btn-danger btn-xs',
												   'title' => 'Delete User',
												   'onclick'=>'return confirm("Confirm delete?")'
										   )) !!}
                                            {!!Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="pagination-wrapper">{!!$users->appends(['search' => Request::get('search')])->render() !!} </div>
					</div>

				</div>
			</div>

@endsection
