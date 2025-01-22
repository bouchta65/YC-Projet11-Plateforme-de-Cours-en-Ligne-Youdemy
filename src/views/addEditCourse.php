<?php
session_start();
require_once '../db/config.php';
require_once '../classes/teacher.php';
require_once '../classes/tag.php';
require_once '../classes/category.php';

// Check if a teacher is logged in
if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    if($user->getStatus()=="Active"){
        if ($user instanceof Teacher) {
            $teacher = $user;
        } else {
            die("No teacher is logged in.");
        }
    }else{
        die("Please wait for your account to be activated.");
    }
    
} else {
    die("No session variable found.");
}

if (isset($_POST['validateForm']) || isset($_POST['editForm'])) {
    $courseType = $_POST['pdfORvideo'] ?? ''; 
    $Titre = $_POST['Titre_Course'] ?? '';
    $Description = $_POST['Description_Course'] ?? '';
    $Category = $_POST['Category_Course'] ?? '';
    $Type = $_POST['Type_Course'] ?? '';
    $Tags = $_POST['Tags_Course'] ?? [];

    $target_dir = "../../public/assets/images/coursesData/";
    $unique_identifier = uniqid('', true);



        $imageFileType = strtolower(pathinfo($_FILES["Image_Course"]["name"], PATHINFO_EXTENSION));
        $image_path = $target_dir . $unique_identifier . '.' . $imageFileType;
        move_uploaded_file($_FILES["Image_Course"]["tmp_name"], $image_path);
    

        $fileFileType = strtolower(pathinfo($_FILES["File_Course"]["name"], PATHINFO_EXTENSION));
        $file_path = $target_dir . $unique_identifier . '.' . $fileFileType;
        move_uploaded_file($_FILES["File_Course"]["tmp_name"], $file_path);


    if (isset($_POST['validateForm'])) {
        if ($teacher->addCourse($conn, $Titre, $Description, $file_path, $Type, $image_path, $Category, $teacher->getIdUser(), "", $courseType)) {
            echo "<script>alert('Course added successfully!');</script>";
            
        }


    } elseif (isset($_POST['editForm'])) {
        $courseId = $_POST['editForm'];
        $course = $teacher->getCourseById($conn,$courseId);

        $image_path = $course->getImage();
        $file_path = $course->getContenu();

        if (!empty($_FILES["Image_Course"]["name"])) {
            $imageFileType = strtolower(pathinfo($_FILES["Image_Course"]["name"], PATHINFO_EXTENSION));
            $image_path = $target_dir . $unique_identifier . '.' . $imageFileType;
            move_uploaded_file($_FILES["Image_Course"]["tmp_name"], $image_path);
        }
    
        if (!empty($_FILES["File_Course"]["name"])) {
            $fileFileType = strtolower(pathinfo($_FILES["File_Course"]["name"], PATHINFO_EXTENSION));
            $file_path = $target_dir . $unique_identifier . '.' . $fileFileType;
            move_uploaded_file($_FILES["File_Course"]["tmp_name"], $file_path);
        }

        $teacher->editCourse($conn, $courseId, $Titre, $Description, $file_path, $Type, $image_path, $Category);
        header("Location: CourseDetailsTeacher.php?id=" . $courseId);
    }
}
?>