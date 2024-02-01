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
            ma_num,
            dm_id,
            b_id,
            u_id
        ) VALUES (
            :ma_date,
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
  public function getNumCourtMatch($date,$u_id){
    $sql = "
      SELECT * 
      FROM tb_match
      WHERE ma_date = '{$date}' AND u_id = {$u_id} 
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
  // -----------------------------------------------------------------------------แสดงแมท manage.php
  public function getCourtMatch($date,$u_id){
    $sql = "
      SELECT * 
      FROM tb_match
      WHERE ma_date = '{$date}' AND u_id = {$u_id}
      ";
      $stmt = $this->pdo->query($sql);
      $data = $stmt->fetchAll();
      return $data;
  }
  public function delMatch($id){
    $sql ="
      DELETE FROM tb_match WHERE ma_id='{$id}'
    ";
    $stmt = $this->pdo->query($sql);
    if($stmt){
      return true;
    }else{
      return false;
    }
    
  }
  public function delDataMatch($id){
    $sql ="
      DELETE FROM tb_data_match WHERE dm_id='{$id}'
    ";
    $stmt = $this->pdo->query($sql);
    if($stmt){
      return true;
    }else{
      return false;
    }
    
  }
  public function delBad($id){
    $sql ="
      DELETE FROM tb_bad WHERE b_id='{$id}'
    ";
    $stmt = $this->pdo->query($sql);
    if($stmt){
      return true;
    }else{
      return false;
    }
    
  }

  // match data
  public function getMatchDataById($dm_id)
  {
    $sql ="
        SELECT dm.*, m.m_name,m.m_id
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
  public function countMember($date,$m_id){
    $sql ="
      SELECT * 
      FROM tb_data_match 
      WHERE dm_date = '{$date}' AND m_id = '{$m_id}'
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return count($data);
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
  public function updateBad($data){
    $sql = "
      UPDATE tb_bad SET 
        b_name=:b_name 
      WHERE id=:id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return true;
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

  // bill
  public function addBill($data){
    $sql = "
      INSERT INTO tb_bill(
        bi_date,
        bi_court,
        bi_game,
        bad_one,
        bad_count,
        bad_sum,
        u_id
      ) VALUES (
        :bi_date,
        :bi_court,
        :bi_game,
        :bad_one,
        :bad_count,
        :bad_sum,
        :u_id
      )
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
  public function getBillByDate($action,$date,$u_id){
    $sql = "
      SELECT * FROM tb_bill WHERE bi_date = '{$date}' AND u_id={$u_id}
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    if($action=="count"){
      return count($data);
    }else{
      return $data[0];
    }
  }
  public function getBillById($action,$bi_id){
    $sql = "
      SELECT * FROM tb_bill WHERE bi_id = '{$bi_id}'
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    if($action=="count"){
      return count($data);
    }else{
      return $data[0];
    }
  }
  public function updateBill($data){
    $sql = "
      UPDATE tb_bill SET
        bi_court=:bi_court,
        bi_game=:bi_game,
        bad_one=:bad_one,
        bad_count=:bad_count,
        bad_sum=:bad_sum
      WHERE bi_date = :bi_date AND u_id = :u_id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return true;
  }

  // data bill
  public function addDataBill($data){
    $sql = "
      INSERT INTO tb_data_bill(
        bi_id,
        m_name,
        court_cal,
        bad_cal,
        bad_m,
        bi_sum
      ) VALUES (
        :bi_id,
        :m_name,
        :court_cal,
        :bad_cal,
        :bad_m,
        :bi_sum
      )
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
  public function getDataBillById($bi_id){
    $sql = "
      SELECT * FROM tb_data_bill WHERE bi_id={$bi_id}
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function delDataBillById($bi_id){
    $sql = "
      DELETE FROM tb_data_bill
      WHERE bi_id = {$bi_id}
    ";
    $stmt = $this->pdo->query($sql);
    if($stmt){
      return true;
    }else{
      return false;
    }
  }
}
?>