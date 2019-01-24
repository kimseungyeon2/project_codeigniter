<?php
class Tools extends CI_Model
{
    function __construct(){
        parent::__construct();
    }
    function requestValue($name){
      return isset($_REQUEST[$name])?$_REQUEST[$name]:"";
    }//request 받은 값
    function readSessionVar($name){
      if(session_status() == PHP_SESSION_NONE){
        session_start();
      }
      $result = isset($_SESSION[$name])?$_SESSION[$name]:"";
      return $result;
    }//세션 값
    function SessionMake($name,$value){
      if(session_status() == PHP_SESSION_NONE){
        session_start();
      }
      $_SESSION[$name] =  $value;
    }//세션 생성
    function checkGo($msg,$url){
      ?>
        <script type="text/javascript">
          alert('<?= $msg ?>');
          location.href = '<?=$url?>';
          exit();
        </script>
      <?php
    }//체크 돌아기기
    function checkMsg(){
      ?>
        <script type="text/javascript">
          function checkMsg(url,value){
            var result = confirm("Are you sure");
            if(result){
              location.href=url+'/'+value;
            }
          }
        </script>
      <?php
    }
    function goUrl($url){
      ?>
        <script type="text/javascript">
          location.href='<?=$url?>';
        </script>
      <?php
    }
    function modal(){
      ?>
      <script type="text/javascript">
        function button(name){
          $.ajax({
              async : false,
              type: "post",
              url:name,
              success:function(data) {
              $('#container').html(data);}
            });
          $('.ui.modal').modal('show');
        };
    </script>
    <?php
    }//모달창 띄우기 위한 것
    function makeChart($data_php,$data_php_num){
      ?>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

      <?php
      $data = $data_php;
      $data_num = $data_php_num;
      ?>
      <script type="text/javascript">
        function data_s(){
          var data_script ='<?=$data?>';
          var data_script_num = '<?=$data_num?>';
          //var data= data_script.split('"');
          var data = data_script.split('/');
          var data_num = data_script_num.split('/');
          var data_arr =new Array();
          data_arr[0] = new Array();
          data_arr[0][0] = "항목";
          data_arr[0][1] = "항목";

          for (var i = 1; i <= data.length; i++) {
            data_arr[i] =new Array();
            data_arr[i][0] = data[i];
            data_arr[i][1] = parseInt(data_num[i]);
          };

          return data_arr;
        }//스크립트에서 항목들을 정리해서 뱉어내는 함수

         var data_arr = data_s();

          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable(data_arr);

            var options = {
              title: "현황보기"
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }
      </script>
      <?php
    }//end
    function chart_check(){
      ?>
        <script type="text/javascript">
        function chartChage(url){
          $.ajax({
            async :true,
            url: url,
            type:'POST',
                success:function(data) {
                    $('#chart').append($('#piechart').append(data));
                },
                error: function(jqXHR, textStatus, errorThrown){
                  alert('실패');
                }
            });
        }
        </script>
      <?php
  }//end
  function mail_check($mymail){
    require_once('./PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();

    $mail->ContentType = "text/html";

    //전송시 한글 깨짐 방지
    $mail->Charset = 'UTF-8';
    $mail->SMTPSecure = 'ssl';

    $mail->isSMTP();
    // $mail->SMTPDebug = 2;//디버그용 문자출력 코드

    $subject = "사이트 소개 사이트 메일 확인";
    $mail_from  = "master";
    $mail_to  = $mymail;

    //제목과 보내는 사람 이름 등등은 직접적으로 인코딩 변경
    $subject = "=?UTF-8?B?".base64_encode($subject)."?="."\r\n";
    $mail_from = "=?UTF-8?B?".base64_encode($mail_from )."?="."\r\n";
    $mail_to = "=?UTF-8?B?".base64_encode($mail_to)."?="."\r\n";
    $random = mt_rand(1, 10000);
    $message =  "인증 번호를 입력하세요.".$random."";

    $mail->Debugoutput = 'html';

    $mail->Host = 'smtp.naver.com';

    $mail->Port = 465;
    $mail->SMTPAuth = true;

    $mail->Username = "mymr0796@naver.com";

    $mail->Password = "976smreockrgka";

    $mail->setFrom('mymr0796@naver.com', $mail_from);

    $mail->addReplyTo('mymr0796@naver.com', $mail_from);

    $mail->addAddress($mymail, $mail_to);

    $mail->Subject = $subject;

    $mail->msgHTML($message, dirname(__FILE__));

    $mail->AltBody = 'This is a plain-text message body';

    if (!$mail->send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      echo $random;
    }

}//mail_check end
}//end
?>
