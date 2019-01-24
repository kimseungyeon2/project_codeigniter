<?php
  $startPage = (floor(($page-1)/10)*10)+1;
  $endPage = floor(($page+9)/10)*10;

  if($endPage > $maxPage){
    $endPage = $maxPage;
  }else{

  }
 ?>
 <div class="ten wide column">

   <div class="ui grid">
     <?php for ($i=0; $i<count($content); $i++) {?>
       <div class="four wide column">
         <div class="ui special cards">
           <div class="card">
             <div class="blurring dimmable image">
               <div class="ui dimmer">
                 <div class="content">
                   <div class="center">
                     <div class="ui inverted button" onclick="location.href='/project/index.php/topic/mainView/<?=$content[$i]['num']?>'">자세히보기</div>
                   </div>
                 </div>
               </div>
                <div class="" style="height:170px;width:100%;">
                  <img src="/project/files/<?=$content[$i]['firstImg']?>" height="100%" width="100%">
                </div>
              </div>
             <div class="content">
               <a class="header"><?=$content[$i]['title']?></a>
               <div class="meta">
                 <span>작성자</span>
                 <span class="date"><?=$content[$i]['id']?></span>
                 <br>
                 <span>작성일자</span>
                 <span class="date"><?=$content[$i]['createTime']?></span>
                 <br>
                 <span><i class="hand point right outline icon"></i>조회수</span>
                 <span class="date"><?=$content[$i]['hists']?></span>
               </div>
             </div>
           </div>
         </div>
       </div>
     <?php } ?>
   </div>


<!--페이지 네이션 -->
   <div class="ui centered grid">
       <div class="ui pagination menu">
         <?php if(!($startPage<10)){  ?>
           <a class="item" href="../main/<?=$startPage-10?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
             <<
           </font></font></a>
         <?php } ?>

         <?php for ($i=$startPage; $i<=$endPage ; $i++) { ?>
           <a class="item" href="../main/<?=$i?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
             <?php if($i == $page){?>
               <i class="hand point down outline icon"></i><b><?=$i?></b>
             <?php }else{?>
                  <?=$i?>
             <?php }?>
           </font></font></a>
         <?php } ?>

         <?php if(floor($endPage-1/10)*10>$page){ ?>
           <a class="item" href="../main/<?=$endPage+1?>"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
             >>
           </font></font></a>
         <?php } ?>
       </div>
   </div>
   <br>
</div>

<!--도구바-->
  <div class="two wide column">

    <div class="ui sticky" >
      <div class="ui labeled icon vertical menu" style="margin-top:60px">
        <a class="item"><i class="truck icon"></i> 미정</a>
        <a class="item"><i class="truck icon"></i> 미정</a>
        <a class="item"><i class="mail icon"></i> 미정</a>
      </div>
    </div>

  </div>

  </div>
</div>

<script type="text/javascript">
  $(function(){
    $('.special.cards .image').dimmer({on: 'hover'});
  })
</script>
