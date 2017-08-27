@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">Edit Order #{{ $order->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/orders') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        {!! Form::model($order, [
                            'method' => 'PATCH',
                            'url' => ['/orders', $order->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('orders.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>

@endsection
