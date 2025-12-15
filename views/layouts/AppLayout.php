<?php
function AppLayout($children)
{
?>
    <div class="flex flex-row min-h-screen">
        <!-- Sidebar -->
        <div class="w-60 flex-none">
            <?php include "../views/components/sidebar.php"; ?>
        </div>


        <!-- Topbar (or footer, depends on layout) -->
        <div class="flex-1">
            <?php include "../views/components/topbar.php"; ?>
            <!-- Children content -->
            <div class="p-5">
                <?= $children ?>
            </div>
        </div>
    </div>
<?php
}
?>