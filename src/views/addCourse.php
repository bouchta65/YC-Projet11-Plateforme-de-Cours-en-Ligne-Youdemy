<?php
session_start();
require_once '../classes/teacher.php';
require_once '../classes/tag.php';
require_once '../classes/category.php';

if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    if ($user instanceof Teacher) {
        $teacher = $user;
    } else {
        echo "No teacher is logged in.";
    }
} else {
    echo "No session variable found.";
}


if (isset($_POST['validateForm'])) {
        $courseType = $_POST['pdfORvideo'];
        $Titre = $_POST['Titre_Course'];
        $Description = $_POST['Description_Course'];
        $Category = $_POST['Category_Course'];
        $Type = $_POST['Type_Course'];
        $Tags = isset($_POST['Tags_Course']) ? $_POST['Tags_Course'] : [];

    $target_dir = "../../public/assets/images/coursesData/";
    $allowed_formats_Image = ['jpg', 'jpeg', 'png'];
    $allowed_formats_File = ['mp4', 'avi', 'mov', 'pdf'];
    $imageFileType = strtolower(pathinfo($_FILES["Image_Course"]["name"], PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($_FILES["File_Course"]["name"], PATHINFO_EXTENSION));

    if (in_array($imageFileType, $allowed_formats_Image) && in_array($imageFileType2, $allowed_formats_File)) {
    $unique_identifier = uniqid('', true);
    $image_path = $target_dir . $unique_identifier . '.' . $imageFileType;
    $file_path = $target_dir . $unique_identifier . '.' . $imageFileType2;

    move_uploaded_file($_FILES["Image_Course"]["tmp_name"], $image_path);
    move_uploaded_file($_FILES["File_Course"]["tmp_name"], $file_path);

    if($courseType == "PDF"){
        $teacher->addCourse($conn,$Titre,$Description,$file_path,$Type,$image_path,$Category,$teacher->getIdUser(),"");
    }else{
        $teacher->addCourse($conn,$Titre,$Description,$file_path,$Type,$image_path,$Category,$teacher->getIdUser(),"");

    }
    
    } else {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG are allowed.')
        ;</script>";
    }
    

}

?>