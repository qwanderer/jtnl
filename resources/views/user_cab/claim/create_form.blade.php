@extends("layouts.app")

@section("content")

    <ol class="breadcrumb">
        <li><a href="{{ route("home") }}">{{ trans("words.main") }}</a></li>
        <li><a href="{{ route("user.claim.index") }}">User Cab</a></li>
        <li class="active">Create</li>
    </ol>



    <h1>Creating claim</h1>
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

    <form method="post" action="{{ route('user.claim.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
            {{ $errors->first('title') }}
        </div>
        <div class="form-group">
            <label for="descr">Descr</label>
            <textarea class="form-control" id="descr" name="descr" placeholder="Descr">{{ old('descr') }}</textarea>
            {{ $errors->first('descr') }}
        </div>
        <div class="form-group">
            <label for="rail_id">Rail</label>
            <select name="rail_id" class="form-control" style="max-width:200px;">
                <option value="">Select Rail</option>
                @foreach($rails as $rail)
                    <option {{ $rail->id==old('rail_id')?"selected":"" }} value="{{ $rail->id }}">{{ $rail->title }}</option>
                @endforeach
            </select>
            {{ $errors->first('rail_id') }}
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" style="max-width:200px;">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option {{ $category->id==old('category_id')?"selected":"" }} value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
            {{ $errors->first('category_id') }}
        </div>


        <div class="form-group">
            <label>Upload files</label>
            <div class="row">
                @foreach(range(1,5) as $i)
                    <div class="col-md-3" style="margin:10px; padding:10px;">
                        <input class="form-control js_upload_image_input" data-loop="{{ $i }}" name="imgs[]" type="file">
                        <div id="upload_image_placeholder_{{ $i }}"></div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Create</button>
        </div>
    </form>
@endsection
