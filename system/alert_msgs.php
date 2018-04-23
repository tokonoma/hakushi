<?php

    //alerts and notifications
    $statusMessage = "";
    $statusType = "";
  
  //define the noun for alerts if available
    if (isset($_SESSION['sessionnoun'])){
        $alertnoun = $_SESSION['sessionnoun'];
    }

    //_SESSION alerts
    if (isset($_SESSION['sessionalert'])){
        $getAlert = $_SESSION['sessionalert'];
        //set a default type in case it's not sent for any reason
        $statusType = "info";
        switch ($getAlert) {
            case "generalsuccess":
                $statusMessage = "Success!";
                $statusType = "success";
                break;
            case "generalerror":
                $statusMessage = "Something went wrong...";
                $statusType = "danger";
                break;

            /*login*/
            case "loginfail":
                $statusMessage = "Incorrect username or password";
                $statusType = "danger";
                break;

            /*settings and form alerts*/
            case "missingfield":
                $statusMessage = "Looks like you left a field empty - try again!";
                $statusType = "danger";
                break;
            case "settingssaved":
                $statusMessage = "Settings saved";
                $statusType = "success";
                break;
            case "passwordchangefail":
                $statusMessage = "Password change failed, please try again";
                $statusType = "danger";
                break;
            case "passwordchanged":
                $statusMessage = "Password changed & settings saved";
                $statusType = "success";
                break;
            case "emailexists":
                $statusMessage = "This email address already has an account";
                $statusType = "danger";
                break;

            /*first user creation*/
            case "usercreated":
                $statusMessage = "New user successfully created";
                $statusType = "success";
                break;
        }
        unset($_SESSION['sessionalert']);
    }

    //_GET alerts
    if (isset($_GET['alert'])){
        $getAlert = $_GET['alert'];
        //set a default type in case it's not sent for any reason
        $statusType = "info";
        switch ($getAlert) {
            case "logout":
                $statusMessage = "You have been logged out";
                $statusType = "info";
                break;
        }
    }