<?php  
class Admin extends User{

    public function __construct(int $idUser, string $username, string $email, string $password, string $role, string $status,string $image, string $address, string $phone) {
        parent::__construct($idUser, $username, $email, $password, $role, $status,$image,$address,$phone);
    }

  

    public function addCategory(PDO $conn,string $categoryName):void{
        $category = new Category(0,$categoryName);
        $category->saveCategory($conn);
    }

    public function addTag(PDO $conn,string $tagName):void{
        $tag = new Tag(0,$tagName);
        $tag->saveTag($conn);
    }

    public function deleteUser($conn, $userId) {
        $sql = "DELETE FROM user WHERE idUser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId]);
    }

    public function activateTeacher($conn, $teacherId) {
        $sql = "UPDATE user SET statut = 'Active' WHERE idUser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$teacherId]);
    }

    public function getAdminStatistics(PDO $conn): array {
        $statistics = [];
    
        $sql = "SELECT COUNT(*) as totalUsers FROM user";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $statistics['totalUsers'] = $result['totalUsers'];
        } else {
            $statistics['totalUsers'] = 0; 
        }
    
        $sql = "SELECT COUNT(*) as totalCourses FROM cours";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $statistics['totalCourses'] = $result['totalCourses'];
        } else {
            $statistics['totalCourses'] = 0; 
        }
    
        $sql = "SELECT COUNT(*) as totalTeachers FROM user WHERE role = 'Teacher'";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $statistics['totalTeachers'] = $result['totalTeachers'];
        } else {
            $statistics['totalTeachers'] = 0;
        }
    
        return $statistics;
    }
    
 
}
?>