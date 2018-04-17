<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $baseurl; ?>">
                ALLOWANCE
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-right-button-end">
                <li>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle navbar-btn link-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hi <?php if(!empty($_SESSION['firstname'])): ?> <?php echo $_SESSION['firstname'] ?> <?php else: ?> There <?php endif ?> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $baseurl; ?>?mode=settings">Settings</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <form id="login-form" method="POST" action="<?php echo $baseurl; ?>">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit" name="submit" class="btn btn-link">
                                        Logout
                                    </button>
                                </form> 

                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>