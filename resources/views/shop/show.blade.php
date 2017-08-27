@extends('layouts.app')

@section('content')

                <div class="panel panel-default">
                    <div class="panel-heading">Shop {{ $shop->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/shops') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/shops/' . $shop->id . '/edit') }}" title="Edit Shop"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['shops', $shop->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Shop',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $shop->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $shop->name }} </td></tr><tr><th> Country </th><td> {{ $shop->country }} </td></tr><tr><th> City </th><td> {{ $shop->city }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

@endsection
