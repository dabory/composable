@extends($masterName)
@section('title', $formA['General']['Title'])
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
            <div class="mb-1 pt-2 text-right btn-groups item_tabbed">
    {{--       <button type="button"                               --}}
    {{--            class="btn btn-success btn-open-modal"         --}}
    {{--            data-target="setting_prompt"                   --}}
    {{--            data-clicked="PromptTabbedForm.fetch_prompt">  --}}
    {{--        <i class="icon-folder-open"></i>                   --}}
    {{--      </button>                                            --}}

    <button type="button" class="btn btn-sm btn-primary save-spinner-btn" id="item-save-spinner-btn">
        <span class="save-spinner spinner-border spinner-border-sm text-center" role="status" aria-hidden="true"></span>
        Loading...
    </button>
    <div class="btn-group" id="item-btn-group" hidden>
        <button type="button" class="btn btn-sm btn-primary prompt-act" data-value="save" {{ $formA['FormVars']['Hidden']['SaveButton'] }}>{{ $formA['FormVars']['Title']['SaveButton'] }}</button>
            @include('front.dabory.erp.partial.select-btn-options', [
                    'selectBtns' => $formA['SelectButtonOptions'],
                'eventClassName' => 'prompt-act',
            ])
    </div>
</div>

<div class="card p-2 item_tabbed" id="prompt-form">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
    <div class="tabs_wrap">
        <ul class="nav nav-tabs nav-tabs-solid rounded justify-content-between my-2">
            <li class="nav-item {{ $formA['FormVars']['Display']['TAB1'] }}"><a href="#anch-tab1" id="basic-tab" class="nav-link active"> {{ $formA['FormVars']['Title']['TAB1'] }} </a></li>
            <li class="nav-item {{ $formA['FormVars']['Display']['TAB2'] }} d-flex"><a href="#anch-tab2" class="nav-link"> {{ $formA['FormVars']['Title']['TAB2'] }} </a></li>
            <li class="nav-item d-flex {{ $formA['FormVars']['Display']['TAB3'] }}"><a href="#anch-tab3" class="nav-link"> {{ $formA['FormVars']['Title']['TAB3'] }} </a></li>
            <li class="nav-item"><a href="#anch-badge" class="nav-link" ></a></li>
            <li class="nav-item"><a href="#anch-related" class="nav-link"></a></li>
            <li class="nav-item"><a href="#anch-revindex" class="nav-link"></a></li>
            <li class="nav-item d-flex"><a href="#anch-delivery" class="nav-link"></a></li>
            <li class="nav-item d-flex"><a href="#anch-erp" class="nav-link"></a></li>
        </ul>
    </div>

    <div class="tab-content" id="frm">
        <input type="hidden" id="Id" name="Id" value="0">
        <div id="anch-tab1" class="anch"></div>
        <div class="tab-pane fade show active" id="tab1">
            <div class="card-header">
                <div class="stit">
                    <h3>기본</h3>
                </div>
                <div class="row">
                    <div class="col-12 card-header-item">
                        <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                            <div class="card-header p-0 mb-2">
                            </div>
                            <div class="card-body">
                                <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['PromptNo'] }}>
                                    <label>{{ $formA['FormVars']['Title']['PromptNo'] }}</label>
                                    <br>
                                    <input type="text" id="prompt-no-txt" data-copy="true"
                                        maxlength="{{ $formA['FormVars']['MaxLength']['PromptNo'] }}"
                                        {{ $formA['FormVars']['Required']['PromptNo'] }}
                                        placeholder="숫자를 입력해주세요.">
                                </div>
                                <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['ModelVer'] }}>
                                    <label>{{ $formA['FormVars']['Title']['ModelVer'] }}</label>
                                    <br>
                                    <input type="text" id="model-ver-txt"
                                        maxlength="{{ $formA['FormVars']['MaxLength']['ModelVer'] }}"
                                        {{ $formA['FormVars']['Required']['ModelVer'] }}>
                                </div>
                                <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['FuncTitle'] }}>
                                    <!-- <label class="m-0 ">{{ $formA['FormVars']['Title']['FuncTitle'] }}</label>
                                    <select class="rounded w-100" id="deal-type-select"
                                            maxlength="{{ $formA['FormVars']['MaxLength']['FuncTitle'] }}"
                                            {{ $formA['FormVars']['Required']['FuncTitle'] }}>
                                            <option value="meta">meta</option>
                                            <option value="schema">schema</option>
                                    </select> -->
                                    <label>{{ $formA['FormVars']['Title']['FuncTitle'] }}</label>
                                    <br>
                                    <input type="text" id="func-title-txt"
                                        maxlength="{{ $formA['FormVars']['MaxLength']['FuncTitle'] }}"
                                        {{ $formA['FormVars']['Required']['FuncTitle'] }}>
                                </div>
                                <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['FuncVer'] }}>
                                    <label>{{ $formA['FormVars']['Title']['FuncVer'] }}</label>
                                    <br>
                                    <input type="text" id="func-ver-txt"
                                        maxlength="{{ $formA['FormVars']['MaxLength']['FuncVer'] }}"
                                        {{ $formA['FormVars']['Required']['FuncVer'] }}>
                                </div>
                            </div>
                            <!-- card-body 종료 -->
                        </div>
                    </div>
                    <!-- card-header-item 종료 -->
                </div>
                <!-- row 종료 -->
            </div>
            <!-- card-header 종료 -->
        </div>
        <!-- tab1 종료 -->

        <!-- 피드입력 시작 -->
        <div id="anch-tab2" class="anch"></div>
        <div class="tab-pane fade show active" id="tab2">
            <div class="card-header">
                <div class="stit">
                    <h3>피드입력*</h3>
                </div>
                <div class="row">
                    <!-- 왼쪽 컬럼 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
                        <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                            <div class="card-body">
                                <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['PromptFeed'] }}>
                                    <label>{{ $formA['FormVars']['Title']['PromptFeed'] }}</label>
                                    <textarea style="height: 500px" class="rounded w-100 bg-white" id="prompt-feed-txt-area" {{ $formA['FormVars']['Required']['PromptFeed'] }}></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--//왼쪽 컬럼 끝 -->

                    <!-- 테스트용 자료 시작 -->
					<div class="col-md-6 col-12 col-lg card-header-item">
                        <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                            <div class="card-body">

                                <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['TestFeed'] }}>
                                    <label>{{ $formA['FormVars']['Title']['TestFeed'] }}</label>
                                    <textarea style="height: 500px" class="rounded w-100 bg-white" id="test-feed-txt-area" {{ $formA['FormVars']['Required']['TestFeed'] }}></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// 테스트용 자료 끝 -->
                </div>
                <!-- row 종료 -->
            </div>
        </div>
        <!-- 피드입력 종료 -->

        <div class="p-5 flex-column text-center position-absolute top-250 left-50 justify-content-center align-items-center"
                 id="spinner-processing-feed"
                 style="z-index: 9999; display: none;">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Processing...</span>
                </div>
                <div class="small pt-2 text-success">Processing…</div>
            </div>

        <!-- 테스트용 결과 시작 -->
        <div id="anch-tab3" class="anch"></div>
        <div class="tab-pane fade show active" id="tab3">
            <div class="card-header">
                <div class="stit">
                    <h3>테스트용 결과*</h3>
                </div>

                <div class="row">
                    <div class="col-12 card-header-item">
                        <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                            <div class="card-body">
                                <!-- <div class="pt-0 mt-1 text-right btn-groups">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary standard-act save-button" data-value="test" {{ $formA['FormVars']['Hidden']['TestButton'] }}>
                                            {{ $formA['FormVars']['Title']['TestButton'] }}
                                        </button>
                                    </div>
                                </div> -->
                                <div class="form-group d-flex justify-content-end align-items-center">
                                    <div class="btn-group ml-1 mb-3">
                                        <button type="button" class="btn btn-sm btn-primary prompt-act test-button" data-value="test" {{ $formA['FormVars']['Hidden']['TestButton'] }}>
                                            {{ $formA['FormVars']['Title']['TestButton'] }}
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group mb-3" {{ $formA['FormVars']['Hidden']['TestResult'] }}>
                                    <textarea style="height: 500px" class="rounded w-100 bg-white" id="test-result-txt-area" {{ $formA['FormVars']['Required']['TestResult'] }}></textarea>
                                </div>
                            </div>
                            <!-- card-body 종료 -->
                        </div>
                    </div>
                    <!-- card-header-item 종료 -->
                </div>
                    <!-- row 끝 -->
            </div>
            <!-- card-header 끝 -->
        </div>
        <!--// tab3 결과 끝 -->
    </div>
    <!-- tab-content 종료 -->
</div>
<!-- prompt_tabbed 종료 -->
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @include('front.outline.static.setting-prompt')
    @include('front.outline.static.memo')
@endsection

@section('js')
<script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
<script>
    $(document).ready(async function() {
        $('.prompt-act').on('click', function () {
            switch( $(this).data('value') ) {
                case 'save': Atype.btn_act_save('#prompt-form #frm', undefined, 'PromptTabbedForm'); break;
                case 'test': PromptTabbedForm.sendPrompt(); break;
            }
        });
        await PromptTabbedForm.include_blades()
        activate_button_group({save_spinner_btn: '#item-save-spinner-btn', btn_group: '#item-btn-group'})
        Atype.set_parameter_callback(PromptTabbedForm.parameter);
    });

    (function( PromptTabbedForm, $, undefined ) {
        PromptTabbedForm.formA = {!! json_encode($formA) !!};
        PromptTabbedForm.parameter = function () {
            let id = Number( $('#prompt-form').find('#Id').val());
            let parameter = {
                Id: id,
                CreatedOn: get_now_time_stamp(),
                UpdatedOn: get_now_time_stamp(),
                UserId: window.User['UserId'],
                ModelVer: $('#prompt-form').find('#model-ver-txt').val(),
                PromptNo: $('#prompt-form').find('#prompt-no-txt').val(),
                FuncTitle: $('#prompt-form').find('#func-title-txt').val(),
                FuncVer: $('#prompt-form').find('#func-ver-txt').val(),
                PromptFeed: $('#prompt-form').find('#prompt-feed-txt-area').val(),
                TestFeed: $('#prompt-form').find('#test-feed-txt-area').val(),
                TestResult: $('#prompt-form').find('#test-result-txt-area').val(),
                Status : '1'
            }
            if (id < 0) {
                parameter = { Id: id }
            } else if (id > 0) {
                delete parameter.CreatedOn;
            } else {
                delete parameter.UpdatedOn;
            }
            // console.log('parameter : ', parameter)
            return parameter;
        }

        PromptTabbedForm.fetch_prompt = async function (id) {
            let response = await get_api_data(PromptTabbedForm.formA['General']['PickApi'], {
                Page: [ { Id: id } ]
            })
            console.log(response);
            PromptTabbedForm.set_prompt_ui(response)
        }

        PromptTabbedForm.set_prompt_ui = function (response) {
            if (isEmpty(response.data) || response.data.apiStatus) {
                $('#modal-setting_prompt').modal('hide');
                return;
            }
            let prompt = response.data.Page[0];
            // console.log('set_prompt_ui : ', prompt);
            $('#prompt-form').find('#Id').val(prompt.Id)
            $('#prompt-form').find('#prompt-no-txt').val(prompt.PromptNo)
            $('#prompt-form').find('#model-ver-txt').val(prompt.ModelVer)
            $('#prompt-form').find('#func-title-txt').val(prompt.FuncTitle)
            $('#prompt-form').find('#func-ver-txt').val(prompt.FuncVer)
            $('#prompt-form').find('#prompt-feed-txt-area').val(prompt.PromptFeed)
            $('#prompt-form').find('#test-feed-txt-area').val(prompt.TestFeed)
            $('#prompt-form').find('#test-result-txt-area').val(prompt.TestResult)
            $('#modal-setting_prompt').modal('hide');
        }

        PromptTabbedForm.sendPrompt = function () {
            $('#spinner-processing-feed').show();
            const testFeed = $('#test-feed-txt-area').val();
            const promptFeed = $('#prompt-feed-txt-area').val();
            const question = testFeed + '\n' + promptFeed;
            if (!testFeed || !promptFeed) {
                // iziToast.warning({ title: 'Warning', message: $('#action-failed').text() })
                iziToast.error({
                    title: 'Error',
                    message: @json(_e('프롬프트 피드와 테스트 피드를 입력해주세요')),
                });
                $('#spinner-processing-feed').hide();
                return;
            }
            // console.log(question);
            $.ajax({
                url: '/ajax/openai-completion',
                method: 'POST',
                beforeSend: function() {
                    const apiKey = '{{ env('OPENAI_API_KEY') }}';
                    if (!apiKey) {
                        iziToast.error({
                            title: 'Error',
                            message: 'API key is missing. Please provide a valid API key.',
                        });
                        $('#spinner-processing-feed').hide();
                        return false;
                    }
                },
                data: JSON.stringify({
                    message: question,
                    _token: '{{ csrf_token() }}'
                }),
                contentType: 'application/json',
                success: function(response) {
                    const text = response.text || "";
                    $('#test-result-txt-area').val(text);
                },
                error: function(xhr, status, error) {
                    iziToast.error({
                        title: 'Error',
                        message: @json(_e('An error has occurred.')),
                    });
                    console.error('AJAX Error:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        errorThrown: error,
                        responseText: xhr.responseText
                    });
                },
                complete: function() {
                    $('#spinner-processing-feed').hide();
                }
            });
        }

        PromptTabbedForm.include_blades = async function() {
            get_blades_html('front.outline.static.setting', PromptTabbedForm.etcBrandModal, function (html) {
                if ($('#element_in_which_to_insert').find('#modal-setting.etc-brand').length) return;
                $('#element_in_which_to_insert').append(html);
            }, 'moealSetFile', { modalClassName: 'etc-brand' });

            const promptId = getParameterByName('id')
            if (promptId) {
                return PromptTabbedForm.fetch_prompt(Number(promptId))
            }

            const isItemRegist = '{{ $isItemRegist ?? 0 }}'
            if (isItemRegist == '1') {
                PromptTabbedForm.btn_act_new()
            }
        }

        PromptTabbedForm.call_prompt_pick = async function(page) {
            return await get_api_data(PromptTabbedForm.formA['General']['PickApi'], {
                ImageType: 'thumb',
                Page: page
            })
        }

        //탭 선택시 바탕색 변화
		$(".item_tabbed .nav-link").click(function(){
			$(".item_tabbed .nav-link").removeClass("active");
           $(this).addClass("active")
        })

    }( window.PromptTabbedForm = window.PromptTabbedForm || {}, jQuery ));


</script>
@endsection


