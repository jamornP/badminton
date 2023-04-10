<?php

namespace App\Model\Badminton;

use App\Database\DbBadminton;


class Court extends DbBadminton
{
  public function addCourt($data)
  {
    $sql = "
        INSERT INTO tb_court (     
        c_name, 
        c_date,
        u_id
        ) VALUES (
        :c_name, 
        :c_date,
        :u_id
        )    
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
  public function updateCourt($data)
  {
    $sql = "
        
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return true;
  }
  public function getCourtByDateUser($date,$u_id)
  {
    $sql ="
        SELECT * 
        FROM tb_court 
        WHERE c_date = '{$date}' AND u_id = {$u_id} 
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function getCourtByDateUserStatus($date,$u_id)
  {
    $sql ="
        SELECT * 
        FROM tb_court 
        WHERE (c_date = '{$date}') AND (u_id = {$u_id}) 
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function getCourtById($id)
  {
    $sql ="
        SELECT * 
        FROM tb_court 
        WHERE c_id = {$id}
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data[0];
  }
}
?>