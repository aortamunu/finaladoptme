<nav>
    <div class="nav-site-title">
        <a href="./index.php" class="nav-site-title">
            <!-- <div class="logo"> -->
            <!-- <?php
                    include './public/avatar.svg'
                    ?> -->
            <!-- <img src="./paw.jpg" alt="" srcset="" width="80px">
            </div> -->
            <div class="nav-title">Adopt Me</div>
        </a>
        <div class="hamburger btn">
            =
        </div>
    </div>
    <div class="nav-links">
        <div class="nav-item">
            <a href="./list.php" class='nav-link'>
                <img src="home.png"><!-- Adopt -->
            </a>
        </div>

        <?php
        if (isAuthenticated() === true) :
        ?>
            <div class="nav-item">
                <a href="./new-help.php" class='nav-link'>
                    <img src="addpost.png"> <!-- Create Post -->
                </a>
            </div>

            <div class="nav-item">
                <div class="nav">
                    <div class="profile" onclick="menuToggle();">
                        <img src="dog.jpg">
                    </div>


                    <div class="menu">
                        <!-- <h3><?php echo "Hello " ?><?=$_SESSION["user"]["email"]?><?php echo " :)" ?></h3> -->
                        <h3><?=$_SESSION["user"]["email"]?></h3>
                        <ul>
                            <div class="log">
                                <li><img src="mypost.png"><a href="./my-helps.php">My posts</a></li>
                                <li><img src="adoptionrequest.png"><a href="./adoption-requests.php">All Requests</a></li>
                                <li><img src="pendingrequest.png"><a href="./pending-adoptions.php">Pending Adoptions</a></li>
                                <li><img src="care.png"><a href="./aboutus.php">ABOUT US</a></li>
                                <li><img src="changepw.png"><a href="password_change.php">Change Password</a></li>
                                <li><img src="logout.png"><a href="./logout.php">Logout</a></li>



                            </div>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
    <script>
        function menuToggle() {
            const toggleMenu = document.querySelector('.menu');
            toggleMenu.classList.toggle('active')
        }
    </script>

<?php else : ?>
    <!-- <div class="nav-item">
                <a href="./login.php" class='nav-link'>
                    Sign In
                </a>
            </div> -->

    <div class="nav-btn nav-item">
        <a class="btn btn-login" href="./register.php">
            Register
        </a>
    </div>
<?php endif ?>
</div>
</nav>