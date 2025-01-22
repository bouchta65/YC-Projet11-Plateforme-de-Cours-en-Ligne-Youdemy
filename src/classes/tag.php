<?php
class Tag {
    private int $idTag;
    private string $tagName;

    public function __construct(int $idTag, string $tagName) {
        $this->idTag = $idTag;
        $this->tagName = $tagName;
    }

    public function getIdTag(): int {
        return $this->idTag;
    }

    public function setIdTag(int $idTag): void {
        $this->idTag = $idTag;
    }

    public function getTagName(): string {
        return $this->tagName;
    }

    public function setTagName(string $tagName): void {
        $this->tagName = $tagName;
    }

    public static function getAllTags(PDO $conn): array{
        $sql = "SELECT * from tag";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tags;
    }

    public function saveTag($conn) {
        $sql = "INSERT INTO tag (tagName) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->tagName, PDO::PARAM_STR);  
        $stmt->execute();
    }

    
}
?>
