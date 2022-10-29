<?php
ob_start();
$ad = $data[0];
$title = $data[0]->title;
?>

<main>
    <div class="user">
        <?php if (isset($_SESSION["User"]) &&  ($_SESSION["User"]["id"] == $ad->company_id || $_SESSION["User"]["privileges"] == 3)) { ?>

            <form action="<?= Router::makeURL("/advertisements/update/" . $ad->id) ?>" method="POST">
                <input type="text" name="title" placeholder="<?= $ad->title ?>">
                <input type="text" name="company_name" placeholder=" <?= $ad->company_name ?>">
                <input type="number" name="salary" placeholder="Actual salary : <?= $ad->salary ?> €/an">
                <select name="type" id="type">
                    <option value="NULL">Actual type : <?= $ad->type ?></option>
                    <option value="cdi">permanent contract</option>
                    <option value="cdd">fixed-term contract</option>
                    <option value="alternance">apprenticeship</option>
                    <option value="internship">Internship</option>
                </select>
                <textarea class="short" name="short_description" placeholder="<?= $ad->short_description ?>"></textarea>
                <textarea class="long" name="long_description" placeholder="<?= $ad->long_description ?>" ?></textarea>
                <input type="submit" value="Modify" class="mofidy">
                <a href="<?= router::makeURL("advertisements/delete/" . $ad->id) ?>"><i class="fa-solid fa-trash-can"></i></a>
            </form>

            <?php if (sizeof($events)>0):?>
            <div class="user ads">
                <h2>Events from this ad :</h2>
                <table>
                    <th>
                        <tr>
                            <td>id</td>
                            <td>date</td>
                            <td>name</td>
                            <td>surname</td>
                            <td>email</td>
                            <td>message</td>
                        </tr>
                    </th>
                    <tbody>
                        <?php if(isset($events)&& $events!=""){
                           foreach ($events as $event) :
                            $user = curlGet("https://job-board.fun/user/" . $event->id_user);
                            $user = $user[0][0]; ?>
                            <tr>
                                <td><?= $event->id ?></td>
                                <td><?= $event->date ?></td>
                                <td><?= $user->name ?></td>
                                <td><?= $user->surname ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $event->content ?></td>
                            </tr> 
                        
                        
                        <?php endforeach; }?>
                    </tbody>
                </table>

            </div>
<?php endif ?>
        <?php } else { ?>
            <h1><?= $ad->title ?></h1>
            <div class="advertisement">
                <h2>Contract : <?= $ad->type ?></h2>
                <p><?= $ad->long_description ?></p>
                <p class="price">Salary : <?= $ad->salary ?> €/year</p>
                <a href="<?= router::makeURL("/events/apply/" . $ad->id) ?>" class="submit">Apply</a>
            </div>
        <?php } ?>
    </div>
</main>




<?php
$content = ob_get_clean();

require_once "template.php";
?>