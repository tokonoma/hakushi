<div class="container">
    <div class="row">

        <?php include('views/alerts.php');?>

        <div class="col-sm-4 text-center hidden-xs">
            <i class="fa fa-user-circle-o profile-icon" aria-hidden="true"></i>
        </div>

        <div class="col-sm-8">

            <!-- HEADER BAR -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header pull-left">
                        <span class="navbar-brand">
                            User Settings
                        </span>
                    </div>
                    <div class="navbar-header pull-right">
                        <ul class="nav navbar-nav navbar-right navbar-right-button-end">
                            <li>
                                <button type="button" class="btn allw-success navbar-btn save-settings-btn">
                                    Save Changes
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- using REQUEST_URI routes straight back to settings for processing -->
            <form id="settings-form" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>">
                <?php foreach($results as $user): ?>
                    <div class="form-group">
                        <label for="user-email">Email</label>
                        <input type="text" class="form-control" id="user-email" name="user-email" placeholder="email" autocomplete='off' value="<?php echo $user['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" placeholder="title" autocomplete='off' value="<?php echo $user['fname']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" placeholder="title" autocomplete='off' value="<?php echo $user['lname']; ?>">
                    </div>
                    <hr>
                    <div class="checkbox">
                        <label>
                            <?php if($user['stayloggedin'] == 1): ?>
                            <input id="stay-logged-in" type="checkbox" name="stay-logged-in" value="1" checked> Stay Logged-In?
                            <?php else: ?>
                            <input id="stay-logged-in" type="checkbox" name="stay-logged-in" value="1"> Stay Logged-In?
                            <?php endif; ?>
                        </label>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="password-one">Change Password</label>
                        <input type="password" class="form-control" id="password-one" name="password-one" placeholder="Enter new password" autocomplete='off' value="">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password-two" name="password-two" placeholder="Confirm new password" autocomplete='off'>
                    </div>
                <?php endforeach; ?>

            </form>
            
        </div>

    </div> <!--/row-->
</div> <!--/container-->