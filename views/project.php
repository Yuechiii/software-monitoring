<?php require VIEWS_COMPONENTS_PATH . '/header.php' ?>

<div class="p-5 bg-gray-50/50 min-h-screen">
    <div class="p-4 sm:p-8">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start ">

            <div class="lg:sticky lg:top-20">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 bg-[#2AA6B0]/10 rounded-lg">
                            <i class="fas fa-plus text-[#2AA6B0]"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-[#0F2C4F]">Add Project</h2>
                            <p class="text-sm text-gray-500">Assign a new milestone</p>
                        </div>
                    </div>

                    <form action="<?= PAGES_PATH . '/project.php?f=AddNewProject' ?>" method="POST" class="flex flex-col gap-5 w-full">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Project Name
                            </label>
                            <input
                                type="text"
                                name="project_name"
                                placeholder="Enter project title..."
                                required
                                class=" w-full h-11 px-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#2AA6B0]/20 focus:border-[#2AA6B0] outline-none transition-all">
                        </div>

                        <button type="submit"
                            class="h-11 w-full bg-[#0F2C4F] hover:bg-[#1a3a5f] text-white font-bold rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                            <i class="fas fa-save"></i>
                            Save Project
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-2">
                <?php require VIEWS_COMPONENTS_PATH . '/table-projects.php'; ?>
            </div>

        </div>
    </div>
</div>

<?php require VIEWS_COMPONENTS_PATH . '/footer.php' ?>