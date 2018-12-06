@extends("layouts.app")


@section("content")

    <ol class="breadcrumb">
        <li><a href="{{ route("home") }}">Main</a></li>
        <li class="active">user Cab</li>
    </ol>

    <div class="row">
        <div class="col-md-12">
            <h2>{{ Auth()->user()->name }}</h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(isset($claims) and $claims)
        @foreach($claims as $claim)
            <div class="row">
                <div class="col-md-12">
                    <h4>
                        <a href="{{ route('user.claim.edit', ['claim'=>$claim->id]) }}">{{ $claim['title'] }}</a>


                        <a class="btn btn-xs btn-danger pull-right" href="" onclick="event.preventDefault(); document.getElementById('frm-claim_destroy_{{ $claim->id }}').submit();">delete</a>
                        <form id="frm-claim_destroy_{{ $claim->id }}" action="{{ route('user.claim.destroy', $claim) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                        </form>

                    </h4>
                    <p>{{ $claim['descr'] }}</p>
                </div>
            </div>
            <hr>
        @endforeach
    @endif

    @if(auth()->user()->canCreateClaim())
        <a class="btn btn-primary" style="display:block; width:250px; margin:10px auto;" href="{{ route('user.claim.create') }}">Create new Claim</a>
    @else
        <div class="alert alert-info" style="width:250px; margin:10px auto;" >U have max claims amount</div>
    @endif

@endsection