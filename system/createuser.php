<?php

try{
    //postgres for prod
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input_email = $_POST['newemail'];
    $input_password = $_POST['newpassword'];
    $password_store = password_hash($input_password, PASSWORD_BCRYPT);
    $input_fname = $_POST['newuserfirstname'];
    $input_lname = $_POST['newuserlastname'];
    $stayloggedin = 0;

    $insert = $db->prepare("INSERT INTO users (email, password, fname, lname, stayloggedin) VALUES (?, ?, ?, ?, ?)");
    $insertarray = array($input_email, $password_store, $input_fname, $input_lname, $stayloggedin);
    $insert->execute($insertarray);

    // close the database connection
    $db = NULL;
}
catch(PDOException $e){
    // $statusMessage = $e->getMessage();
    // $statusType = "danger";
    $_SESSION['sessionalert'] = "loginfail";
    header("Location: ".$baseurl);
    exit();
}


//is this the first user of all time, log user in
if(!empty($_SESSION['firstuser'])){
    $_SESSION['firstname'] = $input_fname;
    $_SESSION['email'] = $input_email;
    //$_SESSION['admin'] = true;

    $_SESSION['expire'] = time()+60*360;
    unset($_SESSION['firstuser']);
}

$_SESSION['sessionalert'] = "usercreated";
header("Location: ".$baseurl);

?>