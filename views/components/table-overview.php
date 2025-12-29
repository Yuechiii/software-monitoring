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
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pending Reviews</th>

                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">


                <?php foreach ($overview_container as $programmer):

                    // Determine workload status based on Workload_percentage
                    $workload = $programmer['Workload_percentage'];

                    if ($workload <= 5) {
                        $status_label = 'Very Light Workload';
                        $status_color = 'bg-blue-200';
                        $status_text = "text-blue-500";
                        $status_border = "border-blue-400";
                    } elseif ($workload <= 15) {
                        $status_label = 'Light Workload';
                        $status_color = 'bg-green-200';
                        $status_text = "text-green-500";
                        $status_border = "border-green-400";
                    } elseif ($workload <= 30) {
                        $status_label = 'Moderate Workload';
                        $status_color = 'bg-yellow-200';
                        $status_text = 'text-yellow-800';
                        $status_border = "border-yellow-400";
                    } else {
                        $status_label = 'Heavy Workload';
                        $status_color = 'bg-red-200/50';
                        $status_text = 'text-red-500';
                        $status_border = "border-red-400";
                    }

                ?>
                    <tr class=" transition duration-150 cursor-pointer group"
                        data-href="<?= PAGES_PATH . '/dashboard.php?id=' . urlencode($programmer['programmer_idno']) ?>">
                        <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                            <?= htmlspecialchars($programmer['programmer_name']) ?>
                        </td>
                        <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm text-[#d08904] font-bold ">
                            <?= htmlspecialchars($programmer['total_assigned']) ?>
                        </td>

                        <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm text-red-600 font-bold ">
                            <?= htmlspecialchars($programmer['total_delayed']) ?>
                        </td>

                        <!-- workload -->
                        <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap justify-center text-center">
                            <span class="px-3 py-1 text-xs rounded-full border
                            <?= $status_color ?> <?= $status_text ?> <?= $status_border ?>">
                                <?= $status_label ?>
                            </span>
                        </td>

                        <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm text-[#00807A] font-bold ">
                            <?= htmlspecialchars($programmer['total_pending']) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('click', function(e) {
        const row = e.target.closest('tr[data-href]');
        if (!row) return;

        // Prevent redirect if clicking a link inside the row
        if (e.target.closest('a')) return;

        window.location.href = row.dataset.href;
    });
</script>