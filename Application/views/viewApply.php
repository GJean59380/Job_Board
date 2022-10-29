<?php
ob_start();
$title = "Apply";


?>

<main class="login">
    <form action="<?= Router::makeURL("/events/apply/".$url[2]."/validate") ?>" method="post">
        <div class="formcontainer">
            <div class="formulaire">
                <h2>Apply to this job</h2>
                <div class="input">
                    <div class="apply-form">
                        <div>
                            <label for="apply_content">Your message</label>
                            <textarea name="apply_content" id="write" maxlength="255" placeholder="Write a quick description about you (255 max caracters)"></textarea>
                        </div>
                    </div>
                    <input type="submit" value="SUBMIT" class="submit" />
                    <?php if(isset($msg)){echo ($msg);} ?>
                </div>
            </div>
    </form>
    




    <?php
    $content = ob_get_clean();

    require_once "template.php";
    ?>