@foreach([10, 15, 20, 30, 40, 50, 100, 200, 300, 400, 500] as $limit)
    <option value="{{ $limit }}" {{ request('limit') == $limit ? 'selected' : '' }}>{{ $limit }} Lines</option>
@endforeach
