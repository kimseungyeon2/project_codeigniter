<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//content관련

class Topic extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->model('member_model');
        $this->load->model('content_model');
        $this->load->model('tools');
    }

	public function index(){

  }
  //main
  public function main($page){
    $this->tools->modal();
    $this->load->view('head');
    //head
    $uid = $this->tools->readSessionVar('uId');
    $uname = $this->tools->readSessionVar('uName');
    if($uid&&$uname){
      $data = $this->member_model->gets($uid);
      $this->load->view('navbar.php', array('data'=>$data));
    }else{
      $data = "";
      $this->load->view('navbar.php', array('data'=>$data));
    }
    //navbar
    $db_startPage = ($page*10)-10;
    $content = $this->content_model->selectContent_page($db_startPage,10);

    $maxPage = count($this->content_model->selectContent_all());
    $maxPage = ceil($maxPage/10);
    //maxPage 구하기
    $this->load->view('main',array('content'=>$content,'page'=>$page,'maxPage'=>$maxPage));
    //main
    $this->load->view('footer');
    //footer
  }//end
  //mian하부
  public function mainview($num){
    $uid = $this->tools->readSessionVar('uId');
    $content = $this->content_model->selectContent_num($num);
    $this->content_model->update_hists($uid,$num);
    $this->load->view('head');
    $kinds =explode('/',$content[0]['Kinds']);
    $this->chart($num,$content);
    $this->tools->chart_check();
    $this->load->view('view',array('content'=>$content,'kinds'=>$kinds,'uid'=>$uid));
    $this->commentView($num,$content);
    $this->load->view('footer');
  }//end

  public function chartUpdate($num,$kinds_num){
    $uid = $this->tools->readSessionVar('uId');
    $content = $this->content_model->selectContent_num($num);
    $check = $this->content_model->select_check_chart($uid,$content[0]['num']);
    if($uid){
      if($check){
        ?>
        <script type="text/javascript">
          alert("이미 투표 함");
        </script>
        <?php
      }else{
        $this->content_model->insert_check_chart($uid,$content[0]['title'],$content[0]['num']);

        $kindsNum = explode('/',$content[0]['kindsNum']);
        $kindsNum[$kinds_num] = $kindsNum[$kinds_num]+1;
        $kindsNums='';
        for ($i=1; $i <count($kindsNum) ; $i++) {
          $kindsNums = $kindsNums.'/'.$kindsNum[$i];
        }
        if($kindsNums){
          $this->content_model->updateKindsNum($kindsNums,$num);
          $title = $content[0]['title'];
          $titleNum = $content[0]['num'];
          ?>
          <script type="text/javascript">
            alert("투표완료!");
          </script>
          <?php
          $this->chart($num);
        }else{
          $this->tools->checkGo('오류','/project/index.php/topic/main/1');
        }
      }
    }else{
      ?>
      <script type="text/javascript">
        alert("회원만 투표 가능");
      </script>
      <?php
    }
  }//end
  public function chart($num){
    $content = $this->content_model->selectContent_num($num);
    $kinds =explode('/',$content[0]['Kinds']);
    $this->tools->makeChart($content[0]['Kinds'],$content[0]['kindsNum']);
    $this->load->view('chart.php',array('content'=>$content,'kinds'=>$kinds));
  }//end


  public function person_page($check){
    $this->load->view('head');
    $uid = $this->tools->readSessionVar('uId');
    if($uid){
      $data = $this->content_model->selectContent_id($check);
      $this->load->view('person_page',array('content'=>$data));
    }else{
      $this->tools->checkGo('잘못된 접근입니다.','/project/index.php/topic/main/1');
    }
    $this->load->view('footer');
  }//개인 이 올린 자료들 보기//end
  public function contentPage($num){
    $uid = $this->tools->readSessionVar('uId');
    $this->load->view('head');
    if($uid){
      $content = $this->content_model->selectContent_num($num);
      $this->tools->makeChart($content[0]['Kinds'],$content[0]['kindsNum']);

      $this->load->view('contentPage',array('content'=>$content,'id'=>$uid));
    }
    $this->load->view('footer');
  }//개인 이 올린 자료 자세히 보기
  //insert
  public function contentInsert_from(){
    $uid = $this->tools->readSessionVar('uId');
    $uname = $this->tools->readSessionVar('uName');
    $this->load->view('head');
    $this->load->view('contentInsertFrom');
    $this->load->view('footer');
  }

  public function contentInsert(){
    $id = $this->tools->readSessionVar('uId');
    $title = $this->tools->requestValue('title');
    $content = $this->tools->requestValue('content');
    $kind = $this->tools->requestValue('kinds');
    $url = $this->tools->requestValue('url');
    $kinds ='';
    $kindsNum ='';
    for ($i=0; $i <count($kind) ; $i++) {
      $kinds = $kinds.'/'.$kind[$i];
      $kindsNum = $kindsNum.'/'.'1';
    }
    if($id){
      if($title&&$content&&$kinds&&$url){
        if($_FILES["firstImg"]["error"] == UPLOAD_ERR_OK){
          $tnamePicture = $_FILES["firstImg"]["tmp_name"];
          $fnamePicture = $_FILES["firstImg"]["name"];
          $save_namePicture = iconv("utf-8","cp949",$fnamePicture);
          if(move_uploaded_file($tnamePicture,"files/$save_namePicture")){
            $this->content_model->insertContent($id,$title,$save_namePicture,$content,$kinds,$url,$kindsNum);
            $this->tools->checkGo('작성되었습니다.','/project/index.php/topic/main/1');
          }else{
            $this->tools->checkGo('이미지를 채워 주세요','/project/index.php/topic/main/1');
          }
        }else{
          $this->tools->checkGo('이미지 에러','/project/index.php/topic/main/1');
        }
      }else{
        $this->tools->checkGo('빈칸을 채워주세요','/project/index.php/topic/main/1');
      }
    }else{
      $this->tools->checkGo('허용된 사용자가 아닙니다.','/project/index.php/topic/main/1');
    }
  }
  public function contentInsert_file(){//ckditor의 이미지 업로드를 위한 부분
    if($_FILES["upload"]["error"] == UPLOAD_ERR_OK){
      $tnamePicture = $_FILES["upload"]["tmp_name"];
      $fnamePicture = $_FILES["upload"]["name"];
      $url = '/project/files/'.$fnamePicture;//경로 지정 중요
      $save_namePicture = iconv("utf-8","cp949",$fnamePicture);
      if(move_uploaded_file($tnamePicture,"files/$save_namePicture")){
        echo '{"filename" : "'.$fnamePicture.'", "uploaded" : 1, "url":"'.$url.'"}';
      }else{
        echo "<script>alert('오류');</script>";
      }
    }else{
      echo "<script>alert('오류');</script>";
    }
    //CKeditor4버전 이상 부터는 콜백 함수가 아닌 json으로 보내주기 때문에 성공했을시 다시 editor로 넘겨줄 것을 echo 에 찍혀 있는 것처럼 보내야 함
  }
  //update
  public function contentUpdate_form($num){
    $content = $this->content_model->selectContent_num($num);
    $this->load->view('head');
    $this->load->view('contentUpdateForm',array('content'=>$content));
    $this->load->view('footer');
  }
  public function contentUpdate($num){
    $id = $this->tools->readSessionVar('uId');
    $title = $this->tools->requestValue('title');
    $content = $this->tools->requestValue('content');
    $kind = $this->tools->requestValue('kinds');
    $url = $this->tools->requestValue('url');
    $kinds ='';
    for ($i=0; $i <count($kind) ; $i++) {
      $kinds = $kinds.'/'.$kind[$i];
    }
    if($id){
      if($title&&$content&&$kinds&&$url){
        if($_FILES["firstImg"]["error"] == UPLOAD_ERR_OK){
          $tnamePicture = $_FILES["firstImg"]["tmp_name"];
          $fnamePicture = $_FILES["firstImg"]["name"];
          $save_namePicture = iconv("utf-8","cp949",$fnamePicture);
          if(move_uploaded_file($tnamePicture,"files/$save_namePicture")){
            $this->content_model->updateContent($title,$save_namePicture,$content,$kinds,$num,$url);
            $this->tools->checkGo('수정되었습니다.','/project/index.php/topic/main/1');
          }else{
            $this->tools->checkGo('빈칸을 채우세요','/project/index.php/topic/main/1');
          }
        }else{
          $save_namePicture = "";
          $this->content_model->updateContent($title,$save_namePicture,$content,$kinds,$num,$url);
          $this->tools->checkGo('수정되었습니다.','/project/index.php/topic/main/1');
        }
      }else{
        $this->tools->checkGo('빈칸을 채워주세요','/project/index.php/topic/main/1');
      }
    }else{
      $this->tools->checkGo('허용된 사용자가 아닙니다.','/project/index.php/topic/main/1');
    }
  }
  //delete
  public function contentDelete($num){
    $uid = $this->tools->readSessionVar('uId');
    if($uid){
      $this->content_model->deleteContent($num);
      $this->tools->checkGo("삭제 되었습니다.", "/project/index.php/topic/person_page/$uid");
    }else{
      $this->tools->checkGo('허용된 사용자가 아닙니다.','/project/index.php/topic/main/1');
    }
  }
//댓글 관련 창
  public function commentView($num,$topic){
    $comment = $this->content_model->commentSelect();
    $this->load->view('commentView.php',array('comment'=>$comment,'num'=>$num,'topic'=>$topic));
  }
  public function commentInsert($num){
    $uid = $this->tools->readSessionVar('uId');
    if($uid){
      $parent = $this->tools->requestValue('parent');
      $content = $this->tools->requestValue('content');
      $redepth = $this->tools->requestValue('redepth');
      $pageNo = $this->tools->requestValue('pageNo');
      $this->content_model->commmentInsert($uid,$content,$parent,$pageNo);
      $this->tools->checkGo("댓글작성 완료","/project/index.php/topic/mainView/$num");
    }else{
      $this->tools->checkGo("허용된 사용자가 아닙니다.","/project/index.php/topic/mainView/$num");
    }
  }
  public function commentDelete($comment_num,$id,$num){
    $uid = $this->tools->readSessionVar('uId');
    if($uid == $id){
      $this->content_model->commentDelete($comment_num);
        $this->tools->checkGo("삭제 완료","/project/index.php/topic/mainView/$num");
    }else{
      $this->tools->checkGo("권한이 없습니다.","/project/index.php/topic/mainView/$num");
    }
  }

}//end-end
?>
