<?php  
include "user.php";
class Student extends User{

    public function __construct(PDO $conn,int $idUser,string $username,string $email,string $password,string $role,bool $status){
        parent::construct($conn,$idUser,$username,$email,$password,$role,$status);
    }
}
?>