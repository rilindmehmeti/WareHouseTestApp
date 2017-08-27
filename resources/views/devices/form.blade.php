
<div class="form-group {{$errors->has('shop_id') ? 'has-error' : ''}}">
	{!!Form::label('shop_id', 'Shop*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
        {!!Form::select('shop_id', $shops, null, ['class' => 'form-control']) !!}
        {!!$errors->first('shop_id', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{$errors->has('IMEI1') ? 'has-error' : ''}}">
	{!!Form::label('IMEI1', 'IMEI1*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!!Form::text('IMEI1', null, ['class' => 'form-control']) !!}
        {!!$errors->first('IMEI1', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{$errors->has('IMEI2') ? 'has-error' : ''}}">
	{!!Form::label('IMEI2', 'IMEI2*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!!Form::text('IMEI2', null, ['class' => 'form-control']) !!}
        {!!$errors->first('IMEI2', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{$errors->has('EAN') ? 'has-error' : ''}}">
	{!!Form::label('EAN', 'EAN*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!!Form::text('EAN', null, ['class' => 'form-control']) !!}
        {!!$errors->first('EAN', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{$errors->has('condition') ? 'has-error' : ''}}">
	{!!Form::label('condition', 'Condition*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!!Form::select('condition', ['New', 'Opened', 'Broken Fixable', 'Broken Unfixable'], null, ['class' => 'form-control']) !!}
        {!!$errors->first('condition', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
	{!!Form::label('description', 'Description*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!!Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!!$errors->first('description', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{$errors->has('returnOrderId') ? 'has-error' : ''}}">
	{!!Form::label('returnOrderId', 'Return Order No*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!!Form::number('returnOrderId', null, ['class' => 'form-control']) !!}
        {!!$errors->first('returnOrderId', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
<div class="form-group {{$errors->has('returnOrderId') ? 'has-error' : ''}}">
	{!!Form::label('images', 'Images*', ['class' => 'col-md-4 control-label']) !!}
	<div class="col-md-6">
		{!!Form::file('images[]', ['multiple' => 'multiple']) !!}
        {!!$errors->first('images', '
		<p class="help-block">:message</p>') !!}
	</div>
</div>
@if (isset($device) && count($device->images))
<div class="form-group {{$errors->has('returnOrderId') ? 'has-error' : ''}}">
	<label class="col-md-4 control-label">
		List of Images
	</label>
	<div class="col-md-6">
		@include ('devices.images', ['images' => $device->images])
	</div>
</div>
@endif

<div class="form-group">
	<div class="col-md-offset-4 col-md-4">
		{!!Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
	</div>
</div>
