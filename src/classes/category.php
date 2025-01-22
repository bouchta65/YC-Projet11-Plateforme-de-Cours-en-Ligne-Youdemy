<?php

class Category {
    private int $idCategory;
    private string $categoryName;

    public function __construct(int $idCategory, string $categoryName) {
        $this->idCategory = $idCategory;
        $this->categoryName = $categoryName;
    }

    public function getCategoryName(): string {
        return $this->categoryName;
    }

    public function getidCategory(): string {
        return $this->idCategory;
    }

    public function setCategoryName(string $categoryName): void {
        $this->categoryName = $categoryName;
    }

    public static function getAllGategorys(PDO $conn): array{
        $sql = "SELECT * from category";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }
    public static function getCategoryById(PDO $conn , int $categoryId): string {
        $sql = "SELECT * FROM Category WHERE idCategory = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($category) {
            return $category['categoryName'];
        } else {
            return null; 
        }
    }
    public function saveCategory($conn) {
        $sql = "INSERT INTO category (categoryName) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->categoryName, PDO::PARAM_STR);  
        $stmt->execute();
    }

    
    
}
?>
