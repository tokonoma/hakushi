<!-- NEW BUDGET MODAL -->
<?php if(!isset($budgetuid)): ?>
<div class="modal fade form-modal" id="new-budget-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="new-budget-form" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">New Budget</h4>
                </div>
                <div class="modal-body">
                    <p>Enter budget details</p>
                    <div class="form-group">
                        <label for="budget-name-input">Budget Name</label>
                        <input type="text" class="form-control" id="budget-name-input" name="budget-name-input" placeholder="Budget Title" autocomplete='off' autofocus>
                    </div>
                    <div class="form-group">
                        <label for="budget-balance-input">Initial Balance</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="number" class="form-control" id="budget-balance-input" name="budget-balance-input" placeholder="0.00" autocomplete='off' step="0.01">
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input id="budget-refill-input" type="checkbox" name="budget-refill-input" value="1"> Auto-Refill
                        </label>
                    </div>
                    <div id="refill-options-group" class="hidden form-hidden">
                        <div id="refill-amount-group" class="form-group">
                            <label for="refill-amount-input">Refill Amount</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="refill-amount-input" placeholder="0.00" autocomplete='off' step="0.01">
                            </div>
                        </div>
                        <div id="refill-frequency-group" class="form-group">
                            <label for="refill-frequency-input">Refill Frequency</label>
                            <select id="refill-frequency-input"  class="form-control" name="refill-frequency-input">
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <div id="refill-weekly-group" class="form-group default-show">
                            <label for="refill-weekly-input">Day of the Week</label>
                            <select class="form-control" name="refill-weekly-input">
                                <?php $daysofweek=["sunday","monday","tuesday","wednesday","thursday","friday","saturday"]; ?>
                                <?php foreach($daysofweek as $dayofweek): ?>         
                                    <option value="<?php echo $dayofweek ?>">
                                        <?php echo ucfirst($dayofweek) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="refill-monthly-group" class="form-group hidden form-hidden">
                            <label for="refill-monthly-input">Day of the Month</label>
                            <select class="form-control" name="refill-monthly-input">
                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                    <option><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="budgetaction" value="new">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-- BUDGET DEDUCT MODAL -->
<div class="modal fade form-modal" id="budget-deduct-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="budget-deduct-form" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Deduct from Budget</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <strong><span class="say-budget-name"></span></strong>: 
                        <span class="say-current-balance"></span>
                    </p>
                    <p>How much would you like to deduct?</p>
                    <div class="form-group">
                        <label for="budget-deduction-input">Deduction Amount</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="number" class="form-control" id="budget-deduction-input" name="budget-deduction-input" placeholder="0.00" autocomplete='off' step="0.01" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deduction-desc-input">Description (optional)</label>
                        <input type="text" class="form-control" id="deduction-desc-input" name="deduction-desc-input" placeholder="Write a brief description about this deduction!" autocomplete='off'>
                    </div>
                    <input type="hidden" name="budgetaction" value="deduct">
                    <input type="hidden" name="deduct-uid" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Deduct</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- BUDGET DELETE MODAL -->
<?php if(isset($budgetuid)): ?>
<div class="modal fade form-modal" id="budget-delete-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Budget</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to <strong>DELETE</strong> this budget?</p>
                <p>
                    <strong><span class="say-delete-budget-name"></span></strong>: 
                    <span class="say-delete-current-balance"></span>
                </p>
                <p>Please check the following boxes to delete this budget</p>

                <p id="must-check-to-delete" class="hidden form-hidden">Gotta check those checkboxes!!!</p>
                
                <form id="budget-delete-form" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                    <div class="checkbox">
                        <label>
                            <input id="delete-you-sure-1" type="checkbox" name="delete-you-sure-1" value="1" class="delete-you-sure"> I want to delete this budget!
                        </label>
                    </div>
                   <div class="checkbox">
                        <label>
                            <input id="delete-you-sure-2" type="checkbox" name="delete-you-sure-2" value="1" class="delete-you-sure"> I want to destroy all data concerning this budget!
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input id="delete-you-sure-3" type="checkbox" name="delete-you-sure-3" value="1" class="delete-you-sure"> I want to never see this budget again!
                        </label>
                    </div>
                    <input type="hidden" name="budgetaction" value="delete">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" id="delete-budget-submit-btn" name="delete-budget-submit-btn" class="btn btn-danger disabled-fade">Delete Forever</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-- BUDGET SHARE MODAL -->
<?php if(isset($budgetuid)): ?>
<div class="modal fade form-modal" id="budget-share-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Share Budget</h4>
            </div>
            <form id="budget-delete-form" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                <div class="modal-body">
                    <h3>Aye yo <?php echo $_SESSION['firstname'] ?>, you tryin' to share this budget?</h3>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <strong><?php echo $thisbudgetname; ?></strong>: <?php echo $thisprintbalance; ?>
                        </div>
                    </div>
                    <p>
                        Enter the email address of the user with whom you would like to share. And try not to faint at how grammatically correct that sentence was...
                    </p>
                    <p>
                        If the user has an account, this budget will appear on their dashboard.
                    </p>
                    <div class="form-group">
                        <label for="share-user-input">Share With</label>
                        <input type="email" class="form-control" id="share-user-input" name="share-user-input" placeholder="Please enter a users email address" autocomplete='off'>
                    </div>
                    <input type="hidden" name="budgetaction" value="share">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn allw-success">Share!</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-- BUDGET UNSHARE MODAL -->
<?php if(isset($budgetuid)): ?>
<div class="modal fade form-modal" id="budget-unshare-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Stop Sharing Budget</h4>
            </div>
            <form id="budget-unshare-form" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                <div class="modal-body">
                    <p>
                        Stop sharing with this user?
                    </p>
                    <p>
                        <strong><span class="say-unshare-user"></span></strong>
                    </p>
                    <input type="hidden" name="budgetaction" value="unshare">
                    <input type="hidden" name="share-uid" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-danger">Stop Sharing</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-- EDIT BUDGET MODAL -->
<?php if(isset($budgetuid)): ?>
<div class="modal fade form-modal" id="edit-budget-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit-budget-form" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Budget</h4>
                </div>
                <div class="modal-body">
                    <p>Edit budget details</p>
                    <div class="form-group">
                        <label for="budget-name-input">Budget Name</label>
                        <input type="text" class="form-control" id="budget-name-input" name="budget-name-input" placeholder="Budget Title" autocomplete='off' value="<?php echo $thisbudgetname ?>">
                    </div>
                    <div class="form-group">
                        <label for="budget-balance-input">Current Balance</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="number" class="form-control" id="budget-balance-input" name="budget-balance-input" placeholder="0.00" autocomplete='off' step="0.01" value="<?php echo $thisprintbalance ?>">
                        </div>
                    </div>
                    <?php if($thisautorefill == 1): ?>
                    <div class="checkbox">
                        <label>
                            <input id="budget-refill-input" type="checkbox" name="budget-refill-input" value="1" checked> Auto-Refill
                        </label>
                    </div>
                    <div id="refill-options-group" class="">
                        <div id="refill-amount-group" class="form-group">
                            <label for="refill-amount-input">Refill Amount</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="refill-amount-input" placeholder="0.00" autocomplete='off' step="0.01" value="<?php echo $thisprintrefillamount ?>">
                            </div>
                        </div>
                        <?php if($thisrefillfreq == "weekly"): ?>
                        <div id="refill-frequency-group" class="form-group">
                            <label for="refill-frequency-input">Refill Frequency</label>
                            <select id="refill-frequency-input"  class="form-control" name="refill-frequency-input">
                                <option value="weekly" selected>Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <div id="refill-weekly-group" class="form-group default-show">
                            <label for="refill-weekly-input">Day of the Week</label>
                            <select class="form-control" name="refill-weekly-input">
                                <?php $daysofweek=["sunday","monday","tuesday","wednesday","thursday","friday","saturday"]; ?>
                                <?php foreach($daysofweek as $dayofweek): ?>
                                    <?php if($thisrefillon == $dayofweek): ?>
                                    <option value="<?php echo $dayofweek ?>" selected>
                                        <?php echo ucfirst($dayofweek) ?>
                                    </option>
                                    <?php else: ?>
                                    <option value="<?php echo $dayofweek ?>">
                                        <?php echo ucfirst($dayofweek) ?>
                                    </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="refill-monthly-group" class="form-group hidden form-hidden">
                            <label for="refill-monthly-input">Day of the Month</label>
                            <select class="form-control" name="refill-monthly-input">
                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                    <option><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <?php else: ?>
                        <div id="refill-frequency-group" class="form-group">
                            <label for="refill-frequency-input">Refill Frequency</label>
                            <select id="refill-frequency-input"  class="form-control" name="refill-frequency-input">
                                <option value="weekly">Weekly</option>
                                <option value="monthly" selected>Monthly</option>
                            </select>
                        </div>
                        <div id="refill-weekly-group" class="form-group form-hidden hidden">
                            <label for="refill-weekly-input">Day of the Week</label>
                            <select class="form-control" name="refill-weekly-input">
                                <?php $daysofweek=["sunday","monday","tuesday","wednesday","thursday","friday","saturday"]; ?>
                                <?php foreach($daysofweek as $dayofweek): ?>         
                                    <option value="<?php echo $dayofweek ?>">
                                        <?php echo ucfirst($dayofweek) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="refill-monthly-group" class="form-group default-show">
                            <label for="refill-monthly-input">Day of the Month</label>
                            <select class="form-control" name="refill-monthly-input">
                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                    <?php if($thisrefillon == $i): ?>
                                    <option selected><?php echo $i; ?></option>
                                    <?php else: ?>
                                    <option><?php echo $i; ?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                    <div class="checkbox">
                        <label>
                            <input id="budget-refill-input" type="checkbox" name="budget-refill-input" value="1"> Auto-Refill
                        </label>
                    </div>
                    <div id="refill-options-group" class="hidden form-hidden">
                        <div id="refill-amount-group" class="form-group">
                            <label for="refill-amount-input">Refill Amount</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number" class="form-control" name="refill-amount-input" placeholder="0.00" autocomplete='off' step="0.01">
                            </div>
                        </div>
                        <div id="refill-frequency-group" class="form-group">
                            <label for="refill-frequency-input">Refill Frequency</label>
                            <select id="refill-frequency-input"  class="form-control" name="refill-frequency-input">
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>
                        <div id="refill-weekly-group" class="form-group default-show">
                            <label for="refill-weekly-input">Day of the Week</label>
                            <select class="form-control" name="refill-weekly-input">
                                <?php $daysofweek=["sunday","monday","tuesday","wednesday","thursday","friday","saturday"]; ?>
                                <?php foreach($daysofweek as $dayofweek): ?>         
                                    <option value="<?php echo $dayofweek ?>">
                                        <?php echo ucfirst($dayofweek) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div id="refill-monthly-group" class="form-group hidden form-hidden">
                            <label for="refill-monthly-input">Day of the Month</label>
                            <select class="form-control" name="refill-monthly-input">
                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                    <option><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>
                    <input type="hidden" name="budgetaction" value="edit">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" name="submit" class="btn allw-success">
                        Save Edits
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>