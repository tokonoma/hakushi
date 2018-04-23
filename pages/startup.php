<?php include('views/header.php');?>

<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4 mt-5">
                
                <?php include('views/alerts.php');?>
                
                <h3>Let's Get started</h3>
                <h5>Create an admin user</h5>
                <div class="card">
                    <div class="card-body">
                        <form id="js-submit-form" method="POST" action="<?php echo $baseurl; ?>">
                            <div class="form-group">
                                <label for="newemail">Email address</label>
                                <input type="email" name="newemail" class="form-control" id="newemail" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="newpassword">Password</label>
                                <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="passwordconfirm">Confirm Password</label>
                                <input type="password" name="passwordconfirm" class="form-control" id="passwordconfirm" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label for="newuserfirstname">First Name</label>
                                <input type="text" name="newuserfirstname" class="form-control" id="newuserfirstname" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="newuserlastname">Last Name</label>
                                <input type="text" name="newuserlastname" class="form-control" id="newuserlastname" placeholder="Last Name">
                            </div>
                            
                            <input type="hidden" name="action" value="createuser">
                            <button id="js-pw-check" type="button" class="btn btn-primary pull-right">
                                Create User
                            </button>
                        </form>
                    </div>
                </div> <!--/panel-->
            </div></div> <!--/tables-->
        </div> <!--/col-->
    </div> <!--/row-->
</div> <!--/container-->


<!--BOTTOM-->

<?php include('views/footer.php'); ?>

<?php include('views/commonjs.php');?>

<?php include('views/ender.php');?>