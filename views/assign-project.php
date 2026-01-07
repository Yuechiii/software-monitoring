<?php require VIEWS_COMPONENTS_PATH . '/header.php' ?>
<?php require VIEWS_COMPONENTS_PATH . '/modals.php'; ?>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto px-6 py-10">

        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-[#0F2C4F]">
                Assign Project
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Select project details and assign one or more programmers.
            </p>
        </div>

        <form action="<?= PAGES_PATH . 'assign-project.php' ?>" method="POST" class="space-y-10">

            <section>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">
                    Project Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Group Name</label>
                        <select id="groupSelect" name="group_name" required
                            class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Select Group</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
                        <select id="projectSelect" name="project_name" required
                            class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Select Project</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Project Code</label>
                        <select id="codeSelect" name="project_code" required
                            class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            <option value="">Select Code</option>
                        </select>
                    </div>

                </div>
            </section>

            <section>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">
                    Project Settings
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deadline (optional)</label>
                        <input type="date" name="deadline"
                            class="w-full rounded-md border border-gray-300 bg-white px-3 py-2">
                    </div>
                </div>
            </section>

            <section>
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-4">
                    Assign Programmers
                </h3>
                <div class="space-y-4 max-w-md">
                    <select id="programmer_multiple_select" name="programmer_ids[]" required multiple size="5"
                        class="w-full rounded-md border border-gray-300 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <?php foreach ($programmers as $programmer): ?>
                            <option value="<?= $programmer['idno'] ?>">
                                <?= htmlspecialchars($programmer['programmer_fullname']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="text-xs text-gray-400 italic">Hold Ctrl (Cmd) to select multiple.</p>
                </div>
            </section>

            <div class="flex justify-end border-t pt-6">
                <button type="submit"
                    class="px-8 py-3 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                    Save Task
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const groupSelect = document.getElementById('groupSelect');
        const projectSelect = document.getElementById('projectSelect');
        const codeSelect = document.getElementById('codeSelect');

        /**
         * Helper to handle API requests
         */
        async function fetchJSON(url, postData = null) {
            try {
                const options = postData ? {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams(postData)
                } : {};

                const response = await fetch(url, options);
                if (!response.ok) throw new Error('Network response was not ok');
                return await response.json();
            } catch (error) {
                console.error('Fetch error:', error);
                return [];
            }
        }

        /**
         * 1. Load initial Groups
         */
        const groups = await fetchJSON('<?= API_PATH ?>/api.php?action=getGroupNames');
        groups.forEach(g => {
            const opt = document.createElement('option');
            opt.value = g.group_name;
            opt.textContent = g.group_name;
            groupSelect.appendChild(opt);
        });

        /**
         * 2. When Group changes -> Load Projects
         */
        groupSelect.addEventListener('change', async () => {
            const groupName = groupSelect.value;

            // Reset children
            projectSelect.innerHTML = '<option value="">Select Project</option>';
            codeSelect.innerHTML = '<option value="">Select Code</option>';

            if (!groupName) return;

            const projects = await fetchJSON('<?= API_PATH ?>/api.php?action=getProjectNames', {
                group_name: groupName
            });

            projects.forEach(p => {
                const opt = document.createElement('option');
                opt.value = p.project_name;
                opt.textContent = p.project_name;
                projectSelect.appendChild(opt);
            });
        });

        /**
         * 3. When Project changes -> Load Codes
         */
        projectSelect.addEventListener('change', async () => {
            const projectName = projectSelect.value;

            // Reset child
            codeSelect.innerHTML = '<option value="">Select Code</option>';

            if (!projectName) return;

            const codes = await fetchJSON('<?= API_PATH ?>/api.php?action=getProjectCodes', {
                project_name: projectName
            });

            codes.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.project_code;
                opt.textContent = c.project_code;
                codeSelect.appendChild(opt);
            });
        });
    });
</script>

<?php require VIEWS_COMPONENTS_PATH . '/footer.php' ?>