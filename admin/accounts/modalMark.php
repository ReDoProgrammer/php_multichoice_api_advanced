<div id="modalMarks" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="mdlTitle">Kết quả bài thi</h4>
      </div>
      <div class="modal-body">
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
      <div class="modal-footer">        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  $(document).on('click',"input[name='viewExamDetail']",function() {
		index = 1;
    count = 0;
    var trid = $(this).closest('tr').attr('id'); // lấy id của dòng đc chọn trên table khi click vào
 
    console.log(trid)
     $.ajax({
      url:'load-chitiet-baithi.php',
      type:'get',
      data:{id:trid},
      success:function(data){          
        let result = JSON.parse(data);
       let questions = JSON.parse(result.questions);

       $('#modalChiTiet').modal();
        questions.forEach(q=>{
          $('#mdBody').empty();
          GetQuestion(q)
        })
     
      }
     })

});

function GetQuestion(question){
  $.ajax({
    url:'get-question.php',
    type:'get',
    data:{id:question.id},
    success:function(data){
     
      q = jQuery.parseJSON( data);
     console.log(q.answer);
      
     
      
      let d = '';
 
        d+=   '<div class="row" style = "margin-left:10px;" id="question_'+q.id+'"> ';
        d+=   '<h5 style="font-weight:bold;" id="'+q.id+'"> <span class="text-danger">Câu '+index+': </span>'+q.question+'</h5>';

        d +=   '<fieldset>';
        d+=   '<div class="radio col-md-12 ">';
        if(question.choice == 'A'){
          d+=    '<label class = "A"><input type="radio" onclick="return false;" checked class="A" name = "'+q.id+'"><span class="text-danger">A: </span>'+q.option_a+'</label>';
        }else{
          d+=    '<label class = "A"><input type="radio" onclick="return false;"  class="A" name = "'+q.id+'"><span class="text-danger">A: </span>'+q.option_a+'</label>';
        }
        
        d+=   '</div>';

        d+=  ' <div class="radio col-md-12">';
        if(question.choice == 'B'){
          d+=    '<label class = "B"><input type="radio"  checked onclick="return false;" class="B" name = "'+q.id+'"><span class="text-danger">B: </span>'+q.option_b+'</label>';
        }else{
          d+=    '<label class = "B"><input type="radio"  onclick="return false;" class="B" name = "'+q.id+'"><span class="text-danger">B: </span>'+q.option_b+'</label>';
        } 
        d+=   '</div>';

        d+=   '<div class="radio  col-md-12">';
        if(question.choice == 'C'){
        d+=     '<label class = "C"><input type="radio" onclick="return false;" checked class="C" name = "'+q.id+'"><span class="text-danger">C: </span>'+q.option_c+'</label>';
        }else{
          d+=     '<label class = "C"><input type="radio" onclick="return false;" class="C" name = "'+q.id+'"><span class="text-danger">C: </span>'+q.option_c+'</label>';
        }
        d+=   '</div>';

        d+=   '<div class="radio col-md-12">';
        if(question.choice == 'D'){
        d+=     '<label class = "D"><input type="radio" onclick="return false;" checked class="D" name = "'+q.id+'"><span class="text-danger">D: </span>'+q.option_d+'</label>';
        }else{
          d+=     '<label class = "D"><input type="radio" onclick="return false;" class="D" name = "'+q.id+'"><span class="text-danger">D: </span>'+q.option_d+'</label>';
        }
        d+=   '</div>';
        d+=  '</fieldset>';
        d+= '</div>';
        index++;
     
      $('#mdBody').append(d);
      $('#question_'+question.id+' > fieldset > div > label.'+q.answer).css("background-color", "yellow");
    }
  });
}
</script>