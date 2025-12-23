<div class="xl:col-span-2 bg-white/95 backdrop-blur-[2px]  rounded-2xl shadow-xl p-8 border border-white ring-1 ring-blue-100">
    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-100">
        <h3 class="text-2xl font-bold text-[#0F2C4F]">
            <span class="text-[#37B8BF]">👩‍💻</span> Programmers
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table id="Programmer_tbl" class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Projects</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Delayed</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Workload Status</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Developer Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pending Reviews</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">


                <?php foreach ($programmers as $programmer):

                    // Determine workload status
                    if ($programmer['tasks_assigned'] <= 3) {
                        $status_label = 'Light Workload';
                        $status_color = 'bg-green-500';
                    } elseif ($programmer['tasks_assigned'] <= 6) {
                        $status_label = 'Moderate Workload';
                        $status_color = 'bg-yellow-500';
                    } else {
                        $status_label = 'Heavy Workload';
                        $status_color = 'bg-red-500';
                    }

                ?>
                    <tr class="hover:bg-blue-50/30 transition duration-150 cursor-pointer"
                        data-href="<?= PAGES_PATH . '/dashboard.php?id=' . urlencode($programmer['id']) ?>">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                            <?= htmlspecialchars($programmer['name']) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= htmlspecialchars($programmer['tasks_assigned']) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-bold">
                            <?= htmlspecialchars($programmer['tasks_pending']) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-3 py-1 text-xs uppercase font-black rounded-full 
                            <?= $status_color ?> text-white">
                                <?= $status_label ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <?= htmlspecialchars($programmer['experience_years']) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <a href="/programmer/<?= urlencode($programmer['name']) ?>" class="text-[#37B8BF] hover:underline font-bold">
                                Details &rarr;
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>