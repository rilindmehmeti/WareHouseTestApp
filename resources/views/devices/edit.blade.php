@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">Edit Device #{{ $device->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/devices') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        {!! Form::model($device, [
                            'method' => 'PATCH',
                            'url' => ['/devices', $device->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('devices.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>

@endsection
