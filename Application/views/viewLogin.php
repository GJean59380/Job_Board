<?php
ob_start();

$title = "Login";
?>

<main class="login">
  <div class="formcontainer">

    <div class="formulaire">

      <form action="<?= Router::makeURL("/user/login/validate") ?>" method="POST">
        <h2>Login</h2>

        <div class="input">
          <label name="email" class="form-label" for="typeEmailX">Email</label>
          <input name="email" type="email" id="typeEmailX" class="form-control form-control-lg" />


          <label name="pass" class="form-label" for="typePasswordX">Password</label>
          <input name="pass" type="password" id="" />
        </div>
        <?php if (isset($err)) {
          echo $err;
        } ?>
        <input type="submit" value="submit" class="submit" />
      </form>
    </div>

    <div class="signup">
      <p>Don't have an account? <a href="<?= Router::makeURL("/user/register")?>" class="text-white-50 fw-bold">Sign Up</a>
      </p>
    </div>

  </div>
</main>

<?php
$content = ob_get_clean();

require_once "template.php";
?>