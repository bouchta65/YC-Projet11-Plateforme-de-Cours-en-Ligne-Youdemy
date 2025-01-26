<?php  
class Cours_inscription {
        private int $idCourse;
        private int $idStudent;
    
        public function __construct(int $idCourse, int $idStudent) {
            $this->idCourse = $idCourse;
            $this->idStudent = $idStudent;
        }
    
        public function getIdCourse(): int {
            return $this->idCourse;
        }
    
        public function getIdStudent(): int {
            return $this->idStudent;
        }


    
        public function addStudentToCourse(PDO $conn): void {
            $sql = "INSERT INTO courseinscription (idCours, idStudent) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $this->idCourse, PDO::PARAM_INT);
            $stmt->bindValue(2, $this->idStudent, PDO::PARAM_INT);
            $stmt->execute();
        }
    
        public function removeStudentFromCourse(PDO $conn): void {
            $sql = "DELETE FROM courseinscription WHERE idCours= ? AND idStudent = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $this->idCourse, PDO::PARAM_INT);
            $stmt->bindValue(2, $this->idStudent, PDO::PARAM_INT);
            $stmt->execute();
        }
    
        public static function EnrolledStudentStatistic(PDO $conn, int $idTeacher): array {
            $sql = "SELECT user.username, COUNT(courseinscription.idCours) AS courses_count, cours.titre, cours.idCours, courseinscription.idStudent
                    FROM user
                    JOIN courseinscription ON user.idUser = courseinscription.idStudent
                    JOIN cours ON cours.idCours = courseinscription.idCours
                    where cours.idTeacher = ?
                    GROUP BY user.username, cours.titre, cours.idCours, courseinscription.idStudent
                    ORDER BY courses_count DESC
                    LIMIT 3";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $idTeacher, PDO::PARAM_INT);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($results)) {
                return [];
            }
            
            $topStudents = [];
            
            foreach ($results as $row) {
                $topStudents[] = [
                    'username' => $row['username'],
                    'titre' => $row['titre'],
                    'idCours' => $row['idCours'],
                    'idStudent' => $row['idStudent'],
                ];
            }
            
            return $topStudents;
        }
        

        public static function isStudentEnrolled($conn, $studentId, $courseId):bool{
            $sql = "SELECT * FROM courseinscription WHERE idStudent = ? AND idCours = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $studentId, PDO::PARAM_INT);
            $stmt->bindValue(2, $courseId, PDO::PARAM_INT);            
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_NUM);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    
}
?>