<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['nameRole']);

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>DEPIA WIKI </title>
    <link rel="shortcut icon" type="image/icon" href="/../images/wikipedia.png" />
</head>

<body>
    <section class="bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen">
            <img class="w-[44rem] h-[24rem] mr-12" src="/depiawiki/public/images/logo.png" alt="logo">

            <div class="w-full  rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 bg-gray-800 border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="md:text-2xl text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="/depiawiki/app/controller/auth.php" method="post">

                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-white">username</label>
                            <input id="username" type="username" name="username"
                                class="bg-gray-50 border border-gray-300 sm:text-sm rounded-lg  block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                                placeholder="username">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                            <input id="password" type="password" name="password" placeholder="•••••••"
                                class="bg-gray-50 border border-gray-300 sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <button name="login" type="submit"
                            class="w-full text-white hover:bg-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-cyan-500 ">log
                            in</button>
                        <P class=" flex justify-center text-white">
                            You don't have an account ? please click here
                        </P><a class="flex justify-center text-cyan-500" href="register.php">register</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>