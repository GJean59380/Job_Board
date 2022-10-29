<?php
ob_start();
$title = "Validation du nouvel utilisateur";
?>


<main>
    <?=$msg?>
</main>

<?php 
$content = ob_get_clean();

require_once "template.php";
?>