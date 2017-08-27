@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">Edit Shop #{{ $shop->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/shops') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        {!! Form::model($shop, [
                            'method' => 'PATCH',
                            'url' => ['/shops', $shop->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('shop.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>

@endsection
