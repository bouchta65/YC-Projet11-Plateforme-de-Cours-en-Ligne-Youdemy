<?php 
require_once "coursePdf.php";
require_once "courseVideo.php"; 
class Student extends User{
    private array $EnrolledCourses= [];

    public function __construct(int $idUser, string $username, string $email, string $password, string $role, string $status,string $image, string $address, string $phone) {
        parent::__construct($idUser, $username, $email, $password, $role, $status,$image,$address,$phone);
    }

    public function addEnrollemnt(PDO $conn, int $idCourse):void{
        $Enrollement = new Cours_inscription($idCourse,$this->idUser);
        $Enrollement->addStudentToCourse($conn);
    }

    public function removeEnrollemnt(PDO $conn, int $idCourse):void{
        $Enrollement = new Cours_inscription($idCourse,$this->idUser);
        $Enrollement->removeStudentFromCourse($conn);
    }

    public static function getAllStudents($conn) :array{
        $sql = "SELECT * FROM user WHERE role = 'Student'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEnrolledCourses(): array {
        return $this->EnrolledCourses;
    }

    public function loadEnrolledCourses(PDO $conn) :void{
        $sql = "SELECT c.* FROM cours c 
                JOIN courseinscription e ON c.idCours = e.idCours 
                WHERE e.idStudent = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->idUser, PDO::PARAM_INT);
        $stmt->execute();
        $enrolledCourses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->EnrolledCourses = [];
        foreach($enrolledCourses as $course){
            if ($course['typeCours'] === 'pdf') {
                $courseObject = new CoursePDF (
                    $course['idCours'], 
                    $course['titre'], 
                    $course['description'], 
                    $course['contenu'],
                    $course['type'], 
                    $course['image'], 
                    $course['idCategory'], 
                    $course['idTeacher'], 
                    $course['date_creation'], 
                    $course['typeCours']
                );
            } else {
                $courseObject = new CourseVideo(
                    $course['idCours'], 
                    $course['titre'], 
                    $course['description'], 
                    $course['contenu'],
                    $course['type'], 
                    $course['image'], 
                    $course['idCategory'], 
                    $course['idTeacher'], 
                    $course['date_creation'], 
                    $course['typeCours']
                );
        }
        $this->EnrolledCourses[] = $courseObject;
    }

}
}
?>