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
            <div>
                <a href="/ruta/a/login" class="py-[0.2rem] px-[0.2rem] flex gap-[0.5rem] text-center text-zinc-800 text-[0.9rem] font-semibold font-['Nunito Sans'] hover:border-b-[0.2rem] hover:border-[#FF621E] transition ease-all delay-[0.2s]">LOGIN
                    <picture class="w-[1rem]">
                        <img src="http://localhost/booknook/src\resources\img\icon_user.png" alt="User Icon">
                    </picture>
                </a>
            </div>
        </nav>
    </header>