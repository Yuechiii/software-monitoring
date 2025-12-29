<?php require VIEWS_COMPONENTS_PATH . '/header.php' ?>
<?php require VIEWS_COMPONENTS_PATH . '/modals.php'; ?>

<div class="p-5 bg-white-50 min-h-screen">

    <?php
    if (isset($_GET['id'])) {
        require VIEWS_COMPONENTS_PATH . '/programmer_details.php';
        return;
    }
    ?>
    <div class="p-4 sm:p-8">
        <!-- Programmer Details -->

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">



            <!-- Upcoming Deadlines Card -->

            <div class="bg-white p-6 rounded-2xl shadow border border-gray-200 lg:sticky lg:top-20">
                <div class="flex justify-between items-center mb-4 border-b pb-3 border-gray-100">
                    <h3 class="text-xl font-bold text-[#0F2C4F]">
                        <span class="text-[#2AA6B0]">📅</span> Upcoming Deadlines
                    </h3>
                </div>

                <!-- Scrollable container -->
                <div class="overflow-y-auto max-h-96 pr-2">
                    <div class="space-y-4">
                        <?php foreach ($upcoming_deadlines as $deadline):
                            $formatted_deadline = (new DateTime($deadline['deadline']))->format('F j, Y');
                            $bgColor = 'bg-red-50';
                            $textColor = 'text-red-600';

                        ?>
                            <div class="<?= $bgColor ?> shadow rounded-2xl p-4 hover:shadow-lg transition-shadow duration-200">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-bold text-[#0F2C4F]"><?= htmlspecialchars($deadline['group_name']) ?></p>
                                        <p class="text-sm font-medium text-gray-700"><?= htmlspecialchars($deadline['project_name']) ?> (<?= htmlspecialchars($deadline['project_code']) ?>)</p>
                                        <p class="text-xs text-gray-500 mt-1">Programmer: <?= htmlspecialchars($deadline['programmer_name']) ?></p>
                                        <p class="text-xs text-gray-500 mt-1">Deadline: <?= $formatted_deadline ?></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold <?= $textColor ?>"><?= $deadline['remaining_days'] ?> <?= $deadline['remaining_days'] == 1 ? 'day' : 'days' ?> left</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <?php if (empty($upcoming_deadlines)): ?>
                            <p class="text-center text-gray-400">No upcoming deadlines</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>



            <!-- Main Content: Stats & Overview -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php require VIEWS_COMPONENTS_PATH . '/stats.php' ?>
                </div>

                <!-- Table Overview -->
                <div>
                    <?php require VIEWS_COMPONENTS_PATH . '/table-overview.php' ?>
                </div>

            </div>

        </div>
    </div>
</div>

<?php require VIEWS_COMPONENTS_PATH . '/footer.php' ?>