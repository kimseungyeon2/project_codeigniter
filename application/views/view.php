<div class="ui grid">
  <div class="eight wide column">
    <?php if($content[0]['id'] != $uid){ ?>
      <?php for ($i=1; $i <count($kinds) ; $i++) {?>
        <button class="ui inverted orange button" type="button" name="button" onclick="chartChage('/project/index.php/topic/chartUpdate/<?=$content[0]['num']?>/<?=$i?>')">
          <?=$kinds[$i]?>
        </button>
      <?php } ?>
    <?php }else{ ?>
      <h1><i class="address card icon"></i>현재 현황 입니다.</h1>
    <?php } ?>
  </div>
  <div class="eight wide column">
    

  </div>
</div>
<hr>
