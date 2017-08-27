@extends('layouts.app')

@section('content')
                <div class="panel panel-default">
                    <div class="panel-heading">Create New User</div>
                    <div class="panel-body">
                        <a href="{{ url('/users') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
                        {!! Form::open(['url' => '/register', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('users.form')

                        {!! Form::close() !!}

                    </div>
                </div>
@endsection
