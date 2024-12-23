@push('css')
    <link href="{{ csset('/css/cal-type1.css') }}" rel="stylesheet" type="text/css">
@endpush

<div class="{{ $calType1['FormVars']['Display']['SelectPopup'] }} flex-column mb-2">
    <label class="m-0">{{ $calType1['FormVars']['Title']['SelectPopup'] }}</label>
    <select class="rounded w-100" id="select-popup-select">
        @foreach ($calType1['SelectPopupOptions'] as $popupOption)
            <option value="{{ $popupOption['Caption'] }}" data-component="{{ $popupOption['ModalClassName'] }}"
                    data-type="{{ $popupOption['ParameterType'] }}" data-unique="{{ $popupOption['Unique'] }}">
                {{ $popupOption['Caption'] }}
            </option>
        @endforeach
    </select>
</div>

<div class="row">
    <div class="col-xl-8">
        <div id='calendar'></div>
    </div>

    <div class="col-xl-4">
        <div class="callendar_cont card border-light" style="overflow-y: scroll; height: 735px;">
            <div class="d-flex align-items-center date justify-content-between">
                <div class="current-date"></div>
                <button class="btn btn-sm btn-primary cal-type1-bd-act" data-value="add">
                    {{ $calType1['FormVars']['Title']['AddNewBdButton'] ?? '일정 등록' }}
                </button>
            </div>
            <ul>
                <li v-for="(todo, index) in todoDetails" class="todo-Details position-relative">
                    <div>
                        <div class="d-flex align-items-center">
                            <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event pr-1"
                                 @click="showSelectPopup(todo['Id'], todo['C1'])"
                                 :class="statusBgColor(todo['C6'])">
                                <div class="fc-daygrid-event-dot"
                                     :style="{borderColor: convertColor(todo['C5'])}">

                                </div>
                                <div class="fc-event-title">@{{ todo['C2'] }} (@{{ convertSort(todo['C5']) }}) (@{{ convertStatus(todo['C6']) }})</div>
                            </div>
                        </div>
                        <strong class="mb-1">@{{ todo['C3'] }}</strong>
                        <div style="line-height: 1.3715">
                            @{{ todo['C4'] }}
                        </div>
                    </div>
                    <button type="button"
                            @click="showSelectPopup(todo['Id'], todo['C1'])"
                            class="position-absolute top-0 right-0 text-danger color-danger bg-white">
                        <i class="fas fa-edit fa-2x"></i>
                    </button>

                </li>
            </ul>
        </div>
    </div>
</div>

<div class="color-desc d-flex justify-content-between col-8">
    <div class="d-flex">
        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2">
            <div class="fc-daygrid-event-dot"></div>
            <div class="fc-event-title">업무마감</div>
        </div>

        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2">
            <div class="fc-daygrid-event-dot" style="border-color: green;"></div>
            <div class="fc-event-title">내부회의</div>
        </div>

        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2">
            <div class="fc-daygrid-event-dot" style="border-color: orange;"></div>
            <div class="fc-event-title">방문미팅</div>
        </div>

        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2">
            <div class="fc-daygrid-event-dot" style="border-color: purple;"></div>
            <div class="fc-event-title">외부미팅</div>
        </div>

        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2">
            <div class="fc-daygrid-event-dot" style="border-color: red;"></div>
            <div class="fc-event-title">중요회의</div>
        </div>
    </div>

    <div class="d-flex status-color">
        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2 bg-wh">
            <div class="fc-event-title">계획</div>
        </div>

        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2 bg-lightgray">
            <div class="fc-event-title">완료</div>
        </div>

        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2 bg-darkgray">
            <div class="fc-event-title">미결</div>
        </div>

        <div tabindex="0" class="fc-daygrid-event fc-daygrid-dot-event mr-2 bg-blackgray">
            <div class="fc-event-title">취소</div>
        </div>
    </div>
</div>

@foreach ($calType1['SelectPopupOptions'] as $popupOption)
    {{--    @php dd($calType1['SelectPopupOptions']); @endphp;--}}
    @if (! empty($popupOption['Caption']))
        @push('modal')
            @include('front.outline.static.select-popup', [
                'popupOption' => $popupOption,
                'attachClassName' => $calType1['General']['PageApi']
            ])
        @endpush
    @endif
@endforeach

@push('js')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/locales-all.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.0/locale/ko.js'></script>
    <script>
        var vm = new Vue({
            el: '.callendar_cont',

            data: function () {
                return {
                    todoDetails: [],
                    deleteId: 0,
                    deleteDate: new Date(),
                    addDate: new Date(),
                };
            },
            methods: {
                showSelectPopup: function (id, date) {
                    this.deleteId = id
                    this.deleteDate = date
                    show_select_popup(id, '')
                },
            },

        });

        $(document).ready(function() {
            $('.callendar_cont').find('.current-date').text(moment().format('YYYY년 MM월 DD일 (dd)'))
            showDetails(new Date())

            $('.cal-type1-bd-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'add': type1_new(); break;
                }
            });

            $(document).on('add.todo', '#modal-select-popup', function (event, todo) {
                const is_update_event = calendar.getEventById(todo['Id'])
                if (is_update_event) {
                    is_update_event.remove()
                }
                const date = moment(todo['TodoDate']).format('YYYY-MM-DD')
                calendar.addEvent({
                    id: todo['Id'],
                    title: todo['TodoTitle'],
                    start: date + 'T' + todo['TodoTime'],
                    color: convertColor(todo['Sort']),
                    className: statusBgColor(todo['Status'])
                })
                calendar.unselect()

                calendar.gotoDate( date );
                showDetails(new Date(date))
            });

            $(document).on('delete.todo', '#modal-select-popup', function (event) {
                calendar.getEventById(vm.deleteId).remove()

                const todoDate = vm.deleteDate
                const date = moment(todoDate).format('YYYY-MM-DD')
                calendar.gotoDate( date );
                showDetails(new Date(date))
            });
        });

        document.addEventListener('DOMContentLoaded', async function() {
            const response = await getPage()
            console.log(response)
            const todo = convertPage(response.data.Page ?? [])

            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                height: '735px',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                navLinks: true, // 날짜를 선택하면 Day 캘린더나 Week 캘린더로 링크
                editable: false, // 수정 가능?
                // selectable: true, // 달력 일자 드래그 설정가능
                nowIndicator: true, // 현재 시간 마크
                dayMaxEvents: true, // 이벤트가 오버되면 높이 제한 (+ 몇 개식으로 표현)
                locale: 'ko', // 한국어 설정
                navLinkDayClick: function(date, jsEvent) {
                    vm.addDate = date
                    calendar.gotoDate( date );
                    showDetails(date)
                },
                eventClick: function(info) {
                    vm.showSelectPopup(info.event.id, moment(info.event.start).format('YYYYMMDD'))
                },
                eventAdd: function(obj) { // 이벤트가 추가되면 발생하는 이벤트
                    console.log(obj);
                },
                eventChange: function(obj) { // 이벤트가 수정되면 발생하는 이벤트
                    console.log(obj);
                },
                eventRemove: function(obj){ // 이벤트가 삭제되면 발생하는 이벤트
                    console.log(obj);
                },
                select: function(arg) { // 캘린더에서 드래그로 이벤트를 생성할 수 있다.
                    console.log(arg)
                },
                mouseEnterInfo: function (obj) {
                    console.log(obj)
                },
                // 이벤트
                events: todo
            });
            calendar.render();
        });

        async function showDetails(date) {
            const filter_data = moment(date).format('YYYYMMDD')
            const response = await getPage(filter_data)
            console.log(response)
            vm.todoDetails = response.data.Page
            $('.callendar_cont').find('.current-date').text(moment(date).format('YYYY년 MM월 DD일 (dd)'))
        }

        function convertStatus(status) {
            return format_conver_for(status, calType1.ListVars['Format']['C1']);
        }

        function convertSort(sort) {
            return format_conver_for(sort, calType1.ListVars['Format']['C2']);
        }

        function convertPage(page) {
            return page.map(todo => {
                return {
                    id: todo['Id'],
                    title: todo['C3'],
                    start: moment(todo['C1']).format('YYYY-MM-DD') + 'T' + todo['C2'],
                    color: convertColor(todo['C5']),
                    className: statusBgColor(todo['C6'])
                }
            })
        }

        function statusBgColor(status) {
            switch (status) {
                case '0':
                    return 'bg-wh'
                case '1':
                    return 'bg-lightgray'
                case '2':
                    return 'bg-darkgray'
                case '3':
                    return 'bg-blackgray'
            }
        }

        function convertColor(status) {
            let color = ''
            switch (status) {
                case '1':
                    color = 'green'
                    break;
                case '2':
                    color = 'orange'
                    break;
                case '3':
                    color = 'purple'
                    break;
                case '4':
                    color = 'red'
                    break;
            }
            return color
        }

        async function getPage(date = '') {
            return await get_api_data(calType1['General']['PageApi'], {
                QueryVars: {
                    QueryName: calType1['QueryVars']['QueryName'],
                    FilterName: calType1['QueryVars']['FilterName'],
                    FilterValue: calType1['QueryVars']['FilterValue'],
                    SimpleFilter: calType1['QueryVars']['SimpleFilter'],
                    SubSimpleFilter: calType1['QueryVars']['SubSimpleFilter'],
                    IsntPagination: false,
                    // TestMode: "query"
                },
                ListType1Vars: {
                    FilterDate: calType1['QueryVars']['FilterDate'],
                    StartDate: date,
                    EndDate: date,
                    ListFilterName: $('.cal-type1').find('#filter-name-select').val(),
                    ListFilterValue: $('.cal-type1').find('#filter-value-txt').data('value'),
                },
                PageVars: {
                    Limit: 10000000000,
                    Offset: 0,
                }
            })
        }

        function type1_new() {
            const modal_class_name = $('#select-popup-select option:selected').data('component');
            eval(capitalize(camelCase(modal_class_name))).btn_act_new_callback(vm.addDate)
            $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
            $(`#modal-select-popup.${modal_class_name}`).modal('show')
        }

        async function show_select_popup(id, c1) {
            if (c1.toLowerCase() == 'total') return;

            let modal_class_name = $('#select-popup-select option:selected').data('component');
            let parameter_type = $('#select-popup-select option:selected').data('type');
            let unique = $('#select-popup-select option:selected').data('unique');
            if (isEmpty(modal_class_name)) return;

            // console.log(modal_class_name)
            // console.log(unique)
            // console.log(capitalize(camelCase(modal_class_name)))
            await eval(capitalize(camelCase(modal_class_name))).show_popup_callback(id, c1, {
                    start_date: $('#type1-start-date').val(),
                    end_date: $('#type1-end-date').val(),
                    range_val: $('input:radio[name=type1-date-range]:checked').val()
                }
            )

            // hide => 업데이트 유무
            // if (parameter_type != 'list1') {
            //     $(`#modal-select-popup.${modal_class_name}`).addClass('list-update')
            // } else {
            //     $(`#modal-select-popup.${modal_class_name}`).removeClass('list-update')
            // }

            $(`#modal-select-popup.${modal_class_name}`).modal('show')
        }
        var calendar
        const calType1 = {!! json_encode($calType1) !!};
    </script>
@endpush
