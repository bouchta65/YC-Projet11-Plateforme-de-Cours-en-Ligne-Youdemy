<?php 
include '../db/config.php'; 
include '../classes/user.php';

if(isset($_POST['loginbutton'])){
  $email = $_POST['emaillogin'];
  $pass = $_POST['passwordlogin'];
  User::login($conn,$email,$pass);
  }

  
if(isset($_POST['registrebutton'])){
  $name = $_POST['nameregistre'];
  $role = $_POST['role'];
  $email = $_POST['emailregister'];
  $password = $_POST['passwordregister'];
  $address = $_POST['address'];
  $phone = $_POST['phone'];
  $target_dir = "../../public/assets/images/coursesData/";
  $unique_identifier = uniqid('', true);

  $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
  $image_path = $target_dir . $unique_identifier . '.' . $imageFileType;
  move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

  user::registre($conn,$name,$email,$password,$role,$image_path,$address,$phone);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bruxy Blog</title>
  <link rel="icon" href="../../public/assets/images/Neon Green and Black Graffiti Urban Grunge Logo.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../../public/assets/css/header.css">

  <body class="p-6 min-h-screen flex items-center justify-center bg-gray-100">
  <div class="absolute top-6 left-6">
    <img src="../../public/assets/images/logo.svg" alt="Logo" class="w-32 h-auto">
  </div>
  <section id="login" class="w-full max-w-lg">
  <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-6">
      <h3 class="text-2xl font-bold text-center text-gray-700">Login</h3>

      <form action="#" method="POST" class="mt-8 space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Email</label>
          <div class="relative">
            <input 
              type="email" 
              name="emaillogin"
              required 
              placeholder="Enter your email" 
              class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Password</label>
          <div class="relative">
            <input 
              type="password" 
              name="passwordlogin" 
              required
              placeholder="Enter your password" 
              class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>
        </div>

        <button 
          type="submit" 
          name="loginbutton" 
          class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
          Login
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
          Don’t have an account? 
          <a href="#" id="logintoregistre" class="text-blue-500 hover:underline">Register now</a>
        </p>
      </form>
    </div>
  </div>
</section>

<section id="registre" class="w-full hidden">
  <div class="bg-white rounded-xl shadow-lg overflow-hidden px-8 py-6 mx-auto max-w-7xl">
    <h3 class="text-3xl font-bold text-center text-gray-700">Register</h3>

    <form action="#" method="POST" enctype="multipart/form-data" class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Full Name -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
        <input 
          type="text" 
          name="nameregistre" 
          placeholder="Enter your full name" 
          required
          class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <!-- Role -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">Role</label>
        <select 
          name="role" 
          class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
          <option value="Student">Student</option>
          <option value="Teacher">Teacher</option>
        </select>
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">Email</label>
        <input 
          type="email" 
          name="emailregister" 
          required
          placeholder="Enter your email" 
          class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">Password</label>
        <input 
          type="password" 
          name="passwordregister" 
          placeholder="Create a password" 
          required
          class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">Photo</label>
        <input 
          type="file" 
          name="image" 
          accept=".jpg, .jpeg, .png"
          required
          class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">

      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">Address</label>
        <input 
          type="text" 
          name="address"
          required 
          placeholder="Enter your address" 
          class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-600 mb-2">Phone Number</label>
        <input 
          type="number" 
          name="phone" 
          required
          placeholder="Enter your phone number" 
          class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div></div>

      <div class="col-span-1 md:col-span-2">
        <button 
          type="submit" 
          name="registrebutton" 
          required
          class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
          Register
        </button>
        <p class="text-center text-sm text-gray-600 mt-4">
          Already have an account? 
          <a href="#" id="registretologin" class="text-blue-500 hover:underline">Login here</a>
        </p>
      </div>
    </form>
  </div>
</section>


<script src="../../public/assets/js/script.js"></script>

</body>
</html>