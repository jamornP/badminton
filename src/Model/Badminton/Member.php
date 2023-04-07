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
            m_status,
            u_id
        ) VALUES (
            :m_name, 
            :m_date,
            :m_status,
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
        UPDATE tb_member 
        SET
          m_status = :m_status
        WHERE
          m_id = :m_id
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    return true;
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
  public function getMemberByDateUserStatus($date,$u_id,$status)
  {
    $sql ="
        SELECT * 
        FROM tb_member 
        WHERE m_date = '{$date}' AND u_id = {$u_id} AND m_status = {$status}
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
}
?>