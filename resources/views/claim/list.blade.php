@extends("layouts.app")

@section('filters')
    @include('layouts.blocks.filters.nav_row')
@endsection

@section('content')
    @if(count(request()->only($request_filters))>0)
        @include('layouts.blocks.filters.current')
    @endif
    @if(isset($claims) and count($claims)>0)
        @foreach($claims as $claim)
            <div class="row">
                <div class="col-md-12">
                    <h4>
                        <a href="{{ route('claim.show', ['category'=>$claim->category, 'claim_id'=>$claim->id]) }}">{{ $claim['title'] }}</a>
                    </h4>
                    <small>
                        <a href="{{ route('claim.by_category', ['category'=>$claim->category]) }}">{{ $claim->category->title }}</a>
                    </small>
                    <small>
                        {{ $claim->rail_id }}
                    </small>
                    <p>{{ $claim['descr'] }}</p>
                </div>
            </div>
            <hr>
        @endforeach
        {{ $claims->appends(request()->only($request_filters))->links() }}
    @else
        <br><br>
        <div class="alert alert-info">
            no claims
        </div>

    @endif
@endsection