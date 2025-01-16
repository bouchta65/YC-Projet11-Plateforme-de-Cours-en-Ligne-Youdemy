<?php 
session_start();
include '../db/config.php'; 
include '../classes/user.php';

if(isset($_POST['loginbutton'])){
  $email = $_POST['emaillogin'];
  $pass = $_POST['passwordlogin'];
  User::login($conn,$email,$pass);
  }

  
// if(isset($_POST['registrebutton'])){
//   $name = $_POST['nameregistre'];
//   $dateofbirth = $_POST['dateofbirth'];
//   $currentDate = time();
//   $age = ($currentDate - strtotime($dateofbirth)) / (60 * 60 * 24 * 365.25);
//   $email = $_POST['emailregister'];
//   $pass = $_POST['passwordregister'];
//   $member = new Member($conn,$name,$email,$age,$pass,"user");
//   $member->registre();
//   }

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

<section id="registre" class="w-full max-w-lg hidden">
  <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="p-6">
      <h3 class="text-2xl font-bold text-center text-gray-700">Register</h3>

      <form action="#" method="POST" class="mt-8 space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
          <div class="relative">
            <input 
              type="text" 
              name="name" 
              placeholder="Enter your full name" 
              class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Date of Birth</label>
          <div class="relative">
            <input 
              type="date" 
              name="date" 
              class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Email</label>
          <div class="relative">
            <input 
              type="email" 
              name="email" 
              placeholder="Enter your email" 
              class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-2">Password</label>
          <div class="relative">
            <input 
              type="password" 
              name="password" 
              placeholder="Create a password" 
              class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
          </div>
        </div>

        <button 
          type="submit" 
          name="registrebutton" 
          class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
          Register
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
          Already have an account? 
          <a href="#" id="registretologin" class="text-blue-500 hover:underline">Login here</a>
        </p>
      </form>
    </div>
  </div>
</section>

<script src="../../public/assets/js/script.js"></script>

</body>
</html>