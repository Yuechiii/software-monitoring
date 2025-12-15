<?php require VIEWS_COMPONENTS_PATH . "/header.php"; ?>


<?php
ob_start();
?>

<div>
    <h1>Main Content</h1>
    <p>This is your page content, the “children”.</p>
</div>

<?php
$children = ob_get_clean();
include "layouts/AppLayout.php";
AppLayout($children);
