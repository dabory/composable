@extends('layouts.master')
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                {{-- act button include --}}
                <div class="card">
                    <div class="card-body">
                        <div id="">

                            <div class="form-grou mb-3" {{ $formA['FormVars']['Hidden']['StorageCode'] }}>
                                <label>아이디</label>
                                <br>
                                <input type="text" id="StorageCode" name="StorageCode" disabled>
                            </div>
                            <div class="form-grou mb-3" {{ $formA['FormVars']['Hidden']['StorageName'] }}>
                                <label>비밀번호</label>
                                <br>
                                <button type="button" class="btn btn-sm btn-primary" onclick="show_modal('password')">변경</button>
                            </div>
                            <div class="form-grou mb-3" {{ $formA['FormVars']['Hidden']['Location'] }}>
                                <label>이름</label>
                                <br>
                                <input type="text" id="Location" name="Location" disabled>
                            </div>
                            <div class="form-grou mb-3" {{ $formA['FormVars']['Hidden']['Location'] }}>
                                <label>연락처</label>
                                <br>
                                <input type="text" id="Location" name="Location" disabled>
                            </div>
                            <div class="form-grou mb-3" {{ $formA['FormVars']['Hidden']['Location'] }}>
                                <label>관리자 등급</label>
                                <br>
                                <input type="text" id="Location" name="Location" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <button type="button" class="btn btn-sm btn-primary" onclick="show_modal('')">계정 정보 변경</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-my-users" aria-hidden="true" data-backdrop="static" style="z-index: 1049; overflow: auto;">
        <div class="modal-dialog m-auto pt-4"  style="width: 480px;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body p-2" style="background-color: #f5f5f5;">
                    <div class="mb-1 pt-2 text-right btn-groups">
                        <button type="button" class="btn btn-sm btn-primary save-spinner-btn" hidden>
                            <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
                                Loading...
                        </button>
                        <div class="btn-group" >
                            <button type="button" class="btn btn-sm btn-primary ticket-act save-button" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>
                                {{ $formA['FormVars']['Title']['SaveButton'] }}
                            </button>
                            @include('front.dabory.erp.partial.select-btn-options', [
                                'selectBtns' => $formA['SelectButtonOptions'],
                                'eventClassName' => 'ticket-act',
                            ])
                        </div>
                    </div>

                    <div class="card mb-2" id="my-users-form">
                        <div class="card-header" id="frm">
                            <div class="row">
                                <div class="col-12 col-lg card-header-item">
                                    <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-0">
                                        <div class="card-header p-0 mb-2">
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" id="Id" name="Id" value="0">
                                            <div id="contact-group">
                                                <div class="d-flex flex-column mb-2">
                                                    <label class="m-0">이름</label>
                                                    <input type="text" id="name-txt" class="rounded w-100" autocomplete="off">
                                                </div>
                                                <div class="d-flex flex-column mb-2">
                                                    <label class="m-0">연락처</label>
                                                    <input type="text" id="contact-txt" class="rounded w-100" autocomplete="off">
                                                </div>
                                            </div>

                                            <div id="password-group">
                                                <div class="d-flex flex-column mb-2">
                                                    <label class="m-0">비밀번호</label>
                                                    <input type="password" id="password-txt" class="rounded w-100" autocomplete="off">
                                                </div>
                                                <div class="d-flex flex-column mb-2">
                                                    <label class="m-0">비밀번호 확인</label>
                                                    <input type="password" id="confirm-pass-txt" class="rounded w-100" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script>
    function show_modal(type) {
        switch (type) {
            case 'password':
                $('#modal-my-users').find('#myModalLabel').text('비밀번호 변경')
                $('#my-users-form').find('#password-group').removeClass('d-none')
                $('#my-users-form').find('#contact-group').addClass('d-none')
                break;
            default:
                $('#modal-my-users').find('#myModalLabel').text('회원 정보 변경')
                $('#my-users-form').find('#contact-group').removeClass('d-none')
                $('#my-users-form').find('#password-group').addClass('d-none')
                break;
        }
        $('#modal-my-users').modal('show')
    }
</script>
@endpush
