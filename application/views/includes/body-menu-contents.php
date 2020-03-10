<section class="navbar custom-navbar navbar-fixed-top" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>

            <a href="/student-attendance-system" class="navbar-brand">Student Attendance System</a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-nav-first">
                <li><a href="/student-attendance-system" class="smoothScroll">Home</a></li>
                <li><a href="" class="smoothScroll">About</a></li>
                <li><a href="" class="smoothScroll">Chef</a></li>
                <li><a href="" class="smoothScroll">Menu</a></li>
                <li><a href="" class="smoothScroll">Contact</a></li>
            </ul>

            <?php
                // NOTE: if currentUser is Type "Administrator", show "Admin" link:
                if(!empty($_SESSION["currentUser"])) {
                    if($_SESSION["currentUser"]->userType == "Administrator") {
                        echo "<ul class='nav navbar-nav navbar-right'>
                                <a href='/student-attendance-system/index.php/admin' class='section-btn'>Admin</a>
                              </ul>";
                    }
                }
            ?>

            <ul class="nav navbar-nav navbar-right">
                <?php
                    if(!empty($_SESSION["currentUser"])) {
                        echo "<a href='/student-attendance-system/index.php/login' class='section-btn'>Logout</a>";
                    }
                    else {
                        echo "<a href='/student-attendance-system/index.php/login' class='section-btn'>Login</a>";
                    }
                ?>
            </ul>
        </div>
    </div>
</section>