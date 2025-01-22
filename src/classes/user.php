<?php 
include "../db/config.php";
require_once "teacher.php";
require_once "student.php";
require_once "admin.php";
abstract class User{
    protected int $idUser;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $role;
    protected string $status;
    protected string $image;
    protected string $address;
    protected string $phone;

    public function __construct(int $idUser,string $username,string $email,string $password,string $role,String $status,string $image,string $address,String $phone) {
        $this->idUser = $idUser;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->image = $image;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function getImage(): string
    {
        return $this->image;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public static function login(PDO $conn ,string $email,string $password): void{
        session_start();
        $sql = "SELECT * from user where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            if(password_verify($password,$user['password'])){
                if($user['role']=="Student"){
                    $_SESSION['user'] = serialize(new Student($user['idUser'],$user['username'],$user['email'],$user['password'],$user['role'],$user['statut'],$user['image'],$user['address'],$user['phone']));
                    header('Location: ../views/courses.php'); 
                }else if($user['role']=="Teacher"){
                    $_SESSION['user'] = serialize(new Teacher($user['idUser'],$user['username'],$user['email'],$user['password'],$user['role'],$user['statut'],$user['image'],$user['address'],$user['phone']));
                    echo "good";
                    header('Location: ../views/dashboard.php'); 
                }else{
                    $_SESSION['user'] = serialize(new Admin($user['idUser'],$user['username'],$user['email'],$user['password'],$user['role'],$user['statut'],$user['image'],$user['address'],$user['phone']));
                    header('Location: ../views/dashboard.php'); 
                }
            }else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found";
        }

    }

    public static function registre(PDO $conn, string $name, string $email, string $password, string $role,string $image,string $address, string $phone): void {
        $sql = "SELECT email FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_NUM);
    
        if ($user) {
            echo "<script>alert('The email is already in use.');</script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            if ($role == "Student") {
                $sql = "INSERT INTO user (username, email, password, role, statut,image,address,phone) VALUES (?, ?, ?, 'Student', 'Active',?,?,?)";
            } else {
                $sql = "INSERT INTO user (username, email, password, role, statut,image,address,phone) VALUES (?, ?, ?, 'Teacher', 'Pending',?,?,?)";
            }
    
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $name, PDO::PARAM_STR);
            $stmt->bindValue(2, $email, PDO::PARAM_STR);
            $stmt->bindValue(3, $hashedPassword, PDO::PARAM_STR); 
            $stmt->bindValue(4, $image, PDO::PARAM_STR); 
            $stmt->bindValue(5, $address, PDO::PARAM_STR); 
            $stmt->bindValue(6, $phone, PDO::PARAM_STR); 
            $stmt->execute();
    
            echo "<script>alert('Registration successful!');</script>";
        }
    }

    public function logout(): void{
        session_start();
        unset($_SESSION['user']);
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }

    public function updateProfile($conn): void {
        $sql = "UPDATE user SET username = ?, email = ?, address = ?, phone = ? WHERE idUser = ?";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(1, $this->username, PDO::PARAM_STR);
        $stmt->bindValue(2, $this->email, PDO::PARAM_STR);
        $stmt->bindValue(3, $this->address, PDO::PARAM_STR);
        $stmt->bindValue(4, $this->phone, PDO::PARAM_STR);
        $stmt->bindValue(5, $this->idUser, PDO::PARAM_INT);
        $stmt->execute();
    }
    


    

  
    
}
    


?>

