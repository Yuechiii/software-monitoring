<?php
function renderStatusBox($value)
{
    if ($value >= 80) {
        $class = 'bg-green-500/20';
        $label = 'Low';
    } elseif ($value >= 50) {
        $class = 'bg-yellow-400 text-black';
        $label = 'Moderate';
    } else {
        $class = 'bg-red-500';
        $label = 'High';
    }

    echo "
        <div class=\"{$class} text-white px-4 py-2 rounded-lg font-semibold inline-block\">
            {$label}: {$value}
        </div>
    ";
}
