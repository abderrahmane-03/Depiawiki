<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-gray-100">
    <div class="flex flex-col h-screen bg-gray-100">


        <div class="bg-white text-white shadow w-full p-2 flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex items-center">
                    <img src="../../public/images/wikipedia.png" alt="Logo" class="w-16 h-18 ml-4"> 
                    <img src="../../public/images/logo.png" alt="Logo" class="w-52 h-28 "> 
               
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-wrap">
            <div class="p-2 bg-white w-full md:w-60 flex flex-col md:flex hidden" id="sideNav">
                <nav><a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white"
                        href="index">
                        <i class="fas fa-home mr-2"></i>dashboard
                    </a>
                    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white"
                        href="users">
                        <i class="fas fa-users mr-2"></i>Tags
                    </a>

                    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white"
                        href="categories">
                        <i class="fas fa-file-alt mr-2"></i>Categories
                    </a>

                    <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white"
                        href="products">
                        <i class="fas fa-store mr-2"></i>wikis
                    </a>

                </nav>

                <a class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white mt-auto"
                    href="#">
                    <i class="fas fa-sign-out-alt mr-2"></i>logout
                </a>


            </div>
            
            <div class="flex-1 p-4 w-full md:w-1/2">

                <div class="mt-8 flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
                    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">

                        <h2 class="text-gray-500 text-lg font-semibold pb-1">authors</h2>
                        <div class="my-1"></div>
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div>
                        <div class="flex">
                            <span class="py-2 px-8 bg-grey-lightest font-bold uppercase text-l text-grey-light ">
                                <?= $data["users"]->countu ?>
                            </span>
                            <h3
                                class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-gray-500 border-b border-grey-light">
                                Active authors</h3>
                        </div>
                    </div>

                    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                        <h2 class="text-gray-500 text-lg font-semibold pb-1">categories</h2>
                        <div class="my-1"></div>
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div>
                        <div class="flex">
                            
                        <span class="py-2 px-16 bg-grey-lightest font-bold uppercase text-l text-grey-light ">
                            <?= $data["categoriess"]->countp ?>
                        </span>
                        <h3
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-gray-500 border-b border-grey-light">
                             categories</h3>
</div>
                    </div>

                    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                        <h2 class="text-gray-500 text-lg font-semibold pb-1">wikis</h2>
                        <div class="my-1"></div>
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div>
                        <div class="flex">
                         <span class="py-2 px-10 bg-grey-lightest font-bold uppercase text-l text-grey-light ">
                            <?= $data["commandes"]->counto ?>
                        </span>
                        <h3
                            class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-gray-500 border-b border-grey-light">
                            Active wikis</h3>

                    </div>
                </div>
                </div>


            </div>

        </div>
    </div>
</body>

</html>