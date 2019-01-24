<br>
<br>
<div class="ui three column grid">
  <div class="row">
    <div class="four wide column"></div>
    <div class="eight wide column">

<form class="ui form" action="/project/index.php/log/member_join" method="post" enctype="multipart/form-data">

  <div for="myImg" class="field">
    <label>내사진</label>
    <input type='file' id="imgInput" multiple accept="image/*" name="myImg" />
    <img id="image_section" src="#" alt="my image" width="150" height="150"/>
  </div>

<!--
  <div class="field">
    <label for="id">ID</label>
    <input id ="id" type="text" name="id" placeholder="아이디">
    <h6 id="idT">ID는 영문자와,숫자,(-,_)특수문자만 가능합니다.</h6>
    <button class="ui inverted blue button" type="button" name="button" onclick="id_check()">중복확인</button>
  </div>
-->
  <div id="id_head"class="field">
    <label for="id">Mail</label>
    <input id ="id" type="email" name="id" placeholder="아이디">
    <h6 id="idT">메일을 인증해 주세요</h6>
    <button class="ui inverted blue button" type="button" name="button" onclick="mail_check()">메일인증</button>
  </div>

  <div for="pw" class="field">
    <label>password</label>
    <input id="pw" type="password" name="pw" placeholder="패스워드">
    <h6 id="pwT">비밀번호는 영문자와,숫자,특수문자 를 섞어서 입력해주세요</h6>
  </div>

  <div for="name" class="field">
    <label>Name</label>
    <input id="name" type="text" name="name" placeholder="이름">
    <h6 id="nameT">Name는 영문자와,숫자,(-,_)특수문자만 가능합니다.</h6>
  </div>
  <hr>
  <div for="addr" class="field">
    <label>우편주소</label>
    <input type="text" name="addr0"/>
    <label>주소</label>
    <input type="text" name="addr1"  readonly />
    <label>상세주소</label>
    <input type="text" name="addr2" />
    <button class="ui inverted blue button" type="button" onclick="openZipSearch()">검색</button><br>
  </div>
  <hr>
  <button id="submit" class="ui inverted blue button" type="button">회원가입</button>
</form>

    </div>
    <div class="two wide column"></div>
  </div>
</div>

<script type="text/javascript">
$(function(){
  var pattern = /([^a-zA-Z0-9-_])/;
  var pattern2 = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,16}$/;//비밀번호 8자리 이상 15자리 이하 소문자
/*
  $('#id').keyup(function(){
    var id = $('#id').val();
    if(pattern.test(id)){
      $('#idT').css("color","red");
      $('#submit').attr("type","text");
    }
    else{
      $('#idT').css("color","black");
    }
  });
*/
  $('#pw').keyup(function(){
    var pw = $('#pw').val();
    if(!pattern2.test(pw)){
      $('#pwT').css("color","red");
    }
    else{
      $('#pwT').css("color","black");
    }
  });

  $('#name').keyup(function(){
    var name = $('#name').val();
    if(pattern.test(name)){
      $('#nameT').css("color","red");
    }
    else{
      $('#nameT').css("color","black");
    }
  });
});
//정규 표현식 공식들
</script>
<!--
<script language="javascript" type="text/javascript">

function openWin(){
  var id = $('#id').val();
  if(id){
    window.open("/project/index.php/log/openCheck/"+id+"", "중복확인", "width=200, height=200, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
  }else{
    alert('id를 입력후 중복확인을 해주세요');
  }
}
//open window
</script>
-->
<script type="text/javascript">
  $(function(){
    $("#submit").click(function(){
      if($('#id').val() == ""){
        alert('id를 입력후 로그인 해주세요');
      }else{
        $("#submit").attr("type","submit");
      }
    })
  })
  function id_check(){
    var id = $('#id').val();
    $.ajax({
      async :true,
      url: "/project/index.php/log/openCheck/"+id+"",
      type:'POST',
          success:function(data) {
            alert(data);
            if(data == "사용 불가 아이디"){
              $('#id').val('');
              $('#id').children('#check').remove();
            }
            else if(data == "사용 가능 아이디"){
              $('#id').css("color","blue");
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            alert('잘못된 문자가 들어갔습니다.');
          }
      });
  }//로그인 중복 체크 함수

  function mail_check(){
    var mail = $('#id').val();
    mail = mail.split('@');
    $.ajax({
      async :true,
      url: "/project/index.php/log/mail_check/"+mail[0]+"/"+mail[1]+"",
      type:'POST',
          success:function(data) {
            var check_num = prompt("인증하시오-(현재 윈도우창 을 이동 닫지 말고 다른 창을 열어 확인해 주세요)");
            if(check_num == data){
              alert("인증성공");
              $('#id').css("color","blue");
            }
            else{
              alert("인증실패");
              $('#id').val('');
            }
          },
          error: function(jqXHR, textStatus, errorThrown){
            alert('오류!-2번 이메일을 다시 입력해 주세요.');
          }
      });
  }

</script>

<script type="text/javascript">
function readURL(input) { //사진 보여주기 함수.

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


function openZipSearch() {//주소 관련 api 함수
	new daum.Postcode({
		oncomplete: function(data) {
			$('[name=addr0').val(data.zonecode); // 우편번호 (5자리)
			$('[name=addr1').val(data.address);
			$('[name=addr2').val(data.buildingName);
		}
	}).open();
}
</script>
