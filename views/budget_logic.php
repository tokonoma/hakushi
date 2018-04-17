<?php

    $dashboarduser = $_SESSION['email'];
    $origin = isset($_GET['origin']) ? $_GET['origin'] : "owner";

    //define current date
    $currenttimestamp = time();
    $currentdate = date("Ymd");
    $currentyear = date("Y");
    $currentmonth = date("m");
    $currentday = date("d");
    
    try{
        //postgres for prod
        $db = new PDO($dsn);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //WHITELIST CHECK HERE
        $owneduids = $db->query("SELECT uid FROM budgets WHERE owner = '$dashboarduser'");
        $shareduids = $db->query("SELECT budgetuid FROM shares WHERE shareduser = '$dashboarduser'");
        $whitelistarray = array();
        foreach($owneduids as $owneduid){
            $whitelistarray[] = $owneduid['uid'];
        }
        foreach($shareduids as $shareduid){
            $whitelistarray[] = $shareduid['budgetuid'];
        }

        if(in_array($_GET['budget'], $whitelistarray)){
            $budgetuid = $_GET['budget'];
            $budgettablename = "budget".$budgetuid;  
        }
        else{
            header("Location: ".$baseurl."?mode=404");
            exit();
        }

        //budget actions
        if(isset($_POST['budgetaction'])){
                
            $savetype = $_POST['budgetaction'];

            switch ($savetype){
                case 'deduct':
                    //get current balance
                    $currentbalancedata = $db->query("SELECT balance FROM budgets WHERE uid = '$budgetuid'");
                    foreach($currentbalancedata as $getbalance){
                        $input_currentbalance = $getbalance['balance'];
                    }

                    $input_deductamount = $_POST['budget-deduction-input'];
                    $input_deductamount = $input_deductamount*100;
                    $newbalance = $input_currentbalance - $input_deductamount;

                    $input_deductdesc = (!empty($_POST['deduction-desc-input']) ? $_POST['deduction-desc-input'] : "no description");

                    //subtract from balance in budgets table
                    $update = $db->prepare("UPDATE budgets SET balance = :newbalancebind WHERE uid = $budgetuid");
                    $update->bindParam(':newbalancebind', $newbalance, PDO::PARAM_STR);
                    $update->execute();

                    //add transaction to history table
                    $insert = $db->prepare("INSERT INTO $budgettablename (name, budgetuid, balance, withdraw, deposit, transactiondate, user) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $insertarray = array($input_deductdesc, $budgetuid, $newbalance, $input_deductamount, 0, $currentdate, $dashboarduser);
                    $insert->execute($insertarray);

                    //finish and redirect with success message
                    $_SESSION['sessionalert'] = "generalsuccess";
                    header("Location: ".$_SERVER['REQUEST_URI']);
                    exit();

                    break;
                case 'edit':
                    //edit item
                    //add row to table
                    $input_budgetname = $_POST['budget-name-input'];
                    $input_balance = $_POST['budget-balance-input'];
                    $input_balance = $input_balance*100;
                    $input_autorefill = (!empty($_POST['budget-refill-input']) ? $_POST['budget-refill-input'] : 0);
                    //If refill is off, use this to hold original balance
                    if(!empty($_POST['budget-refill-input'])){
                        $input_refillamount = $_POST['refill-amount-input'];
                        $input_refillamount = $input_refillamount*100;
                    }
                    else{
                        $input_refillamount = $input_balance;
                    }
                    $input_refillfreq = (!empty($_POST['budget-refill-input']) ? $_POST['refill-frequency-input'] : "none");

                    //calculate next refill
                    if($input_refillfreq == "weekly"){
                        $input_refillon = $_POST['refill-weekly-input'];
                        $input_nextrefill = findRefillDate($currenttimestamp, $input_refillfreq, $input_refillon);
                    }
                    elseif($input_refillfreq == "monthly"){
                        $input_refillon = $_POST['refill-monthly-input'];
                        $input_refillon = sprintf("%02d", $input_refillon);

                        $input_nextrefill = findRefillDate($currenttimestamp, $input_refillfreq, $input_refillon);
                    }
                    else{
                        $input_refillon = "none";
                        $input_nextrefill = findRefillDate($currenttimestamp, $input_refillfreq, $input_refillon);
                    }

                    //update budget in budgets table
                    $update = $db->prepare("UPDATE budgets SET name = :namebind, balance = :balancebind, autorefill = :autorefillbind, refillamount = :refillamountbind, refillfrequency = :frequencybind, refillon = :refillonbind, nextrefill = :nextbind WHERE uid = $budgetuid");
                    $update->bindParam(':namebind', $input_budgetname, PDO::PARAM_STR);
                    $update->bindParam(':balancebind', $input_balance, PDO::PARAM_STR);
                    $update->bindParam(':autorefillbind', $input_autorefill, PDO::PARAM_STR);
                    $update->bindParam(':refillamountbind', $input_refillamount, PDO::PARAM_STR);
                    $update->bindParam(':frequencybind', $input_refillfreq, PDO::PARAM_STR);
                    $update->bindParam(':refillonbind', $input_refillon, PDO::PARAM_STR);
                    $update->bindParam(':nextbind', $input_nextrefill, PDO::PARAM_STR);
                    $update->execute();

                    //log creation of budget into table
                    $input_transactionname = "Budget edited";

                    $insert = $db->prepare("INSERT INTO $budgettablename (name, budgetuid, balance, withdraw, deposit, transactiondate, user) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $insertarray = array($input_transactionname, $budgetuid, $input_balance, "-", "-", $currentdate, $dashboarduser);
                    $insert->execute($insertarray);

                    //finish and redirect with success message
                    $_SESSION['sessionalert'] = "generalsuccess";
                    header("Location: ".$_SERVER['REQUEST_URI']);
                    exit();

                    break;
                case 'delete':
                    //delete budget from budgets table
                    $db->exec("DELETE FROM budgets WHERE uid = $budgetuid");

                    //delete any shares this budget may have had
                    $db->exec("DELETE FROM shares WHERE budgetuid = $budgetuid");

                    //delete budgets table
                    $db->exec("DROP TABLE $budgettablename");


                    header("Location: ".$baseurl);
                    exit();

                    break;
                case 'share':
                    //get share email input
                    $input_shareduser = $_POST['share-user-input'];

                    //add to shares column of budgets table
                    $update = $db->prepare("UPDATE budgets SET shares = shares + 1 WHERE uid = $budgetuid");
                    $update->execute();

                    //add details to shares table
                    $insert = $db->prepare("INSERT INTO shares (budgetuid, owner, shareduser) VALUES (?, ?, ?)");
                    $insertarray = array($budgetuid, $dashboarduser, $input_shareduser);
                    $insert->execute($insertarray);

                    $_SESSION['sessionalert'] = "generalsuccess";
                    header("Location: ".$_SERVER['REQUEST_URI']);
                    exit();

                    break;
                case 'unshare':
                    //get unshare uid
                    $input_shareuid = $_POST['share-uid'];

                    //add to shares
                    $update = $db->prepare("UPDATE budgets SET shares = shares - 1 WHERE uid = $budgetuid");
                    $update->execute();

                    //add share details to share table
                    $db->exec("DELETE FROM shares WHERE uid = $input_shareuid");

                    $_SESSION['sessionalert'] = "generalsuccess";
                    header("Location: ".$_SERVER['REQUEST_URI']);
                    exit();

                    break;
            }
            //$statusMessage = "Error saving item";
            //$statusType = "danger";

            header("Location: ".$_SERVER['REQUEST_URI']);
            exit();

        }

        //maybe change this to be processed above via whitelist because the functions get called before this... technically you could post something to a budget page and it would get processed...
        if($origin == "shared"){
            $thisbudget = $db->query("SELECT * FROM budgets WHERE uid = $budgetuid");
        }
        else{
            $thisbudget = $db->query("SELECT * FROM budgets WHERE owner = '$dashboarduser' AND uid = $budgetuid");
        }

        $budgettable = $db->query("SELECT * FROM $budgettablename ORDER BY CAST(uid AS REAL)DESC");
        $numberofshares = $db->query("SELECT COUNT(*) FROM shares WHERE budgetuid = $budgetuid")->fetchColumn();
        $budgetshares = $db->query("SELECT * FROM shares WHERE budgetuid = $budgetuid");

        //reordering save - called via ajax
        /*
        if(isset($_POST['moveuid']) && isset($_POST['movepos'])){
            $moveuid = $_POST['moveuid'];
            $movepos = $_POST['movepos'];

            $posupdate = $db->prepare("UPDATE $dbtable SET pos = :movepos WHERE uid = $moveuid");
            $posupdate->bindParam(':movepos', $movepos, PDO::PARAM_STR);
            $posupdate->execute();
        }
        */

        // close the database connection
        $db = NULL;
    }
    catch(PDOException $e){
        $statusMessage = $e->getMessage();
        $statusType = "danger";
    }

    // remove alert variable
    unset($_SESSION['sessionalert']);

    function findRefillDate($now, $freq, $refillon){
        if($freq == "weekly"){
            $nextrefillstr = "next ".$refillon;
            $nextrefill = date("Ymd", strtotime($nextrefillstr, $now));
        }
        elseif($freq == "monthly"){
            //breakapart $now
            $nowyear = date("Y", $now);
            $nowmonth = date("m", $now);
            $nowday = date("d", $now); 
            //have we already passed the day for this month?
            if($nowday >= $refillon){
                //do we need to move into 2018?
                if($nowmonth == 12){
                    $refillmonth = "01";
                    $refillyear = $nowyear + 1;
                }
                else{
                    $refillmonth = $nowmonth + 1;
                    $refillmonth = sprintf("%02d", $refillmonth);
                    $refillyear = $nowyear;
                }
            }
            else{
                $refillmonth = $nowmonth;
                $refillyear = $nowyear;
            }
            $nextrefill = $refillyear.$refillmonth.$refillon;
        }
        else{
            $nextrefill = 0;
        }
        return $nextrefill;
    }   

?>