<div class="xl:col-span-2 bg-white/95 backdrop-blur-[2px] rounded-2xl shadow-xl p-8 border border-white ring-1 ring-blue-100 ">
    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-100">
        <h3 class="text-2xl font-bold text-[#0F2C4F]">
            <i class="fa-solid fa-diagram-project"></i> Projects
        </h3>
    </div>
    <div class="overflow-x-auto">
        <table id="Project_tbl" class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                        Project Name
                    </th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($projects as $p): ?>
                    <tr id="project-row-<?= $p['project_id'] ?>" class="hover:bg-gray-50 transition">

                        <!-- PROJECT NAME -->
                        <td class="px-6 py-4">

                            <!-- VIEW STATE -->
                            <div id="view-state-<?= $p['project_id'] ?>" class="text-gray-800 font-medium">
                                <?= htmlspecialchars($p['project_name']) ?>
                            </div>

                            <!-- EDIT STATE -->
                            <div id="edit-state-<?= $p['project_id'] ?>" class="hidden">
                                <input
                                    id="input-project-<?= $p['project_id'] ?>"
                                    type="text"
                                    class="w-full px-3 py-2 text-sm border rounded-lg
                       focus:ring-2 focus:ring-[#2AA6B0]/30 focus:border-[#2AA6B0] outline-none"
                                    value="<?= htmlspecialchars($p['project_name']) ?>">
                            </div>

                        </td>

                        <!-- ACTIONS -->
                        <td class="px-6 py-4 text-right">

                            <!-- VIEW ACTIONS -->
                            <div id="view-actions-<?= $p['project_id'] ?>" class="flex justify-end gap-3">
                                <button onclick="toggleProjectEdit(<?= $p['project_id'] ?>, true)"
                                    class="text-gray-400 hover:text-blue-600">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button onclick="prepareDelete(<?= $p['project_id'] ?>)"
                                    class="text-gray-400 hover:text-red-500">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                            <!-- EDIT ACTIONS -->
                            <div id="edit-actions-<?= $p['project_id'] ?>" class="hidden justify-end gap-2">
                                <button onclick="toggleProjectEdit(<?= $p['project_id'] ?>, false)"
                                    class="text-xs text-gray-500 hover:underline">
                                    Cancel
                                </button>

                                <button id="btn-save-<?= $p['project_id'] ?>" onclick="saveProjectEdit(<?= $p['project_id'] ?>)"
                                    class="bg-[#2AA6B0] text-white px-3 py-1 rounded text-xs font-bold hover:bg-[#238a92]">
                                    Save
                                </button>
                            </div>

                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>
    </div>
</div>