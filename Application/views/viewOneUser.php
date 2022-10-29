<?php
ob_start();
$user = $data[0][0];
$ads = $data[1];
$title = "Profil " . $user->name;
?>

<main>
    <div class="user">
        <h1>ID : <?= $user->id ?></h1>
        <?php if (isset($_SESSION["User"]) &&  ($_SESSION["User"]["privileges"] == 3 || $_SESSION["User"]["id"] == $url[1])) : ?>
            <form action="<?= Router::makeURL("/user/update/" . $user->id) ?>" method="POST">
                <input type="text" name="name" placeholder="<?= $user->name ?>">
                <input type="text" name="surname" placeholder="<?= $user->surname ?>">
                <select name="gender" id="status-select">
                    <option value="NULL">Current gender : <?= $user->gender ?></option>
                    <option value="male">male</option>
                    <option value="female">female</option>
                </select>
                <input type="email" name="email" placeholder="<?= $user->email ?>">
                <input type="number" min="0" max="<?php if ($_SESSION["User"]["privileges"] < 3) {
                                                        echo ("2");
                                                    } else {
                                                        echo ("3");
                                                    } ?>" name="status" placeholder="<?= $user->privileges ?>">
                <input type="submit" value="Modify">
            </form>
        <?php endif ?>
    </div>
    <?php if (sizeof($ads)>0) :?>
    <div class="user ads">
        <h2>Ads from this user :</h2>
        <table>
            <th>
                <tr>
                    <td>id</td>
                    <td>title</td>
                    <td>date</td>
                </tr>
            </th>
            <tbody>
                    <?php foreach ($ads as $ad) : ?>
                        <tr>
                            <td><?= $ad->id ?></td>
                            <td><a href="<?= router::makeURL("/advertisements/$ad->id") ?>"><?= $ad->title ?></a></td>
                            <td><?= $ad->date ?></td>
                        </tr>
                    <?php endforeach ?>
            </tbody>
        </table>

    </div>
<?php endif ?>
    <?php if (isset($events) && sizeof($events)>0 && isset($_SESSION["User"]) &&  ($_SESSION["User"]["privileges"] == 3 || $_SESSION["User"]["id"] == $url[1])) : ?>
        <div class="user ads">
                <h2>Events from this user :</h2>
                <table>
                    <th>
                        <tr>
                            <td>id</td>
                            <td>date</td>
                            <td>job-title</td>
                            <td>message</td>
                        </tr>
                    </th>
                    <tbody>
                        <?php foreach ($events as $event) :
                            $job_ad_tab = curlGet("https://job-board.fun/advertisements/" . $event->id_publication);
                            $job_ad = $job_ad_tab[0];
                            ?>
                            <tr>
                                <td><?= $event->id ?></td>
                                <td><?= $event->date ?></td>
                                <td><?= $job_ad->title ?></td>
                                <td><?= $event->content ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </div>
    <?php endif ?>

</main>





<?php
$content = ob_get_clean();

require_once "template.php";
?>