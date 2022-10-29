<?php
ob_start();

$title = "Indown";
?>


<main class="users">
    <h3><?php if (isset($msg)) {
            echo ($msg);
        }  ?></h3>
    <table>
        <th>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Surname</td>
                <td>Email</td>
                <td>Privileges</td>
            </tr>
        </th>
        <tbody>
            <?php foreach ($data as $ladata) : ?>
                <tr>
                    <td><?= $ladata->id ?></td>
                    <td><a href="<?=Router::makeURL("/user/$ladata->id")?>"><?= $ladata->name ?></a></td>
                    <td><?= $ladata->surname ?></td>
                    <td><?= $ladata->email ?></td>
                    <td><?= $ladata->privileges ?></td>
                    <td>
                        <form method="POST" action=<?= Router::makeURL("/user/delete/" . $ladata->id) ?>><input type="submit" value="Supprimer"></form>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
</main>





<?php
$content = ob_get_clean();

require_once "template.php";
?>