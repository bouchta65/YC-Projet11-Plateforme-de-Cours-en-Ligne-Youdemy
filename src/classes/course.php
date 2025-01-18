<?php
include "../db/config.php";
class Course {
    protected int $idCours;
    protected string $titre;
    protected string $description;
    protected string $contenu;
    protected string $image;
    protected string $type; 
    protected int $idCategory;
    protected int $idTeacher;
    protected string $date_creation;
    protected array $Students = [];
    

    public function __construct(string $titre,string $description,string $contenu,string $image,string $type,int $idCategory,int $idTeacher,string $date_creation
    ) {
        $this->titre = $titre;
        $this->description = $description;
        $this->contenu = $contenu;
        $this->image = $image;
        $this->type = $type;
        $this->idCategory = $idCategory;
        $this->idTeacher = $idTeacher;
        $this->date_creation = $date_creation;
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

    public function getContenu(): string {
        return $this->contenu;
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

    public function setContenu(string $contenu): void {
        $this->contenu = $contenu;
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
        $sql = "SELECT c.* ,t.*,count(ci.idStudent) as student_count from cours c join courseinscription ci on c.idCours = ci.idCours 
        join user s on ci.idStudent = s.idUser join user t on  t.idUser = c.idTeacher GROUP BY c.idCours";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $courses;
    }

    public function save(PDO $conn):void{
        $sql = "INSERT into cours (titre ,description,contenu,image,type,idCategory,idTeacher,date_creation) values(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1,$this->titre,PDO::PARAM_STR);
        $stmt->bindValue(2,$this->description,PDO::PARAM_STR);
        $stmt->bindValue(3,$this->contenu,PDO::PARAM_STR);
        $stmt->bindValue(4,$this->image,PDO::PARAM_STR);
        $stmt->bindValue(5,$this->type,PDO::PARAM_STR);
        $stmt->bindValue(6,$this->idCategory,PDO::PARAM_INT);
        $stmt->bindValue(7,$this->idTeacher,PDO::PARAM_INT);
        $stmt->bindValue(8,$this->date_creation,PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
