<?php require VIEWS_COMPONENTS_PATH . '/header.php' ?>
<?php require VIEWS_COMPONENTS_PATH . '/modals.php'; ?>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto px-6 py-10">

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-[#0F2C4F]">
                Assign Task
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Select project details and assign one or more programmers.
            </p>
        </div>

        <form action="task_store.php" method="POST" class="space-y-10">

            <!-- Project Information -->
            <section>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">
                    Project Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Group -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Group Name
                        </label>
                        <select name="group_id" required
                            class="assign_project-select w-full rounded-md border border-gray-200
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   transition">
                            <option value="">Select Group</option>
                            <?php foreach ($groups as $group): ?>
                                <option value="<?= $group['id'] ?>">
                                    <?= htmlspecialchars($group['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Project -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Project Name
                        </label>
                        <select name="project_id" required
                            class="assign_project-select w-full rounded-md border border-gray-200
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   transition">
                            <option value="">Select Project</option>
                            <?php foreach ($projects as $project): ?>
                                <option value="<?= $project['id'] ?>">
                                    <?= htmlspecialchars($project['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Code -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Project Code
                        </label>
                        <select name="project_code" required
                            class="assign_project-select w-full rounded-md border border-gray-200
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   transition">
                            <option value="">Select Code</option>
                            <?php foreach ($projects as $project): ?>
                                <option value="<?= htmlspecialchars($project['code']) ?>">
                                    <?= htmlspecialchars($project['code']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
            </section>

            <!-- Task Settings -->
            <section>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">
                    Task Settings
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Deadline -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Deadline (optional)
                        </label>
                        <input type="date" name="deadline"
                            class="w-full rounded-md bg-white border border-gray-300 p-2
                                 ">
                    </div>

                </div>
            </section>

            <!-- Programmer Assignment -->
            <section>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">
                    Programmer Assignment
                </h3>

                <div class="space-y-4 max-w-md">

                    <div id="programmer-container" class="space-y-3">
                        <select name="programmer_ids[]" required
                            class="assign_project-select w-full rounded-md
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   transition">
                            <option value="">Select Programmer</option>
                            <?php foreach ($programmers as $programmer): ?>
                                <option value="<?= $programmer['id'] ?>">
                                    <?= htmlspecialchars($programmer['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- <button type="button" onclick="addProgrammer()"
                        class="text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                        + Add another programmer
                    </button> -->

                </div>
            </section>

            <!-- Actions -->
            <div class="flex justify-end border-t pt-6">
                <button type="submit"
                    class="px-8 py-3 rounded-md bg-blue-600 text-white font-semibold
                           hover:bg-blue-700 transition">
                    Save Task
                </button>
            </div>

        </form>

    </div>
</div>

<script>
    function addProgrammer() {
        const container = document.getElementById('programmer-container');
        const select = container.children[0].cloneNode(true);
        select.value = '';
        container.appendChild(select);
    }
</script>

<?php require VIEWS_COMPONENTS_PATH . '/footer.php' ?>