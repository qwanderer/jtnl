@extends("layouts.app")

@section("content")

    <ol class="breadcrumb">
        <li><a href="{{ route("home") }}">{{ trans("words.main") }}</a></li>
        <li><a href="{{ route("user.claim.index") }}">User Cab</a></li>
        <li class="active">Update</li>
    </ol>

    <h1>Updating claim</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('user.claim.update', ['claim'=>$claim]) }}" enctype="multipart/form-data">
        {{ method_field("PATCH") }}
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $claim->title }}">
        </div>
        <div class="form-group">
            <label for="descr">Descr</label>
            <textarea class="form-control" id="descr" name="descr" placeholder="Descr">{{ $claim->descr }}</textarea>
        </div>
        <div class="form-group">
            <label for="rail_id">Rail</label>
            <select name="rail_id" class="form-control" style="max-width:200px;">
                @foreach($rails as $rail)
                    <option {{ $rail->id==$claim->rail_id?"selected":"" }} value="{{ $rail->id }}">{{ $rail->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" style="max-width:200px;">
                @foreach($categories as $category)
                    <option {{ $category->id==old('category_id')?"selected":"" }} value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Upload files</label>
            <div class="row">
                @foreach(range(1,5) as $i)

                    <div class="col-md-3" style="margin:10px; padding:10px;">
                        @if(isset($claim->imgs[$i-1]))
                            <div id="upload_image_placeholder_{{ $i-1 }}">
                                <img src="{{ $claim->getPathToImgs(false).$claim->imgs[$i-1] }}" style="width: 100px;">
                            </div>
                        @else
                            <input class="form-control js_upload_image_input" data-loop="{{ $i }}" name="imgs[]" type="file">
                            <div id="upload_image_placeholder_{{ $i }}"></div>
                        @endif
                    </div>

                @endforeach
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </div>
    </form>
@endsection
