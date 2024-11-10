<div class="mb-1 pt-2 text-right btn-groups item_tabbed">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary standard-act save-button" data-value="save" {{ $formA['FormPostVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormPostVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'standard-act',
        ])
    </div>

    <button type="button" id="modal-media-btn" hidden
            class="btn btn-success btn-open-modal">
    </button>
</div>

<div class="card mb-0 pb-0 p-2 item_tabbed" id="standard-form">
	<!-- tab 시작 -->
	<div class="tabs_wrap">
		<ul class="nav nav-tabs nav-tabs-solid rounded justify-content-between my-2">
			<li class="nav-item"><a href="#anch-basic" id="basic-tab" class="nav-link active">기본</a></li>
			<li class="nav-item d-flex"><a href="#anch-seo" class="nav-link">SEO</a></li>
			<li class="nav-item d-flex"><a href="#anch-seo-schema" class="nav-link">SEO2</a></li>
			<li class="nav-item d-flex"><a href="#anch-prod-addon-ipn" class="nav-link">제공 정보</a></li>
			<li class="nav-item"><a href="#anch-badge" class="nav-link" >뱃지</a></li>
			<li class="nav-item "><a href="#anch-related" class="nav-link">연관상품</a></li>
			<li class="nav-item "><a href="#anch-revindex" class="nav-link">리뷰</a></li>
			<li class="nav-item d-flex"><a href="#anch-delivery" class="nav-link">배송</a></li>
			<li class="nav-item d-flex"><a href="#anch-erp" class="nav-link">ERP</a></li>
		</ul>
	</div>
	<!--// 탭 끝 -->

	<div class="tab-content">
		<!-- 기본 시작 -->
		<div id="anch-basic" class="anch"></div>
        <div class="tab-pane fade show active" id="basic">
			<div class="stit">
				<h3>기본</h3>
			</div>
			<div class="row" id="frm">
				<input type="hidden" id="Id" name="Id" value="0">
				<input type="hidden" id="attached-files">
				@php
					$collection = collect($formA['FormPostVars']['Title']);
					$chunk = $collection->splice($formA['DisplayVars']['Chunk'] + 1);
					if ($formA['DisplayVars']['Chunk'] == 999) {
						$cardWidth = [12, 0];
					} else {
						$cardWidth = [8, 4];
					}
				@endphp
				@foreach([$collection->all(), $chunk->all()] as $key => $chunk)
					<div class="{{ 'col-md-'.$cardWidth[$key] }} col-12 card-header-item">
						<div class="card card-primary mb-1 mb-md-0 mb-lg-0 border-light">
							<div class="card-header p-0 mb-2"></div>

							<div class="card-body">
								@if($key === 1)
									<div class="form-group d-flex flex-column">
										<div class="d-flex align-items-center">
											<label class="m-0 mr-1">첨부화일들(이전 업로드 파일 복구 불가)</label>
											<button @click="addItem"><i class="fas fa-plus"></i></button>
										</div>
										<div class="d-flex align-items-center mb-2" v-for="(item, index) in attachedFiles">
											<input type="file" @change="handleFileChange(index)"
												   class="cursor-pointer rounded w-100 form-control-uniform-custom mr-1" style="text-indent: 0;">
											<button @click="removeItem(index)"><i class="fas fa-minus"></i></button>
										</div>
									</div>
								@endif

								@foreach($chunk as $key => $title)
									@empty ($formA['FormPostVars']['Ui'][$key]) @continue @endempty
									<div class="form-group d-flex flex-column mb-2">
										<label class="m-0">{{ $title }}</label>
										@switch($formA['FormPostVars']['Ui'][$key])
											@case('postType')
											<select id="{{ $key }}" class="rounded w-100"
													maxlength="{{ $formA['FormPostVars']['MaxLength'][$key] }}"
												{{ $formA['FormPostVars']['Required'][$key] }}>
											</select>
											@break
											@case('select')
											<select id="{{ $key }}" class="rounded w-100"
													maxlength="{{ $formA['FormPostVars']['MaxLength'][$key] }}"
												{{ $formA['FormPostVars']['Required'][$key] }}>

												@foreach($formA[$formA['FormPostVars']['Format'][$key]] as $option)
													<option value="{{ $option['Value'] }}">{{ DataConverter::execute(null, $option['Caption']) ?? $option['Caption'] }}</option>
												@endforeach
											</select>
											@break
											@case('checkbox')
											<input type="checkbox" id="{{ $key }}" class="rounded" value="1"
												{{ $formA['FormPostVars']['Required'][$key] }}>
											@break
											@case('text')
											<input type="text" id="{{ $key }}" class="rounded w-100" autocomplete="off"
												   maxlength="{{ $formA['FormPostVars']['MaxLength'][$key] }}"
												{{ $formA['FormPostVars']['Required'][$key] }}>
											@break
											@case('date')
											<input type="date" id="{{ $key }}" class="rounded w-100"
												{{ $formA['FormPostVars']['Required'][$key] }}>
											@break
											@case('time')
											<input type="time" id="{{ $key }}" class="rounded w-100"
												{{ $formA['FormPostVars']['Required'][$key] }}>
											@break
											@case('datetime')
											<input type="text" id="{{ $key }}" name="datetime" class="rounded w-100"
												{{ $formA['FormPostVars']['Required'][$key] }}>
											@break
											@case('editor')
											<div id="modal-memo">
												@include('components.web-editor')
											</div>
											@break
											@case('textarea')
											<textarea id="{{ $key }}" maxlength="{{ $formA['FormPostVars']['MaxLength'][$key] }}"
												{{ $formA['FormPostVars']['Required'][$key] }}></textarea>
											@break
											@case('media')
											<div class="d-flex">
												<input type="hidden" id="{{ $key }}">
												<input type="text" id="{{ $key . '-file-path' }}" class="rounded w-100 radius-r0" autocomplete="off"
													   maxlength="{{ $formA['FormPostVars']['MaxLength'][$key] }}"
													{{ $formA['FormPostVars']['Required'][$key] }}>
												<button class="text-white rounded border-0 radius-l0 col-3 bg-green-600 border-green-600" onclick="PostTabbedStandard.show_media_modal()">찾기</button>
											</div>
											<div class="form-post-title">
												<div class="form-post-img-div">
													<img id="{{ $key . '-img' }}" class="mt-2 form-post-img" src="">
												</div>
											</div>
											@break
											@default
										@endswitch
									</div>
								@endforeach
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<!--// 기본 끝 -->

        <!-- seo -->
        <div id="anch-seo" class="anch"></div>
        @include('front.dabory.erp.master-data.post-tabbed-prompt', [ 'ref' => 'PostTabbedStandard', 'formA' => $formA])

		<!-- 추가이미지 시작 -->
		<div id="anch-thm-media" class="anch"></div>
        <div class="tab-pane fade show active" id="basic">
			<div class="stit">
				<h3>추가이미지</h3>
			</div>
			<div class="card col-12 mb-3 mb-md-2 mb-lg-0">
				추가이미지 내용이 들어갑니다.
			</div>
		</div>
		<!--// 추가이미지 끝 -->
	</div>
	<!--//tab-content 끝 -->
</div>

<div class="pt-0 mt-1 text-right btn-groups">
    <div class="btn-group">
        <button type="button" class="btn btn-sm btn-primary standard-act save-button" data-value="save" {{ $formA['FormPostVars']['Hidden']['SaveButton'] }}>
            {{ $formA['FormPostVars']['Title']['SaveButton'] }}
        </button>
        @include('front.dabory.erp.partial.select-btn-options', [
            'selectBtns' => $formA['SelectButtonOptions'],
            'eventClassName' => 'standard-act',
        ])
    </div>
</div>

@once
    @push('js')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="{{ csset('/js/modals-controller/a-type/common.js') }}"></script>
        <script src="{{ csset('/js/components/web-editor.js') }}"></script>
        <script>
            const AttachedFiles = new Vue({
                el: '#standard-form',

                data: function () {
                    return {
                        attachedFiles: [null],
                    };
                },

                computed: {
                },

                mounted () {
                },

                methods: {
                    addItem: function () {
                        this.attachedFiles.push(null)
                    },

                    removeItem: function (index) {
                        return this.attachedFiles.splice(index, 1)
                    },

                    handleFileChange: function (index) {
                        const file = event.target.files[0]; // 파일 선택을 받아옴
                        this.$set(this.attachedFiles, index, file); // 파일을 배열에 추가
                    },

                    save: function () {
                        console.log('attachedFiles : ', this.attachedFiles)
                        if (this.attachedFiles.length <= 0 || this.attachedFiles[0] === null) {
                            const save_parameter = PostTabbedStandard.parameter();
                            const postContent = save_parameter['PostContents'];
                            if(save_parameter){
                                $('#standard-form').find('.test-feed').html(postContent);
                            }
                            return Atype.btn_act_save('#standard-form #frm', function () {
                                $('#modal-select-popup.show').trigger('list.requery');
                                $('#modal-select-popup.show').modal('hide');
                            }, 'PostTabbedStandard');
                        }

                        let form = new FormData();
                        form.append('_token', $('meta[name="csrf-token"]').attr('content'))
                        form.append('fileCount', this.attachedFiles.length)
                        this.attachedFiles.forEach((file, index) => {
                            form.append('file' + index, file)
                        })
                        $.ajax({
                            url: "/post-attached-files",
                            type:'POST',
                            data: form,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                $('#attached-files').val(data)
                                Atype.btn_act_save('#standard-form #frm', function () {
                                    $('#modal-select-popup.show').trigger('list.requery');
                                    $('#modal-select-popup.show').modal('hide');
                                }, 'PostTabbedStandard');
                            },
                        });
                    }
                }
            });

            $(document).ready(async function() {
                let query = ''
                const postCode = PostTabbedStandard.formA['General']['PostCode']
                if (postCode) {
                    query = `post_code='${postCode}'`
                    if (postCode === 'integrated') {
                        query = `sort = '400'`
                    }
                }
                const response = await get_api_data('post-type-page', {
                    PageVars: {
                        Query: query,
                        Limit: 100
                    }
                })
                $('#PostTypeId').html(window.custom_create_options('Id', 'TypeTitle', response.data.Page));

                mediaModal = await include_media_library('media-body', 'post')

                $('input[name="datetime"]').daterangepicker({
                    locale: {
                        applyLabel: "확인",
                        cancelLabel: "취소",
                        daysOfWeek: ["일", "월", "화", "수", "목", "금", "토"],
                        monthNames: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
                        format: "YYYY-MM-DD HH:mm:ss"
                    },
                    drops: 'auto',
                    timePicker24Hour: true,
                    timePicker: true,
                    singleDatePicker: true,
                    showDropdowns: true,
                    applyButtonClasses: "btn-apply"
                });

                $('#dbupdate-form').find('#dbupdate-date').val(date_to_sting(new Date()))

                $('.standard-act').on('click', function () {
                    switch( $(this).data('value') ) {
                        case 'save': AttachedFiles.save(); break;
                        case 'del': PostTabbedStandard.btn_act_del(); break;
                        case 'copy': PostTabbedStandard.btn_act_copy(); break;
                        case 'new': PostTabbedStandard.btn_act_new(); break;
                    }
                });
                // await PostTabbedStandard.include_blades()
                $(document).on('file.paste', '#modal-media', function (event, file_url_list, id_list) {
                    $('#MediaId').val(id_list[0])
                    PostTabbedStandard.set_featured_image(file_url_list[0])
                });

                const postTabbedId = getParameterByName('id')
                if (postTabbedId) {
                    PostTabbedStandard.fetch_standard(Number(postTabbedId))
                }

                const isItemRegist = '{{ $isItemRegist ?? 0 }}'
                if (isItemRegist == '1') {
                    PostTabbedStandard.btn_act_new()
                }
            });

            (function( PostTabbedStandard, $, undefined ) {
                PostTabbedStandard.formA = {!! json_encode($formA) !!}

                    PostTabbedStandard.show_media_modal = function () {
                    $('#modal-media').data('target-id', '')
                    PopupForm1FormBMediaForm.btn_act_new();
                    $('#modal-media-btn').data('target', 'media')
                    $('#modal-media-btn').data('variable', mediaModal)
                    $('#modal-media-btn').trigger('click')
                }

                PostTabbedStandard.set_featured_image = function (file_path) {
                    $('#MediaId-file-path').val(file_path)
                    $('#MediaId-img').attr('src', window.env['MEDIA_URL'] + file_path)
                    $('#MediaId-img').prop('hidden', false)
                }

                PostTabbedStandard.btn_act_del = function () {
                    Atype.btn_act_del('#standard-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PostTabbedStandard')
                }

                PostTabbedStandard.btn_act_copy = function () {
                    Atype.btn_act_copy('#standard-form #frm', function () {
                        $('#modal-select-popup.show').trigger('list.requery');
                        $('#modal-select-popup.show').modal('hide');
                    }, 'PostTabbedStandard')
                }

                PostTabbedStandard.btn_act_new = function () {
                    $('#modal-select-popup .modal-body button').removeClass('bg-grey-700 border-grey-700 bg-grey-700-hover')
                    $('#modal-select-popup .modal-body thead th').removeClass('bg-grey-700')
                    $('#modal-select-popup .modal-header').removeClass('bg-grey-700')

                    $('#modal-select-popup .modal-header').addClass('bg-green-600 border-green-600')
                    $('#modal-select-popup .modal-body .btn-group > button').addClass('bg-green-600 border-green-600 bg-green-600-hover')

                    $('#modal-select-popup.form-post-standard .modal-dialog').css('maxWidth', PostTabbedStandard.formA['DisplayVars']['Width'] + 'px');
                    Atype.set_parameter_callback(PostTabbedStandard.parameter)

                    $('#MediaId-img').attr('src', '')
                    $('#MediaId-img').prop('hidden', true)

                    $('#standard-form').find('.fr-view').html('')
                    Atype.btn_act_new('#standard-form #frm')

                    AttachedFiles.attachedFiles = [ null ]
                }

                PostTabbedStandard.parameter = function () {
                    const post_meta = $('#standard-form').find('#meta-test-result-txt-area').val();
                    const schema_markup = $('#standard-form').find('#schema-test-result-txt-area').val();

                    const id = Number($('#standard-form').find('#Id').val())
                    let parameter =
                    {
                        Id: id,
                        UserId: window.User['UserId'],
                        AttachedFiles: $('#attached-files').val(),
                        SchemaMarkup: schema_markup,
                        PostMeta: post_meta
                    }

                    for (const key in PostTabbedStandard.formA['FormPostVars']['Title']) {
                        if (isEmpty(PostTabbedStandard.formA['FormPostVars']['Type'][key])) { continue }

                        let result
                        const value = $('#standard-form').find(`#${key}`).val()
                        const format = PostTabbedStandard.formA['FormPostVars']['Type'][key]
                        switch (format) {
                            case 'YYYY-MM-DD': case 'YYYY.MM.DD': case 'YYYYMMDD':
                            case 'YY-MM-DD': case 'YY.MM.DD': case 'YYMMDD':
                            case 'yy-mm-dd': case 'yy.mm.dd': case 'yymmdd':
                                result = moment(value).format(format);
                                break;
                            case 'string':
                                result = String(value)
                                break;
                            case 'number':
                                result = Number(value)
                                break;
                            case 'check':
                                result = $('#standard-form').find(`#${key}`).prop('checked') ? '1': '0'
                                break;
                            case 'editor':
                                const editor = new FroalaEditor("#standard-form #froala-editor", { key: window.env['FROALA_LICENSE_KEY'], attribution: false })
                                if (editor.codeView.isActive()) {
                                    result = editor.codeView.get()
                                    editor.codeView.toggle()
                                } else {
                                    result = editor.html.get()
                                }
                                break;
                            default:
                                break;
                        }

                        parameter[key] = result
                    }

                    if (id < 0) {
                        parameter = { Id: id }
                    }
                    return parameter;
                }

                PostTabbedStandard.btn_act_new_callback = function () {
                    PostTabbedStandard.btn_act_new()
                    Atype.set_parameter_callback(PostTabbedStandard.parameter);
                }

                PostTabbedStandard.show_popup_callback = async function (id, c1) {
                    PostTabbedStandard.btn_act_new()
                    await PostTabbedStandard.fetch_standard(Number(id));
                }

                PostTabbedStandard.fetch_standard = async function (id) {
                    let response = await get_api_data(PostTabbedStandard.formA['General']['PickApi'], {
                        QueryVars: {
                            QueryName: PostTabbedStandard.formA['General']['QueryName'],
                            SimpleFilter: `mx.id=${id}`
                        },
                        PageVars: {
                            Limit: 1
                        }
                    })
                    console.log(response)
                    PostTabbedStandard.set_standard_ui(response)
                }

                PostTabbedStandard.set_standard_ui = async function (response) {
                    if (isEmpty(response.data) || response.data.apiStatus) return;
                    let post = response.data.Page[0];

                    if (post['MediaId']) {
                        const response = await get_api_data('media-pick', {
                            Page: [ { Id: Number(post['MediaId']) } ]
                        })

                        const page = response.data['Page']
                        if (page) {
                            const file_url = page[0]['FileUrl']
                            PostTabbedStandard.set_featured_image(file_url)
                            $('#standard-form').find('#meta-test-result-txt-area').val(post['PostMeta'])
                            $('#standard-form').find('#schema-test-result-txt-area').val(post['SchemaMarkup'])
                        }
                    }
                    $('#standard-form').find('#Id').val(post.Id)
                    $('#standard-form').find('#attached-files').val(post.AttachedFiles)
                    for (const key in PostTabbedStandard.formA['FormPostVars']['Title']) {
                        if (isEmpty(PostTabbedStandard.formA['FormPostVars']['Ui'][key])) { continue }

                        if (PostTabbedStandard.formA['FormPostVars']['Ui'][key] === 'editor') {
                            $('#standard-form').find('.fr-view').html(post[key])
                            $('#standard-form').find('.test-feed').html(post[key])
                        } else if (PostTabbedStandard.formA['FormPostVars']['Ui'][key] === 'checkbox') {
                            $('#standard-form').find(`#${key}`).prop('checked', post[key] === '1')
                        } else {
                            let value = format_conver_for(post[key], PostTabbedStandard.formA['FormPostVars']['Format'][key])
                            $('#standard-form').find(`#${key}`).val(value)
                        }
                    }
                }

            }( window.PostTabbedStandard = window.PostTabbedStandard || {}, jQuery ));

            let mediaModal

			//탭 선택시 바탕색 변화
			$(".item_tabbed .nav-link").click(function(){
				$(".item_tabbed .nav-link").removeClass("active");
			   $(this).addClass("active")
			})

            const moealSetFile = {!! json_encode($moealSetFile) !!};
        </script>
    @endpush
@endonce
