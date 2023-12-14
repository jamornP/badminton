<?php

namespace App\Model\Badminton;

use App\Database\DbBadminton;


class Users extends DbBadminton
{
  public function addUsers($data)
  {
    $data['u_password'] = password_hash($data['u_password'],PASSWORD_DEFAULT);
    $ck = $this->countUsersByUser($data['u_username']);
    if($ck){
        $sql = "
            INSERT INTO tb_users (     
            u_username,
            u_password,
            u_name,
            u_team,
            u_tel,
            line
            ) VALUES (
            :u_username,
            :u_password,
            :u_name,
            :u_team,
            :u_tel,
            :line
            )    
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return true;
    }else{
        return false;
    }
    
  }
  public function checkUsers($user) {
    $sql = "
        SELECT *
        FROM tb_users
        WHERE u_username = ?
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$user['u_username']]);
    $data = $stmt->fetchAll();
    $userDB = $data[0];
    if(password_verify($user['u_password'],$userDB['u_password'])) {
        session_start();
        $_SESSION['b_u_name'] = $userDB['u_name'];
        $_SESSION['b_u_team'] = $userDB['u_team'];
        $_SESSION['b_u_tel'] = $userDB['u_tel'];
        $_SESSION['b_u_id'] = $userDB['u_id'];
        $_SESSION['b_u_tel'] = $userDB['u_tel'];
        $_SESSION['b_line'] = $userDB['line'];
        $_SESSION['b_login'] = true;   
        if($user['u_username']=='admin'){
            $_SESSION['admin']=true;
        } 
        return true;
    } else {
        return false;
    }
}
public function resetPassword($email) {
    $sql1 = "
        SELECT *
        FROM tb_users
        WHERE u_username = '{$email}'
    ";
    $stmt = $this->pdo->query($sql1);
    $data = $stmt->fetchAll();
    $row = $stmt->rowCount();
    if($row > 0){
        $password = password_hash('123456',PASSWORD_DEFAULT);
        $sql = "
            UPDATE tb_users
            SET u_password = '{$password}'
            WHERE u_username = '{$email}'
        ";
        $stmt = $this->pdo->query($sql);
        return true;
    }else{
        return false;
    }
}
public function changePassword($user) {
    $sql = "
        SELECT *
        FROM tb_users
        WHERE u_username = ?
    ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$user['u_username']]);
    $data = $stmt->fetchAll();
    $userDB = $data[0];
    if(password_verify($user['OldPassword'],$userDB['password'])) {
        $password = password_hash($user['NewPassword'],PASSWORD_DEFAULT);
        $sql2 = "
            UPDATE tb_users
            SET u_password = '{$password}'
            WHERE u_username = '{$user['u_username']}'
        ";
        $stmt = $this->pdo->query($sql2);
        return true;
        // return $sql2;
    } else {
        // return $sql2;
        return false;
    }
}
public function getUsers() {
    $sql = "
        SELECT *
        FROM tb_users
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
}
public function countUsersByUser($user) {
    $sql = "
        SELECT *
        FROM tb_users
        WHERE u_username='{$user}'
    ";
    $stmt = $this->pdo->query($sql);
    $data = $stmt->fetchAll();
    $count = count($data);
    if($count > 0){
        return false;
    }else{
        return true;
    }
    
}
}
?>