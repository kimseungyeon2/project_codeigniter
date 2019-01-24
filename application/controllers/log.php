<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//login관련

class Log extends CI_Controller {
    function __construct(){
        parent::__construct();

        $this->load->database();
        $this->load->model('member_model');
        $this->load->model('content_model');
        $this->load->model('tools');
    }
    public function index(){

    }
    public function member_form(){
      $this->load->view('memberForm');
    }

    public function member_join(){
      $id = $this->tools->requestValue('id');
        /*
        if(preg_match("/[^a-z0-9-_]/i", $id)) {
          $this->tools->checkGo('id를 다시 입력해주세요','/project/index.php/topic/main/1');
        }
        */
      $pw = $this->tools->requestValue('pw');
      /*
        $pattern = '/^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/';//비밀번호 8자리 이상 15자리 이하 소문자, 숫자, 및 특수문자 조합
        if(preg_match($pattern,$pw)){
          $this->tools->checkGo('password를 다시 입력해주세요','/project/index.php/topic/main/1');
        }
      *///조건 다시 알아볼 필요 있음
      $name = $this->tools->requestValue('name');
        if(preg_match("/[^a-z0-9-_]/i", $name)) {
          $this->tools->checkGo('Name를 다시 입력해주세요','/project/index.php/topic/main/1');
        }else{
          $addr0 = $this->tools->requestValue('addr0');
          $addr1 = $this->tools->requestValue('addr1');
          $addr2 = $this->tools->requestValue('addr2');
          $addr = $addr0.'-'.$addr1.'-'.$addr2;
          if($id&&$pw&&$name&&$addr){
            if($_FILES["myImg"]["error"] == UPLOAD_ERR_OK){
              $tnamePicture = $_FILES["myImg"]["tmp_name"];
              $fnamePicture = $_FILES["myImg"]["name"];

              $save_namePicture = iconv("utf-8","cp949",$fnamePicture);

              if(move_uploaded_file($tnamePicture,"files/$save_namePicture")){
                $this->member_model->member_insert($id,$pw,$name,$addr,$save_namePicture);
                //$this->tools->checkGo('가입완료','/project/index.php/topic/main/1');
              }else{
                $this->tools->checkGo('이미지를 채워 주세요','/project/index.php/topic/main/1');
              }
            }else{
              $this->tools->checkGo('이미지 에러','/project/index.php/topic/main/1');
            }
          }else{
            $this->tools->checkGo('빈칸을 채워 주세요','/project/index.php/topic/main/1');
          }
        }
    }
    public function login_form(){
      $this->load->view('loginForm');
    }
    public function login(){
      $id = $this->tools->requestValue('id');
      $pw = $this->tools->requestValue('pw');

      if($id&&$pw){
        $data = $this->member_model->loginMsg($id,$pw);
        if($data){
          $this->tools->SessionMake('uId',$data[0]['id']);
          $this->tools->SessionMake('uName',$data[0]['name']);
          $this->tools->checkGo('로그인성공','/project/index.php/topic/main/1');
        }else{
          $this->tools->checkGo('로그인실패','/project/index.php/topic/main/1');
        }
      }else{
        $this->tools->checkGo('빈칸을 채워주세요','/project/index.php/topic/main/1');
      }
    }

    public function logout(){
      $this->tools->SessionMake('uId','');
      $this->tools->SessionMake('uName','');
      $this->tools->checkGo('로그아웃 되었습니다.','/project/index.php/topic/main/1');
    }
    //추가 기능
    public function openCheck($id){
      $data = $this->member_model->gets($id);
      if(!$data){
        echo "사용 가능 아이디";
      }else{
        echo "사용 불가 아이디";
      }
    }

    public function mail_check($mailhead,$mailfooter){
      $mails = $mailhead."@".$mailfooter;
      $this->tools->mail_check($mails);
    }

    public function mail_checking($data){
      $this->load->view('window_mail_check');
    }





}//끝부분
?>
