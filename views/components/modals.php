<div id="modalDelete" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-red-900/20 backdrop-blur-[2px]" onclick="closeModal('Delete')"></div>
    <div class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl transition-all scale-95 opacity-0 duration-300" id="boxDelete">
        <div class="p-8 text-center">
            <input type="hidden" id="deleteTargetId" value="">
            <input type="hidden" id="modalType" value="">

            <div class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-800">Delete</h3>
            <p class="text-gray-500 text-sm mb-6">Are you sure? This action cannot be undone.</p>

            <button id="btnConfirmDelete" onclick="executeDeletion()" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-4 rounded-2xl shadow-lg transition-colors">
                Confirm Deletion
            </button>

            <button onclick="closeModal('Delete')" class="mt-4 text-gray-400 text-sm font-medium hover:text-gray-600">Cancel</button>
        </div>
    </div>
</div>

<!-- TASK VIEW -->
<div id="modalProject" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-[#0F2C4F]/30 backdrop-blur-[2px]" onclick="closeModal('Project')"></div>
    <div class="relative bg-white w-full max-w-2xl mx-auto rounded-3xl shadow-2xl
           transition-all scale-95 opacity-0 duration-300
           max-h-[90vh] flex flex-col" id="boxProject">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="text-xl font-bold text-[#0F2C4F] flex items-center gap-2">
                <span class="p-2 bg-orange-100 text-orange-600 rounded-lg text-sm"><i class="fas fa-project-diagram"></i></span>
                Task View
            </h3>
            <button onclick="closeModal('Project')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6 space-y-4 overflow-y-auto flex-1">
            <div class="overflow-x-auto">
                <table id="task_view_table" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Group Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Code</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Assigned Programmers</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($task_overview as $task): ?>
                            <tr class=" transition duration-150 cursor-pointer group"
                                data-href="">
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['group_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['project_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['project_code'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['total_programmer'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modalDelayed" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-[#0F2C4F]/30 backdrop-blur-[2px]" onclick="closeModal('Delayed')"></div>
    <div class="relative bg-white w-full max-w-2xl mx-auto rounded-3xl shadow-2xl
           transition-all scale-95 opacity-0 duration-300
           max-h-[90vh] flex flex-col" id="boxDelayed">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="text-xl font-bold text-red-900 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-600"></i> Delayed Project
            </h3>
            <button onclick="closeModal('Delayed')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6 space-y-4 overflow-y-auto flex-1">
            <div class="overflow-x-auto">
                <table id="delayed_view_table" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Group Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Code</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Deadline</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($delayed_overview as $task): ?>
                            <tr class=" transition duration-150 cursor-pointer group"
                                data-href="">
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['group_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['project_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['project_code'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['project_deadline'] ?>
                                </td>
                                <!-- <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['total_programmer'] ?>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modalCompleted" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-green-900/20 backdrop-blur-[2px]" onclick="closeModal('Completed')"></div>
    <div class="relative bg-white w-full max-w-2xl mx-auto rounded-3xl shadow-2xl
           transition-all scale-95 opacity-0 duration-300
           max-h-[90vh] flex flex-col" id="boxCompleted">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="text-xl font-bold text-green-900 flex items-center gap-2">
                <i class="fas fa-check-circle text-green-600"></i> Completed Project This week
            </h3>
            <button onclick="closeModal('Completed')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6 space-y-4 overflow-y-auto flex-1">
            <div class="overflow-x-auto">
                <table id="completed_view_table" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Group Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Code</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Completed At</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($completed_this_week as $task):
                            $date = $task['completed_at']
                                ? (new DateTime($task['completed_at']))->format('F j, Y')
                                : 'N/A';
                        ?>
                            <tr class=" transition duration-150 cursor-pointer group"
                                data-href="">
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['group_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['project_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['project_code'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $date ?>
                                </td>
                                <!-- <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold text-[#0F2C4F]">
                                    <?= $task['total_programmer'] ?>
                                </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modalReview" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-cyan-900/20 backdrop-blur-[2px]" onclick="closeModal('Review')"></div>
    <div class="relative bg-white w-full max-w-2xl mx-auto rounded-3xl shadow-2xl
           transition-all scale-95 opacity-0 duration-300
           max-h-[90vh] flex flex-col" id="boxReview">
        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-xl font-bold text-cyan-900 flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass"></i> Pending Review
            </h3>
            <button onclick="closeModal('Review')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        <div class="p-6 space-y-4 overflow-y-auto flex-1">
            <div class="overflow-x-auto">
                <table id="pending_view_table" class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Group Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Project Code</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Deadline</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($pending_overview as $task):

                            $isDelayed = false;
                            $date = 'N/A';

                            if (!empty($task['deadline'])) {
                                $deadline = new DateTime($task['deadline']);
                                $today = new DateTime('today');

                                $date = $deadline->format('F j, Y');

                                if ($deadline < $today) {
                                    $isDelayed = true;
                                }
                            } else {
                                $date = 'Live Project';
                            }

                            $textColor = $isDelayed ? 'text-red-600' : 'text-[#0F2C4F]';
                        ?>
                            <tr class="transition duration-150 cursor-pointer group">
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold <?= $textColor ?>">
                                    <?= $task['group_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold <?= $textColor ?>">
                                    <?= $task['project_name'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold <?= $textColor ?>">
                                    <?= $task['project_code'] ?>
                                </td>
                                <td class="group-hover:bg-blue-100 px-6 py-4 whitespace-nowrap text-sm font-semibold <?= $textColor ?>">
                                    <?= $date ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>


<div id="modalDeadline" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-cyan-900/20 backdrop-blur-[2px]" onclick="closeModal('Deadline')"></div>
    <div class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl transition-all scale-95 opacity-0 duration-300" id="boxDeadline">
        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-xl font-bold text-cyan-900 flex items-center gap-2">
                <i class="fa-solid fa-calendar"></i> Upcoming Deadline
            </h3>

        </div>

        <form action="<?= PAGES_PATH . '/dashboard.php?f=AddDeadline' ?>" class="p-6 space-y-4" method="post">

            <!-- 1. Group Name -->
            <select required id="groupSelect" name="group_name"
                class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3">
                <option value="" disabled hidden selected>Select a Group :</option>
                <?php foreach ($groups as $value): ?>
                    <option value="<?= $value["group_name"] ?>">
                        <?= $value["group_name"] ?>
                    </option>
                <?php endforeach ?>
            </select>

            <!-- 2. Project Name -->
            <span id="projects_spinner" class="hidden p-5 text-xs font-bold text-cyan-900 ">
                Loading Data...
            </span>
            <select required id="projectSelect" name="project_name"
                class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3">

                <option value="" disabled hidden selected>Select a Project :</option>
                <!-- Options to be populated dynamically based on selected group -->
            </select>

            <!-- 3. Project Code -->
            <span id="projects_spinner" class="hidden p-5 text-xs font-bold text-cyan-900 ">
                Loading Data...
            </span>
            <select required id="projectCodeSelect" name="project_code"
                class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3">
                <option value="" disabled hidden selected>Select Project Code :</option>
                <!-- Options to be populated dynamically based on selected project -->
            </select>


            <select required id="programmerSelect" name="selected_programmer"
                class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3">
                <option value="" disabled hidden selected>Select Programmer :</option>
                <!-- Options to be populated dynamically based on selected project code -->
            </select>

            <!-- Deadline Input -->
            <input required class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3" type="date" name="deadline" />

            <!-- Submit Button -->
            <button class="w-full bg-[#00807A] text-white font-bold py-4 rounded-2xl shadow-lg">Submit</button>
        </form>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", async () => {
        const groupSelect = document.getElementById('groupSelect');
        const projectSelect = document.getElementById('projectSelect');
        const projects_spinner = document.getElementById('projects_spinner');

        // Populate Group dropdown on page load
        try {
            const response = await fetch('<?= API_PATH ?>' + '/api.php?action=getGroupNames');
            const groups = await response.json(); // assuming JSON array of objects like [{group_name: "WEB ENTRY"}, {group_name: "GENERAL"}]

            groups.forEach(group => {
                const option = document.createElement('option');
                option.value = group.group_name;
                option.textContent = group.group_name;
                groupSelect.appendChild(option);
            });
        } catch (error) {
            console.error("Error fetching groups:", error);
        }


        groupSelect.addEventListener('change', async () => {
            const selectedGroup = groupSelect.value;

            // Clear previous project options
            projectSelect.innerHTML = '<option value="" disabled hidden selected>Select a Project :</option>';

            if (!selectedGroup) return;

            try {
                projects_spinner.classList.remove('hidden');

                const response = await fetch(`<?= API_PATH ?>/api.php?action=getProjectNames&group_name=${encodeURIComponent(selectedGroup)}`);
                const projects = await response.json();
                projects.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.project_name;
                    option.textContent = project.project_name;
                    projectSelect.appendChild(option);
                });

            } catch (error) {
                console.error("Error fetching project names:", error);
            } finally {
                // Hide spinner
                projects_spinner.classList.add('hidden');
            }
        });
    });
</script>