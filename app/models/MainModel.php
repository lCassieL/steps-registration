<?php
class MainModel extends Model{
    public function addUser($name,$surname,$phone,$address,$comment){
        if($this->db->connect_errno === 0){
            $query = "insert into users (name,surname,phone,address,comment) values ('".$name."','".$surname."','".$phone."','".$address."','".$comment."')";
            $this->db->query($query);
        }
    }   
}