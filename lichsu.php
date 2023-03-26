<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include_once('./components/header.php') ?>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">Trắc nghiệm.php</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="./">Home</a></li>
                    <li class="active"><a href="./lichsu.php" id="aHistory">Lịch sử thi</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right" id="right-nav">
                    <li><a href="#" class="aProfile"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="#" class="aLogout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="panel-group">

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <span>
                                <i class="glyphicon glyphicon-user"></i>
                                Lịch sử làm bài thi:
                                <strong id="spFullname" class="font-weight-bold">
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" width="40%">Ngày thi</th>
                                <th scope="col" width="40%">Điểm</th>

                                <th scope="col" class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody id="tbHistory">

                        </tbody>
                    </table>

                </div>
                <div class="panel-footer">
                    <ul class="pagination pagination-sm" id="pagination">
                        <li><a href="#">1</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

</body>

</html>

<?php include_once('./components/modals/modalAccount.php') ?>
<?php include_once('./components/modals/modalHistory.php') ?>
<?php include_once('./components/modals/modalExamDetail.php') ?>
<?php include_once('./components/modals/modalProfile.php') ?>
<?php include_once('./components/footer.php') ?>




<script>
    var index = 0;
    var count = 0;
    var page = 1;
    var pageSize = 3;
    var withHis = false; // thuoc tinh danh dau mo modal history
    $(document).ready(function() {
        GetUser();
        GetHistory();
    })
    $(document).on('click', "input[name='btnViewExamDetail']", function() {
        exam_id = $(this).closest('tr').attr('id');
        $.ajax({
            url: './api/user/examination/detail.php',
            type: 'get',
            dataType: 'json',
            headers: {
                'Authorization': getToken(),
                'Content-Type': 'application/json'
            },
            data: {
                id: exam_id
            },
            success: function(data) {
                if (data.code == 200) {
                    let idx = 1;
                    let results = JSON.parse(data.results);
                    $('#modalExamDetail').modal();
                    results.forEach(r => {
                        $('#tblExamDetail').empty();
                        GetQuestion(r, idx++);
                    })
                } else {
                    $.toast({
                        heading: 'Error',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
                }
            },
            error: function(request, status, error) {
                alert(request.responseText);
                console.log(request.responseText);
            }
        });
    })


    function GetQuestion(question, index) {
        $.ajax({
            url: './api/user/question/detail.php',
            type: 'get',
            headers: {
                'Authorization': getToken(),
                'Content-Type': 'application/json'
            },
            data: {
                id: question.id
            },
            success: function(data) {
                if (data.code == 200) {
                    q = data.question;
                    let d = '';
                    d += '<div class="row" style = "margin-left:10px;" id="question_' + q.id + '"> ';
                    d += '<h5 style="font-weight:bold;" id="' + q.id + '"> <span class="text-danger">Câu ' + index + ': </span><strong>' + q.title + '</strong></h5>';

                    d += '<fieldset>';
                    d += '<div class="radio col-md-12 ">';
                    if (question.choice == 'A') {
                        d += '<label class = "A"><input type="radio" onclick="return false;" checked class="A" name = "' + q.id + '"><span class="text-danger">A: </span>' + q.option_a + '</label>';
                    } else {
                        d += '<label class = "A"><input type="radio" onclick="return false;"  class="A" name = "' + q.id + '"><span class="text-danger">A: </span>' + q.option_a + '</label>';
                    }

                    d += '</div>';

                    d += ' <div class="radio col-md-12">';
                    if (question.choice == 'B') {
                        d += '<label class = "B"><input type="radio"  checked onclick="return false;" class="B" name = "' + q.id + '"><span class="text-danger">B: </span>' + q.option_b + '</label>';
                    } else {
                        d += '<label class = "B"><input type="radio"  onclick="return false;" class="B" name = "' + q.id + '"><span class="text-danger">B: </span>' + q.option_b + '</label>';
                    }
                    d += '</div>';

                    d += '<div class="radio  col-md-12">';
                    if (question.choice == 'C') {
                        d += '<label class = "C"><input type="radio" onclick="return false;" checked class="C" name = "' + q.id + '"><span class="text-danger">C: </span>' + q.option_c + '</label>';
                    } else {
                        d += '<label class = "C"><input type="radio" onclick="return false;" class="C" name = "' + q.id + '"><span class="text-danger">C: </span>' + q.option_c + '</label>';
                    }
                    d += '</div>';

                    d += '<div class="radio col-md-12">';
                    if (question.choice == 'D') {
                        d += '<label class = "D"><input type="radio" onclick="return false;" checked class="D" name = "' + q.id + '"><span class="text-danger">D: </span>' + q.option_d + '</label>';
                    } else {
                        d += '<label class = "D"><input type="radio" onclick="return false;" class="D" name = "' + q.id + '"><span class="text-danger">D: </span>' + q.option_d + '</label>';
                    }
                    d += '</div>';
                    d += '</fieldset>';
                    d += '</div>';

                    $('#tblExamDetail').append(d);
                    $('#question_' + question.id + ' > fieldset > div > label.' + q.answer).css("background-color", "yellow");
                }
            }
        });
    }

    function GetHistory() {
        $.ajax({
            url: './api/user/examination/get.php',
            type: 'get',
            headers: {
                'Authorization': getToken(),
                'Content-Type': 'application/json'
            },
            data: {
                page,
                pageSize
            },
            success: function(data) {
                $('#tbHistory').empty();
                Pagination(data.pages);
                data.exams.forEach(e => {
                    let tr = `<tr id=${e.id}>`;
                    tr += `<td>${++index}</td>`;
                    tr += `<td>${e.exam_date}</td>`;
                    tr += `<td>${e.mark}</td>`;
                    tr += '<td class="text-right">';
                    tr += '<input type="button" class="btn btn-xs btn-info" value="Xem" name="btnViewExamDetail">';

                    tr += '</td>';
                    $('#tbHistory').append(tr);
                })


            },
            error: function(request, status, error) {
                // alert(request.responseText);
                console.log(request.responseText);
            }
        })
    }

    $("#pagination").on("click", "li a", function(event) {
        event.preventDefault();
        page = $(this).text();
        idx = (page - 1) * pageSize;
        var $activeLi = $('#pagination').find("li.active");
        $activeLi.removeClass('active');
        GetHistory();
    });

    function Pagination(pages) {
        $('#pagination').empty();
        index = (page - 1) * pageSize;
        if (page > pages) {
            page = 1;
        }
        if (pages > 1) {
            $('#pagination').show();
            let pagi = '';
            for (i = 1; i <= pages; i++) {
                if (i == page) {
                    pagi += '<li class="page-item active" ><a class="page-link" href="#">' + i + '</a></li>';
                } else {
                    pagi += '<li class="page-item" ><a class="page-link" href="#">' + i + '</a></li>';
                }

            }
            $('#pagination').append(pagi);
        }

    }

   
</script>