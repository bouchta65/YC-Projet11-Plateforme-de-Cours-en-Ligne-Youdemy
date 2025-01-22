<?php
session_start();
require_once '../db/config.php';
require_once '../classes/user.php';

$isLoggedIn = isset($_SESSION['user']);
if ($isLoggedIn) {
    $user = unserialize($_SESSION['user']);
    $admin = $user;
}

if ($user->getRole() !== "Admin") {
    header("Location: dashboard.php");
    exit();
}

$students = Student::getAllStudents($conn);
$activeTeachers = Teacher::getActiveTeachers($conn); 
$pendingTeachers =Teacher::getPendingTeachers($conn); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deleteUser'])) {
        $userId = $_POST['userId'];
        $admin->deleteUser($conn, $userId);
        header("Location: users.php"); 
        exit();
    }

    if (isset($_POST['activateTeacher'])) {
        $teacherId = $_POST['teacherId'];
        $admin->activateTeacher($conn, $teacherId);
        header("Location: users.php"); 
        exit();
    }
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
    <title>Manage Users</title>
</head>
<body class="text-gray-800 font-inter">
    <!-- Sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="../../index.php" class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="../../public/assets/images/logo.svg" width="162" height="50" alt="EduWeb logo">
        </a>
        <ul class="mt-4">
            <span class="text-gray-400 font-bold">Admin</span>
            <li class="mb-1 group">
                <a href="dashboard.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
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
            <li class="mb-1 group active">
                <a href="users.php" class="flex font-semibold items-center py-2 px-4 text-gray-900 bg-gray-950 text-white rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
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

        <!-- Users Section -->
        <div class="p-6">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Manage Users</h2>

            <!-- Students Table -->
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Students</h3>
                <div class="overflow-y-auto max-h-96">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Username</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student) { ?>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo $student['username']; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo $student['email']; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <form method="POST" action="" class="inline">
                                            <input type="hidden" name="userId" value="<?php echo $student['idUser']; ?>">
                                            <button type="submit" name="deleteUser" class="text-red-600 hover:text-red-800 focus:outline-none">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Active Teachers Table -->
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md mb-6">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Active Teachers</h3>
                <div class="overflow-y-auto max-h-96">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Username</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($activeTeachers as $teacher) { ?>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo $teacher['username']; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo $teacher['email']; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <form method="POST" action="" class="inline">
                                            <input type="hidden" name="userId" value="<?php echo $teacher['idUser']; ?>">
                                            <button type="submit" name="deleteUser" class="text-red-600 hover:text-red-800 focus:outline-none">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pending Teachers Table -->
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Pending Teachers</h3>
                <div class="overflow-y-auto max-h-96">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Username</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendingTeachers as $teacher) { ?>
                                <tr class="border-t">
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo $teacher['username']; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700"><?php echo $teacher['email']; ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <form method="POST" action="" class="inline">
                                            <input type="hidden" name="teacherId" value="<?php echo $teacher['idUser']; ?>">
                                            <button type="submit" name="activateTeacher" class="text-blue-600 hover:text-blue-800 focus:outline-none">Activate</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../public/assets/js/script.js"></script>
    <script src="../../public/assets/js/dashboard.js"></script>

</body>
</html>