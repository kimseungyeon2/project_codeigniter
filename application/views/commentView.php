<script type="text/javascript">
  function wirte(){
    if($(this).parents().children().text()){
    }else{
      $(this).parents().append("<div class='c'>"+
      "<span>댓글</span><input type='text' name='content' value=''>"+
      "<input type='submit' name='' value='등록'></div>");
    }
  }

  function wirteDelete(){
    $(this).parents().children().remove();
  }
</script>
<div class="ui container">


<div class="ui grid">
  <div class="two column row">
    <div class="column">
      <div class="ui comments">
        <div class="comment">
            <!--댓글 부분-start-->
            <?php for ($i=0; $i <count($comment); $i++) { ?>
              <?php if($num == $comment[$i]['sortNum']){ ?>
              <a class="avatar" style="height:5%;width:5%;">
                <img src="/project/files/ju.jpg" alt="회원사진" style>
              </a>
              <div class="content">
                <a class="author"><?=$comment[$i]['id']?></a>
                <div class="metadata">
                  <div class="date"><?=$comment[$i]['createTime']?></div>
                </div>
                <div class="text">
                  <?=$comment[$i]['content']?>
                </div>
                <div class="actions">
                  <a class="reply active" href="/project/index.php/topic/commentDelete/<?=$comment[$i]['num']?>/<?=$comment[$i]['id']?>/<?=$num?>">삭제</a>
                  <a class="reply active" onclikc="wirte()">답글달기</a>
                </div>
              </div>
              <hr>
              <?php } ?>
            <?php } ?>
            <!--댓글 부분-end-->
            <?php
            ?>
                <form class="ui reply form" action="/project/index.php/topic/commentInsert/<?=$num?>" method="post">
                  <input type="hidden" name="parent" value="">
                  <input type="hidden" name="father" value="">
                  <input type="hidden" name="pageNo" value="<?=$num?>">
                  <div class="field">
                    <textarea name="content"></textarea>
                  </div>
                  <input class="ui inverted green button" type="submit" name="" value="댓글작성">
                </form>
            <?php
             ?>
          </div>
        </div>
    </div>
    <div class="column">
      <div class="ui sticky">
        <div class="column">
          <?php for ($i=0; $i <count($topic); $i++){?>
            <sapn>사이트가보기:</sapn><a href="<?=$topic[$i]['url']?>"><?=$topic[$i]['url']?></a>
            <h1><?=$topic[$i]['title']?></h1>
            <img src="/project/files/<?=$topic[$i]['firstImg']?>" alt="" style="height:50%;width:50%;">
            <h1><?=$topic[$i]['content']?></h1>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</div>
<script type="text/javascript">
  $(function(){
    $('.ui.sticky').sticky();
  })
</script>
