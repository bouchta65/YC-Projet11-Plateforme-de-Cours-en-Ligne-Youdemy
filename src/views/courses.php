
<?php 

session_start();
require_once '../db/config.php';
require_once '../classes/course.php';
require_once '../classes/teacher.php';
require_once '../classes/category.php';


$isLoggedIn = isset($_SESSION['user']);
if($isLoggedIn){
    $user = unserialize($_SESSION['user']);

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
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
    <title>EduWeb Plateforme de Cours en Ligne </title>
</head>
<body class="text-gray-800 font-inter">
    <!--sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="../../index.php" class="flex items-center pb-4 border-b border-b-gray-800">

        <img src="../../public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
        </a>
        <ul class="mt-4">
            <?php if($user->getRole()=="Teacher"){?>
            <span class="text-gray-400 font-bold">Teacher</span>
            <li class="mb-1 group">
                <a href="dashboard.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            
            <li class="mb-1 group">
                <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Profile</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Coures</span>
            <li class="mb-1 group">
                <a href="TeacherCourses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-archive mr-3 text-lg'></i>                
                    <span class="text-sm">My Courses</span>
                </a>
            </li>
                    <li class="mb-1 group">
            <a href="courses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-book mr-3 text-lg'></i>                
                <span class="text-sm">All Courses</span>
            </a>
        </li>
        <?php }elseif($user->getRole()=="Student"){?>
            <span class="text-gray-400 font-bold">User</span>
            <li class="mb-1 group">
                <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Profile</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Coures</span>
            <li class="mb-1 group">
                <a href="studentCourses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-archive mr-3 text-lg'></i>                
                    <span class="text-sm">My Courses</span>
                </a>
            </li>
                    <li class="mb-1 group">
            <a href="courses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-book mr-3 text-lg'></i>                
                <span class="text-sm">All Courses</span>
            </a>
        </li>
        <?php }else{?>
            <span class="text-gray-400 font-bold">ADMIN</span>
            <li class="mb-1 group">
                <a href="dashboard.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            
            <li class="mb-1 group">
                <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Profile</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="users.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Users</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Coures</span>
                    <li class="mb-1 group">
            <a href="courses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-book mr-3 text-lg'></i>                
                <span class="text-sm">All Courses</span>
            </a>
        </li>
            <?php }?>
          
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end sidenav -->

    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
        <!-- navbar -->
        <div class="py-2 px-6 bg-[#f8f4f3] flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>

            <ul class="ml-auto flex items-center">
                <li class="mr-1 dropdown">
                    <button type="button" class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center  hover:text-gray-600">
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
                                <img class="w-8 h-8 rounded-full" src="../../public/<?php echo $user->getImage()?>" alt=""/>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping"></div>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full"></div>
                            </div>
                        </div>
                        <div class="p-2 md:block text-left">
                            <h2 class="text-sm font-semibold text-gray-800"><?php echo $user->getusername()?></h2>
                            <p class="text-xs text-gray-500"><?php echo $user->getRole()?></p>
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
    <div class="w-full mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">All Courses</h1>
               
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php 
                $courses = Course::getAllCourses($conn);
                foreach($courses as $course){
                    $badgeColor = '';
                    switch ($course['type']) {
                        case 'Beginner':
                            $badgeColor = 'bg-green-500'; 
                            break;
                        case 'Intermediate':
                            $badgeColor = 'bg-yellow-500';
                            break;
                        case 'Advanced':
                            $badgeColor = 'bg-red-500'; 
                            break;
                        default:
                            $badgeColor = 'bg-gray-500'; 
                            break;
                    }
                    echo '
                    <div class="max-w-xs bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <!-- Header Image -->
                        <div class="relative">
                            <a href="CourseDetails.php?id='.$course['idCours'].'">
                                <img src="../../public/'.$course['image'].'" alt="Course Image" class="w-full h-48 object-cover">
                            </a>
                            <!-- Badge (e.g., Beginner) -->
                              <div class="absolute top-4 left-4 ' . $badgeColor . ' text-white text-xs font-semibold px-3 py-1 rounded-full">
                                ' . $course['type'] . '
                            </div>
                      
                        </div>
                
                        <!-- Course Details -->
                        <div class="p-4">
                            <!-- Title -->
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 truncate">
                                '.$course['titre'].'
                            </h3>
                
                            <!-- Metadata -->
                            <div class="text-sm text-gray-600 space-y-1">
                                <!-- Teacher Name -->
                                <div class="flex items-center">
                                    <i class="ri-user-line mr-2"></i>
                                    <span>by: '.$course['username'].'</span>
                                </div>
                                <!-- Student Count -->
                                <div class="flex items-center">
                                    <i class="ri-group-line mr-2"></i>
                                    <span>'.$course['student_count'].' Students</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            
                
                ?>
            </div>
        </div>
    </div>
</div>


    </main>






    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../public/assets/js/script.js"></script>
    <script src="../../public/assets/js/dashboard.js"></script>

   

   

</body>
</html>
