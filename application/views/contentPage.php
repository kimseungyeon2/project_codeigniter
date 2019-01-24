<div class="ui grid">
  <div class="row">
    <div class="three wide column">
    </div>
    <div class="ten wide column">
      <div class="ui fluid icon input">
        <input type="text" value="<?=$content[0]['title']?>">
      </div>
      <br>
      <div class="ui fluid icon input">
        <input type="text" value="<?=$content[0]['url']?>">
      </div>
      <br>
      <div id="piechart" style="width: 900px; height: 500px;"></div>
      <div class="ui segment">
        <?=$content[0]['content']?>
      </div>
      <br>
      <div class="ui right">
        <div class="ui buttons">
          <button class="ui inverted purple button" onclick="location.href='/project/index.php/topic/contentUpdate_form/<?=$content[0]['num']?>'">수정</button>
          <div class="or"></div>
          <button class="ui inverted pink button" onclick="checkMsg('/project/index.php/topic/contentDelete/<?=$content[0]['num']?>','정말 삭제 하시겠습니까?')">삭제</button>
          <div class="or"></div>
          <button class="ui inverted purple button" onclick="location.href='/project/index.php/topic/person_page/<?=$id?>'">돌아가기</button>
        </div>
      </div>
    </div>
    <div class="three wide column"></div>
 </div>
</div>
<br>
<script type="text/javascript">
  function checkMsg(url,msg){
    var result = confirm(msg);
    if(result){
      location.href=url;
    }
  }
</script>
