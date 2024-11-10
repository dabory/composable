<!--- manual --->
<div class="modal fade" id="modal-manual" aria-hidden="true" data-backdrop="static" style="z-index: 1050; overflow: auto;">
    <div class="modal-dialog m-auto pt-4" style="max-width: 768px !important;">
        <div class="modal-content">
            <div class="modal-header bg-warning-600">
                <h4 class="modal-title text-white" id="myModalLabel">매뉴얼</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-2" style="background-color: #f5f5f5;">
                <div class="mt-2 card px-2">
                    <ul class="nav nav-tabs nav-tabs-solid rounded my-2">
                        @foreach ($manual['Text'] as $key => $data)
                            @if ($key == 0)
                                <li class="nav-item"><a href="{{ '#Text-'.$key }}" class="nav-link active" data-toggle="tab">{{ $data['Title'] }}</a></li>
                            @else
                                <li class="nav-item"><a href="{{ '#Text-'.$key }}" class="nav-link" data-toggle="tab">{{ $data['Title'] }}</a></li>
                            @endif
                        @endforeach
                        @foreach ($manual['Images'] as $key => $data)
                            <li class="nav-item"><a href="{{ '#Images-'.$key }}" class="nav-link" data-toggle="tab">{{ $data['Title'] }}</a></li>
                        @endforeach
                        @foreach ($manual['Movies'] as $key => $data)
                            <li class="nav-item"><a href="{{ '#Movies-'.$key }}" class="nav-link" data-toggle="tab">{{ $data['Title'] }}</a></li>
                        @endforeach
                    </ul>

                    <div class="tab-content">
                        @foreach ($manual['Text'] as $key => $data)
                            <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}" id="{{ 'Text-'.$key }}"></div>
                        @endforeach
                        @foreach ($manual['Images'] as $key => $data)
                            <div class="tab-pane fade mb-1" id="{{ 'Images-'.$key }}">
                                <a href="/{{ $data['Path'] }}" target="_blank">
                                    <img src="/{{ $data['Path'] }}" class="w-100 h-100">
                                </a>
                            </div>
                        @endforeach
                        @foreach ($manual['Movies'] as $key => $data)
                            <div class="tab-pane fade" id="{{ 'Movies-'.$key }}">
                                <iframe width="100%" height="600" src="{{ $data['LinkUrl'] }}"></iframe>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@once
<script>
    $('#modal-manual').on('show.bs.modal', function (event) {
        $('#modal-manual').draggable({ handle: ".modal-header" });
    })

    $(document).ready(async function() {
        const converter = new showdown.Converter()
        manual['Text'].forEach((data, key) => {
            const html = converter.makeHtml(data['Parameter'])
            $(`#Text-${key}`).append(html)
        });
        hljs.highlightAll();
    });

    const manual = {!! json_encode($manual) !!};
</script>
@endonce
