<div class="row" style="margin: 0 0 10px;">
    <form class="form-inline" id="filters_form" method="get">
        <div class="form-group">
            <select class="form-control" name="by_rail">
                <option>choose rail</option>
                @foreach($rails as $rail)
                    <option value="{{ $rail->id }}">{{ $rail->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">filter</button>
    </form>
</div>
