<section class="navbar custom-navbar navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>

            <span class="navbar-brand">Student Attendance System</span>

            <?php
            if(!empty($_SESSION["currentUser"])) {
                echo "<span class='navbar-brand'>" . $_SESSION["currentUser"]->userType . "</span>";
            }
            ?>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (!empty($_SESSION["currentUser"])) {
                        echo "<a href='/student-attendance-system/' class='section-btn'>Logout</a>";
                    } else {
                        echo "<a href='/student-attendance-system/' class='section-btn'>Login</a>";
                    }
                ?>
            </ul>
        </div>
    </div>
</section>
