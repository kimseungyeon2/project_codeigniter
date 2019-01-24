<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/project/static/semantic/dist/semantic.min.css">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="/project/static/semantic/dist/semantic.min.js"></script>
    <script type="text/javascript" src="/project/ckeditor/ckeditor.js"></script>
    <!--<script type="text/javascript" src="http://localhost/project/nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>-->
    <script src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script><!--다음 주소 api-->
    <style media="screen">
      #head{
        margin-bottom: 30px;
      }
    </style>
</head>
<body>

  <div id="head" class="ui menu">
  <a class="header item" onclick="location.href='/project/index.php/topic/main/1'">
    Main
  </a>
  <a id="button" class="item">
    목차
  </a>
  <a class="item">
    미정
  </a>
  <a class="item" href="/project/index.php/log/logout">
    Logout
  </a>
  </div>

  <div class="ui inverted vertical masthead center aligned segment">
    <div class="ui slide masked reveal image">
        <div class="visible content">
          <div class="ui text container">
              <br>
              <br>
              <h1><i class="comment alternate outline icon"></i>게시판</h1>
              <br>
              <br>
           </div>
        </div>
        <div class="hidden content">
          <div class="ui text container">
              <br>
              <br>
              <br>
              <div class="ui inverted blue button">Get Started <i class="right arrow icon"></i></div>
              <br>
              <br>
              <br>
           </div>
        </div>
    </div>
  </div>

  <br>
  <hr>
  <!--항목바-->
  <div class="ui left demo vertical inverted sidebar labeled icon menu">
    <br>
    <h3>
      <div class="ui link list">
        <div class="active item">미정</div>
        <a class="item">1.미정</a>
        <a class="item">2.미정</a></a>
        <a class="item">3.미정</a>
      </div>
    </h3>
    <br>

    <h3>
      <div class="ui link list">
        <div class="active item">미정</div>
        <a class="item">1.미정</a>
        <a class="item">2.미정</a></a>
        <a class="item">3.미정</a>
      </div>
    </h3>
  </div>

  <script type="text/javascript">
    $(function(){
      $('#head').sticky();
      $("#button").click(function(){
        $('.ui.labeled.icon.sidebar').sidebar('toggle');
      });
    });
  </script>
