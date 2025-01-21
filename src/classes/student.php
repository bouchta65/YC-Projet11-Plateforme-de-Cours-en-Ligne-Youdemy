<?php  
class Student extends User{

    public function __construct(int $idUser, string $username, string $email, string $password, string $role, string $status,string $image, string $address, string $phone) {
        parent::__construct($idUser, $username, $email, $password, $role, $status,$image,$address,$phone);
    }
}
?>