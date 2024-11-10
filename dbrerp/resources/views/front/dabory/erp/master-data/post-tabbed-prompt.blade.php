@php
    $createdPromptFormA = new App\Models\Parameter\FormB(request('bpa'), '/form/form-b/master/post-tabbed-prompt');
    $createdPromptFormA = $createdPromptFormA->getData()['formB'];
@endphp

<div class="tab-pane fade show active" id="prompt-tab">
    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
    <div class="card-header">
		<div class="stit">
			<h3>SEO</h3>
		</div>

        <div class="col-12 card-header-item">
            <div class="card card card-primary mb-3 mb-md-2 mb-lg-0 border-light">
                <div class="card-body py-2">
                    <div class="p-5 flex-column text-center position-absolute top-250 left-50 justify-content-center align-items-center"
                        id="spinner-processing-feed"
                        style="z-index: 9999; display: none;">
                        <div class="spinner-border text-success" role="status">
                            <span class="sr-only">Processing...</span>
                        </div>
                        <div class="small pt-2 text-success">Processing…</div>
                    </div>

                    <!-- meta row -->
                    <div class="row">
                        <div class="col-md-6 col-12 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">
                                    <div class="form-group mb-3" {{ $createdPromptFormA['FormVars']['Hidden']['TestFeed'] }}>
                                        <textarea style="height: 400px" class="rounded w-100 bg-white test-feed" id="test-feed-txt-area" {{ $createdPromptFormA['FormVars']['Required']['TestFeed'] }} readonly></textarea>
                                    </div>
                                    <div class="form-group mb-3" {{ $createdPromptFormA['FormVars']['Hidden']['PromptFeed'] }}>
                                        <textarea style="height: 400px" class="rounded w-100 bg-white prompt-feed" id="meta-prompt-feed-txt-area" {{ $createdPromptFormA['FormVars']['Required']['PromptFeed'] }} readonly></textarea>
                                    </div>

                                    <!-- meta search -->
                                    <div class="form-group d-flex justify-content-end align-items-center">
                                    <button type="button" id="item-related-modal-btn"
                                            class="btn btn-success btn-open-modal"
                                            data-target="setting_prompt"
                                            data-modalId="meta"
                                            data-clicked="PostTabbedPromptForm.fetch_meta_prompt">
                                            <i class="icon-folder-open"></i>
                                        </button>
                                        <div class="btn-group ml-1">
                                            <button type="button" class="btn btn-sm btn-primary prompt-act save-button" data-value="meta" {{ $createdPromptFormA['FormVars']['Hidden']['CreateSchema'] }}>
                                                {{ $createdPromptFormA['FormVars']['Title']['CreateMeta'] }}
                                            </button>
                                            @include('front.dabory.erp.partial.select-btn-options', [
                                                'selectBtns' => [
                                                    [ 'Value' => 'del', 'Caption' => '내용삭제' ],
                                                ],
                                                'eventClassName' => 'prompt-act'
                                            ])
                                        </div>
                                    </div>

                                    <label>{{ $createdPromptFormA['FormVars']['Title']['TestResult'] }}</label>
                                    <div class="form-group mb-3" {{ $createdPromptFormA['FormVars']['Hidden']['TestResult'] }}>
                                        <textarea style="height: 400px" class="rounded w-100 bg-white" id="meta-test-result-txt-area" {{ $createdPromptFormA['FormVars']['Required']['TestResult'] }} readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 col-lg card-header-item">
                            <div class="card card card-info mb-3 mb-md-2 mb-lg-0 border-light">
                                <div class="card-body">
                                    <div class="form-group mb-3" {{ $createdPromptFormA['FormVars']['Hidden']['PromptFeed'] }}>
                                        <textarea style="height: 400px" class="rounded w-100 bg-white prompt-feed" id="schema-prompt-feed-txt-area" {{ $createdPromptFormA['FormVars']['Required']['PromptFeed'] }} readonly></textarea>
                                    </div>

                                    <!-- schema search -->
                                    <div class="form-group d-flex justify-content-end align-items-center">
                                        <button type="button" id="item-related-modal-btn"
                                                class="btn btn-success btn-open-modal"
                                                data-target="setting_prompt"
                                                data-modalId="schema"
                                                data-clicked="PostTabbedPromptForm.fetch_schema_prompt">
                                                <i class="icon-folder-open"></i>
                                        </button>
                                        <div class="btn-group ml-1">
                                            <button type="button" class="btn btn-sm btn-primary prompt-act save-button" data-value="schema" {{ $createdPromptFormA['FormVars']['Hidden']['CreateSchema'] }}>
                                                {{ $createdPromptFormA['FormVars']['Title']['CreateSchema'] }}
                                            </button>
                                            @include('front.dabory.erp.partial.select-btn-options', [
                                                'selectBtns' => [
                                                    [ 'Value' => 'del', 'Caption' => '내용삭제' ],
                                                ],
                                                'eventClassName' => 'prompt-act'
                                            ])
                                        </div>
                                    </div>
                                    <label>{{ $createdPromptFormA['FormVars']['Title']['TestResult'] }}</label>
                                    <div class="form-group mb-3" {{ $createdPromptFormA['FormVars']['Hidden']['TestResult'] }}>
                                        <textarea style="height: 400px" class="rounded w-100 bg-white" id="schema-test-result-txt-area" {{ $createdPromptFormA['FormVars']['Required']['TestResult'] }} readonly></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- meta row -->
                </div>
            </div>
        </div>
    </div>
</div>

@section('modal')
    @include('front.outline.static.setting-prompt')
@endsection
@once
@push('js')
    <script>
        let currentModalId = '';
        $(document).ready(async function() {
            $('.prompt-act').on('click', function () {
                switch( $(this).data('value') ) {
                    case 'meta': PostTabbedPromptForm.sendPrompt(1); break;
                    case 'schema': PostTabbedPromptForm.sendPrompt(2); break;
                    case 'del': PostTabbedPromptForm.delContents(); break;
                }
            });
        });

        (function( PostTabbedPromptForm, $, undefined ) {
            PostTabbedPromptForm.set_ui = async function (response, type) {
                if (isEmpty(response.data) || response.data.apiStatus) {
                    $('#modal-setting_prompt').modal('hide');
                    return;
                }

                let fetchedPrompt = response.data.Page[0] ?? [];
                prompt = response.data.Page ?? []
                // console.log('prompt : ', prompt);
                const target = type === 1 ? '#meta-prompt-feed-txt-area' : '#schema-prompt-feed-txt-area';
                $('#standard-form').find(target).val(fetchedPrompt.PromptFeed);
                $('#modal-setting_prompt').modal('hide');
            }

            PostTabbedPromptForm.sendPrompt = function (type) {
                $('#spinner-processing-feed').show();
                const testFeedValue = $('.test-feed').val();
                const promptFeedValue = type === 1 ? $('#meta-prompt-feed-txt-area').val() : $('#schema-prompt-feed-txt-area').val();
                const question = testFeedValue + '\n' + promptFeedValue;

                // console.log('question : ', question);

                if (!testFeedValue || !promptFeedValue) {
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
                        const resultTxt = type === 1 ? '#meta-test-result-txt-area' : '#schema-test-result-txt-area';
                        $(resultTxt).val(text);
                        iziToast.success({ title: 'Success', message: 'Success' })
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

            PostTabbedPromptForm.call_prompt_pick = async function(page) {
                return await get_api_data(PostTabbedPromptForm.formB['General']['PickApi'], {
                    Page: page
                })
            }

            PostTabbedPromptForm.fetch_meta_prompt = async function (id) {
                const response = await PostTabbedPromptForm.call_prompt_pick([ { Id: id } ])
                if(response.status == 200){
                    iziToast.success({ title: 'Success', message: '메타생성 버튼을 눌러주세요' });
                }
                PostTabbedPromptForm.set_ui(response, 1)
            }
            PostTabbedPromptForm.fetch_schema_prompt = async function (id) {
                const response = await PostTabbedPromptForm.call_prompt_pick([ { Id: id } ])
                // console.log(response);
                if(response.status == 200){
                    iziToast.success({ title: 'Success', message: '스키마생성 버튼을 눌러주세요' });
                }
                PostTabbedPromptForm.set_ui(response, 2)
            }

            PostTabbedPromptForm.delContents = function(){
                const contents = $('#prompt-tab').find('textarea, input');
                contents.each(function(){
                    $(this).val('');
                });
            }

            function escapeHtml(text) {
                return text
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }


        }( window.PostTabbedPromptForm = window.PostTabbedPromptForm || {}, jQuery ));

        PostTabbedPromptForm.formB = {!! json_encode($createdPromptFormA) !!};
        var prompt = [];
    </script>
@endpush
@endonce
