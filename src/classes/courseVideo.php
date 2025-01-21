<?php 
require_once "course.php";
class CourseVideo extends Course {
    protected string $videoUrl;

    public function __construct(int $idCours, string $titre, string $description, string $videoUrl, string $type ,string $image, int $idCategory, int $idTeacher, string $date_creation,string $typeCourse) {
        parent::__construct($idCours, $titre, $description, $image, $type, $idCategory, $idTeacher, $date_creation,$typeCourse);
        $this->videoUrl = $videoUrl;
    }

    public function getVideoUrl(): string {
        return $this->videoUrl;
    }

    public function saveCourse(PDO $conn): void {
        $sql = "INSERT INTO cours (titre, description, contenu, type, image, idCategory, idTeacher, typeCours) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->titre, PDO::PARAM_STR);
        $stmt->bindValue(2, $this->description, PDO::PARAM_STR);
        $stmt->bindValue(3, $this->videoUrl, PDO::PARAM_STR);
        $stmt->bindValue(4, $this->type, PDO::PARAM_STR);
        $stmt->bindValue(5, $this->image, PDO::PARAM_STR);
        $stmt->bindValue(6, $this->idCategory, PDO::PARAM_INT);
        $stmt->bindValue(7, $this->idTeacher, PDO::PARAM_INT);
        $stmt->bindValue(8, $this->typeCourse, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateCourse(PDO $conn):void{
        $sql = "UPDATE cours SET  titre = ?, description = ?, contenu = ?, type = ?, image = ?, idCategory = ?, idTeacher = ?,  date_creation = ? 
    WHERE idCours = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->titre, PDO::PARAM_STR);
        $stmt->bindValue(2, $this->description, PDO::PARAM_STR);
        $stmt->bindValue(3, $this->videoUrl, PDO::PARAM_STR);
        $stmt->bindValue(4, $this->type, PDO::PARAM_STR);
        $stmt->bindValue(5, $this->image, PDO::PARAM_STR);
        $stmt->bindValue(6, $this->idCategory, PDO::PARAM_INT);
        $stmt->bindValue(7, $this->idTeacher, PDO::PARAM_INT);
        $stmt->bindValue(8, $this->typeCourse, PDO::PARAM_STR);
        $stmt->bindValue(8, $this->idCours, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function getCourseType(): string {
        return "Video";
    }

    public function setURL(string $videoUrl): void {
        $this->videoUrl = $videoUrl;
    }

    public function getContenu(): string {
        return $this->videoUrl;
    }
}

?>