<?php
ob_start();

$title = "Page d'erreur";
?>
<main>
    <?=$err?>
</main>
<?php 
$content = ob_get_clean();

require_once "template.php";
?>