<?php 
include "../db/config.php";
abstract class User{
    private int $idUser;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private bool $status;


    public function __construct(PDO $conn,int $idUser,string $username,string $email,string $password,string $role,bool $status) {
        $this->idUser = $idUser;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->conn = $conn;
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

    public function getStatus(): bool
    {
        return $this->status;
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

    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    public static function login(PDO $conn ,string $email,string $password): void{
        $sql = "SELECT * from user where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            if(password_verify($password,$user['password'])){
                if($user['role']=="Student"){
                    $_SESSION['user'] = new Student($conn,$user['idUser'],$user['username'],$user['email'],$user['password'],$user['role'],$user['status']);
                }else if($user['role']=="teacher"){
                    $_SESSION['user'] = new Teacher($conn,$user['idUser'],$user['username'],$user['email'],$user['password'],$user['role'],$user['status']);
                }else{
                    $_SESSION['user'] = new Admin($conn,$user['idUser'],$user['username'],$user['email'],$user['password'],$user['role'],$user['status']);

                }
            }else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found";
        }

    }

    public static function registre(PDO $conn ,string $email,string $password,string $date): void{
        $sql = "SELECT email FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_NUM);

        if ($user) {
            echo "<script>alert('Lemail est déjà utilisé.');</script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user (Full_Name_User, Email_User, Age_User, Role_User, Password_User) VALUES (?, ?, ?, 'user', ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $name, PDO::PARAM_STR); 
            $stmt->bindValue(2, $email, PDO::PARAM_STR); 
            $stmt->bindValue(3, $age, PDO::PARAM_INT); 
            $stmt->bindValue(4, $hashedPassword, PDO::PARAM_STR); 
                
            if ($stmt->execute()) {
                echo "<script>alert('Inscription réussie.');</script>";
            } else {
                echo "<script>alert('Erreur lors de linscription.');</script>";
            }

    }
    

    }
}
    


?>

