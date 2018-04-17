<?php

    //alerts and notifications
    $statusMessage = "";
    $statusType = "";
    $alertnoun = "";
    
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
            case "budgetcreated":
                $statusMessage = "New Budget Created!";
                $statusType = "success";
                break;
            case "itemedited":
                $statusMessage = ucfirst($alertnoun)." edited";
                $statusType = "success";
                break;
            case "itemcreated":
                $statusMessage = ucfirst($alertnoun)." created";
                $statusType = "success";
                break;
            case "itemdeleted":
                $statusMessage = ucfirst($alertnoun)." deleted";
                $statusType = "danger";
                break;
            case "pagesaved":
                $statusMessage = "Page saved";
                $statusType = "success";
                break;
            case "loginfail":
                $statusMessage = "Login failed - please check your credentials";
                $statusType = "danger";
                break;
            case "generalerror":
                $statusMessage = "Something went wrong...";
                $statusType = "danger";
                break;
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
            case "cms":
                $statusMessage = "You do not have access to Marian CMS";
                $statusType = "danger";
                break;
            case "admin":
                $statusMessage = "You do not have access to Marian Admin";
                $statusType = "danger";
                break;
        }
    }