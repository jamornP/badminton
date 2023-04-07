<?php

namespace App\Model\Badminton;

use App\Database\DbBadminton;


class Matchs extends DbBadminton
{
  public function addMatch($data)
  {
    $sql = "
        INSERT INTO tb_match (     
            c_id,
            ma_num,
            ma_date,
            ma_status,
            u_id
        ) VALUES (
            :c_id,
            :ma_num,
            :ma_date,
            :ma_status,
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


  // match data
  public function getMatchDataByDateUser($date,$u_id)
  {
    $sql ="
        SELECT md.*, m.m_name
        FROM tb_match_data as md
        LEFT JOIN tb_member as m ON md.m_id = m.m_id
        WHERE md.md_date = '{$date}' AND md.u_id = {$u_id} 
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function addMatchData($data)
  {
    $sql = "
        INSERT INTO tb_match_data (     
            ma_id,
            m_id,
            md_date,
            u_id
        ) VALUES (
            :ma_id,
            :m_id,
            :md_date,
            :u_id
        )    
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
}
?>