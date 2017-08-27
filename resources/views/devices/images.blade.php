@foreach ($images as $i => $img)
<div class="img-box" data-row-id="{{$i}}">
    <div class="img-container">
        <img src="{{Storage::url($img->path)}}" />
    </div>
    <div class="cmd-container">
        <button type="button" class="btn btn-info btn-xs" onclick="window.open('{{Storage::url($img->path)}}', 'blank')">
            <i aria-hidden="true" class="fa fa-eye"></i>
        </button>
        <button type="button" onclick="deleteItem(event, '/devices/deleteImage/{{$img->id}}', null, {{$i}})" class="btn btn-danger btn-xs">
            <i aria-hidden="true" class="fa fa-trash-o"></i>
        </button>
    </div>
</div>
@endforeach