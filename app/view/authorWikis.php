<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/depiawiki/app/service/WikiService.php");

include_once($_SERVER["DOCUMENT_ROOT"] . "/depiawiki/app/service/CategoryService.php");

include_once($_SERVER["DOCUMENT_ROOT"] . "/depiawiki/app/service/TagService.php");

include_once($_SERVER["DOCUMENT_ROOT"] . "/depiawiki/app/service/UserService.php");
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-gray-100">
    <div class="flex flex-col h-screen bg-gray-100">


        <div class="bg-white text-whit w-full flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex items-center">
                    <img src="../../public/images/wikipedia.png" alt="Logo" class="w-16 h-16 ml-4">
                    <img src="../../public/images/logo.png" alt="Logo" class="w-52 h-28 ">

                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-wrap">
            <div class="p-2 bg-white w-full md:w-60 flex flex-col md:flex hidden" id="sideNav">
                <nav>

                    <a class="block flex text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-gray"
                        href="../view/adminWikis.php">
                        <i class="flex fas fa-store mr-2"><svg class="w-6 h-6 text-gray-800 dark:text-gray"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 18">
                                <path
                                    d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a1 1 0 0 0 1.506 0L13.454 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z" />
                            </svg></i>wikis
                    </a>

                </nav>

                <a class="block flex text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-500 hover:to-cyan-500 hover:text-white mt-auto"
                    href="/depiawiki/public/login.php">
                    <i class="fas fa-sign-out-alt mr-2"><svg class="w-6 h-6 text-gray-800 dark:text-gray"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 15">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 7.5h11m0 0L8 3.786M12 7.5l-4 3.714M12 1h3c.53 0 1.04.196 1.414.544.375.348.586.82.586 1.313v9.286c0 .492-.21.965-.586 1.313A2.081 2.081 0 0 1 15 14h-3" />
                        </svg></i>logout
                </a>


            </div>
            <div class="flex-1 p-4 w-full md:w-1/2">
            <div class="text-right mt-4">
                    <button id="addBtn" class="mr-4 bg-cyan-500 text-white px-4 py-2 rounded">Add Wiki</button>
                </div>
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <?php
                    $WikiService = new WikiService;
                    $loggedInUserId = $_SESSION['user_id'];
                    $author = $_SESSION['username'];
                   
                    $loggedInUserWiki = new Wiki();
                    $loggedInUserWiki->setIduser($loggedInUserId);
                    $Wikis = $WikiService->displayonly($loggedInUserWiki);
                    foreach ($Wikis as $Wiki): ?>
                        <div class="flex-1  p-4  min-w-md max-w-md">
                            <div class="mt-8">
                                <div class="flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
                                    <div class="flex-1 bg-white p-4 shadow rounded-lg md:w-1/2">
                                    <h2 class="flex justfy-between ml-2 text-black text-lg font-semibold pb-1">
                                         author: <?= $author ?>
                                          </h2>
                                        <h2 class="flex justfy-between text-gray-500 text-lg font-semibold pb-1">
                                            <img src="../../public/images/<?= $Wiki['pictureWiki']; ?>"
                                                class="w-52 h-28" alt="">
                                               <p class="ml-8"> <?= $Wiki['dateCreated']; ?></p>
                                        </h2><span class=" flex justify-between py-2 px-8 bg-grey-lightest font-bold uppercase
                                            text-l text-grey-light ">
                                            <?= $Wiki['title']; ?>
                                            <div class="flex">
                                                <p class="px-4">id:<?= $Wiki['idWiki']; ?>
                                                </p>
                                                
                                                <form method="post">
                                                    <input type="hidden" name="idWiki">
                                                    <button type="button"
                                                        onclick="showeditModal(<?= $Wiki['idWiki'] ?>)">
                                                        <svg class="w-6 h-6 text-gray-800 dark:text-gray-500"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 20 18">
                                                            <path
                                                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                                                            <path
                                                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="../controller/Wiki.php" method="POST">
                                                    <input type="hidden" name="deletewiki">
                                                    <input type="hidden" name="delete_Wiki_ID"
                                                        value="<?= $Wiki['idWiki'] ?>">
                                                    <button type="submit" data-modal-toggle="delete-product-modal">

                                                        <svg class="w-6 h-6 text-gray-800 dark:text-gray-500"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 18 20">
                                                            <path
                                                                d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                                                        </svg>
                                                        
                                                    </button>
                                                </form>
                                            </div>
                                        </span>
                                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div>
                                        <div class="flex">
                                            <div class="w-96">
                                                <?= $Wiki['content']; ?>
                                            </div>
                                        </div>
                                        <h3
                                            class="flex space-x-12 py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-gray-500 border-b border-grey-light">
                                         <p class="flex"><svg class="w-6 h-6 text-gray-800 dark:text-gray"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 16">
                                <path d="M18 0H6a2 2 0 0 0-2 2h10a4 4 0 0 1 4 4v6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Z" />
                                <path d="M14 16H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2Z" />
                                <path d="M8 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm0-4a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z" />
                            </svg><?= $Wiki['nameCategory'];?></p> 
                                        </h3><h3
                                            class="flex space-x-12 py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-gray-500 border-b border-grey-light">
                                         <p class="flex"><svg class="w-6 h-6 text-gray-800 dark:text-gray" aria-hidden="
                                true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                <path
                                    d="M15.045.007 9.31 0a1.965 1.965 0 0 0-1.4.585L.58 7.979a2 2 0 0 0 0 2.805l6.573 6.631a1.956 1.956 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 18 8.479v-5.5A2.972 2.972 0 0 0 15.045.007Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                            </svg><?= $Wiki['tagNames'];?></p> 
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div id="addModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center flex justify-center">
            <div class="bg-white p-8 rounded shadow-lg w-96">
                <h2 class="text-2xl font-bold mb-4">Add Wiki</h2>
                <form id="addForm" action="../controller/Wiki.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-semibold text-gray-600">title:</label>
                        <input type="text" id="title" name="title" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-semibold text-gray-600">Content:</label>
                        <input type="text" id="content" name="content" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="Wikipic" class="block text-sm font-semibold text-gray-600">Wiki pic:</label>
                        <input type="file" id="Wikipic" name="Wikipic" class="w-full p-2 border rounded">
                    </div>
                    <div>
                    <label for="CategoryId" class="block text-sm font-semibold text-gray-600">Select Category:</label>
                    <select name="Category_Id"  class="w-full p-2 border rounded">
                        <?php
                        $CategoryService = new CategoryService();
                        $Categorys = $CategoryService->display();
                        foreach ($Categorys as $Category) {
                            echo "<option value='$Category[idCategory]'>$Category[nameCategory]</option>";
                        }
                        ?>
                    </select>
         <div>     
         <?php
                        $TagService = new TagService();
                        $Tags = $TagService->display();
                        foreach ($Tags as $Tag) {      
                            echo" <input type='checkbox' id='tag' name='tag[]' value='$Tag[idTag]'>
                  <label for='tag'> $Tag[nameTag]</label><br>";}?>
</div>
                </div>
                

                    <button type="submit" name="addWiki" class="bg-cyan-500 text-white px-4 py-2 rounded">Add
                        Wiki</button>
                    <button type="button" id="closeAddModal"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </form>
            </div>
        </div>
        <div id="editModal"
            class="fixed inset-0 bg-gray-900 bg-opacity-80 backdrop-blur-sm hidden items-center flex justify-center">
            <div class="bg-white p-8 rounded shadow-lg w-96">
                <h2 class="text-2xl font-bold mb-4">edite Wiki</h2>
                <form method="post" action="../controller/Wiki.php" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-semibold text-gray-600">Title:</label>
                        <input type="text" id="title" name="title" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-semibold text-gray-600">Content:</label>
                        <input type="text" id="content" name="content" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label for="Wikipic" class="block text-sm font-semibold text-gray-600">Wiki pic:</label>
                        <input type="file" id="Wikipic" name="Wikipic" class="w-full p-2 border rounded">
                    </div>
                    
                    <div>                 
                </div>
                    <input type="hidden" id="id-edit" name="id-edit">
                    <button type="submit" name="editWiki" action="../controller/Wiki.php"
                        onclick="hideeditModal()" class="bg-cyan-500 text-black px-4 py-2 rounded">edit
                        Wiki</button>
                    <button type="button" id="closeeditModal" onclick="hideeditModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script src="/depiawiki/public/js/modal.js"></script>
</body>

</html>