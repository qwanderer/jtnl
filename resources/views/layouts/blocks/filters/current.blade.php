<br>
<div class="row">
    Активные фильтры:<br><br>
    @foreach(request()->only($request_filters) as $k=>$v)
        @if($k=='by_rail' and $find_rail = $rails->firstWhere('id', $v) and isset($find_rail->title))
            <span style="border:1px solid #ccc; border-radius:5px; padding:5px;"> Rail: <b>{{ $find_rail->title }}</b> </span>
        @endif
    @endforeach
    <a style="margin-left:15px;" class="btn btn-xs btn-info" href="{{ request()->url() }}">drop filters</a>
</div>