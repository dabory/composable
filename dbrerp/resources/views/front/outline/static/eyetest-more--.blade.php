<!--- eyetest-more --->
<div class="modal fade" id="modal-eyetest-more" aria-hidden="true" data-backdrop="static" style="z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h4 class="modal-title text-white" id="myModalLabel">상세처방</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                <div class="eyetest">
                    <div class="card input_info">
                        <div class="card_inner">
                            <div class="row m-0 mb-2">
                                <button type="button" tabindex="-1" class="btn btn-sm btn-black col-2"
                                onclick="test2()">
                                    처방 초기화
                                </button>
                                <h1 class="col-6 text-center mb-0">Form of Eye Examination</h1>
                                <div class="col-4 p-0 d-flex">
                                    <button type="button" tabindex="-1" class="btn btn-sm btn-black col-8 mr-1"
                                    onclick="test()">
                                        양안시 처방인쇄
                                    </button>
                                    <button type="button" tabindex="-1" class="btn btn-sm btn-black col">
                                        닫기
                                    </button>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-8 px-1 h-100" id="chief-complaint">
                                    <div class="row mx-0 pl-0 mb-2 d-flex align-items-center">
                                        <div class="col-2 px-0 text-right mr-2">
                                            Reason for Visit &<br>Chief complaint
                                        </div>
                                        <textarea class="col" style="height: 50px;"></textarea>
                                    </div>
                                    <div class="row mx-0 pl-0 d-flex align-items-center">
                                        <div class="col-2 px-0 text-right mr-2">
                                            나안시력
                                        </div>
                                        <div class="col">
                                            <label class="mb-0">OD</label>
                                            <input type="text" class="rounded w-100 h-75">
                                        </div>
                                        <div class="col">
                                            <label class="mb-0">OS</label>
                                            <input type="text" class="rounded w-100 h-75">
                                        </div>
                                        <div class="col">
                                            <label class="mb-0">OU</label>
                                            <input type="text" class="rounded w-100 h-75">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4 border border-dark position-relative p-0" id="canvasDiv1">
                                    <button type="button" tabindex="-1" class="px-0 border border-right-0 border-bottom-0 border-success bg-white position-absolute right-0 bottom-0"
                                    onclick="clear_canvas1()">
                                        <i class="fas fa-eraser px-1"></i>
                                    </button>
                                </div>
                                {{-- <div class="col-4 border border-dark position-relative">
                                    <button type="button" tabindex="-1" class="px-0 border border-right-0 border-bottom-0 border-success bg-white position-absolute right-0 bottom-0">
                                        <i class="fas fa-eraser px-1"></i>
                                    </button>
                                </div> --}}
                            </div>

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border mb-1">구안경도수</legend>
                                <div class="table-responsive eye-lens-table">
                                    <table>
                                        <tr>
                                            <th></th>
                                            <th>SPH</th>
                                            <th>CYL</th>
                                            <th>AXIS</th>
                                            <th>원용PD</th>
                                            <th>ADD</th>
                                            <th>근용PD</th>
                                            <th>BASE(I/O)/△</th>
                                            <th>BASE(U/D)/△</th>
                                            <th>나안</th>
                                            <th>교정</th>
                                        </tr>
                                        <tr class="r-eye-lens">
                                            <td style="width: 10px">OD</td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text"> º</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                                            </td>
                                        </tr>
                                        <tr class="l-eye-lens">
                                            <td style="width: 10px">OS</td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text"> º</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </fieldset>

                            <div class="row m-0">
                                <div class="col-5 px-1 h-100" id="cover-test">
                                    <div class="row mx-0 pl-0 mb-2 d-flex align-items-center mb-2">
                                        <div class="col-3 px-0 text-right mr-2">
                                            Cover test
                                        </div>
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">Dis</label>
                                            <input type="text" class="rounded w-100 h-75">
                                        </div>
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">Near</label>
                                            <input type="text" class="rounded w-100 h-75">
                                        </div>
                                    </div>
                                    <div class="row mx-0 pl-0 d-flex align-items-center mb-2">
                                        <div class="col-3 px-0 text-right mr-2">
                                            폭주근점
                                        </div>
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">Normal</label>
                                            <input type="checkbox" tabindex="-1">
                                        </div>
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">Abnormal</label>
                                            <input type="checkbox" tabindex="-1">
                                            <label class="mb-0 mr-1">(over</label>
                                            <input type="text" class="rounded h-75" style="width: 43px">
                                            <label class="mb-0">cm)</label>
                                        </div>
                                    </div>
                                    <div class="row mx-0 pl-0 d-flex align-items-center">
                                        <div class="col-3 px-0 text-right mr-2">
                                            <div class="d-flex justify-content-end">
                                                <input type="checkbox" tabindex="-1">
                                                <label class="mb-0">확장</label>
                                                <label class="mb-0 ml-2">조절력</label>
                                            </div>
                                        </div>
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">OD</label>
                                            <input type="text" class="rounded w-100 h-75">
                                            <label class="mb-0">D</label>
                                        </div>
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">OS</label>
                                            <input type="text" class="rounded w-100 h-75">
                                            <label class="mb-0">D</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col border border-dark mr-2">
                                    <div class="text-center mt-2">
                                        <label class="m-0">주시안</label>
                                    </div>

                                    <div class="text-center mt-2 d-flex justify-content-around">
                                        <div class="d-flex">
                                            <label class="mb-0">OD</label>
                                            <input type="checkbox" class="ml-1" tabindex="-1">
                                        </div>

                                        <div class="d-flex">
                                            <label class="mb-0">OS</label>
                                            <input type="checkbox" class="ml-1" tabindex="-1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 border border-dark position-relative p-0" id="canvasDiv2">
                                    <button type="button" tabindex="-1" class="px-0 border border-right-0 border-bottom-0 border-success bg-white position-absolute right-0 bottom-0"
                                    onclick="clear_canvas2()">
                                        <i class="fas fa-eraser px-1"></i>
                                    </button>
                                </div>
                            </div>

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border mb-1">완전교정</legend>
                                <div class="table-responsive eye-lens-table">
                                    <table>
                                        <tr>
                                            <th></th>
                                            <th>SPH</th>
                                            <th>CYL</th>
                                            <th>AXIS</th>
                                            <th>원용PD</th>
                                            <th>ADD</th>
                                            <th>근용PD</th>
                                            <th>BASE(I/O)/△</th>
                                            <th>BASE(U/D)/△</th>
                                            <th>나안</th>
                                            <th>교정</th>
                                        </tr>
                                        <tr class="r-eye-lens">
                                            <td style="width: 10px">OD</td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text"> º</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                                            </td>
                                        </tr>
                                        <tr class="l-eye-lens">
                                            <td style="width: 10px">OS</td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text"> º</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </fieldset>

                            <div class="row m-0">
                                <div class="col-5 px-1 row mx-0 pl-0 mb-2 d-flex align-items-center mb-2">
                                    <div class="col-3 px-0 text-right mr-2">
                                        사위 테스트
                                    </div>
                                    <div class="col d-flex">
                                        <label class="mb-0 mr-1">Dis&nbsp;H</label>
                                        <input type="text" class="rounded w-100 h-75">
                                    </div>
                                    <div class="col d-flex">
                                        <label class="mb-0 mr-1">Dis&nbsp;V</label>
                                        <input type="text" class="rounded w-100 h-75">
                                    </div>
                                </div>
                                <div class="col px-1 row mx-0 pl-0 mb-2 d-flex align-items-center mb-2">
                                    <div class="col d-flex">
                                        <label class="mb-0 mr-1">Near&nbsp;H</label>
                                        <input type="text" class="rounded w-100 h-75">
                                    </div>
                                    <div class="col d-flex">
                                        <label class="mb-0 mr-1">Near&nbsp;V</label>
                                        <input type="text" class="rounded w-100 h-75">
                                    </div>
                                </div>
                                <div class="col px-1 row mx-0 pl-0 mb-2 d-flex align-items-center mb-2">
                                    <div class="col d-flex justify-content-center">
                                        <label class="mb-0 mr-1">AC/A</label>
                                        <input type="text" class="rounded w-100 h-75">
                                        <label class="mb-0 mr-1">△/D</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-5 px-1 row mx-0 pl-0 d-flex align-items-center mb-2">
                                    <div class="col-3 px-0 text-right mr-2">
                                        융합 테스트
                                    </div>
                                    <div class="py-1">
                                        <div class="col d-flex mb-1 justify-content-end">
                                            <label class="mb-0 mr-1">Dis&nbsp;BI&nbsp;(</label>
                                            <input type="text" class="rounded h-75" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">&nbsp;)
                                        </div>
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">Near&nbsp;BI&nbsp;(</label>
                                            <input type="text" class="rounded h-75" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">&nbsp;)
                                        </div>
                                    </div>
                                </div>
                                <div class="col px-1 row mx-0 pl-0 d-flex align-items-center mb-2">
                                    <div class="py-1">
                                        <div class="col d-flex mb-1 justify-content-end">
                                            <label class="mb-0 mr-1">Dis&nbsp;BO&nbsp;(</label>
                                            <input type="text" class="rounded h-75" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">&nbsp;)
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <label class="mb-0 mr-1">Near&nbsp;BO&nbsp;(</label>
                                            <input type="text" class="rounded h-75" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">&nbsp;)
                                        </div>
                                    </div>
                                </div>
                                <div class="col px-1 row mx-0 pl-0 d-flex align-items-center mb-2">
                                    <div class="jumbotron jumbotron-fluid py-1 mb-0">
                                        <div class="col d-flex mb-1 justify-content-end">
                                            <label class="mb-0 mr-1">Supra&nbsp;vergence&nbsp;(</label>
                                            <input type="text" class="rounded h-75" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">&nbsp;)
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <label class="mb-0 mr-1">Infra&nbsp;vergence&nbsp;(</label>
                                            <input type="text" class="rounded h-75" style="width: 43px">/
                                            <input type="text" class="rounded h-75 ml-1" style="width: 43px">&nbsp;)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-5 px-1 row mx-0 pl-0 d-flex align-items-center mb-2">
                                    <div class="col-3 px-0 text-right mr-2">
                                        조절 테스트
                                    </div>
                                    <div class="py-1">
                                        <div class="col d-flex">
                                            <label class="mb-0 mr-1">Binocular&nbsp;accomo.facility</label>
                                        </div>
                                        <div class="col d-flex pr-0">
                                            <label class="mb-0 mr-1">Normal</label>
                                            <input type="checkbox" tabindex="-1">
                                            <label class="mb-0 mr-1">Abnormal&nbsp;(</label>
                                            <input type="checkbox" tabindex="-1">+2,00D&nbsp;/&nbsp;
                                            <input type="checkbox" tabindex="-1">-2,00D&nbsp;)
                                        </div>
                                    </div>
                                </div>
                                <div class="col px-1 row mx-0 pl-0 d-flex align-items-center mb-2">
                                    <div class="py-1">
                                        <div class="col d-flex justify-content-end">
                                            <label class="mb-0 mr-1">Mono&nbsp;<span class="font-weight-bold">OD</span></label>
                                            <label class="mb-0 mr-1">Normal</label>
                                            <input type="checkbox" tabindex="-1">
                                            <label class="mb-0 mr-1">Abnormal&nbsp;(</label>
                                            <input type="checkbox" tabindex="-1">+2,00D&nbsp;/&nbsp;
                                            <input type="checkbox" tabindex="-1">-2,00D&nbsp;)
                                        </div>
                                        <div class="col d-flex justify-content-end">
                                            <label class="mb-0 mr-1">-cular&nbsp;<span class="font-weight-bold">OS</span></label>
                                            <label class="mb-0 mr-1">Normal</label>
                                            <input type="checkbox" tabindex="-1">
                                            <label class="mb-0 mr-1">Abnormal&nbsp;(</label>
                                            <input type="checkbox" tabindex="-1">+2,00D&nbsp;/&nbsp;
                                            <input type="checkbox" tabindex="-1">-2,00D&nbsp;)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-5 px-1 row mx-0 pl-0 mb-2 d-flex align-items-center mb-2">
                                    <div class="col-3 px-0 text-right mr-2">
                                        상대 조절력
                                    </div>
                                    <div class="col d-flex">
                                        <label class="mb-0 mr-1">NRA</label>
                                        <input type="text" class="rounded w-100 h-75">D
                                    </div>
                                    <div class="col d-flex">
                                        <label class="mb-0 mr-1">PRA</label>
                                        <input type="text" class="rounded w-100 h-75">D
                                    </div>
                                </div>
                                <div class="col px-1 row mx-0 pl-0 mb-2 d-flex align-items-center mb-2">
                                    <div class="col d-flex">
                                        <label class="mb-0 mr-1">조절반응검사</label>
                                        <input type="text" class="rounded w-75 h-75" style="max-width: 100%">D
                                    </div>
                                </div>
                            </div>

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border mb-1">처방</legend>
                                <div class="table-responsive eye-lens-table">
                                    <table>
                                        <tr>
                                            <th></th>
                                            <th>SPH</th>
                                            <th>CYL</th>
                                            <th>AXIS</th>
                                            <th>원용PD</th>
                                            <th>ADD</th>
                                            <th>근용PD</th>
                                            <th>BASE(I/O)/△</th>
                                            <th>BASE(U/D)/△</th>
                                            <th>나안</th>
                                            <th>교정</th>
                                        </tr>
                                        <tr class="r-eye-lens">
                                            <td style="width: 10px">OD</td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text"> º</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                                            </td>
                                        </tr>
                                        <tr class="l-eye-lens">
                                            <td style="width: 10px">OS</td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 sph-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 cyl-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 axis-txt" type="text"> º</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 long-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 add-txt" type="text"> D</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 short-pd-txt" type="text"> mm</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-i-txt" type="text"><input class="rounded w-100 base-o-txt" type="text"> △</div>
                                            </td>
                                            <td class="base">
                                                <div class="d-flex"><input class="rounded w-100 base-u-txt" type="text"><input class="rounded w-100 base-d-txt" type="text"> △</div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 bare-eye-txt" type="text"></div>
                                            </td>
                                            <td>
                                                <div class="d-flex"><input class="rounded w-100 adjust-txt" type="text"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </fieldset>

                            <div class="row ml-4 mr-0">
                                <div class="col-1 row mr-1 pl-0 text-right d-flex justify-content-end px-1">
                                    Diagnosis<br>&<br>Plans
                                </div>
                                <textarea class="col" style="height: 80px;"></textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
@push('js')
<script src="/js/utils/canvas.js?{{date('YmdHis')}}"></script>
    <script>
        $(document).ready(async function() {
            canvas1 = new Canvas('canvasDiv1', 'canvas1');
            canvas2 = new Canvas('canvasDiv2', 'canvas2');

            $('#eyetest-more-btn').click(()=>{
                canvas1.clearCanvas()
                canvas2.clearCanvas()
                setTimeout(()=>{
                    canvas1.setCanvasWidth($('#canvasDiv1').width())
                    canvas1.setCanvasHeight($('#chief-complaint').height())

                    canvas2.setCanvasWidth($('#canvasDiv2').width())
                    canvas2.setCanvasHeight($('#cover-test').height())
                }, 601)
            });
        });

        function test2() {
            console.log(clickX)
            console.log(clickY)
            console.log(clickDrag)
            canvas1.setClickX(clickX)
            canvas1.setClickY(clickY)
            canvas1.setClickDrag(clickDrag)
            canvas1.redraw()
        }

        function test() {
            clickX = canvas1.getClickX()
            clickY = canvas1.getClickY()
            clickDrag = canvas1.getClickDrag()
        }

        function clear_canvas1() {
            canvas1.clearCanvas()
        }

        function clear_canvas2() {
            canvas2.clearCanvas()
        }

        let clickX;
        let clickY;
        let clickDrag;

        let canvas1, canvas2;
    </script>
@endpush
@endonce
