
<?php 
session_start();
require_once '../db/config.php';
require_once '../classes/user.php';


$isLoggedIn = isset($_SESSION['user']);
if($isLoggedIn){
    $user = unserialize($_SESSION['user']);

}

if (isset($_POST['updateProfileForm'])) {
    
    $user->setUsername($_POST['ProfileName']);
    $user->setEmail($_POST['ProfileEmail']);
    $user->setAddress($_POST['ProfileAddress']);
    $user->setPhone($_POST['ProfilePhone']);
    
    $user->updateProfile($conn);
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
                <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
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
            <a href="courses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class='bx bx-book mr-3 text-lg'></i>                
                <span class="text-sm">All Courses</span>
            </a>
        </li>
        <?php }elseif($user->getRole()=="Student"){?>
            <span class="text-gray-400 font-bold">User</span>
            <li class="mb-1 group">
                <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
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
            <a href="courses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
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
                <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Profile</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="Profile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Users</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Coures</span>
                    <li class="mb-1 group">
            <a href="courses.php" class="flex font-semibold items-center py-2 px-4 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
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
                <h1 class="text-2xl font-semibold text-gray-800">Profil Details</h1>
                <div class="flex space-x-4 mt-6">
              
        </div>
            </div>
            <div class="h-screen w-full bg-gray-100">
    <div class="bg-blue-500 text-white py-8 px-4 flex items-center">
        <div class="flex items-center space-x-4">
            <img class="w-24 h-24 rounded-full border-4 border-white shadow-lg" src="../../public/<?php echo $user->getImage()?>" alt="User Avatar">
            <div>
                <h1 class="text-2xl font-semibold"><?php echo $user->getusername()?></h1>
                <p class="text-sm text-gray-200"><?php echo $user->getusername()?></p>
                <div class="flex items-center mt-2">
                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                    <span class="ml-2 text-sm">Online</span>
                </div>
            </div>
        </div>
    </div>

    <div class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div>
            <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
            <input type="text" id="username" name="username" value="<?php echo $user->getusername()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $user->getEmail()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-600">Role</label>
            <input type="text" id="role" name="role" value="<?php echo $user->getRole()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-600">Phone</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user->getPhone()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Address -->
        <div class="col-span-1 sm:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $user->getAddress()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Update Profile Button -->
        <div class="col-span-1 sm:col-span-2 lg:col-span-3 flex justify-end">
            <button type="button" id="changeProfile" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                Update Profile
            </button>
        </div>
    </div>
</div>


<form action="" method="POST">
<div id="updateProfile" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-50 hidden">
  <div id="ProfileForm" class="bg-white rounded-lg w-full max-w-[60rem] sm:max-w-3/4 md:max-w-2/3 p-4 sm:p-6 shadow-lg overflow-y-auto">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4 sm:mb-6">
      <h2 class="text-xl sm:text-2xl font-semibold text-gray-800">Update Profile</h2>
      <button id="cancelProfileUpdate" class="text-gray-500 hover:text-gray-700 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Form Fields -->
    <div class="space-y-4">
      <div class="flex flex-col">
        <label for="ProfileName" class="font-medium text-gray-600 text-sm sm:text-base">Name</label>
        <input type="text" id="ProfileName" name="ProfileName" value="<?php echo $user->getusername(); ?>" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Name" required>
      </div>

      <div class="flex flex-col">
        <label for="ProfileEmail" class="font-medium text-gray-600 text-sm sm:text-base">Email</label>
        <input type="email" id="ProfileEmail" name="ProfileEmail" value="<?php echo $user->getEmail(); ?>" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Email" required>
      </div>

      <div class="flex flex-col">
        <label for="ProfilePhone" class="font-medium text-gray-600 text-sm sm:text-base">Phone</label>
        <input type="text" id="ProfilePhone" name="ProfilePhone" value="<?php echo $user->getPhone(); ?>" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Phone Number" required>
      </div>

      <div class="flex flex-col">
        <label for="ProfileAddress" class="font-medium text-gray-600 text-sm sm:text-base">Address</label>
        <input type="text" id="ProfileAddress" name="ProfileAddress" value="<?php echo $user->getAddress(); ?>" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Address" required>
      </div>


    </div>

    <div class="mt-6 sm:mt-8 flex justify-between">
      <button id="cancelProfileUpdate" class="bg-red-500 text-white py-2 sm:py-3 px-6 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>
      <input type="submit" value="Update" name="updateProfileForm" id="changeProfile" class="bg-green-600 text-white py-2 sm:py-3 px-6 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>
  </div>
</div>
</form>




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
