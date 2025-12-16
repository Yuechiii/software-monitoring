<?php
$activeClass = 'bg-cyan-50 text-cyan-800 font-bold shadow-lg shadow-cyan-950/20 ring-2 ring-cyan-500/50';
$inactiveClass = 'text-gray-300 hover:bg-cyan-700 hover:text-white';
$iconActive = 'text-cyan-700';
$iconInactive = 'text-gray-400';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title><?= isset($active_page) ? $active_page . " | Software Monitoring" : '' ?> </title>
    <link rel="stylesheet" href="<?= GLOBAL_SRC ?>/css/global.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="flex flex-row min-h-screen">

        <div id="sidebar-container" class="w-60 flex-none transition-all duration-1000 ease-in-out">
            <div id="sidebar" class="flex flex-col bg-linear-to-br from-cyan-900 to-cyan-800 h-full min-h-screen p-4 w-full shadow-2xl transition-all duration-1000 ease-in-out">

                <div class="bg-white/10 backdrop-blur-sm rounded-xl flex flex-col items-center shadow-inner shadow-cyan-950/20border border-white/20">
                    <div class="flex flex-row justify-center items-center py-2 overflow-hidden w-full">

                        <img id="logo-img" class="h-10 sm:h-12 mr-1 transition-opacity duration-1000" src="<?= GLOBAL_SRC ?>/assets/logo.png" alt="DDC Logo">
                    </div>



                    <div id="logo-title" class="mb-2 h-auto opacity-100 transition-opacity duration-1000">

                        <h1 class="text-xl font-extrabold text-white text-center whitespace-nowrap">
                            THE
                            <span class="text-cyan-400">DDC</span>
                            GROUP
                        </h1>
                    </div>

                </div>

                <nav class="flex flex-col items-start gap-y-3 grow pt-8 w-full">
                    <a href="<?= PAGES_PATH . '/dashboard.php' ?>"
                        class="w-full rounded-xl p-3 flex items-center gap-x-4 whitespace-nowrap
                        <?= $active_page === 'Dashboard' ? $activeClass : $inactiveClass ?>">

                        <i class="fas fa-grip text-xl w-6 text-center
                        <?= $active_page === 'Dashboard' ? $iconActive : $iconInactive ?>"></i>

                        <span class="link-text text-base">Dashboard</span>
                    </a>
                    <a href="<?= PAGES_PATH . '/users.php' ?>"
                        class="w-full rounded-xl p-3 flex items-center gap-x-4 whitespace-nowrap
                        <?= $active_page === 'Users' ? $activeClass : $inactiveClass ?>">

                        <i class="fas fa-grip text-xl w-6 text-center
                        <?= $active_page === 'Users' ? $iconActive : $iconInactive ?>"></i>

                        <span class="link-text text-base">Users</span>
                    </a>





                </nav>

            </div>
        </div>

        <div class="flex-1">
            <header class="w-full bg-white shadow-md sticky top-0 z-10">
                <div class="flex items-center justify-between px-4 py-3 sm:px-6">
                    <div class="flex flex-row gap-x-2 items-center">

                        <button
                            id="sidebar-toggle"
                            class=" px-3 py-2 flex justify-center border rounded-full
                        text-black
                       shadow-2xl">
                            <i id="collapse-icon" class="fas fa-angle-double-left text-sm transition-all duration-1000 ease-in-out"></i>
                        </button>
                        <h1 class="text-xl sm:text-2xl font-bold font-roboto-flex text-gray-800">
                            <?= isset($active_page) ? $active_page : "" ?>
                        </h1>
                    </div>


                    <div class="relative flex items-center gap-x-4 sm:gap-x-6">
                        <h2 class="text-base font-semibold text-cyan-700 hidden sm:block">
                            Welcome, MARC JOSEPH DAYLO
                        </h2>
                        <div id="user-menu-button" class="flex items-center gap-x-2 cursor-pointer group select-none" aria-expanded="false">
                            <div class="h-9 w-9 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-600 border-2 border-cyan-500 transition group-hover:bg-cyan-200">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm-2 9c-2.67 0-8 1.34-8 4v3h20v-3c0-2.66-5.33-4-8-4h-4z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 sm:hidden">
                                MARC JOSEPH DAYLO
                            </span>
                            <svg id="dropdown-arrow" class="h-4 w-4 text-gray-400 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div
                            id="user-menu-dropdown"
                            class="hidden absolute right-0 top-full mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none origin-top-right z-20">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <a href="/software-monitoring/pages/logout.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700" role="menuitem" tabindex="-1">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>