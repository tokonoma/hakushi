<div class="container mt-4">
    <div class="row">

        <div class="col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">

            <?php include('views/alerts.php');?>

            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
                <a class="navbar-brand" href="#">User Settings</a>
                <button type="button" class="btn btn-primary js-submit-btn ml-auto">
                    Save Changes
                </button>
            </nav>

            <!-- using REQUEST_URI routes straight back to settings for processing -->
            <form id="js-submit-form" class="mt-3" method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>" autocomplete="false">
                <?php foreach($results as $user): ?>

                    <div class="text-center mb-4 profile-image">
                        <i class="fas fa-user-circle"></i>
                    </div>

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
                    <div class="checkbox">
                        <label>
                            <?php if($user['stayloggedin'] == 1): ?>
                            <input id="stay-logged-in" type="checkbox" name="stay-logged-in" value="1" checked> Stay Logged-In?
                            <?php else: ?>
                            <input id="stay-logged-in" type="checkbox" name="stay-logged-in" value="1"> Stay Logged-In?
                            <?php endif; ?>
                        </label>
                    </div>
                    <hr class="my-5">
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