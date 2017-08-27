@extends('layouts.app')

@section('content')

			<div class="panel panel-default">
				<div class="panel-heading">{{$user->name }}</div>
				<div class="panel-body">

					<a href="{{url('/users') }}" title="Back">
						<button class="btn btn-warning btn-xs">
							<i class="fa fa-arrow-left" aria-hidden="true"></i>Back
						</button>
					</a>
					{!!Form::open([
                    'method'=>'DELETE',
                    'url' => ['users', $user->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!!Form::button('
					<i class="fa fa-trash-o" aria-hidden="true"></i>Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete User',
                    'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                    {!!Form::close() !!}
                    @unless($user->HasRole('admin') || Auth::user()->HasRole('manager'))
					<a href="{{url('users/'.$user->id.'/shops') }}" title="Manage Shops">
						<button class="btn btn-info btn-xs pull-right">
							<i class="fa fa-cogs" aria-hidden="true"></i>Manage Shops
						</button>
					</a>
					@endunless
					<br />
					<br />

					<div class="table-responsive">
						<table class="table table-borderless">
							<tbody>
								<tr>
									<th>ID</th>
									<td>{{$user->id }}</td>
								</tr>
								<tr>
									<th>Name </th>
									<td>{{$user->name }} </td>
								</tr>
								<tr>
									<th>Email </th>
									<td>{{$user->email }} </td>
								</tr>
								<tr>
									<th>Role </th>
									<td>{{ucfirst($user->role) }} </td>
								</tr>
								<tr>
									<th>Shops</th>
									<td>
										@foreach($user->managingShops()->get() as $shop)
											{{$shop->name}}<br/>
										@endforeach
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>

@endsection
