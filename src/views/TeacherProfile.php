
<?php 
include "addEditCourse.php"; 
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $teacher->loadCourses($conn);
    $course = $teacher->getCourseById($conn,$courseId);

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
    <title>EduWeb Plateforme de Cours en Ligne </title>
</head>
<body class="text-gray-800 font-inter">
    <!--sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="../../index.php" class="flex items-center pb-4 border-b border-b-gray-800">

        <img src="../../public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
        </a>
        <ul class="mt-4">
            <span class="text-gray-400 font-bold">ADMIN</span>
            <li class="mb-1 group">
                <a href="dashboard.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            
            <li class="mb-1 group">
                <a href="teacherProfile.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 ">
                    <i class='bx bx-user mr-3 text-lg'></i>                
                    <span class="text-sm">Profile</span>
                </a>
            </li>
            <span class="text-gray-400 font-bold">Coures</span>
            <li class="mb-1 group">
            <a href="TeacherCourses.php" class="flex font-semibold items-center py-2 px-4 text-gray-900  hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class='bx bxl-blogger mr-3 text-lg' ></i>                 
                    <span class="text-sm">My Courses</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="InvolvedStudent.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class='bx bx-archive mr-3 text-lg'></i>                
                    <span class="text-sm">Students Involved</span>
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
                                <img class="w-8 h-8 rounded-full" src="../../public/<?php echo $teacher->getImage()?>" alt=""/>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-400 border-2 border-white rounded-full animate-ping"></div>
                                <div class="top-0 left-7 absolute w-3 h-3 bg-lime-500 border-2 border-white rounded-full"></div>
                            </div>
                        </div>
                        <div class="p-2 md:block text-left">
                            <h2 class="text-sm font-semibold text-gray-800"><?php echo $teacher->getusername()?></h2>
                            <p class="text-xs text-gray-500"><?php echo $teacher->getRole()?></p>
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
            <img class="w-24 h-24 rounded-full border-4 border-white shadow-lg" src="../../public/<?php echo $teacher->getImage()?>" alt="User Avatar">
            <div>
                <h1 class="text-2xl font-semibold"><?php echo $teacher->getusername()?></h1>
                <p class="text-sm text-gray-200"><?php echo $teacher->getusername()?></p>
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
            <input type="text" id="username" name="username" value="<?php echo $teacher->getusername()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $teacher->getEmail()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-600">Role</label>
            <input type="text" id="role" name="role" value="<?php echo $teacher->getRole()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Additional Information -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-600">Phone</label>
            <input type="text" id="phone" name="phone" value="<?php echo $teacher->getPhone()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Address -->
        <div class="col-span-1 sm:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-600">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $teacher->getAddress()?>" disabled class="mt-2 w-full p-3 border rounded-md bg-gray-50 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Update Profile Button -->
        <div class="col-span-1 sm:col-span-2 lg:col-span-3 flex justify-end">
            <button type="button" id="changeProfile" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                Update Profile
            </button>
        </div>
    </div>
</div>



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
        <input type="text" id="ProfileName" name="ProfileName" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Name" required>
      </div>

      <div class="flex flex-col">
        <label for="ProfileEmail" class="font-medium text-gray-600 text-sm sm:text-base">Email</label>
        <input type="email" id="ProfileEmail" name="ProfileEmail" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Email" required>
      </div>

      <div class="flex flex-col">
        <label for="ProfilePhone" class="font-medium text-gray-600 text-sm sm:text-base">Phone</label>
        <input type="text" id="ProfilePhone" name="ProfilePhone" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Phone Number" required>
      </div>

      <div class="flex flex-col">
        <label for="ProfileAddress" class="font-medium text-gray-600 text-sm sm:text-base">Address</label>
        <input type="text" id="ProfileAddress" name="ProfileAddress" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Address" required>
      </div>

      <div class="flex flex-col">
        <label for="ProfileImage" class="font-medium text-gray-600 text-sm sm:text-base">Profile Image</label>
        <input type="file" id="ProfileImage" name="ProfileImage" accept=".jpg, .jpeg, .png" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="flex flex-col">
        <label for="ProfilePassword" class="font-medium text-gray-600 text-sm sm:text-base">Password</label>
        <input type="password" id="ProfilePassword" name="ProfilePassword" class="mt-2 p-2 sm:p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="New Password">
      </div>
    </div>

    <!-- Actions -->
    <div class="mt-6 sm:mt-8 flex justify-between">
      <button id="cancelProfileUpdate" class="bg-red-500 text-white py-2 sm:py-3 px-6 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>
      <input type="submit" value="Update" name="updateProfileForm" id="updateProfileForm" class="bg-green-600 text-white py-2 sm:py-3 px-6 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>
  </div>
</div>




        </div>
    </div>
</div>



    </main>

<script>
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Write your course description here...',
    });

    const descriptionInput = document.getElementById('Description_Course');
    const descriptionContent = descriptionInput.value;

    if (descriptionContent) {
        quill.root.innerHTML = descriptionContent;
    }

    const form = document.getElementById('courseForm');
    form.addEventListener('submit', function(event) {
        descriptionInput.value = quill.root.innerHTML;

        console.log("Description Content: ", descriptionInput.value);

        if (!descriptionInput.value.trim() || descriptionInput.value === '<p><br></p>') {
            alert('Please provide a valid description.');
            event.preventDefault(); 
        } else {
            alert('Form submitted successfully!');
        }
    });
</script>




    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../public/assets/js/script.js"></script>
    <script src="../../public/assets/js/dashboard.js"></script>

   

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
