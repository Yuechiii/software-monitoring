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

<div id="modalProject" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-[#0F2C4F]/30 backdrop-blur-[2px]" onclick="closeModal('Project')"></div>
    <div class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl transition-all scale-95 opacity-0 duration-300" id="boxProject">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="text-xl font-bold text-[#0F2C4F] flex items-center gap-2">
                <span class="p-2 bg-orange-100 text-orange-600 rounded-lg text-sm"><i class="fas fa-project-diagram"></i></span>
                Add New Project
            </h3>
            <button onclick="closeModal('Project')" class="text-gray-400 hover:text-red-500"><i class="fas fa-times"></i></button>
        </div>
        <form action="<?= PAGES_PATH . '/dashboard.php?f=AddNewProject' ?>" method="POST" class="p-6 space-y-4">
            <input required type="text" name="project_name" placeholder="Project Name" class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3 focus:ring-2 focus:ring-orange-400">
            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl shadow-lg transition-all">Create Project</button>
        </form>
    </div>
</div>

<div id="modalDelayed" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-red-900/20 backdrop-blur-[2px]" onclick="closeModal('Delayed')"></div>
    <div class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl transition-all scale-95 opacity-0 duration-300" id="boxDelayed">
        <div class="p-6 border-b border-gray-50">
            <h3 class="text-xl font-bold text-red-900 flex items-center gap-2">
                <i class="fas fa-exclamation-circle text-red-600"></i> Report Delay
            </h3>
        </div>
        <form class="p-6 space-y-4">
            <select class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3">
                <option>Select a Project...</option>
            </select>
            <label class="text-xs font-bold text-gray-400 uppercase">Reason for Delay</label>
            <textarea name="reason" rows="4" placeholder="Why is this project delayed?" class="w-full bg-red-50/50 border border-red-100 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none"></textarea>
            <button class="w-full bg-[#5C0202] text-white font-bold py-4 rounded-2xl shadow-xl">Update Status</button>
        </form>
    </div>
</div>

<div id="modalCompleted" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-green-900/20 backdrop-blur-[2px]" onclick="closeModal('Completed')"></div>
    <div class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl transition-all scale-95 opacity-0 duration-300" id="boxCompleted">
        <div class="p-8 text-center">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">
                <i class="fas fa-check-double"></i>
            </div>
            <h3 class="text-2xl font-black text-gray-800">Finish Project</h3>
            <p class="text-gray-500 text-sm mb-6">Confirming this will move the project to the archives.</p>
            <button class="w-full bg-[#008000] text-white font-bold py-4 rounded-2xl shadow-lg">Confirm Completion</button>
            <button onclick="closeModal('Completed')" class="mt-4 text-gray-400 text-sm font-medium">Cancel</button>
        </div>
    </div>
</div>

<div id="modalReview" class="fixed inset-0 z-100 hidden items-center justify-center p-4 transition-all duration-300">
    <div class="absolute inset-0 bg-cyan-900/20 backdrop-blur-[2px]" onclick="closeModal('Review')"></div>
    <div class="relative bg-white w-full max-w-md rounded-3xl shadow-2xl transition-all scale-95 opacity-0 duration-300" id="boxReview">
        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
            <h3 class="text-xl font-bold text-cyan-900 flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass"></i> Pending Review
            </h3>
        </div>
        <form class="p-6 space-y-4">
            <select class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3">
                <option>Select Project to Review...</option>
            </select>
            <textarea placeholder="Reviewer Notes" class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3"></textarea>
            <button class="w-full bg-[#00807A] text-white font-bold py-4 rounded-2xl shadow-lg">Submit Review</button>
        </form>
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

            <!-- 4. Sub Project Code -->
            <span id="projects_spinner" class="hidden p-5 text-xs font-bold text-cyan-900 ">
                Loading Data...
            </span>
            <select required id="subProjectCodeSelect" name="sub_project_code"
                class="w-full bg-gray-50 border-none rounded-2xl px-4 py-3">
                <option value="" disabled hidden selected>Select Sub Project Code :</option>
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