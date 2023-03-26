<div class="modal" tabindex="-1" role="dialog" id="modalQuestion">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalQuestionTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control" id="txaQuestion"  placeholder="Câu hỏi" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="txaOptionA"  placeholder="Đáp án A" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="txaOptionB"  placeholder="Đáp án B" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="txaOptionC"  placeholder="Đáp án C" rows="2"> </textarea>
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="txaOptionD"  placeholder="Đáp án D" rows="2"></textarea>
                </div>

                <hr class="clearfix">
                <div class="form-group">
                    <label for="">Đáp án</label>
                    <select class="form-control" id="slAnswer">
                        <option value="A">Đáp án A</option>
                        <option value="B">Đáp án B</option>
                        <option value="C">Đáp án C</option>
                        <option value="D">Đáp án D</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnSubmit">Xác nhận</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('#modalQuestion').on('hidden.bs.modal', function () {
        ResetInputs();
    })
    $('#btnSubmit').click(function () {
        let title = $('#txaQuestion').val().trim();//lấy giá trị của textarea có id là txaQuestion gán cho biến question
        let option_a = $('#txaOptionA').val().trim();//lấy giá trị của textarea có id là txaOptionA gán cho biến option_a
        let option_b = $('#txaOptionB').val().trim();//lấy giá trị của textarea có id là txaOptionB gán cho biến option_b
        let option_c = $('#txaOptionC').val().trim();//lấy giá trị của textarea có id là txaOptionC gán cho biến option_c
        let option_d = $('#txaOptionD').val().trim();//lấy giá trị của textarea có id là txaOptionD gán cho biến option_d
        let answer = $('#slAnswer option:selected').val();




        //ràng buộc dữ liệu
        if (title.length == 0 || option_a.length == 0 || option_b.length == 0 || option_c.length == 0 || option_d.length == 0) {
            $.toast({
                heading: 'Warning',
                text: 'Vui lòng nhập đầy đủ dữ liệu!',
                showHideTransition: 'fade',
                icon: 'warning'
            })
            return;
        }



        if (questionId <= 0) {// thêm mới câu hỏi
            $.ajax({
                url: '../api/admin/question/create.php',
                type: 'post',
                dataType: 'json',
                headers: {
                    'Authorization': getToken(),
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    'title': title,
                    'option_a': option_a,
                    'option_b': option_b,
                    'option_c': option_c,
                    'option_d': option_d,
                    'answer': answer
                }),
                success: function (data) {
                    if (data.code == 201) {
                        $.toast({
                            heading: 'Success',
                            text: data.message,
                            showHideTransition: 'fade',
                            icon: 'info'
                        });

                        $('#btnSearch').click();
                        ResetInputs();
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: data.message,
                            showHideTransition: 'fade',
                            icon: 'error'
                        });
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                    console.log(request.responseText);
                }
            });
        } else {//cập nhật câu hỏi đã có
            $.ajax({
                url: '../api/admin/question/update.php',
                type: 'put',
                dataType: 'json',
                headers: {
                    'Authorization': getToken(),
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify({
                    'id':questionId,
                    'title': title,
                    'option_a': option_a,
                    'option_b': option_b,
                    'option_c': option_c,
                    'option_d': option_d,
                    'answer': answer
                }),
                success: function (data) {
                    if (data.code == 200) {
                        $.toast({
                            heading: 'Success',
                            text: data.message,
                            showHideTransition: 'fade',
                            icon: 'info'
                        });

                        $('#btnSearch').click();
                        ResetInputs();
                        $('#modalQuestion').modal('hide');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: data.message,
                            showHideTransition: 'fade',
                            icon: 'error'
                        });
                    }
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                    console.log(request.responseText);
                }
            });
        }


    });

    function ResetInputs() {
        //set các giá trị mặc định cho các input
        $('#txaQuestion').val('');
        $('#txaOptionA').val('');
        $('#txaOptionB').val('');
        $('#txaOptionC').val('');
        $('#txaOptionD').val('');
        $('#slAnswer').val('A');
        $('#txaQuestion').attr('readonly',false);
        $('#txaOptionA').attr('readonly', false);
        $('#txaOptionB').attr('readonly', false);
        $('#txaOptionC').attr('readonly', false);
        $('#txaOptionD').attr('readonly', false);
        $('#slAnswer').attr("disabled", false); 
        questionId = -1;
        $('#btnSubmit').show();
    }
</script>