@extends('layouts.master')
@section('title', $formB['General']['Title'])
@section('content')

<div class="content accounting">
    <button type="button" hidden
        class="btn btn-success btn-open-modal modal-btn">
    </button>

    <div class="row">
        <div class="col-xl-12">
            @if (request('popup'))
                @include('front.dabory.erp.accounting.acc-slip-popup-form', [
                    'formB' => $formB
                ])
            @else
                @include('front.dabory.erp.accounting.acc-slip-form', [
                    'formB' => $formB
                ])
            @endif
        </div>
    </div>
</div>

@endsection

@foreach ($formB['HeadSelectOptions'] as $selectOption)
    @if (! empty($selectOption['Parameter']))
        @push('modal')
            @include($selectOption['BladeRoute'], [
                'moealSetFile' => $selectOption['Parameter'],
                'modalClassName' => $selectOption['ModalClassName']
            ])
        @endpush
    @endif
@endforeach

@section('modal')
    @include('front.outline.static.slip', ['moealSetFile' => $accSlipModal])
@endsection

@section('js')
    <script>
        window.onload = async function () {
            // Btype.set_slip_cache_data();
            //
            // if (! isEmpty(pickCacheData['query'])) {
            //     let query = JSON.parse(pickCacheData['query'])
            //     await Btype.fetch_slip_form_book(query['QueryVars']['FilterValue']);
            // }
        }

        function btn_bd_act_body_copy(parameter_name) {
            if (parseInt($('#frm').find('#Id').val()) == 0) {
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('Can NOT copy in the status')),
                });
                return;
            }

            $(`#modal-bodycopy.${parameter_name}`).find('.slip_no-txt').val($('#acc-slip-form').find('#auto-slip-no-txt').val())
            $(`#modal-bodycopy.${parameter_name}`).find('.company_name-txt').val($('#acc-slip-form').find('#supplier-txt').val())

            let data = formB['HeadSelectOptions'].filter(selectOption => selectOption['ModalClassName'] == parameter_name)[0];
            // console.log(data['Parameter'])
            $('.accounting').find('.modal-btn').data('target', 'bodycopy')
            $('.accounting').find('.modal-btn').data('variable', data['Parameter'])
            $('.accounting').find('.modal-btn').data('class', parameter_name)
            $('.accounting').find('.modal-btn').trigger('click')
            $(`#modal-bodycopy.${parameter_name}`).find('.body-copy-act').data('slip_no', $('#auto-slip-no-txt').val() )
        }

        function set_save_btn_disabled(value) {
            $('.acc-slip-act').prop('disabled', value)
            $('.dropdown-toggle').prop('disabled', value)
        }

        const accSlipModal = {!! json_encode($accSlipModal) !!};
        const slipCacheData = {!! json_encode($slipCacheData) !!};
        const pickCacheData = {!! json_encode($pickCacheData) !!};
    </script>
@endsection
