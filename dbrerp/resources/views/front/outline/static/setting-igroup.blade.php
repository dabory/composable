@inject('callApiService', 'App\Services\CallApiService')
@php
    $modalClassName = $modalClassName ?? '';
    $response =  $callApiService->callApi([
        'url' => 'list-type1-page',
        'data' => [
            'QueryVars' => [
                'QueryName' => 'seo-meta/igroup-input',
                'SimpleFilter' => "",
                'IsntPagination' => true,
            ],
            'PageVars' => [
                'Limit' => 100000
            ]
        ],
    ]);

    $mainMenuList = App\Helpers\Utils::formatIgroupMenuList($response['Page'] ?? [], 'C1');
@endphp

<div class="modal fade modal-cyan {{ $modalClassName }}" id="modal-setting_igroup" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1100px !important;">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row align-items-end">
                    <div class="col-4" >
                        <div class="d-flex flex-column">
                            <label class="m-0">검색조건</label>
                            <div class="row">
                                <div class="col-5 pr-1">
                                    <select class="rounded w-100" id="filter-name-select">
                                        @foreach ($moealSetFile['FilterSelectOptions'] ?? [] as $key => $popupOption)
                                            <option value="{{ $popupOption['Value'] }}" data-reverse="{{ $popupOption['Reverse'] ?? '' }}">
                                                {{ $popupOption['Caption'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input class="rounded w-100" type="text" id="filter-value-txt" onkeydown="override_enter_pressed_setting_modal_auto_search(event)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7" >
                        <div class="d-flex flex-column">
                            <label class="m-0">상태별 검색</label>
                            <input class="rounded w-100" type="text" id="simple-filter-txt" hidden>
                            <select class="rounded w-100" id="simple-filter-select" onchange="$('#modal-setting_igroup.show').find('.modal-search').trigger('click')">
                                @foreach ($moealSetFile['SimpleSelectOptions'] ?? [] as $key => $popupOption)
                                    <option value="{{ $popupOption['Value'] }}">
                                        {{ DataConverter::execute(null, $popupOption['Caption']) ?? $popupOption['Caption'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="setting_igroup" data-class="{{ $modalClassName }}"></button>
                    </div>

                    <div class="d-flex w-100 mt-2" id="igroup-card">
                        <div class="card col mb-0 mr-1 igroup-card-div">
                            <div class="card-header pl-0 pb-1">
                                <label class="m-0">1차 카테고리</label>
                            </div>
                            <div class="card-body px-0">
                                <div class="align-items-center d-flex" v-for="igroup in firstCategories">
                                    <input type="radio" name="first_categories" :value="igroup['C1']" class="text-center mr-1" :id="igroup['C1']">
                                    <label class="mb-0" :for="igroup['C1']">
                                        @{{ igroup['C2'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card col mb-0 mr-1 igroup-card-div">
                            <div class="card-header pl-0">
                                <label class="m-0">2차 카테고리</label>
                            </div>
                            <div class="card-body px-0">
                                <div class="align-items-center d-flex" v-for="igroup in secondCategories">
                                    <input type="radio" name="second_categories" :value="igroup['C1']" class="text-center mr-1" :id="igroup['C1']">
                                    <label class="mb-0" :for="igroup['C1']">
                                        @{{ igroup['C2'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card col mb-0 mr-1 igroup-card-div">
                            <div class="card-header pl-0">
                                <label class="m-0">3차 카테고리</label>
                            </div>
                            <div class="card-body px-0">
                                <div class="align-items-center d-flex" v-for="igroup in thirdCategories">
                                    <input type="radio" name="third_categories" :value="igroup['C1']" class="text-center mr-1" :id="igroup['C1']">
                                    <label class="mb-0" :for="igroup['C1']">
                                        @{{ igroup['C2'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card col mb-0 igroup-card-div">
                            <div class="card-header pl-0">
                                <label class="m-0">4차 카테고리</label>
                            </div>
                            <div class="card-body px-0">
                                <div class="align-items-center d-flex" v-for="igroup in fourthCategories">
                                    <input type="radio" name="fourth_categories" :value="igroup['C1']" class="text-center mr-1" :id="igroup['C1']">
                                    <label class="mb-0" :for="igroup['C1']">
                                        @{{ igroup['C2'] }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 my-2 table-responsive" style="height: 400px;">
                        <table class="table-row">
                            <thead id="table-head">
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6" >
                        <select class="modal-line-select" data-target="setting_igroup" data-class="{{ $modalClassName }}">
                            @include('front.outline.moption')
                        </select>
                    </div>
                    <div class="col-6" >
                        <ul class="pagination pagination-sm" style="float: right;"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script src="/js/modals-controller/a-type/setting.js?{{date('YmdHis')}}"></script>
<script src="/js/modals-controller/a-type/setting-igroup.js?{{date('YmdHis')}}"></script>

<script>
    var modalSetting = new Vue({
        el: '#modal-setting_igroup',

        data: function () {
            return {
                mainMenuList: @json($mainMenuList),
                firstCategories: [],
                secondCategories: [],
                thirdCategories: [],
                fourthCategories: [],
            };
        },

        computed: {
        },

        mounted() {
            this.firstCategories = this.mainMenuList;
            const self = this
            $(document).on('click', '#modal-setting_igroup #igroup-card input', function() {
                if ($(this).prop('checked')) {
                    const code = formatDateString($(this).val()) + '%'
                    $('#modal-setting_igroup.show').find('#simple-filter-txt').val(`mx.igroup_code like '${code}'`)
                    $('#modal-setting_igroup.show').find('.modal-search').trigger('click')

                    let filter = []
                    switch ($(this).attr('name')) {
                        case 'first_categories':
                            filter = self.mainMenuList.filter(igroup => String(igroup['C1']) === $(this).val())[0]
                            self.secondCategories = filter['child']
                            self.thirdCategories = []
                            self.fourthCategories = []
                            $('#modal-setting_igroup').find('input[name=second_categories]').prop('checked', false)
                            break;
                        case 'second_categories':
                            filter = self.secondCategories[$(this).val()]
                            self.thirdCategories = filter['child']
                            self.fourthCategories = []
                            $('#modal-setting_igroup').find('input[name=third_categories]').prop('checked', false)
                            break;
                        case 'third_categories':
                            filter = self.thirdCategories[$(this).val()]
                            self.fourthCategories = filter['child']
                            $('#modal-setting_igroup').find('input[name=fourth_categories]').prop('checked', false)
                            break;
                    }
                }

            });
        },

        created() {
        },
    });
</script>
@endonce
