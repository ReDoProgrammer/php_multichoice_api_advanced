<div id="modalExamDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="mdlTitle">Chi tiết bài thi</h4>
            </div>
            <div class="modal-body" id="tblExamDetail">

            </div>
        </div>

    </div>
</div>

<script>
    $('#modalExamDetail').on('hidden.bs.modal', function() {
        if(withHis){
            $('#modalHistory').modal();
        }
    })
</script>

<style>
    .modal-body {
        max-height: calc(100vh - 100px);
        overflow-y: auto;
    }
</style>