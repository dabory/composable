@extends('layouts.master')
@section('title', 'DBUpdate')
@section('content')

<div class="content py-0">
    <div class="mb-1 text-right d-flex justify-content-end">
        <div class="btn-group">
            <form action="{{ route('db-update.store') }}" method="POST">
                @csrf
                <input type="checkbox" name="is_run" id="is-run-check" value="1"><label for="is-run-check">실행</label>
                <button type="submit" class="btn btn-sm btn-primary ml-1" data-value="update">
                    DBUpdate
                </button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header header-elements-inline">
            <div class="header-elements">
                <div class="form-check form-check-right form-check-switchery form-check-switchery-sm">
                </div>
            </div>
        </div>

        <div class="card-body py-0">
            <div class="table-responsive" style="height: 570px">
                <table class="table-row" style="min-width: 1000px; table-layout: fixed;">
                    <thead>
                    <tr>
                        <th style="width:5%;">번호</th>
                        <th style="width:5%;">업데이트번호</th>
                        <th style="width:5%;">구분</th>
                        <th style="width:20%;">SQL명령어</th>
                        <th style="width:5%;">실행승인</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $no = count($dbupdateProc['Page'] ?? []) @endphp
                    @forelse($dbupdateProc['Page'] ?? [] as $dbupdate)
                        <tr>
                            <td>{{ $no-- }}</td>
                            <td>{{ $dbupdate['DbupdateNo'] }}</td>
                            <td>{{ DataConverter::execute($dbupdate['Sort'], "sort('dbupdate')") }}</td>
                            <td>{{ $dbupdate['SqlCommand'] }}</td>
                            <td>{{ DataConverter::execute($dbupdate['IsConfirmed'], 'check') }}</td>
                        </tr>
                    @empty
                        <tr><td class="text-center" colspan="5">{{ _e('No data found') }}</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
