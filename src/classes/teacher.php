<?php 
require_once "coursePdf.php";
require_once "courseVideo.php";
require_once "tag.php";
require_once "category.php";
require_once "user.php";

class Teacher extends User {
    private array $courses = []; 

    public function __construct(int $idUser, string $username, string $email, string $password, string $role, string $status,string $image, string $address, string $phone) {
        parent::__construct($idUser, $username, $email, $password, $role, $status,$image,$address,$phone);
    }

    public function addCourse(PDO $conn, string $titre, string $description, string $fileUrl, string $type,string $image, int $idCategory, int $idTeacher, string $date, string $typeCourse): void {
        if ($typeCourse == 'pdf') {
            $course = new CoursePDF(0, $titre, $description, $fileUrl,$type,$image, $idCategory, $idTeacher, $date, $typeCourse);
        }else{
            $course = new CourseVideo(0, $titre, $description, $fileUrl,$type, $image, $idCategory, $idTeacher, $date, $typeCourse);
        }
        $course->saveCourse($conn);
        $this->loadCourses($conn);
    }

    public function editCourse(PDO $conn, int $idCours , string $titre, string $description, string $fileUrl, string $type,string $image, int $idCategory): void {
        
        $course = $this->getCourseById($conn,$idCours);

        $course->setTitre($titre);
        $course->setDescription($description);
        $course->setUrl($fileUrl);
        $course->setType($type);
        $course->setImage($image);
        $course->setIdCategory($idCategory);
        
        $course->updateCourse($conn);
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
    
            $this->courses[] = $courseObject;
        }
    }
    

    public function getCourses(): array {
        return $this->courses;
    }

    public function getCourseById(PDO $conn,int $courseId): ?Course {
        $this->loadCourses($conn);
        foreach ($this->courses as $course) {
            if ($course->getIdCours() === $courseId) {
                return $course;
            }
        }
        return null; 
    }

    public function getCategoryById(PDO $conn , int $categoryId): Category{
        $sql="SELECT * from Category where idCategory = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$categoryId,PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $category = new Category($row[0],$row[1]);
        return $category;

    }

    public function getTagById(PDO $conn , int $tagId): tag{
        $sql="SELECT * from tag where idTag = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$tagId,PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $tag = new Tag($row[0],$row[1]);
        return $tag;

    }
}
?>
