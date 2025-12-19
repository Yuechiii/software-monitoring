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
                    <tr>
                        <td class="px-6 py-4 text-gray-800"><?= htmlspecialchars($p['project_name']) ?></td>
                        <td class="px-6 py-4 text-right flex justify-start gap-3">

                            <!-- Edit Icon -->
                            <a href="edit_project.php?id=<?= $p['project_id'] ?>"
                                class="text-blue-500 hover:text-blue-700 transition-all"
                                title="Edit Project">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete Icon -->
                            <form action="delete_project.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                <input type="hidden" name="project_id" value="<?= $p['project_id'] ?>">
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-all" title="Delete Project">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>