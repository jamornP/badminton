<?php

namespace App\Model\Badminton;

use App\Database\DbBadminton;


class Dates extends DbBadminton
{
  public function addDate($data)
  {
      $ck = $this->ckDateUser($data);
    if($ck){
      return false;
    }else{
      $sql = "
        INSERT INTO tb_date (     
          d_date,
          u_id
        ) VALUES (
          :d_date,
          :u_id
        )    
      ";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($data);
      return true;
    }
    
  }
  public function getDateByUser($u_id)
  {
    $sql = "
        SELECT * 
        FROM tb_date
        WHERE u_id = {$u_id}
        ORDER BY d_date DESC   
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
  }
  public function ckDateUser($data){
    $sql = "
      SELECT *
      FROM tb_date
      WHERE u_id = :u_id AND d_date = :d_date
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
    $data = $stmt->fetchAll();
    if(count($data)>0){
      return true;
    }else{
      return false;
    }
  }
  
}
?>