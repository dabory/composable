<style>
.modal-header {padding: 5px 20px;}
</style>
<!--- igroup --->
<div class="modal fade modal-cyan" id="modal-igroup" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-filter-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="igroup" style="width: 100%;">
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="igroup"></button>
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
                        <select class="modal-line-select" data-target="igroup">
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
<div class="modal fade modal-cyan" id="modal-storage" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-filter-select" style="width: 100%;">
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

<!--- cgroup --->
<div class="modal fade modal-cyan" id="modal-cgroup" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-filter-select" style="width: 100%;">
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
<div class="modal fade modal-cyan" id="modal-sgroup" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-filter-select" style="width: 100%;">
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

<!--- branch --->
<div class="modal fade modal-cyan" id="modal-branch" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-filter-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="branch" style="width: 100%;">
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
                        <select class="modal-line-select" data-target="branch">
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

<!--- item --->
<div class="modal fade modal-cyan" id="modal-item" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-filter-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="item" style="width: 100%;">
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

<!--- company --->
<div class="modal fade modal-cyan" id="modal-company" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary" style="border:1px solid red;">
                <h4 class="modal-title text-white" id="myModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4" >
                        <select class="modal-filter-select" style="width: 100%;">
                        </select>
                    </div>
                    <div class="col-7" >
                        <input class="modal-input search-moadal-text" type="text" data-target="company" style="width: 100%;">
                    </div>
                    <div class="col-1" >
                        <button type="button" class="btn btn-primary btn-sm icon-search4 modal-search" data-target="company"></button>
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
                        <select class="modal-line-select" data-target="company">
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
