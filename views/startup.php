<?php include('views/header.php');?>

<div class="container height100">
    <div class="row height100">
        <div class="col-sm-4 col-sm-offset-4 height100">
            <div class="table-parent height80"><div class="table-cell table-cell-vcenter">
                
                <?php include('views/alerts.php');?>
                
                <h3>Let's Get started</h3>
                <h4>Create an admin user</h4>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="js-submit-form" method="POST" action="<?php echo $baseurl; ?>">
                            <div class="form-group">
                                <label for="newuseremail">Email address</label>
                                <input type="email" name="newuseremail" class="form-control" id="newemail" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="newuserpassword">Password</label>
                                <input type="password" name="newuserpassword" class="form-control" id="newuserpassword" placeholder="Password">
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

<?php include('views/commonjs.php');?>

<script>
    $(function() {
        $("#js-pw-check").click(function() {
            if($('input[name=newuserpassword]').val() == $('input[name=passwordconfirm]').val()){
                submitJSForm();
            }
            else{
                $('#passwordconfirm').css('border-color', '#AA4444');
                $('#passwordconfirm').css('background-color', '#FCD6D6');
                $(document).scrollTop($("#passwordconfirm").offset().top); 
            }
        });
        //also prompt with error if you unfocus with mismatching passswords
        $('#passwordconfirm').blur(function(){
            if($('input[name=newuserpassword]').val() == $('input[name=passwordconfirm]').val()){
                $('#passwordconfirm').removeAttr( 'style');
            }
            else{
                $('#passwordconfirm').css('border-color', '#AA4444');
                $('#passwordconfirm').css('background-color', '#FCD6D6');
            }
        });
    });
</script>

<?php include('views/ender.php');?>