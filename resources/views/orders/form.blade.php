
<div class="form-group {{$errors->has('device_id') ? 'has-error' : ''}}">
    {!!Form::label('device_id', 'Device*', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <input type="hidden" name="device_id" id="device_id" value="{{isset($order) ? $order->id : '-1'}}" />
		<input class="form-control" type="text" id="device_id_autocomplete" value="{{isset($order) ? $order->device->name.' - '.$order->device->IMEI1 : ''}}" />
        {!!$errors->first('device_id', '
        <p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
    {!!Form::label('status', 'Status*', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!!Form::select('status', ['On Stock', 'Being Repaired', 'To Be Sold', 'Sold'], null, ['class' => 'form-control']) !!}
        {!!$errors->first('status', '
        <p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{$errors->has('saleOrderId') ? 'has-error' : ''}}">
    {!!Form::label('saleOrderId', 'Sale Order No', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!!Form::number('saleOrderId', null, ['class' => 'form-control']) !!}
        {!!$errors->first('saleOrderId', '
        <p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!!Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>


<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script>
	var jAuto = null;
	attachToWinLoad(function () {
		jAuto = jQuery("#device_id_autocomplete");
		jAuto.autocomplete({
			source: function (request, response) {
				jQuery.ajax({
					type: "GET",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: "/orders/device/124",
					data: { term: request.term },
					success: function (data) {
						response(data);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						jQuery('#device_id').val(-1);
					},
				});
			},
			minLength: 3,
			select: function (event, ui) {
				jQuery('#device_id').val(ui.item.hidden);
			}
		});
	});
</script>