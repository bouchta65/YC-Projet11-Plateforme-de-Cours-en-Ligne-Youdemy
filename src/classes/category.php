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
    
}
?>
