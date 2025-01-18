<?php 
require_once "course.php";
require_once "user.php";

class Teacher extends User {
    private array $courses = []; 

    public function __construct(int $idUser, string $username, string $email, string $password, string $role, string $status) {
        parent::__construct($idUser, $username, $email, $password, $role, $status);
    }

    public function addCourse(PDO $conn, string $titre, string $description, string $contenu, string $image, string $type, int $idCategory, int $idTeacher, string $date): void {
        $course = new Course($titre, $description, $contenu, $image, $type, $idCategory, $idTeacher, $date);
        $course->save($conn);
        $this->loadCourses($conn);
    }

    public function loadCourses(PDO $conn): void {
        $sql = "SELECT c.* FROM cours c JOIN user t ON t.idUser = c.idTeacher WHERE t.idUser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->idUser, PDO::PARAM_INT);  
        $stmt->execute();
        $this->courses = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getCourses(): array {
        return $this->courses;
    }
}
?>
