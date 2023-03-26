<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Làm bài thi trắc nghiệm</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Toast plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">Trắc nghiệm.php</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="./">Home</a></li>
                    <li><a href="./lichsu.php" id="aHistory">Lịch sử thi</a></li>
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
                                Thí sinh:
                                <strong id="spFullname" class="font-weight-bold">
                                </strong>
                            </span>
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="button" name="button" class="btn btn-default" id="btnStart">
                                <i class="glyphicon glyphicon-time text-warning" aria-hidden="true"></i>
                                Bắt đầu
                            </button>
                            <span class="text-right font-weight-bold pl-2" id="divRemainingTime">
                                Thời gian còn lại: <span id="spRemainingTime" style="color:yellow; font-weight:bold;">45:59:59</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="questions"> </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button type="button" class="btn btn-warning" id="btnFinish">Kết thúc bài thi</button>
                            <button class="btn btn-primary" id="btnSave">Lưu bài thi</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <h4 id='mark' class="text-info"></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>

<?php include_once('./components/footer.php') ?>

<script type="text/javascript">
    var totalSeconds = 0;
    var questions; //biến toàn cục để lưu danh sách câu hỏi
    var result = []; // biến để lưu kết quả thi
    var mark = 0;
    const duration = 15; //thoi gian lam bai thi
    var time_over = false;
    var intervalId = null;
    const noq = 10; // so cau hoi cua de thi

    $(document).ready(function() {
        $('#right-nav').hide();
        $('#btnFinish').hide();
        $('#aHistory').hide();
        $('#divRemainingTime').hide();
        GetUser();
        $('#btnSave').hide();
    });




    $('#btnSave').click(function() {
        $.ajax({
            url: './api/user/examination/save.php',
            type: 'post',
            headers: {
                'Authorization': getToken(),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                "result": result,
                "mark": mark
            }),
            success: function(data) {
                if (data.code == 201) {
                    $.toast({
                        heading: 'Success',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'info'
                    })

                } else {
                    $.toast({
                        heading: 'Error',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
                }
            }
        })
    })







    $('#btnStart').click(function() {
        let token = getToken();
        StartExamination();
    });

    $('#btnFinish').click(function() {
        clearInterval();
        $(this).hide();
        $('#btnStart').show();
        $('#btnSave').show();
        CheckResult();
        totalSeconds = 0;       
        $('#divRemainingTime').hide(200);
        $('#btnSave').show(300);
    });

    function CheckResult() {
        $('#questions div.row').each(function(k, v) {
            //bước 1: lấy đáp án đúng của câu hỏi
            let id = $(v).find('h5').attr('id');
            let question = questions.find(x => x.id == id); //tìm câu hỏi trong mảng questions dựa vào id đã có ở trên
            let answer = question['answer']; //lấy đáp án đúng của câu hỏi


            //bước 2: lấy đáp án của người dùng ~ thằng radio được check
            let choice = $(v).find('fieldset input[type="radio"]:checked').attr('class');

            if (choice == answer) {
                mark += 1; //mỗi câu đúng được cộng 1 điểm
            } else {
                console.log('Câu có id: ' + id + ' sai');
            }

            result.push({
                id,
                choice,
                answer
            }); // luu ket qua thi vao mang

            //bước 3: đánh dấu đáp án đúng để người dùng đối chiếu

            $('#question_' + id + ' > fieldset > div > label.' + answer).css("background-color", "yellow");

        });

        $('#mark').text('Điểm của bạn là: ' + mark);

    }

    function CreateExam() {

        $.ajax({
            url: './api/user/examination/create.php',
            type: 'post',
            headers: {
                'Authorization': getToken(),
                'Content-Type': 'application/json'
            },
            data: JSON.stringify({
                "noq": noq
            }),
            success: function(data) {

                if (data.code == 200) {
                    let index = 1;
                    let d = '';
                    questions = data.questions;
                    $.each(questions, function(k, v) {
                        d += '<div class="row" style = "margin-left:10px;" id="question_' + v['id'] + '"> ';
                        d += '<h5 style="font-weight:bold;" id="' + v['id'] + '"> <span class="text-danger">Câu ' + index + ': </span><strong class="text-info">' + v['title'] + '</strong></h5>';

                        d += '<fieldset>';
                        d += '<div class="radio col-md-12 ">';
                        d += '<label class = "A"><input type="radio" class="A" name = "' + v['id'] + '"><span class="text-danger">A: </span>' + v['option_a'] + '</label>';
                        d += '</div>';

                        d += ' <div class="radio col-md-12">';
                        d += '<label class = "B"><input type="radio" class="B" name = "' + v['id'] + '"><span class="text-danger">B: </span>' + v['option_b'] + '</label>';
                        d += '</div>';

                        d += '<div class="radio  col-md-12">';
                        d += '<label class = "C"><input type="radio"  class="C" name = "' + v['id'] + '"><span class="text-danger">C: </span>' + v['option_c'] + '</label>';
                        d += '</div>';

                        d += '<div class="radio col-md-12">';
                        d += '<label class = "D"><input type="radio" class="D" name = "' + v['id'] + '"><span class="text-danger">D: </span>' + v['option_d'] + '</label>';
                        d += '</div>';
                        d += '</fieldset>';
                        d += '</div>';
                        index++;
                    });
                    $('#questions').html(d);
                } else {
                    $.toast({
                        heading: 'Error',
                        text: data.message,
                        showHideTransition: 'fade',
                        icon: 'error'
                    })
                }

            }
        });
    }


    //hàm đếm ngược thời gian
    function startTimer() {
        --totalSeconds;
        hours = Math.floor(totalSeconds / 3600);
        minutes = Math.floor((totalSeconds - hours * 3600) / 60);
        seconds = totalSeconds - (hours * 3600 + minutes * 60);
        $('#spRemainingTime').html(`${hours < 10 ? '0' + hours : hours}:${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`);



        if (totalSeconds == 0) {
            time_over = true;
            clearInterval();
            $("#btnFinish").click();
        }
    }

    
    function StartExamination() {
        CreateExam();
        mark = 0;
        $('#btnFinish').show();
        $('#btnSave').hide();
        $('#btnStart').hide();
        $('#divRemainingTime').show(200);
        result = []; //thiết lập mảng kết quả về mặc định là 1 mảng trống       
        totalSeconds = duration * 60;
        intervalId = setInterval(startTimer, 1000);
        startTimer();
    }
</script>