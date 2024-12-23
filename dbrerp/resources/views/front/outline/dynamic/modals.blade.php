<style>
.modal-header {padding: 5px 20px;}
</style>
<!--- item --->
<div class="modal fade" id="modal-item" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-exit" style="margin-top: 10px;"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="item" style="width: 100%;">
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="item"></button>
                    </div>
                    <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                        <table class="table-row">
                            <thead id="table-head">
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6" >
                        <select class="modal-line-select" data-target="item">
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

<!--- cgroup --->
<div class="modal fade" id="modal-cgroup" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-exit" style="margin-top: 10px;"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="cgroup" style="width: 100%;">
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="cgroup"></button>
                    </div>
                    <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                        <table class="table-row">
                            <thead id="table-head">
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6" >
                        <select class="modal-line-select" data-target="cgroup">
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

<!--- sgroup --->
<div class="modal fade" id="modal-sgroup" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-exit" style="margin-top: 10px;"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="sgroup" style="width: 100%;">
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="sgroup"></button>
                    </div>
                    <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                        <table class="table-row">
                            <thead id="table-head">
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6" >
                        <select class="modal-line-select" data-target="sgroup">
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

<!--- storage --->
<div class="modal fade" id="modal-storage" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-exit" style="margin-top: 10px;"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="storage" style="width: 100%;">
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="storage"></button>
                    </div>
                    <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                        <table class="table-row">
                            <thead id="table-head">
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6" >
                        <select class="modal-line-select" data-target="storage">
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


<!--- purchase/pquote --->
<div class="modal fade" id="modal-pquote" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-exit" style="margin-top: 10px;"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="pquote" style="width: 100%;">
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="pquote"></button>
                    </div>
                    <div class="col-6">범위 : </div>
                    <div class="col-6">날짜 : </div>
                    <div class="col-6">속도 : </div>
                    <div class="col-6">정렬 : </div>
                    <div class="col-12 mt-2 mb-2 table-responsive" style="height: 400px;">
                        <table class="table-row">
                            <thead id="table-head">
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6" >
                        <select class="modal-line-select" data-target="pquote">
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
