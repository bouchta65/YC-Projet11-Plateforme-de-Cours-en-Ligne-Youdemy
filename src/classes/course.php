<?php
require_once "coursePdf.php";
require_once "courseVideo.php";
abstract class Course {
    protected int $idCours;
    protected string $titre;
    protected string $description;
    protected string $image;
    protected string $type; 
    protected int $idCategory;
    protected int $idTeacher;
    protected string $date_creation;
    protected string $typeCourse;
    protected array $Students = [];
    

    public function __construct(int $idCours, string $titre,string $description,string $image,string $type,int $idCategory,int $idTeacher,string $date_creation,string $typeCourse) {
        $this->idCours = $idCours;
        $this->titre = $titre;
        $this->description = $description;
        $this->image = $image;
        $this->type = $type;
        $this->idCategory = $idCategory;
        $this->idTeacher = $idTeacher;
        $this->date_creation = $date_creation;
        $this->typeCourse = $typeCourse;
    }

    public function getIdCours(): int {
        return $this->idCours;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getIdCategory(): int {
        return $this->idCategory;
    }

    public function getIdTeacher(): int {
        return $this->idTeacher;
    }

    public function getDateCreation(): string {
        return $this->date_creation;
    }

    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }


    public function setImage(string $image): void {
        $this->image = $image;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function setIdCategory(int $idCategory): void {
        $this->idCategory = $idCategory;
    }

    public function setIdTeacher(int $idTeacher): void {
        $this->idTeacher = $idTeacher;
    }

    public function setDateCreation(string $date_creation): void {
        $this->date_creation = $date_creation;
    }

    public static function getAllCourses(PDO $conn): array{
        $sql = " SELECT c.* ,t.username,count(ci.idStudent) as student_count from cours c left join courseinscription ci on c.idCours = ci.idCours 
       left join user s on ci.idStudent = s.idUser join user t on  t.idUser = c.idTeacher GROUP BY c.idCours";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $courses;
    }

    public static function topCourses(PDO $conn): array {
        $sql = "SELECT   c.*, t.username , COUNT(ci.idStudent) AS student_count FROM 
        cours c LEFT JOIN courseinscription ci ON c.idCours = ci.idCours 
        LEFT JOIN user s ON ci.idStudent = s.idUser
        JOIN user t ON t.idUser = c.idTeacher
        GROUP BY 
        c.idCours
        ORDER BY 
        student_count DESC LIMIT 3";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $courses;
    }
    

    public function deleteCourse(PDO $conn): void{
        $sql = "DELETE from cours where idCours = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$this->idCours,PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function getCourseById(PDO $conn, int $courseId): ?array {
        $sql = "SELECT * FROM cours WHERE idCours = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $courseId, PDO::PARAM_INT);
        $stmt->execute();
    
        $courseData = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $courseData;
    }
    
    

  

    abstract public function saveCourse(PDO $conn): void;
    abstract public function updateCourse(PDO $conn): void;
    abstract public function getCourseType(): string;
    abstract public function setUrl(string $filrUrl): void;
    abstract public function getContenu(): string;


    
}
?>
