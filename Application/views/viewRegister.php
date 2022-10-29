<?php
$title  = "Register";
ob_start();
?>

<main class="login">
            <div class="formcontainer">
				<form action="<?=Router::makeURL("/user/register/validate") ?>" method="POST">
					<h2>Sign up</h2>
                    <p>Please fill the form below.</p>
                    <div class="input">
                        <div class="select">
                            <select name="status" id="status-select">
                                <option value="NULL">who are you ?</option>
                                <option value="1">a candidate</option>
                                <option value="2">a company</option>
                            </select>
                        </div>
                        <div class="who">
                            <div class="name">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name"/>
                            </div>
                            <div class="name">
                                <label for="surname">Surname</label>
                                <input type="text" id="surname" name="surname"/>
                            </div>
                            
                        </div>
                        <div class="gender">
                            <div class="sex">
                                <label for="gender">Male</label>
                                <input type="radio" name="gender" value="male">
                            </div>
                            <div class="sex">
                                <label for="gender">Female</label>
                                <input type="radio" name="gender" value="female">
                            </div>
                        </div>
                        
                        <label for="email" id="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        <div class="password">
                            <div>
                                <label for="password">Password</label>
                                <input type="password" name="password" minlength="8" required> 
                            </div>
                            <div>
                                <label for="confirm-password">confirm password</label>
                                <input type="password" name="confirm-password" minlength="8" required> 
                            </div>
                            
                        </div>                 
                    </div>
                <input type="submit" value="Sign up" class="submit"/>
                <?php if(isset($err)){echo($err);}?>
				</form>
                    
            </div>
        </main>

<?php
$content = ob_get_clean();
require_once "template.php";
?>