<?php

class Member_model extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    public function gets($id){
      $sql = "select * from member where id=?";
      return $this->db->query($sql, array($id))->result_array();
    }

    public function loginMsg($id,$password){
      $sql = "select * from member where id=? and pw=?";
      return $this->db->query($sql, array($id,$password))->result_array();
    }

    public function member_insert($id,$pw,$name,$addr,$myImg){
        $sql ="insert into member(id,pw,name,addr,createTime,picture) values(?,?,?,?,?,?)";
        $this->db->query($sql, array( $id, $pw, $name, $addr,date("Y-m-d H:i:s"),$myImg));
    }

    public function delete($num){
        $sql ="delete from topic where num=?";
        $this->db->query($sql, array( $num));
    }

    public function update($num){
        $sql ="update topic set title=?,content=? where num=:num";
        $this->db->query($sql, array( $num));
    }

}

?>
