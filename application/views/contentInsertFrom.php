<script type="text/javascript">
  $(function(){
    $('#add').click(function(){
      if($('#text').val()){
        $('#add_tag').append("<div class='four wide column'>"+"<input type='text' name='kinds[]' value='"+$('#text').val()+"'>"+"</div>");
        $('#text').val('');
      }else{
        alert('내용을 입력하세요.');
      }
    });
    $('#minus').click(function(){
      $('#add_tag').children().last().remove();
    });
  });
</script>

 <div class="ui internally celled grid">
  <div class="row">
    <div class="three wide column">
    </div>
    <div class="ten wide column">

      <form class="ui form" name="nse" action="contentInsert" method="post" enctype="multipart/form-data">
          <div class="field">
            <label for="title">제목</label>
            <input type="text" name="title" value="">
          </div>
          <div for="myImg" class="field">
            <label>myImg</label>
            <input type='file' id="imgInput" multiple accept="image/*" name="firstImg" />
            <img id="image_section" src="#" alt="my image" width="150" height="150"/>
          </div>
          <div for="url" class="field">
            <label>url</label>
            <input type='text' name="url" value="" />
          </div>
          <div class="field">
            <div class="ui grid">

              <div class="ten wide column">
                <label for="">항목</label>
                <br>
                <div class="ui two column grid">
                  <div class="row">
                    <div class="column">
                      <input id="text" type="text" name="" value="">
                    </div>
                    <div class="column">
                      <div class="ui buttons">
                        <input id="add" class="ui inverted violet button" type="button" value="추가">
                        <div class="or" data-text="ou"></div>
                        <input id="minus" class="ui inverted violet button" type="button" value="삭제">
                      </div>
                    </div>
                  </div>
                </div>
                <div id="add_tag" class="ui grid">
                </div>
              </div>
            </div>
          </div>
          <textarea name="content" id="ir1" class="nse_content" rows="20" cols="110" ></textarea>
          <script type="text/javascript">

            CKEDITOR.replace('content',{
              filebrowserUploadUrl:
              'contentInsert_file?type=image'//type 안넣어서 존나 시간버림
              //extraPlugins : 'uploadimage' ? 코레 나니 ??

            });

          </script>
          <br>
          <input class="ui inverted violet button" type="submit" value="전송" onclick="submitContents(this)" />
      </form>
    </div>
    <div class="three wide column">
    </div>
  </div>
</div>

<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#image_section').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}//이미지를 붙이기 위한 함수

$("#imgInput").change(function(){
  readURL(this);
});//함수 실행부분
</script>
