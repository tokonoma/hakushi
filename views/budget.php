<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">

            <?php include('views/alerts.php');?>
            
            <ul id="item-list" class="list-unstyled">
                <?php foreach($thisbudget as $budget): ?>

                <?php
                    //let's get all those variables we need
                    $thisbudgetuid = $budget['uid'];
                    $thisbudgetname = $budget['name'];
                    $thisbudgetbalance = $budget['balance'];
                    $thisprintbalance = number_format(($thisbudgetbalance/100), 2, '.', ',');
                    $thisautorefill = $budget['autorefill'];
                    $thisrefillamount = $budget['refillamount'];
                    $thisprintrefillamount = number_format(($thisrefillamount/100), 2, '.', ',');
                    $thisrefillfreq = $budget['refillfrequency'];
                    $thisrefillon = $budget['refillon'];
                    $thisnextrefill = $budget['nextrefill'];
                    $thisbudgetshares = $budget['shares'];
                    $thisbudgetowner = $budget['owner'];
                ?>
                <?php if($thisautorefill == 1): ?>
                <h6>This budget will automatically refill on <strong><?php echo date("l\, F jS Y", strtotime($thisnextrefill)); ?></strong></h6>
                <?php endif; ?>
                <li class="budget-table budget-detail table-parent" id="budget<?php echo $thisbudgetuid?>">
                    <div class="budget-data table-cell">
                        <div class="budget-data-padding">
                            <div class="budget-details table-cell">
                                <div class="budget-name">
                                    <?php echo $thisbudgetname; ?>
                                </div>
                                <div class="budget-balance tiny-balance">
                                    <?php echo "$".$thisprintbalance?>
                                </div>
                                <div class="budget-properties">
                                    <?php if($thisautorefill == 1): ?>
                                        <div class="half-badge half-badge-left refill-badge">
                                            <i class="fa fa-repeat" aria-hidden="true"></i>
                                        </div><div class="half-badge half-badge-right refill-badge">
                                            <?php
                                                echo "$".$thisprintrefillamount."/".$thisrefillfreq;
                                            ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge initial-badge">
                                            <?php
                                                echo "Started with "."$".$thisprintrefillamount;
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if(($thisbudgetshares > 0) && ($origin != "shared")): ?>
                                        <span class="badge shares-badge">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i><?php echo $thisbudgetshares?>
                                        </span>
                                    <?php elseif($origin == "shared"): ?>
                                        <span class="badge shares-badge">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo $thisbudgetowner; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="budget-balance table-cell table-cell-vcenter">
                                <?php echo "$".$thisprintbalance?>
                            </div>
                        </div>
                        <div class="balance-health-bar-container">
                            <?php
                                $balancehealth = $thisbudgetbalance/$thisrefillamount*100;
                                if($balancehealth >= 66){
                                    $balancehealthhex = "#09A387";
                                }
                                elseif($balancehealth < 66 && $balancehealth > 33){
                                    $balancehealthhex = "#C6B40B";
                                }
                                else{
                                    $balancehealthhex = "#C6500B";
                                }
                            ?>
                            <?php if($thisbudgetbalance < $thisrefillamount): ?>
                                <div class="balance-health-bar" style="background: <?php echo $balancehealthhex?>; width: <?php echo $balancehealth."%"?>;"></div>
                            <?php else: ?>
                                <div class="balance-health-bar"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="budget-spacing-column table-cell"></div>
                    <div class="budget-deduct-btn-cell table-cell table-cell-vcenter text-center">
                        <button type="button" class="btn deduct-btn" data-toggle="modal" data-target="#budget-deduct-modal" data-uid="<?php echo $thisbudgetuid?>" data-name="<?php echo $thisbudgetname?>" data-balance="<?php echo $thisbudgetbalance?>">
                            <i class="fa fa-chevron-circle-down fa-4x" aria-hidden="true"></i>
                        </button>
                    </div>
                </li>

                <?php endforeach; ?>

            </ul>
        </div> <!-- /col -->
    </div> <!-- /row -->
</div> <!-- /container -->

<div class="container">
    <div class="row budget-toolbar">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <button type="button" id="edit-me-btn" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-budget-modal"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
            <button type="button" id="share-me-btn" class="btn btn-default btn-sm" data-toggle="modal" data-target="#budget-share-modal"><i class="fa fa-user-plus" aria-hidden="true"></i> Share</button>
            <?php if($origin != "shared"): ?>
                <button type="button" id="delete-me-btn" class="btn btn-default btn-sm" data-toggle="modal" data-target="#budget-delete-modal" data-name="<?php echo $thisbudgetname?>" data-balance="<?php echo $thisbudgetbalance?>">
                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php if(($numberofshares > 0) && ($origin != "shared")): ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">
            <h3>Shares</h3>
            <p>This budget has been shared with the following users</p>
            <?php foreach($budgetshares as $budgetshare): ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php echo $budgetshare['shareduser']?>
                    <button type="button" class="btn btn-default btn-xs pull-right unshare-btn" data-toggle="modal" data-target="#budget-unshare-modal" data-uid="<?php echo $budgetshare['uid']?>" data-shareduser="<?php echo $budgetshare['shareduser']?>">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div> <!-- /col -->
    </div> <!-- /row -->
</div> <!-- /container -->
<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-12">

            <h3>Budget History</h3>
            <div class="panel panel-default">
                <!-- Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                <span class="hidden-sm hidden-xs">Date</span>
                                <span class="hidden-md hidden-lg"><i class="fa fa-calendar"></i></span>
                            </th>
                            <th>
                                <span class="hidden-sm hidden-xs">Description</span>
                                <span class="hidden-md hidden-lg"><i class="fa fa-commenting"></i></span>
                            </th>
                            <th>
                                <span class="hidden-sm hidden-xs">Withdraw/Deposit</span>
                                <span class="hidden-md hidden-lg"><i class="fa fa-minus"></i>/<i class="fa fa-plus"></i></span>
                            </th>
                            <th>
                                <span class="hidden-sm hidden-xs">User</span>
                                <span class="hidden-md hidden-lg"><i class="fa fa-user"></i></span>
                            </th>
                            <th class="text-right" align="right">
                                <span class="hidden-sm hidden-xs">Balance</span>
                                <span class="hidden-md hidden-lg"><i class="fa fa-money"></i></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($budgettable as $budgettransaction): ?>
                        <tr>
                            <td><?php echo date("m/d/y", strtotime($budgettransaction['transactiondate']))?></td>
                            <td>
                                <span class="hidden-xs">
                                    <?php echo $budgettransaction['name']?>
                                </span>
                                <span class="hidden-sm hidden-md hidden-lg">
                                    <div class="btn-group tool-tip-btn">
                                        <button type="button" class="btn btn-link btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="no-a-tag"><?php echo $budgettransaction['name']?></li>
                                        </ul>
                                    </div>
                                </span>
                            </td>
                            <td>
                                <?php
                                    $depositamount = $budgettransaction['deposit'];
                                    $withdrawamount = $budgettransaction['withdraw'];
                                    if($depositamount == 0 && $withdrawamount > 0){
                                        echo "<span class='withdraw-span'>-$".number_format(($withdrawamount/100), 2, '.', ',')."</span>";
                                    }
                                    elseif($depositamount > 0 && $withdrawamount == 0){
                                         echo "<span class='deposit-span'>+$".number_format(($depositamount/100), 2, '.', ',')."</span>";;
                                    }
                                    else{
                                        echo "-";
                                    }
                                ?>
                            </td>
                            <td>
                                <span class="hidden-xs">
                                    <?php echo $budgettransaction['user']?>
                                </span>
                                <span class="hidden-sm hidden-md hidden-lg">
                                    <div class="btn-group tool-tip-btn">
                                        <button type="button" class="btn btn-link btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="no-a-tag"><?php echo $budgettransaction['user']?></li>
                                        </ul>
                                    </div>
                                </span>
                            </td>
                            <td align="right"><?php echo "$".number_format(($budgettransaction['balance']/100), 2, '.', ',')?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div> <!-- /col -->
    </div> <!-- /row -->
</div> <!-- /container -->



