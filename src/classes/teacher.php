<?php 
require_once "course.php";
require_once "user.php";

class Teacher extends User {
    private array $courses = []; 

    public function __construct(int $idUser, string $username, string $email, string $password, string $role, string $status) {
        parent::__construct($idUser, $username, $email, $password, $role, $status);
    }

    public function addCourse(PDO $conn, string $titre, string $description, string $contenu, string $image, string $type, int $idCategory, int $idTeacher, string $date): void {
        $course = new Course(0,$titre, $description, $contenu, $image, $type, $idCategory, $idTeacher, "");
        $course->save($conn);
        $this->loadCourses($conn);
    }

    public function loadCourses(PDO $conn): void {
        $sql = "SELECT c.* FROM cours c JOIN user t ON t.idUser = c.idTeacher WHERE t.idUser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->idUser, PDO::PARAM_INT);  
        $stmt->execute();
        $coursesData = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        $this->courses = [];

        foreach ($coursesData as $course) {
            $course = new Course(
                $course['idCours'], 
                $course['titre'], 
                $course['description'], 
                $course['contenu'], 
                $course['image'], 
                $course['type'], 
                $course['idCategory'], 
                $course['idTeacher'], 
                $course['date_creation']
            );
            $this->courses[] = $course;
        }
    }

    public function getCourses(): array {
        return $this->courses;
    }

    public function getCourseById(int $courseId): ?Course {
        foreach ($this->courses as $course) {
            if ($course->getIdCours() === $courseId) {
                return $course;
            }
        }
        return null; 
    }
}
?>
