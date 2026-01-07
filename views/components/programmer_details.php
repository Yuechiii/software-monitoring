<?php



// Calculations
$total_assigned = count($programmer_details);
$total_completed = count(array_filter($programmer_details, fn($p) => $p['status'] === 'Completed'));
$total_pending = count(array_filter($programmer_details, fn($p) => $p['status'] === 'Pending'));
$total_delayed = count(array_filter($programmer_details, function ($p) {
    return !empty($p['deadline']) &&
        strtotime($p['deadline']) < time() &&
        $p['status'] !== 'Completed';
}));

?>

<div class="max-w-7xl mx-auto p-6">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 border-b border-gray-200 pb-4">
        <h2 class="text-3xl font-bold text-[#0F2C4F] flex items-center gap-3">
            <span class="text-[#37B8BF]">👩‍💻</span> <?= empty($programmer_details[0]['programmer_name']) ? 'N/A' : htmlspecialchars($programmer_details[0]['programmer_name']) ?>
        </h2>
        <span class="text-sm text-gray-500 mt-2 sm:mt-0">ID: <?= empty($programmer_details[0]['programmer_idno']) ? 'N/A' : $programmer_details[0]['programmer_idno'] ?></span>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 p-4 rounded-lg text-center">
            <div class="text-gray-500 text-xs font-semibold">Total Assigned</div>
            <div class="text-xl font-bold text-[#0F2C4F]"><?= $total_assigned ?></div>
        </div>
        <div class="bg-green-50 p-4 rounded-lg text-center">
            <div class="text-gray-500 text-xs font-semibold">Completed</div>
            <div class="text-xl font-bold text-green-600"><?= $total_completed ?></div>
        </div>
        <div class="bg-yellow-50 p-4 rounded-lg text-center">
            <div class="text-gray-500 text-xs font-semibold">Pending</div>
            <div class="text-xl font-bold text-yellow-800"><?= $total_pending ?></div>
        </div>
        <div class="bg-red-50 p-4 rounded-lg text-center">
            <div class="text-gray-500 text-xs font-semibold">Delayed</div>
            <div class="text-xl font-bold text-red-600"><?= $total_delayed ?></div>
        </div>
    </div>

    <!-- Detailed Projects -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y pt-5 divide-gray-200" id="programmer_details_tbl">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Group Name</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Name</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Code</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Deadline</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php
                foreach ($programmer_details as $project):
                    // Determine if the project is delayed
                    $hasDeadline = !empty($project['deadline']);
                    $isDelayed = $hasDeadline && strtotime($project['deadline']) < time() && $project['status'] !== 'Completed';

                    if ($project['status'] === 'Completed') {
                        $badgeColor = 'bg-green-200 text-green-700';
                        $badgeLabel = 'Completed';
                    } elseif (!$hasDeadline) {
                        // LIVE PROJECT
                        $badgeColor = 'bg-blue-200 text-blue-700';
                        $badgeLabel = 'Live';
                    } elseif ($isDelayed) {
                        $badgeColor = 'bg-red-200 text-red-700';
                        $badgeLabel = 'Delayed';
                    } else {
                        $badgeColor = 'bg-yellow-200 text-yellow-800';
                        $badgeLabel = 'Pending';
                    }


                ?>
                    <tr class="hover:bg-blue-50 transition">
                        <td class="px-6 py-4 text-sm font-semibold text-[#0F2C4F]"><?= htmlspecialchars($project['group_name']) ?></td>
                        <td class="px-6 py-4 text-sm font-semibold text-[#0F2C4F]"><?= htmlspecialchars($project['project_name']) ?></td>
                        <td class="px-6 py-4 text-sm font-semibold text-[#0F2C4F]"><?= htmlspecialchars($project['project_code']) ?></td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $badgeColor ?>">
                                <?= $badgeLabel ?>
                            </span>

                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?= $project['deadline']
                                ? date('F j, Y', strtotime($project['deadline']))
                                : 'N/A';
                            ?>
                        </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?php require VIEWS_COMPONENTS_PATH . '/footer.php' ?>