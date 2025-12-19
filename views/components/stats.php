<?php

$stats = [
    ['label' => 'Number of Projects', 'value' => count($projects), 'color' => 'bg-[#FFA500]', 'icon' => 'fas fa-project-diagram', 'text' => 'text-[#0F2C4F]', 'action' => "openModal('Project')"],

    ['label' => 'Delayed Projects', 'value' => $number_of_projects ?? 0, 'color' => 'bg-[#5C0202]', 'icon' => 'fas fa-exclamation-triangle', 'text' => 'text-red-600', 'action' => "openModal('Delayed')"],

    ['label' => 'Completed This Week', 'value' => '6', 'color' => 'bg-[#008000]', 'icon' => 'fas fa-check-double', 'text' => 'text-green-600', 'action' => "openModal('Completed')"],

    ['label' => 'Pending Reviews', 'value' => '9', 'color' => 'bg-[#00807A]', 'icon' => 'fa-solid fa-magnifying-glass', 'text' => 'text-[#0F2C4F]', 'action' => "openModal('Review')"],
];

?>
<?php foreach ($stats as $stat): ?>
    <div class="bg-white/90 backdrop-blur-[2px] rounded-2xl shadow-lg p-6 border border-white ring-1 ring-blue-100 transform hover:-translate-y-1 transition duration-300 group">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-x-2">
                    <p class="text-sm font-medium text-gray-500"><?= $stat['label'] ?></p>

                    <?php if ($stat['action']): ?>
                        <button onclick="<?= $stat['action'] ?>"
                            class="transition-all duration-200                             
                            opacity-100 text-[#2AA6B0] active:scale-95 active:text-[#0F2C4F]
                            lg:opacity-0 lg:group-hover:opacity-100 lg:hover:scale-110"
                            title="Add New">
                            <i class="fas fa-plus-circle text-xl lg:text-xs"></i>
                        </button>
                    <?php endif; ?>
                </div>

                <h2 class="text-4xl font-bold <?= $stat['text'] ?> mt-1"><?= $stat['value'] ?></h2>
            </div>

            <div class="p-4 flex justify-center align-middle <?= $stat['color'] ?> rounded-xl text-white shadow-md">
                <i class="<?= $stat['icon'] ?> text-xl"></i>
            </div>
        </div>
    </div>
<?php endforeach; ?>