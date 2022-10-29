<?php
ob_start();

$title = "Create a new ad"
?>

<main class="login">
            <form action="<?=Router::makeURL("/advertisements/new/validate") ?>" method="post">
                <div class="formcontainer">
                    <div class="formulaire">
                        <h2>Create a new ad</h2>
                        <div class="input">
                            <div class="who">
                                <div>
                                    <label for="job_title">Job title :</label>
                                    <input name="job_title" type="text" id="name"/>
                                </div>
                                <div>
                                    <label for="company_name">Company name :</label>
                                    <input name="company_name" type="text" id="name">
                                </div>
                            </div>
                            <div class="salary">
                                <label for="salary">Annual salary :</label><br>
                                <input name="salary" type="number" placeholder="123456" max="999999">
                            </div>
                            <div class="type">
                                <label for="type">type of employement</label><br>
                                <select name="type" id="type">
                                    <option value="0">Please choose an option</option>
                                    <option value="cdi">permanent contract</option>
                                    <option value="cdd">fixed-term contract</option>
                                    <option value="alternance">apprenticeship</option>
                                    <option value="internship">Internship</option>
                                </select>
                            </div>
                            <div class="informations">
                            <label for="short_description">Short informations :</label>
                                <textarea name="short_description" id="write" maxlength="255" placeholder="Write a quick description about the job (255 max caracters)"></textarea>
                                <label for="long_description" >Detailed informations :</label>
                                <textarea name="long_description" maxlength="1000" id="write" placeholder="Give the maximum amount of informations you can, be as precise as possible about the job"></textarea> 
                            </div>
                            
                        </div>
                        <input type="submit" value="SUBMIT" class="submit"/>
                        <?php if(isset($err) && $err != ""){echo ($err);} ?>
                    </div>
                </div>
            </form>
        </main>





<?php
$content = ob_get_clean();

require_once "template.php";
?>