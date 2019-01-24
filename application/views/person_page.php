<h2 class="ui center aligned icon header">
  <i class="user secret icon"></i>
  개인 페이지
</h2>
<div class="ui internally celled grid">
  <div class="row">
    <div class="three wide column">
    </div>

    <div class="ten wide column">

      <div class="ui grid">
        <?php for ($i=0; $i <count($content) ; $i++) {?>
          <div class="four wide column">
            <div class="ui special cards">
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui inverted button" onclick="location.href='/project/index.php/topic/contentPage/<?=$content[$i]['num']?>'">자세히 보기</div>
                      </div>
                    </div>
                  </div>
                  <a class="image" href="#">
                    <div class="" style="height:170px;width:100%;">
                      <img src="/project/files/<?=$content[$i]['firstImg']?>" height="100%" width="100%">
                    </div>
                  </a>
                </div>
                <div class="content">
                  <a class="header"><?=$content[$i]['title']?></a>
                  <div class="meta">
                    <span>등급:</span>
                    <span class="date"></span>
                    <br>
                    <span>종류:</span>
                    <span class="date"><?=$content[$i]['Kinds']?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="three wide column">
    </div>
  </div>
</div>




<script type="text/javascript">
  $(function(){
    $('.special.cards .image').dimmer({on: 'hover'});
  })
</script>
