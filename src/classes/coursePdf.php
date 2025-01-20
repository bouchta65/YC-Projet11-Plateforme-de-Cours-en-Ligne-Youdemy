<?php
require_once "course.php";
class CoursePDF extends Course {
    protected string $pdfUrl;

    public function __construct(int $idCours, string $titre, string $description, string $pdfUrl, string $type ,string $image, int $idCategory, int $idTeacher, string $date_creation,string $typeCourse) {
        parent::__construct($idCours, $titre, $description, $image, $type, $idCategory, $idTeacher, $date_creation,$typeCourse);
        $this->pdfUrl = $pdfUrl;
    }

    public function getPdfUrl(): string {
        return $this->pdfUrl;
    }

    public function saveCourse(PDO $conn): void {
        $sql = "INSERT INTO cours (titre, description, contenu, type, image, idCategory, idTeacher, typeCours) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->titre, PDO::PARAM_STR);
        $stmt->bindValue(2, $this->description, PDO::PARAM_STR);
        $stmt->bindValue(3, $this->pdfUrl, PDO::PARAM_STR);
        $stmt->bindValue(4, $this->type, PDO::PARAM_STR);
        $stmt->bindValue(5, $this->image, PDO::PARAM_STR);
        $stmt->bindValue(6, $this->idCategory, PDO::PARAM_INT);
        $stmt->bindValue(7, $this->idTeacher, PDO::PARAM_INT);
        $stmt->bindValue(8, $this->typeCourse, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getCourseType(): string {
        return "pdf";
    }

    public function getContenu(): string {
        return $this->pdfUrl;
    }
}

?>