<?php

class Content_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }//end
    function selectContent_all(){
      $sql = "select * from content";
      return $this->db->query($sql)->result_array();
    }//end
    function selectContent_page($db_startPage,$count){
      $sql = "select * from content order by num desc limit ?, ?";
      return $this->db->query($sql,array($db_startPage,$count))->result_array();
    }//end
    function selectContent_id($id){
      $sql = "select * from content where id=?";
      return $this->db->query($sql, array($id))->result_array();
    }//end
    function selectContent_num($num){
      $sql = "select * from content where num=?";
      return $this->db->query($sql, array($num))->result_array();
    }//end
    function update_hists($id,$num){
      $sql = "select * from hists_check where checkNum = ?";
      $checkResult = $this->db->query($sql,array($num))->result_array();
      if(!$checkResult){
        $sql = "update content set hists=hists+1 where num=?";
        $this->db->query($sql, array($num));
        $sql = "insert into hists_check(id,checkNum) values(?,?)";
        $this->db->query($sql,array($id,$num));
      }else{

      }
    }//end
    function insertContent($id,$title,$firstImg,$content,$kinds,$url,$kindsNum){//kindsNum
      $sql = "insert into content(id,title,firstImg,content,kinds,createTime,url,kindsNum) values(?,?,?,?,?,?,?,?)";
      $this->db->query($sql, array($id,$title,$firstImg,$content,$kinds,date("Y-m-d H:i:s"),$url,$kindsNum));
    }//end
    /*
    //chart insert
    function insertContentChart($id,$title,$kinds){
      $sql = "insert into chart(id,title,kind,kindNum) values(?,?,?,?)";
      for ($i=0; $i <=count($kinds) ; $i++) {
        $this->db->query($sql, array($id,$title,$kinds[$i],1));
      };
    }test 용 입니다.
    */
    function deleteContent($num){
      $sql = "delete from content where num =?";
      $this->db->query($sql, array($num));
    }//end
    function updateContent($title,$firstImg,$content,$kinds,$num,$url){
      $sql_f = "update content set title=?,firstImg=?,content=?,Kinds=?,url=? where num=?";
      $sql_s = "update content set title=?,content=?,Kinds=?, url=? where num=?";
      if($firstImg){
        $this->db->query($sql_f, array($title,$firstImg,$content,$kinds,$url,$num));
      }else{
        $this->db->query($sql_s, array($title,$content,$kinds,$url,$num));
      }
    }//end
    function updateKindsNum($kindsNum,$num){
      $sql = "update content set kindsNum=? where num=?";
      $this->db->query($sql, array($kindsNum,$num));
    }
    //check_chart
    function select_check_chart($uid,$titleNum){
      $sql = "select * from check_chart where id=? and titleNum =?";
      return $this->db->query($sql, array($uid,$titleNum))->result_array();
    }
    function insert_check_chart($uid,$title,$titleNum){
      $sql = "insert into check_chart(id,title,titleNum,createTime) values(?,?,?,?)";
      $this->db->query($sql, array($uid,$title,$titleNum,date("Y-m-d H:i:s")));
    }
    //comment query
    function commentSelect(){
      $sql = "select * from com_ment";
      return $this->db->query($sql)->result_array();
    }
    function commmentInsert($id,$content,$parent,$sortNum){
      $sql = "insert into com_ment(id,content,parent,sortNum,createTime) values(?,?,?,?,?)";
      $this->db->query($sql, array($id,$content,$parent,$sortNum,date("Y-m-d H:i:s")));
    }
    function commentDelete($num){
      $sql = "delete from com_ment where num =?";
      $this->db->query($sql, array($num));
    }

}//class-end

?>
