@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Edit Invoice - Order #{{ $order->orders_id }}</div>
                <div class="panel-body">
                    <a href="{{ url('/orders') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::model($order, [
                    'method' => 'POST',
                    'url' => ['/orders/download', $order->id],
                    'class' => 'form-horizontal',
                    'files' => true
                    ]) !!}

                    <div class="form-group">
                        {!!Form::label('info[orders_id]', 'Order ID', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('info[orders_id]', $order->orders_id, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('info[date_purchased]', 'Date Purchased', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('info[date_purchased]', $order->date_purchased, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('info[payment_method]', 'Payment Method', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('info[payment_method]', $order->payment_method, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('info[shipping_method]', 'Shipping Method', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('info[shipping_method]', $order->shipping_method, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('customer[telephone]', 'Telephone', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('customer[telephone]', $order->orderCustomer->telephone, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('customer[email_address]', 'Email Address', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('customer[email_address]', $order->orderCustomer->email_address, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12"><hr /></div>
                        <label class="col-md-4 control-label">Billing Address</label>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[company]', 'Company', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[company]', $order->orderBillingAddress->company, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[name]', 'Name', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[name]', $order->orderBillingAddress->name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[street_address]', 'Street', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[street_address]', $order->orderBillingAddress->street_address, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[suburb]', 'Suburb', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[suburb]', $order->orderBillingAddress->suburb, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[postcode]', 'Postcode', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[postcode]', $order->orderBillingAddress->postcode, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[city]', 'City', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[city]', $order->orderBillingAddress->city, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[state]', 'State', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[state]', $order->orderBillingAddress->state, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('billing[country]', 'Country', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[country]', $order->orderBillingAddress->country, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12"><hr /></div>
                        <label class="col-md-4 control-label">Shipping Address</label>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[company]', 'Company', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('delivery[company]', $order->orderShippingAddress->company, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[name]', 'Name', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('delivery[name]', $order->orderShippingAddress->name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[street_address]', 'Street', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('delivery[street_address]', $order->orderShippingAddress->street_address, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[suburb]', 'Suburb', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('delivery[suburb]', $order->orderShippingAddress->suburb, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[postcode]', 'Postcode', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('delivery[postcode]', $order->orderShippingAddress->postcode, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[city]', 'City', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('billing[city]', $order->orderShippingAddress->city, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[state]', 'State', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('delivery[state]', $order->orderShippingAddress->state, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('delivery[country]', 'Country', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('delivery[country]', $order->orderShippingAddress->country, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12"><hr /></div>
                        <label class="col-md-4 control-label">Product</label>
                    </div>
                    <div class="form-group">
                        {!!Form::label('product[products_pid]', 'Name', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('product[products_pid]', $order->stockProduct->name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('product[IMEI1]', 'IMEI1', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('product[IMEI1]', $order->stockProduct->imei1, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('product[IMEI2]', 'IMEI2', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('product[IMEI2]', $order->stockProduct->imei2, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('product[final_price]', 'Final Price', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('product[final_price]', $order->stockProduct->final_price, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12"><hr /></div>
                        <label class="col-md-4 control-label">Totals</label>
                    </div>
					@for ($i = 0; $i < count($order->orderTotal); $i++)
                    <div class="form-group">
                        {!!Form::label('totals['.$i.'][title]', 'Title', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('totals['.$i.'][title]', $order->orderTotal[$i]->title, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('totals['.$i.'][text]', 'Text', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('totals['.$i.'][text]', $order->orderTotal[$i]->text, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('totals['.$i.'][value]', 'Value', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('totals['.$i.'][value]', $order->orderTotal[$i]->value, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!!Form::label('totals['.$i.'][class]', 'Class', ['class' => 'col-md-4 control-label']) !!}
                        <div class="col-md-6">
                            {!!Form::text('totals['.$i.'][class]', $order->orderTotal[$i]->class, ['class' => 'form-control']) !!}
                        </div>
                    </div>
					<div class="form-group">
						<div class="col-md-offset-4 col-md-6"><hr /></div>
					</div>
					@endfor


                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">
                            {!!Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
@endsection
