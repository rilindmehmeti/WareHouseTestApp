@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->name }} - Shops</div>
                    <div class="panel-body">
                        <div class="col-md-6">
                            <h4>Managing Shops</h4>
                            @foreach($user->managingShops()->get() as $shop)
                                <div class="col-md-12 no-padding">
                                    <h6>{{$shop->name}}</h6>
                                    {!! Form::open([
                                        'method'=>'POST',
                                        'url' => ['/users/'. $user->id.'/shops/'.$shop->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Remove', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Remove',
                                            'onclick'=>'return confirm("Confirm Removal?")'
                                    )) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h4>Available Shops</h4>
                            @foreach($user->availableShops()->get() as $shop)
                                <div class="col-md-12 no-padding">
                                    <h5>{{$shop->name}}</h5>
                                    {!! Form::open([
                                      'method'=>'POST',
                                      'url' => ['/users/'. $user->id.'/shops/'.$shop->id],
                                      'style' => 'display:inline'
                                    ])!!}
                                    {!! Form::button('<i class="fa fa-plus" aria-hidden="true"></i> Add', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-info btn-xs',
                                            'title' => 'Add',
                                            'onclick'=>'return confirm("Confirm Add?")'
                                    )) !!}
                                    {!! Form::close() !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

@endsection
