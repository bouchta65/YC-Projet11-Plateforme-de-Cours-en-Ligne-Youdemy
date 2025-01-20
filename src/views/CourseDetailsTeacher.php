
<?php 
include "addCourse.php"; 
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $teacher->loadCourses($conn);
    $course = $teacher->getCourseById($courseId);

    if(isset($_POST['deletecourse'])){
      $course->deleteCourse($conn);
      header("Location: TeacherCourses.php");
    }

} else {
    echo "No Course ID .";
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
    <title>Admin Panel</title>
</head>
<body class="text-gray-800 font-inter">
    <!--sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">

        <img src="../../public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
        </a>
        <ul class="mt-4">
            <span class="text-gray-400 font-bold">ADMIN</span>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Profile</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-list-ul mr-3 text-lg'></i>                
                    <span class="text-sm">Activities</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Coures</span>
            <li class="mb-1 group">
            <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class='bx bxl-blogger mr-3 text-lg' ></i>                 
                    <span class="text-sm">My Courses</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-archive mr-3 text-lg'></i>                
                    <span class="text-sm">Archive</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">PERSONAL</span>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-bell mr-3 text-lg' ></i>                
                    <span class="text-sm">Notifications</span>
                    <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-600 bg-red-200 rounded-full">5</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-envelope mr-3 text-lg' ></i>                
                    <span class="text-sm">Messages</span>
                    <span class=" md:block px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-green-600 bg-green-200 rounded-full">2 New</span>
                </a>
            </li>
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
                <li class="dropdown">
                    <button type="button" class="dropdown-toggle text-gray-400 mr-4 w-8 h-8 rounded flex items-center justify-center  hover:text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="hover:bg-gray-100 rounded-full" viewBox="0 0 24 24" style="fill: gray;"><path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"></path></svg>                    
                    </button>
                    <div class="dropdown-menu shadow-md shadow-black/5 z-30 hidden max-w-xs w-full bg-white rounded-md border border-gray-100">
                        <div class="flex items-center px-4 pt-4 border-b border-b-gray-100 notification-tab">
                            <button type="button" data-tab="notification" data-tab-page="notifications" class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1 active">Notifications</button>
                            <button type="button" data-tab="notification" data-tab-page="messages" class="text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 pb-1">Messages</button>
                        </div>
                        <div class="my-2">
                            <ul class="max-h-64 overflow-y-auto" data-tab-for="notification" data-page="notifications">
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                            <div class="text-[11px] text-gray-400">from a user</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                            <div class="text-[11px] text-gray-400">from a user</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                            <div class="text-[11px] text-gray-400">from a user</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                            <div class="text-[11px] text-gray-400">from a user</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">New order</div>
                                            <div class="text-[11px] text-gray-400">from a user</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <ul class="max-h-64 overflow-y-auto hidden" data-tab-for="notification" data-page="messages">
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">John Doe</div>
                                            <div class="text-[11px] text-gray-400">Hello there!</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">John Doe</div>
                                            <div class="text-[11px] text-gray-400">Hello there!</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">John Doe</div>
                                            <div class="text-[11px] text-gray-400">Hello there!</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">John Doe</div>
                                            <div class="text-[11px] text-gray-400">Hello there!</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="py-2 px-4 flex items-center hover:bg-gray-50 group">
                                        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded block object-cover align-middle">
                                        <div class="ml-2">
                                            <div class="text-[13px] text-gray-600 font-medium truncate group-hover:text-blue-500">John Doe</div>
                                            <div class="text-[11px] text-gray-400">Hello there!</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
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
                                <img class="w-8 h-8 rounded-full" src="https://laravelui.spruko.com/tailwind/ynex/build/assets/images/faces/9.jpg" alt=""/>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping"></div>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full"></div>
                            </div>
                        </div>
                        <div class="p-2 md:block text-left">
                            <h2 class="text-sm font-semibold text-gray-800">John Doe</h2>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>                
                    </button>
                    <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Profile</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50">Settings</a>
                        </li>
                        <li>
                            <form method="POST" action="">
                                <a role="menuitem" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-[#f84525] hover:bg-gray-50 cursor-pointer"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
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
                <h1 class="text-2xl font-semibold text-gray-800">Course Details</h1>
                <div class="flex space-x-4 mt-6">
              
        </div>
            </div>
            <div class="">
  <div class="max-w-7xl mx-auto space-y-6">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden transform  ease-in-out">
  <div class="relative">
    <img 
      src="../../public/<?php echo $course->getImage(); ?>" 
      alt="Course Image" 
      class="w-full h-48 sm:h-64 md:h-72 lg:h-80 object-cover"
    >
    
    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
    
    <div class="absolute inset-0 flex flex-col justify-end p-4 sm:p-6 lg:p-8 bg-black/30 backdrop-blur-sm">
      <div class="space-y-2 sm:space-y-3 text-center sm:text-left">
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white drop-shadow-lg">
          <?php echo $course->getTitre(); ?>
        </h1>
        
        <p class="hidden sm:block text-white text-sm sm:text-base md:text-lg opacity-90">
          Category: 
          <span class="font-semibold">
            <?php  $category = $teacher->getCategoryById($conn , $course->getIdCategory()); 
            echo $category->getCategoryName();
            ?>
          </span>
        </p>
        
        <p class="hidden sm:block text-white text-sm sm:text-base md:text-lg opacity-90">
          By: 
          <span class="font-semibold">
            <?php echo $teacher->getUsername(); ?>
          </span>
        </p>
      </div>
      
      <div class="mt-4 sm:mt-6 w-full sm:w-auto">
        <button 
          id="viewCourseButt" 
          class="w-full sm:w-auto bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2 flex items-center justify-center transition-all duration-300 transform hover:scale-105 active:scale-95"
        >
          <svg 
            xmlns="http://www.w3.org/2000/svg" 
            class="w-6 h-6 mr-2" 
            fill="none" 
            viewBox="0 0 24 24" 
            stroke="currentColor" 
            stroke-width="2"
          >
            <path 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              d="M9 5v14l11-7-11-7z" 
            />
          </svg>
          View Course
        </button>
      </div>
    </div>
  </div>
</div>




    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="col-span-2 bg-white p-6 rounded-lg shadow-lg space-y-4">
        <div class="space-y-4 " id="coursDescriptionCont">
        <h2 id="courseDesTitle" class="text-2xl font-bold text-gray-800">Course Description</h2>
        <p  class="text-gray-600 leading-relaxed">
            <?php echo $course->getDescription(); ?>
        </p>        
        </div>
        
       
      
        <div class="mt-4 space-y-2">
            <div id="contenuFrame" class="hidden">
          <h3 class="text-2xl font-bold text-gray-800">Content</h3><br>
          <div class="aspect-w-16 aspect-h-9 bg-black rounded-md overflow-hidden">
          <?php if($course->getCourseType()== "pdf"){?>
     
     <div class="pdf-container bg-gray-100 flex flex-col items-center max-w-full mx-auto p-4">
     <canvas id="pdf-canvas" class="w-full max-w-full mb-4"></canvas>
     <div class="pagination flex justify-center items-center gap-4">
         <button id="prev-page" onclick="changePage(-1)" class="text-xs sm:text-sm md:text-base">
         Previous
         </button>
         <span class="text-xs sm:text-sm md:text-base">Page: <span id="page-num">1</span> / <span id="page-count">1</span></span>
         <button id="next-page" onclick="changePage(1)" class="text-xs sm:text-sm md:text-base">
         Next
         </button>
     </div>
     </div>
     <?php }else{?>

         <div class="">
             <div class="relative aspect-w-16 aspect-h-9">
                 <video class="w-full h-full object-cover" controls>
                     <source src="../../public/<?php echo $course->getContenu(); ?>" type="video/mp4">
                     Your browser does not support the video tag.
                 </video>
             </div>
        
     </div>
         <?php } ?>
          </div>
          </div>
          
      
 


          
   

        </div>

        <div class="space-y-2">
          <h3 class="text-lg font-semibold text-gray-800">Details</h3>
          <p class="text-gray-600">Type: <span class="font-medium">Video</span></p>
          <p class="text-gray-600">Category: <span class="font-medium">Web Development</span></p>
          <p class="text-gray-600">Date of Creation: <span class="font-medium">2024-01-18</span></p>
        </div>
  <form  method="POST" action="" >
   <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 mt-6">
   <button
    class="w-full sm:w-auto bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 flex items-center justify-center" id="editcoursee" name="editcourse">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M11 17.778l8.072-8.072a2 2 0 000-2.828l-2.828-2.828a2 2 0 00-2.828 0L5.344 12.122a2 2 0 00-.586 1.414V18h4.464a2 2 0 001.414-.586zM16 5l3 3" />
    </svg>
    Edit Course
  </button>

  <button
    class="w-full sm:w-auto bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 flex items-center justify-center" name="deletecourse" onclick="return confirmDelete()">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" type="submit">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M9 2h6a2 2 0 012 2v2h3a1 1 0 011 1v1a1 1 0 01-1 1h-1v10a2 2 0 01-2 2H8a2 2 0 01-2-2V8H5a1 1 0 01-1-1V6a1 1 0 011-1h3V4a2 2 0 012-2zm0 4v10m6-10v10" />
    </svg>
    Delete Course
  </button>

</div>

</form>



       
      </div>

      <!-- Sidebar -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-gray-800">Course Summary</h3>
        <ul class="mt-4 space-y-2">
          <li class="flex items-center">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m12 3h-7m0 0h7m-7 0v7"></path>
            </svg>
            <span class="ml-3 text-gray-700">Beginner Friendly</span>
          </li>
          <li class="flex items-center">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20 6h-8m0 0h8M4 6h4m4 0h4m-4 0h4m0 0v10m0 0h-8m12 0h-4"></path>
            </svg>
            <span class="ml-3 text-gray-700">20+ Hours of Content</span>
          </li>
          <li class="flex items-center">
            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M9 21h6a2 2 0 002-2V5a2 2 0 00-2-2H9a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
            <span class="ml-3 text-gray-700">Certificate of Completion</span>
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

        </div>
    </div>
</div>

<form method="POST" action="#" id="courseForm" enctype="multipart/form-data">
  <div id="CourseModel" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50 hidden">
  <div id="CourseForm" class="bg-white rounded-lg w-full max-w-[60rem] sm:max-w-3/4 md:max-w-2/3 p-4 sm:p-6 shadow-lg overflow-y-auto" >
    <div class="flex justify-between items-center mb-4 sm:mb-6">
      <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">New Course</h2>
      <button id="closecoursemodel" class="text-gray-500 hover:text-gray-700 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
      <div class="w-full max-w-[50rem] sm:w-2/3 space-y-4">
        <div class="flex flex-col">
          <label for="Titre_Course" class="font-medium text-gray-600 text-sm sm:text-base">Title</label>
          <input type="text" id="Titre_Course" name="Titre_Course" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Ex: First Principles of Machine Learning">
        </div>
        
        <div class="flex flex-col">
        <label for="Description_Course" class="font-medium text-gray-600 text-sm sm:text-base">Description</label>
        <div id="editor-container" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" style="height: 200px;"></div>
        <input type="hidden" id="Description_Course" name="Description_Course">
        </div>



        <div class="flex flex-col">
          <label for="Type_Course" class="font-medium text-gray-600 text-sm sm:text-base">Course Type</label>
          <select id="Type_Course" name="Type_Course" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
          </select>
        </div>
      </div>

      <div class="w-full sm:w-1/3 bg-gray-100 rounded-lg p-4 space-y-4">
        <div class="flex flex-col">
          <label for="Tags_Course" class="font-medium text-gray-600 text-sm sm:text-base">Tags</label>
          <select id="Tags_Course" name="Tags_Course[]" multiple class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php 
            $tags = Tag::getAllTags($conn);
            foreach($tags as $tag){
                echo '<option value="'.$tag['idTag'].'">'.$tag['tagName'].'</option>';
            }
            ?>
          </select>
        </div>
        <div class="flex flex-col">
          <label for="Category_Course" class="font-medium text-gray-600 text-sm sm:text-base">Category</label>
          <select id="Category_Course" name="Category_Course" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php 
            $categorys = Category::getAllGategorys($conn);
            foreach($categorys as $category){
                echo '<option value="'.$category['idCategory'].'">'.$category['categoryName'].'</option>';
            }
            ?>
          </select>
        </div>
        
        <div class="flex flex-col">
          <label for="Image_Course" class="font-medium text-gray-600 text-sm sm:text-base">Course Image</label>
          <input type="file" id="Image_Course" name="Image_Course" accept=".jpg, .jpeg, .png"  required class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="flex flex-col">
        <label for="File_Course" class="font-medium text-gray-600 text-sm sm:text-base">Course File (PDF)</label>
        <input type="file" id="File_Course" name="File_Course" accept=".pdf, .mp4, .avi, .mov" required class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
      </div>
    </div>

    <div class="mt-6 sm:mt-8 flex justify-between space-y-4 sm:space-y-0 sm:flex-row">
      <button id="closeModalBtn" class="bg-red-500 text-white py-2 sm:py-3 px-6 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>
      <input type="submit" value="Update" name="validateForm" id="validateForm" class="bg-green-600 text-white py-2 sm:py-3 px-6 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>
    </div>
</div>
</form>

    </main>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your course description here...',
        });

        const form = document.getElementById('courseForm');
        form.addEventListener('submit', function(event) {

            const descriptionInput = document.getElementById('Description_Course');
            descriptionInput.value = quill.root.innerHTML; 

            console.log("Description Content: ", descriptionInput.value);

            if (!descriptionInput.value.trim() || descriptionInput.value === '<p><br></p>') {
                alert('Please provide a valid description.');
                return;
            }
            alert('Form submitted successfully!');
        });
    </script>



    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../public/assets/js/script.js"></script>

    <script>
        // start: Sidebar
        const sidebarToggle = document.querySelector('.sidebar-toggle')
        const sidebarOverlay = document.querySelector('.sidebar-overlay')
        const sidebarMenu = document.querySelector('.sidebar-menu')
        const main = document.querySelector('.main')
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        })
        sidebarOverlay.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.add('active')
            sidebarOverlay.classList.add('hidden')
            sidebarMenu.classList.add('-translate-x-full')
        })
        document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
            item.addEventListener('click', function (e) {
                e.preventDefault()
                const parent = item.closest('.group')
                if (parent.classList.contains('selected')) {
                    parent.classList.remove('selected')
                } else {
                    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                        i.closest('.group').classList.remove('selected')
                    })
                    parent.classList.add('selected')
                }
            })
        })



        const popperInstance = {}
        document.querySelectorAll('.dropdown').forEach(function (item, index) {
            const popperId = 'popper-' + index
            const toggle = item.querySelector('.dropdown-toggle')
            const menu = item.querySelector('.dropdown-menu')
            menu.dataset.popperId = popperId
            popperInstance[popperId] = Popper.createPopper(toggle, menu, {
                modifiers: [
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8],
                        },
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 24,
                        },
                    },
                ],
                placement: 'bottom-end'
            });
        })
        document.addEventListener('click', function (e) {
            const toggle = e.target.closest('.dropdown-toggle')
            const menu = e.target.closest('.dropdown-menu')
            if (toggle) {
                const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
                const popperId = menuEl.dataset.popperId
                if (menuEl.classList.contains('hidden')) {
                    hideDropdown()
                    menuEl.classList.remove('hidden')
                    showPopper(popperId)
                } else {
                    menuEl.classList.add('hidden')
                    hidePopper(popperId)
                }
            } else if (!menu) {
                hideDropdown()
            }
        })

        function hideDropdown() {
            document.querySelectorAll('.dropdown-menu').forEach(function (item) {
                item.classList.add('hidden')
            })
        }
        function showPopper(popperId) {
            popperInstance[popperId].setOptions(function (options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: 'eventListeners', enabled: true },
                    ],
                }
            });
            popperInstance[popperId].update();
        }
        function hidePopper(popperId) {
            popperInstance[popperId].setOptions(function (options) {
                return {
                    ...options,
                    modifiers: [
                        ...options.modifiers,
                        { name: 'eventListeners', enabled: false },
                    ],
                }
            });
        }
        // end: Popper

        

        
    </script>

    <script>
        
let pdfDoc = null;
let currentPage = 1;
let totalPages = 1;
const canvas = document.getElementById('pdf-canvas');
const ctx = canvas.getContext('2d');

const url = '../../<?php echo $course->getContenu(); ?>'; 

pdfjsLib.getDocument(url).promise.then((pdf) => {
  pdfDoc = pdf;
  totalPages = pdf.numPages;
  document.getElementById('page-count').textContent = totalPages;
  renderPage(currentPage); 
});

function renderPage(pageNum) {
  pdfDoc.getPage(pageNum).then((page) => {
    const viewport = page.getViewport({ scale: 1 });
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    page.render({
      canvasContext: ctx,
      viewport: viewport
    });

    document.getElementById('page-num').textContent = pageNum;
  });
}

function changePage(direction) {
  if (currentPage + direction > 0 && currentPage + direction <= totalPages) {
    currentPage += direction;
    renderPage(currentPage);
  }
}

    </script>

</body>
</html>
