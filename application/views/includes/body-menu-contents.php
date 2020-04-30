<div class="navbar custom-navbar" role="navigation">
    <div class="container">
        <div class="navbar-inner">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <span class="navbar-brand">Student Attendance System</span>

                <?php if (!empty($_SESSION["currentUser"])) {
                    echo "<span class='navbar-page'>" . $_SESSION["currentUser"]->userType . "</span>";
                }?>
            </div>

            <div class="navbar-content">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if (!empty($_SESSION["currentUser"])) {
                            echo "<p class='nav-user'>" . $_SESSION["currentUser"]->userFirstName . "</p>";
                            echo "<a href='/student-attendance-system/' class='section-btn'>Logout</a>";
                        } else {
                            echo "<a href='/student-attendance-system/' class='section-btn'>Login</a>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
