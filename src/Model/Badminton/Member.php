<?php

namespace App\Model\Badminton;

use App\Database\DbBadminton;


class Member extends DbBadminton
{
  public function addMember($data)
  {
    $sql = "
        INSERT INTO tb_member (     
            m_name, 
            m_date,
            u_id
        ) VALUES (
            :m_name, 
            :m_date,
            :u_id
        )    
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return $this->pdo->lastInsertId();
  }
  public function updateMember($data)
  {
    $sql = "
        
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return true;
  }
  public function getMemberById($id)
  {
    $sql ="
        SELECT * 
        FROM tb_member 
        WHERE m_id = {$id} 
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data[0];
  }
  public function getMemberByDateUser($date,$u_id)
  {
    $sql ="
        SELECT * 
        FROM tb_member 
        WHERE m_date = '{$date}' AND u_id = {$u_id} 
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function getMemberByDateUserStatus($date,$u_id)
  {
    $sql ="
        SELECT * 
        FROM tb_member 
        WHERE m_date = '{$date}' AND u_id = {$u_id} 
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
}
?>