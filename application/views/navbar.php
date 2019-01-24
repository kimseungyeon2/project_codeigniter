<div class="ui internally celled grid">
  <div class="row">
    <div class="three wide column">
      <div class="ui sticky">

      <?php if($data){ ?>
      <div class="ui container">
        <div class="ui cards">
          <div class="card" style="margin-top:70px">
            <div class="content">
              <img class="right floated mini ui image" src="/project/files/<?=$data[0]['picture']?>" alt="이미지">
              <div class="header">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    <?=$data[0]['name']?>
                  </font>
                </font>
              </div>

              <div class="meta">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    ID:<?=$data[0]['id']?>
                  </font>
                </font>
              </div>
              <div class="description">
                <font style="vertical-align: inherit;">
                  <font style="vertical-align: inherit;">
                    주소:<?=$data[0]['addr']?>
                  </font>
                </font>
              </div>
            </div>

            <div class="extra content">
              <div class="ui three buttons">
                <div class="ui basic green button">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      <a href="/project/index.php/topic/person_page/<?=$data[0]['id']?>">내글보기</a>
                    </font>
                  </font>
                </div>
                <div class="ui basic red button">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      <a href="/project/index.php/topic/contentInsert_from">새글등록</a>
                    </font>
                  </font>
                </div>
                <div class="ui basic green button">
                  <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                      <a href="/project/index.php/log/logout">로그아웃</a>
                    </font>
                  </font>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    <?php }else{ ?>
      <div class="ui buttons">
        <button class="ui inverted blue button" onclick="button('/project/index.php/log/login_form')">
          <i class="user icon" ></i>로그인
        </button>
        <div class="or"></div>
        <button class="ui positive button" onclick="button('/project/index.php/log/member_form')">
          <i class="address book outline icon"></i>회원가입
        </button>
      </div>
    <?php } ?>
    <hr>


    <div class="ui modal" id="container">
      <!--모달창 용-->
    </div>

    </div>
  </div>



  <script type="text/javascript">
    $(function(){
      $('.ui.sticky').sticky();
      $('.special.cards .image').dimmer({on: 'hover'});
    });
  </script>
