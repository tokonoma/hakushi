<?php

try{
    //open/create the database sqlite
    //$db = new PDO('sqlite:data/content.sqlite');

    //postgres for prod
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userid = $_SESSION['email'];

    //if the form is submitted
    if(isset($_POST['user-email'])){

        //before doing anything, make sure nothing is blank
        $required = array('user-email', 'first-name', 'last-name');

        foreach($required as $field) {
            if (empty($_POST[$field])) {
                $_SESSION['sessionalert'] = "missingfield";
                header("Location: ".$_SERVER['REQUEST_URI']);
                exit();
            }
        }

        $input_email = $_POST['user-email'];
        $input_fname = $_POST['first-name'];
        $input_lname = $_POST['last-name'];
        $input_stayloggedin = (!empty($_POST['stay-logged-in']) ? $_POST['stay-logged-in'] : 0);

        $uniquecheck = $db->prepare("SELECT email from users where email = '$input_email'");
        $uniquecheck->execute();
        //echo $uniquecheck->rowCount();

        if(($input_email == $userid) || ($uniquecheck->rowCount() <= 0)){

            //did they try to change their password
            if(!empty($_POST['password-one']) || !empty($_POST['password-two'])){

                //are both fields entered and are they the same?
                if(!empty($_POST['password-one']) && !empty($_POST['password-two']) && $_POST['password-one'] == $_POST['password-two'] ){
                    //save it
                    $input_pass = $_POST['password-one'];
                    $newpass = password_hash($input_pass, PASSWORD_BCRYPT);
                    $update = $db->prepare("UPDATE users SET password = :newpass WHERE email = '$userid'");
                    $update->bindParam(':newpass', $newpass, PDO::PARAM_STR);
                    $update->execute();

                    $_SESSION['sessionalert'] = "passwordchanged";
                }
                else{
                    $_SESSION['sessionalert'] = "passwordchangefail";
                    header("Location: ".$_SERVER['REQUEST_URI']);
                    exit();
                }

            }
            else{
                $_SESSION['sessionalert'] = "settingssaved";
            }

            //if the email is the same or it's new AND unique, go ahead and save it
            $update = $db->prepare("UPDATE users SET email = :email, fname = :fname, lname = :lname, stayloggedin = :stayloggedin WHERE email = '$userid'");
            $update->bindParam(':email', $input_email, PDO::PARAM_STR);
            $update->bindParam(':fname', $input_fname, PDO::PARAM_STR);
            $update->bindParam(':lname', $input_lname, PDO::PARAM_STR);
            $update->bindParam(':stayloggedin', $input_stayloggedin, PDO::PARAM_STR);
            $update->execute();

            $_SESSION['firstname'] = $input_fname;
            $_SESSION['email'] = $input_email;
            $_SESSION['stayon'] = $input_stayloggedin;
            header("Location: ".$_SERVER['REQUEST_URI']);
            exit();
        }
        else{
            //not unique, throw error
            $_SESSION['sessionalert'] = "emailexists";
            header("Location: ".$_SERVER['REQUEST_URI']);
            exit();
        }

    }

    //populate content on page
    $results = $db->query("SELECT * FROM users WHERE email = '$userid'");

    // close the database connection
    $db = NULL;
}
catch(PDOException $e){
    $statusMessage = $e->getMessage();
    $statusType = "danger";
}


?>