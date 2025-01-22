<?php 
session_start();
require_once '../db/config.php';
require_once '../classes/user.php';
require_once '../classes/cours_inscription.php';
require_once '../classes/tag.php'; 
require_once '../classes/category.php'; 

$isLoggedIn = isset($_SESSION['user']);
if ($isLoggedIn) {
    $user = unserialize($_SESSION['user']);
}

if ($user->getRole() == "Teacher") {
    $teacher = $user;
    $statistics = $teacher->getStatistics($conn); 
    if (isset($_POST['deleteStudent'])) {
        $idUser = $_POST['idCourse'];
        $idStudent = $_POST['idStudent'];
        $teacher->deleteStudent($conn, $idUser, $idStudent);
    }
} elseif ($user->getRole() == "Admin") {
    $admin = $user;
    $statistics = $admin->getAdminStatistics($conn); 




if (isset($_POST['addTag'])) {
    $tagName = $_POST['tagName'];
    $admin->addTag($conn, $tagName);
}

if (isset($_POST['addCategory'])) {
    $categoryName = $_POST['categoryName'];
    $admin->addCategory($conn, $categoryName);
}
$tags = Tag::getAllTags($conn);
$categories = Category::getAllGategorys($conn);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
    <title>Dashboard</title>
</head>
<body class="text-gray-800 font-inter">
    <!-- Sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="../../index.php" class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="../../public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
        </a>
        <ul class="mt-4">
            <?php if ($user->getRole() == "Teacher") { ?>
                <span class="text-gray-400 font-bold">Teacher</span>
                <li class="mb-1 group">
                    <a href="dashboard.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class="ri-home-2-line mr-3 text-lg"></i>
                        <span class="text-sm">Dashboard</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class='bx bx-user mr-3 text-lg'></i>                
                        <span class="text-sm">Profile</span>
                    </a>
                </li>
                <span class="text-gray-400 font-bold">Courses</span>
                <li class="mb-1 group">
                    <a href="TeacherCourses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class='bx bx-archive mr-3 text-lg'></i>                
                        <span class="text-sm">My Courses</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="courses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class='bx bx-book mr-3 text-lg'></i>                
                        <span class="text-sm">All Courses</span>
                    </a>
                </li>
            <?php } elseif ($user->getRole() == "Admin") { ?>
                <span class="text-gray-400 font-bold">Admin</span>
                <li class="mb-1 group">
                    <a href="dashboard.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class="ri-home-2-line mr-3 text-lg"></i>
                        <span class="text-sm">Dashboard</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class='bx bx-user mr-3 text-lg'></i>                
                        <span class="text-sm">Profile</span>
                    </a>
                </li>
                <li class="mb-1 group">
                    <a href="users.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class='bx bx-group mr-3 text-lg'></i>                
                        <span class="text-sm">Users</span>
                    </a>
                </li>
                <span class="text-gray-400 font-bold">Courses</span>
                <li class="mb-1 group">
                    <a href="courses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class='bx bx-book mr-3 text-lg'></i>                
                        <span class="text-sm">All Courses</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
        <!-- Navbar -->
        <div class="py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>

            <ul class="ml-auto flex items-center">
                <li class="mr-1 dropdown">
                    <button type="button" class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24" style="fill: gray;"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>                    
                    </button>
                    <div class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                        <form action="" class="p-4 border-b border-b-gray-100">
                            <div class="relative w-full">
                                <input type="text" class="py-2 pr-4 pl-10 bg-gray-50 w-full outline-none border border-gray-100 rounded-md text-sm focus:border-blue-500" placeholder="Search...">
                                <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-900"></i>
                            </div>
                        </form>
                    </div>
                </li>
                <button id="fullscreen-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24" style="fill: gray;"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path></svg>
                </button>
                <script>
                    const fullscreenButton = document.getElementById('fullscreen-button');
                    fullscreenButton.addEventListener('click', toggleFullscreen);
                    function toggleFullscreen() {
                        if (document.fullscreenElement) {
                            document.exitFullscreen();
                        } else {
                            document.documentElement.requestFullscreen();
                        }
                    }
                </script>

                <li class="dropdown ml-3">
                    <button type="button" class="dropdown-toggle flex items-center">
                        <div class="flex-shrink-0 w-10 h-10 relative">
                            <div class="p-1 bg-white rounded-full focus:outline-none focus:ring">
                                <img class="w-8 h-8 rounded-full" src="../../public/<?php echo $user->getImage(); ?>" alt=""/>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping"></div>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full"></div>
                            </div>
                        </div>
                        <div class="p-2 md:block text-left">
                            <h2 class="text-sm font-semibold text-gray-800"><?php echo $user->getusername(); ?></h2>
                            <p class="text-xs text-gray-500"><?php echo $user->getRole(); ?></p>
                        </div>                
                    </button>
                    <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Profile</a>
                        </li>
                        <li>
                            <form method="POST" action="">
                                <a href="logout.php" role="menuitem" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50 cursor-pointer">
                                    Log Out
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <?php if ($user->getRole() == "Teacher") { ?>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                        <div class="flex justify-between mb-6">
                            <div>
                                <div class="flex items-center mb-1">
                                    <div class="text-2xl font-semibold"><?php echo $statistics['teacherCourses']; ?></div>
                                </div>
                                <div class="text-sm font-medium text-gray-400">Total Courses</div>
                            </div>
                        </div>
                        <a href="TeacherCourses.php" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
                    </div>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                        <div class="flex justify-between mb-4">
                            <div>
                                <div class="flex items-center mb-1">
                                    <div class="text-2xl font-semibold"><?php echo $statistics['studentsTotal']; ?></div>
                                </div>
                                <div class="text-sm font-medium text-gray-400">Total Students</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                        <div class="flex justify-between mb-6">
                            <div>
                                <div class="text-2xl font-semibold mb-1"><?php echo $statistics['popular_course']; ?></div>
                                <div class="text-sm font-medium text-gray-400">Most Popular Course</div>
                            </div>
                        </div>
                    </div>
            </div>
               <div class="">
                <div class="bg-white border border-gray-100 rounded-md lg:col-span-2">
                <div class="overflow-x-auto bg-white  rounded-lg ">
                <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
  <h3 class="text-2xl font-semibold text-gray-700 mb-4">Students Enrolled in Courses</h3>
  <div class="overflow-y-auto max-h-96"> 
    <table class="min-w-full table-auto">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Username</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Course Name</th>
          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $students = Cours_inscription::EnrolledStudentStatistic($conn,$teacher->getIdUser());

        foreach($students as $student){
            echo '
            <tr class="border-t">
          <td class="px-6 py-4 text-sm text-gray-700">'.$student['username'].'</td>
          <td class="px-6 py-4 text-sm text-gray-700">'.$student['titre'].'</td>
          <td class="px-6 py-4 text-sm text-gray-700">
            <form method="POST" action="">
               <input type="hidden" name="idStudent" value="'.$student['idStudent'].'">
              <input type="hidden" name="idCourse" value="'.$student['idCours'].'">
              <button type="submit"  name="deleteStudent" class="text-red-600 hover:text-red-800 focus:outline-none">Delete</button>
            </form>
          </td>
        </tr>
            ';
        }
        ?>

      </tbody>
    </table>
  </div>
</div>

          
</div>

                    
                </div>



            
            </div>
                <?php } elseif ($user->getRole() == "Admin") { ?>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                        <div class="flex justify-between mb-6">
                            <div>
                                <div class="flex items-center mb-1">
                                    <div class="text-2xl font-semibold"><?php echo $statistics['totalUsers']; ?></div>
                                </div>
                                <div class="text-sm font-medium text-gray-400">Total Users</div>
                            </div>
                        </div>
                        <a href="users.php" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
                    </div>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                        <div class="flex justify-between mb-4">
                            <div>
                                <div class="flex items-center mb-1">
                                    <div class="text-2xl font-semibold"><?php echo $statistics['totalCourses']; ?></div>
                                </div>
                                <div class="text-sm font-medium text-gray-400">Total Courses</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                        <div class="flex justify-between mb-6">
                            <div>
                                <div class="text-2xl font-semibold mb-1"><?php echo $statistics['totalTeachers']; ?></div>
                                <div class="text-sm font-medium text-gray-400">Total Teachers</div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php if ($user->getRole() == "Admin") { ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div class="bg-white border border-gray-100 rounded-md p-6 shadow-md">
    <h3 class="text-2xl font-semibold text-gray-700 mb-4">Tags</h3>
    <div class="overflow-y-auto max-h-80"> 
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Tag Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tags as $tag) { ?>
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo $tag['tagName']; ?></td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <button class="text-red-600 hover:text-red-800 focus:outline-none">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <form method="POST" action="" class="mt-4">
        <div class="flex items-center gap-2">
            <input type="text" name="tagName" placeholder="New Tag" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" name="addTag" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add</button>
        </div>
    </form>
</div>

<!-- Categories Section -->
<div class="bg-white border border-gray-100 rounded-md p-6 shadow-md">
    <h3 class="text-2xl font-semibold text-gray-700 mb-4">Categories</h3>
    <div class="overflow-y-auto max-h-80"> <!-- Add max height and scrollbar -->
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Category Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr class="border-t">
                        <td class="px-6 py-4 text-sm text-gray-700"><?php echo $category['categoryName']; ?></td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <button class="text-red-600 hover:text-red-800 focus:outline-none">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <form method="POST" action="" class="mt-4">
        <div class="flex items-center gap-2">
            <input type="text" name="categoryName" placeholder="New Category" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" name="addCategory" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add</button>
        </div>
    </form>
</div>
                </div>
            <?php } ?>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../public/assets/js/script.js"></script>
    <script src="../../public/assets/js/dashboard.js"></script>

</body>
</html>