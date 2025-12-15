<?php require "components/header.php" ?>

<body class="relative min-h-screen flex flex-col items-center justify-center bg-(--accent)">
    <div class="flex flex-col-reverse lg:flex-row items-center font-roboto bg-white rounded-xl shadow-[8px_8px_7px_6px_rgba(17,76,86,0.4)] m-10 p-10 lg:gap-10 transition-all duration-200 ease-in-out">
        <div>
            <div class="mb-6 flex flex-col items-center lg:items-start">
                <h1 class="lg:text-3xl text-xl text-(--accent) font-bold">Software Monitoring</h1>
                <h1 class="lg:text-[17px] text-xs text-(--base)">Integrated with HRMS Credentials</h1>
            </div>

            <form class="flex flex-col justify-center gap-y-3 font-roboto w-full" action="../pages/login.php?f=validation" method="post">
                <div class="flex flex-col">
                    <span class="text-red-500">Email is wrong password is correct!</span>
                    <input class="lg:text-[16px] text-xs rounded-lg border border-slate-300 placeholder-slate-500 placeholder:font-normal placeholder:normal-case font-bold uppercase text-(--base) bg-slate-200 pl-2 py-2 focus:outline-1 focus:outline-slate-400" type="name" name="_username" placeholder="Username">
                </div>
                    <input class="lg:text-[16px] text-xs rounded-lg border border-slate-300 placeholder-slate-500 placeholder:font-normal placeholder:normal-case placeholder:tracking-normal font-bold tracking-widest bg-slate-200 pl-2 py-2 focus:outline-1 focus:outline-slate-400" type="password" name="_password" placeholder="Password">

                <input class="w-full lg:text-[15px] text-sm bg-(--accent) text-white hover:bg-(--accent-hover)  rounded-full lg:p-2.5 p-[5px] mt-5 lg:font-bold font-semibold" type="submit" value="Login">

                <div class="flex flex-row justify-center">

                    <a class="hover:text-[#1EA0AA] lg:text-sm text-xs underline text-blue-950" href="">Forgot password?</a>
                </div>
            </form>
        </div>

        <div class="border-l border-gray-300 h-60 lg:block hidden"></div>

        <div class="flex flex-col items-center mb-5 lg:p-5">
            <img class="lg:h-30 lg:w-45 h-15 w-25" src="../src/assets/logo.png" alt="">
            <h1 class="font-bold lg:text-[18px] text-sm text-blue-950">The <span class="text-(--accent)">DDC</span> Group</h1>
        </div>
    </div>

</body>



</html>