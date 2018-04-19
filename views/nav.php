<!-- change navbar-expand-sm to control when hamburger gets triggered -->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $baseurl; ?>">白紙</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <!--
            example of standard navbar links
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hi <?php if(!empty($_SESSION['firstname'])): ?> <?php echo $_SESSION['firstname'] ?> <?php else: ?> There <?php endif ?> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profiledropdown">
                        <a class="dropdown-item" href="<?php echo $baseurl; ?>?mode=settings">Settings</a>
                        <div class="dropdown-divider"></div>
                        <form id="login-form" method="POST" action="<?php echo $baseurl; ?>">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit" name="submit" class="btn btn-link">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>