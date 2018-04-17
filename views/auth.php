<?php include('views/header.php');?>

<div class="container height100">
    <div class="row height100">
        <div class="col-sm-4 col-sm-offset-4 height100">
            <div class="table-parent height80"><div class="table-cell table-cell-vcenter">
                
                <?php include('views/alerts.php');?>
                
                <h3>Sign In</h3>
                <div class="panel panel-default">
                    <div class="panel-body">

                        <form id="login-form" method="POST" action="<?php echo $baseurl; ?>">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <input type="hidden" name="action" value="login">
                            <button type="submit" name="submit" class="btn btn-primary pull-right">
                                Login
                            </button>
                        </form>

                    </div>
                </div> <!--/panel-->
            </div></div> <!--/tables-->
        </div> <!--/col-->
    </div> <!--/row-->
</div> <!--/container-->

<?php include('views/commonjs.php');?>

<?php include('views/ender.php');?>