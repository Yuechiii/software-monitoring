<?php require VIEWS_COMPONENTS_PATH . '/header.php' ?>
<div class="p-5">
    <div class="p-4 sm:p-8 space-y-10 min-h-screen">
        <h1 class="text-4xl font-extrabold text-[#0F2C4F] tracking-tight border-b pb-4 border-blue-200">
            <span class="text-[#37B8BF]">📊</span> Development Team Overview
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-white/40 ring-1 ring-blue-200 transform hover:shadow-2xl transition duration-500 ease-in-out">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Programmers</p>
                        <h2 class="text-4xl font-bold text-[#0F2C4F] mt-1">12</h2>
                    </div>
                    <div class="p-4 bg-[#37B8BF] rounded-full text-white shadow-lg shadow-[#37B8BF]/50">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20v-2m0 2H7m12-9h2m-2 0a5 5 0 00-10 0v2m0 0h-2m2 0h-2M9 16H9m8 0H9"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-white/40 ring-1 ring-blue-200 transform hover:shadow-2xl transition duration-500 ease-in-out">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Projects</p>
                        <h2 class="text-4xl font-bold text-[#0F2C4F] mt-1"><?= isset($number_of_projects) ? $number_of_projects : 0 ?></h2>
                    </div>
                    <div class="p-4 bg-[#2AA6B0] rounded-full text-white shadow-lg shadow-[#2AA6B0]/50">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5h6"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-white/40 ring-1 ring-blue-200 transform hover:shadow-2xl transition duration-500 ease-in-out">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Delayed Projects</p>
                        <h2 class="text-4xl font-bold text-red-600 mt-1">6</h2>
                    </div>
                    <div class="p-4 bg-red-500 rounded-full text-white shadow-lg shadow-red-500/50">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-white/40 ring-1 ring-blue-200 transform hover:shadow-2xl transition duration-500 ease-in-out">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending Reviews</p>
                        <h2 class="text-4xl font-bold text-[#0F2C4F] mt-1">9</h2>
                    </div>
                    <div class="p-4 bg-[#1EA0AA] rounded-full text-white shadow-lg shadow-[#1EA0AA]/50">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <div class="xl:col-span-2 bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-8 border border-white/40 ring-1 ring-blue-200">
                <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-100">
                    <h3 class="text-2xl font-bold text-[#0F2C4F]">
                        <span class="text-[#37B8BF]">👩‍💻</span> Programmer Workload Overview
                    </h3>

                </div>
                <div class="overflow-x-auto">
                    <table id="Programmer_tbl" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-blue-50/50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Total Projects
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Delayed Projects
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Workload Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Pending Reviews
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/70 divide-y divide-gray-100">

                            <!-- START OF PHP -->
                            <?php foreach ($programmers_tbl as $programmer => $val): ?>
                                <tr class="hover:bg-blue-50/50 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                        <?= $val['Programmer'] ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= $val['TOTAL_PROJECTS'] ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-bold">
                                        1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full shadow-sm bg-red-500 text-white">
                                            High
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        3
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="/programmer/Alice+Johnson" class="text-[#37B8BF] hover:text-[#0F2C4F] font-medium transition duration-300">View Details &rarr;</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <!-- END OF PHP -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="xl:col-span-1 space-y-8">
                <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 h-fit border border-white/40 ring-1 ring-blue-200">
                    <h3 class="text-2xl font-bold text-[#0F2C4F] mb-6 border-b pb-3 border-gray-100">
                        <span class="text-[#2AA6B0]">🧑‍💻</span> Team Workload Distribution
                    </h3>
                    <div class="flex justify-center items-center h-56 w-full p-4 bg-gray-50/50 rounded-lg shadow-inner">
                        <canvas id="workloadDonutChart" class="max-h-full max-w-full"></canvas>
                    </div>
                </div>
                <div class="bg-white/70 backdrop-blur-md rounded-2xl shadow-xl p-6 border border-white/40 ring-1 ring-blue-200">
                    <h4 class="text-xl font-bold text-[#0F2C4F] mb-4">
                        <span class="text-yellow-500">🔔</span> Action Required
                    </h4>
                    <p class="text-gray-700 mb-4">You have **6** projects delayed and **9** code reviews pending. Prioritize these items.</p>
                    <button class="w-full px-4 py-2 rounded-xl bg-indigo-500 text-white font-semibold hover:bg-indigo-600 transition shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/50">
                        Go to Delayed Projects
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require VIEWS_COMPONENTS_PATH . '/footer.php' ?>