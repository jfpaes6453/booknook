<?php session_start();  ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="http://localhost/booknook/src/resources/css/base.css">
    <!-- <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* Estilos para el botón de cerrar */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style> -->
</head>

<body class="container-fluid p-0 ct-body">
    <header class="bg-white border-b-2 border-[#FF621E] text-white pt-4 pb-4 px-10 flex justify-between items-center">
        <picture class="w-[10rem]">
            <img src="http://localhost/booknook/src/resources/img/logo_1.png" alt="Logo">
        </picture>
        <nav class="flex items-center space-x-32 justify-end">
            <a href="http://localhost/booknook/index.php" class=" py-[0.3rem] px-[0.2rem] text-center text-zinc-800 text-[0.9rem] font-semibold font-['Nunito Sans'] hover:border-b-[0.2rem] hover:border-[#FF621E] transition ease-all delay-[0.2s]">HOME</a>

            <?php if (isset($_SESSION['user_id'])) : ?>

                <a href="http://localhost/booknook/index.php" class=" py-[0.3rem] px-[0.2rem] text-center text-zinc-800 text-[0.9rem] font-semibold hover:border-b-[0.2rem] hover:border-[#FF621E] transition ease-all delay-[0.2s]">ADD A NEW BOOK</a>
                <a href="http://localhost/booknook/src/controller/LogoutController.php" class="py-[0.3rem] px-[0.2rem] text-center text-zinc-800 text-[0.9rem] font-semibold font-[\'Nunito Sans\'] hover:border-b-[0.2rem] hover:border-[#FF621E] transition ease-all delay-[0.2s]">LOGOUT</a>
            <?php else : ?>
                <button data-modal-target="loginModal" data-modal-toggle="loginModal" class="py-[0.2rem] px-[0.2rem] flex gap-[0.5rem] text-center text-zinc-800 text-[0.9rem] font-semibold font-[\'Nunito Sans\'] hover:border-b-[0.2rem] hover:border-[#FF621E] transition ease-all delay-[0.2s]">LOGIN
                    <picture class="w-[1rem]">
                        <img src="http://localhost/booknook/src/resources/img/icon_user.png" alt="User Icon">
                    </picture>
                </button>
            <?php endif; ?>
        </nav>
    </header>
    <!-- Modal -->
    <div id="loginModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full"> <!-- MAIN MODAL -->
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 flex">
                <!-- Image on the left side -->
                <button type="button" class="absolute top-[2rem] right-[2rem] end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="loginModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="hidden md:block w-[60%]">
                    <img src="./src/resources/img/imagen-login 1.svg" alt="Left Side Image" class="object-contain w-full h-full rounded-lg">
                </div>
                <div class="w-full md:w-1/2 p-[2rem]"> <!-- Right Side Content -->
                    <!-- Modal header with smaller image on top -->
                    <div class="flex items-center justify-between px-4 pt-4 pb-[0.5rem]  border-b rounded-t dark:border-gray-600">
                        <div class=" items-center w-full"> <!-- Title and smaller image -->
                            <div class="w-full flex justify-center items-center">
                                <img src="./src/resources/img/logo_1.png" alt="Small Image" class="h-auto max-w-m block w-[15rem]">
                            </div>
                            <h3 class="mt-[1rem] text-[2.5rem] leading-[2.2rem] font-bold text-gray-600 dark:text-white block">
                                Hi,
                            </h3>
                            <h4 class="text-[2rem]">
                                Welcome again!
                            </h4>
                        </div>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" action="http://localhost/booknook/src/controller/LoginController.php" method="POST">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email *</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="user@booknook.com" required />
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password *</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <button type="submit" class="w-full font-extrabold bg-[#FED78C] hover:bg-yellow-100 focus:ring-4 focus:outline-none focus:ring-yellow-200 rounded-lg text-lg px-5 py-2.5 text-center dark:bg-yellow-200 dark:hover:bg-yellow-200 dark:focus:ring-yellow-200 text-[#898181]">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>