@extends("layouts.app")

@section("content")

    <ol class="breadcrumb">
        <li><a href="{{ route("home") }}">{{ trans("words.main") }}</a></li>
        <li><a href="{{ route("user.claim.index") }}">User Cab</a></li>
        <li class="active">Update</li>
    </ol>

    <h1>Updating claim</h1>
    <form method="post" action="{{ route('user.claim.update', ['claim'=>$claim]) }}">
        {{ csrf_field() }}
        {{ method_field("PUT") }}
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
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </div>
    </form>
@endsection
