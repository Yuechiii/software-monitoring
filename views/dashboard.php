<?php require VIEWS_COMPONENTS_PATH . '/header.php' ?>
<?php require VIEWS_COMPONENTS_PATH . '/modals.php'; ?>
<div class="p-5 bg-gray-50/50">
    <div class="p-4 sm:p-8 min-h-screen">


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 lg:sticky lg:top-20">
                <div class="flex justify-between items-center mb-6 border-b pb-3 border-gray-100">
                    <h3 class="text-2xl font-bold text-[#0F2C4F]">
                        <span class="text-[#2AA6B0]">📅</span> Upcoming Deadlines
                    </h3>
                    <button onclick="openModal('Deadline')" class="flex items-center justify-center w-10 h-10 rounded-full bg-[#2AA6B0]/10 text-[#2AA6B0] hover:bg-[#2AA6B0] hover:text-white transition-all duration-300">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="max-h-64 lg:max-h-96 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                    <div class="space-y-4">
                        <?php foreach ($deadlines as $deadline => $d):

                            $formattedDate = date('F j, Y', strtotime($d["deadline"]));
                        ?>
                            <div id="deadline-container-<?= $d["upcoming_deadline_id"] ?>" class="group p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-[#2AA6B0]/30 hover:shadow-md transition-all duration-200">

                                <div id="view-state-<?= $d["upcoming_deadline_id"] ?>" class="flex justify-between items-start">
                                    <div>
                                        <p id="title-display-<?= $d['upcoming_deadline_id'] ?>" class="text-sm font-bold text-[#0F2C4F]"><?= $d['project_name'] ?></p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            <span id="date-display-<?= $d['upcoming_deadline_id'] ?>"><?= $formattedDate ?></span>
                                        </p>
                                    </div>

                                    <div class="flex gap-x-2">
                                        <button onclick="toggleEdit(<?= $d['upcoming_deadline_id'] ?>, true)" class="text-gray-400 hover:text-blue-600 transition-colors p-1">
                                            <i class="fas fa-edit text-xs"></i>
                                        </button>
                                        <button onclick="prepareDelete(<?= $d['upcoming_deadline_id'] ?>)" class="text-gray-400 hover:text-red-500 transition-colors p-1">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </div>

                                <div id="edit-state-<?= $d['upcoming_deadline_id'] ?>" class="hidden">
                                    <div class="space-y-3">

                                        <!-- <input type="text""
                                            class=" w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-[#2AA6B0] outline-none"
                                            value="<?= $d['project_name'] ?>"> -->

                                        <select required id="input-project-<?= $d['upcoming_deadline_id'] ?>" name="project_id"
                                            class="project-select w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-[#2AA6B0] outline-none">
                                            <option selected value="<?= $d['project_id'] ?>"><?= $d['project_name'] ?></option>
                                            <?php foreach ($projects as $p): ?>
                                                <option value="<?= $p['project_id'] ?>">
                                                    <?= $p['project_name'] ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>


                                        <input type="date" id="input-date-<?= $d['upcoming_deadline_id'] ?>"
                                            class="w-full px-2 py-1 text-sm border rounded focus:ring-1 focus:ring-[#2AA6B0] outline-none"
                                            value="<?= $d['deadline'] ?>">

                                        <div class="flex justify-end gap-2 mt-2">
                                            <button onclick="toggleEdit(<?= $d['upcoming_deadline_id'] ?>, false)" class="text-xs text-gray-500 hover:underline">Cancel</button>
                                            <button onclick="saveInlineEdit(<?= $d['upcoming_deadline_id'] ?>)" class="bg-[#2AA6B0] text-white px-3 py-1 rounded text-xs font-bold hover:bg-[#238a92]">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-2 space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php require VIEWS_COMPONENTS_PATH . '/stats.php' ?>
                </div>

                <div>
                    <?php require VIEWS_COMPONENTS_PATH . '/table-overview.php' ?>
                </div>

            </div>

        </div>
    </div>
</div>
<?php require VIEWS_COMPONENTS_PATH . '/footer.php' ?>