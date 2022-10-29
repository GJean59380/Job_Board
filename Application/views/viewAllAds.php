<?php
ob_start();

$title = "Accueil";
?>

<main>
    <article class="new">
        <h2>PUBLISH</h2>
        <a href="<?= Router::makeURL("/advertisements/new") ?>"><i class="fa-solid fa-circle-plus"></i></a>
        <p>Publish a new ad for your company</p>
    </article>
    <?php foreach ($data as $ladata) : ?>
        <article>
            <div class="content">
                <div class="jobtitle"><h3><?=$ladata->company_name?> looks for : <?=$ladata->title?></h3></div>
                <p class="data" id="short_desc"><?= $ladata->short_description ?>
                </p>
                <p class="date"><?= $ladata->date ?>
                </p>
            </div>
            <?php if (isset($_SESSION["User"]) && ($_SESSION["User"]["id"] == $ladata->company_id ||$_SESSION["User"]["privileges"]==3)){ ?>
            <div class="delete"><a href="<?=Router::makeURL("/advertisements/delete/".$ladata->id) ?>"><i class="fa-solid fa-trash-can"></i></a></div>
            <?php } ?>
            <div class="button"><a href="<?=Router::makeURL("/advertisements/".$ladata->id) ?>">Learn more</a></div>
        </article>
    <?php endforeach ?>
</main>
</table>




<?php
$content = ob_get_clean();

require_once "template.php";
?>