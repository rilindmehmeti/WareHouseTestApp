@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">Create New Order</div>
                    <div class="panel-body">
                        <a href="{{ url('/orders') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />


                        {!! Form::open(['url' => '/orders', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('orders.form')

                        {!! Form::close() !!}

                    </div>
                </div>

@endsection
