<?php
ob_start();
require VIEWS_COMPONENTS_PATH . "/header.php";
?>

<div>
    <table id="Programmers_tbl">
        <thead>
            <tr>
                <th>Programmers</th>
                <th>Total Projects</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($programmers_tbl)) {
                foreach ($programmers_tbl as $programmer => $value) {

            ?>

                    <tr>
                        <td><?= $value['Programmer'] ?></td>
                        <td><?= $value['TOTAL_PROJECTS'] ?></td>
                    </tr>

            <?php
                }
            } else {
                echo "<tr><td>No data available</td><td></td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
require VIEWS_COMPONENTS_PATH . "/footer.php";
$children = ob_get_clean();
include "layouts/AppLayout.php";
AppLayout($children);
