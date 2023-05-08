<?php

namespace App\Model\Badminton;

use App\Database\DbBadminton;


class Matchs extends DbBadminton
{
  public function addMatch($data)
  {
    $sql = "
        INSERT INTO tb_match (     
            ma_date,
            c_id,
            ma_num,
            dm_id,
            b_id,
            u_id
        ) VALUES (
            :ma_date,
            :c_id,
            :ma_num,
            :dm_id,
            :b_id,
            :u_id
        )    
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
  public function getMatchByDateUser($date,$u_id)
  {
    $sql ="
        SELECT ma.*, c.c_name
        FROM tb_match as ma
        LEFT JOIN tb_court as c ON ma.c_id = c.c_id
        WHERE ma.ma_date = '{$date}' AND ma.u_id = {$u_id} 
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function getNumCourtMatch($date,$u_id,$c_id){
    $sql = "
      SELECT * 
      FROM tb_match
      WHERE ma_date = '{$date}' AND u_id = {$u_id} AND c_id ={$c_id}
      ";
      $stmt = $this->pdo->query($sql);
      $data = $stmt->fetchAll();
      
      if((count($data)) <= 0){
        $count = 1;
      }else{
        $count = count($data)+1;
      }
      return $count;
  }
  public function getCourtMatch($date,$u_id,$c_id){
    $sql = "
      SELECT * 
      FROM tb_match
      WHERE ma_date = '{$date}' AND u_id = {$u_id} AND c_id ={$c_id}
      ";
      $stmt = $this->pdo->query($sql);
      $data = $stmt->fetchAll();
      return $data;
  }


  // match data
  public function getMatchDataById($dm_id)
  {
    $sql ="
        SELECT dm.*, m.m_name
        FROM tb_data_match as dm
        LEFT JOIN tb_member as m ON dm.m_id = m.m_id
        WHERE dm.dm_id = '{$dm_id}'
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function addMatchData($data)
  {
    $sql = "
        INSERT INTO tb_data_match (     
            dm_id,
            dm_num,
            m_id,
            dm_date
        ) VALUES (
            :dm_id,
            :dm_num,
            :m_id,
            :dm_date
        )    
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
  public function countDM($dm_id){
    $sql = "
      SELECT * 
      FROM tb_data_match
      WHERE dm_id = '{$dm_id}'
      ";
      $stmt = $this->pdo->query($sql);
      $data = $stmt->fetchAll();
      
      if((count($data)) <= 0){
        $count = 1;
      }else{
        $count = count($data)+1;
      }
      return $count;
  }
  public function updateMemberById($data){
    $sql ="
      UPDATE tb_data_match 
      SET m_id=:m_id 
      WHERE id=:id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return true;
  }

  //bad
  public function addBad($data)
  {
    $sql = "
        INSERT INTO tb_bad (     
          b_id,
          b_name,
          b_num
        ) VALUES (
          :b_id,
          :b_name,
          :b_num
        )    
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
  public function countBad($b_id){
    $sql = "
      SELECT * 
      FROM tb_bad
      WHERE b_id = '{$b_id}'
      ";
      $stmt = $this->pdo->query($sql);
      $data = $stmt->fetchAll();
      
      if((count($data)) <= 0){
        $count = 1;
      }else{
        $count = count($data)+1;
      }
      return $count;
  }
  public function getBadByid($b_id){
    $sql = "
      SELECT * 
      FROM tb_bad
      WHERE b_id = '{$b_id}'
      ";
      $stmt = $this->pdo->query($sql);
      $data = $stmt->fetchAll();
      return $data;
  }
  public function delSQL($sql){
    $this->pdo->query($sql);
    // $data = $stmt->fetchAll();
    return true;
  }
  public function countSQL($sql){
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    $countD = count($data);
    return $countD;
  }
  public function getSQL($sql){
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    // $countD = count($data);
    return $data;
  }
}
?>