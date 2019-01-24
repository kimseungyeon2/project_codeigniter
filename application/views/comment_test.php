<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/project/static/semantic/dist/semantic.min.css">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="/project/static/semantic/dist/semantic.min.js"></script>
  </head>
  <body>
    <script type="text/javascript">
      $(function(){
        $('.a').click(function(){
          if($(this).parents('.b').children('.c').text()){
          }else{
            $(this).parents('.b').append("<div class='c'>"+
            "<span>댓글</span><input type='text' name='content' value=''>"+
            "<input type='submit' name='' value='등록'></div>");
          }
        });
        $('.d').click(function(){
          $(this).parents('.b').children('.c').remove();
        });
      });
    </script>
    <?php
    ?>

    <?php
      $parent =0;

      $redepth = 0;

      for ($i=0; $i <count($comment) ; $i++) {
        if($comment[$i]['parent'] == 0){
          ?>
            <form class="b" action="/project/index.php/topic/commentInsert" method="post">
              <input type="text" value="<?=$comment[$i]['content']?>">
              <input type="hidden" name="parent" value="<?=$comment[$i]['num']?>">
              <input type='hidden' name='redepth' value='<?=$comment[$i]['redepth']+1?>'>
              <button class="a" type="button" name="button">답글달기</button><br />
              <button class="d" type="button" name="button">취소</button>
            </form>
          <?php
          $parent = $comment[$i]['num'];
        }
        for ($s=1; $s <=4 ; $s++) {
          for ($r=0; $r <count($comment) ; $r++) {
            if($s == $comment[$r]['redepth']){
              if($parent == $comment[$r]['parent']){
                $parent = $comment[$r]['num'];
                ?>
                  <form class="b" action="/project/index.php/topic/commentInsert" method="post">
                    <input type="text" value="<?=$comment[$r]['content']?>">
                    <input type="hidden" name="parent" value="<?=$comment[$r]['num']?>">
                    <input type='hidden' name='redepth' value='<?=$comment[$r]['redepth']+1?>'>
                    <button class="a" type="button" name="button">답글달기</button><br />
                    <button class="d" type="button" name="button">취소</button>
                  </form>
                <?php
              }
            }
          }
        }
      }//대댓글


/*
    for ($i=0; $i <count($comment) ; $i++) {
      if($comment[$i]['parent'] == 0){
        echo $comment[$i]['content']."<br />";
        $parent = $comment[$i]['num'];
      }
      for ($s=0; $s <3 ; $s++) {
        for ($r=0; $r <count($comment) ; $r++) {
          if($s == $comment[$r]['redepth']){
            if($parent == $comment[$r]['parent']){
              $parent = $comment[$r]['num'];
              echo "<hr />".$comment[$r]['content']."<br>";
            }
          }
        }
      }

      }
*/

     ?>

    <form class="" action="/project/index.php/topic/commentInsert" method="post">
      <div class="">
        <span>댓글</span><input type="text" name="content" value="">
        <input type="submit" name="" value="등록">
      </div>
    </form>
  </body>
</html>
