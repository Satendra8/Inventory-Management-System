<?php session_start(); ?>
<!-----  sidebar started------>
<div class="sidebar">
            <div class="sidebar-menu">
                <li class="item">
                    <a href="index.php" class="menu-btn">
                        <i class="fas fa-desktop"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="item" id="profile">
                    <a href="#profile" class="menu-btn">
                        <i class="fas fa-user-circle"></i><span>Profile<i
                                class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="edit_profile.php"><i class="far fa-edit"></i><span>Edit</span></a>
                        <a href="user_info.php"><i class="fas fa-address-card"></i><span>Info</span></a>

                    </div>
                </li>
                <?php if(isset($_SESSION['user_type'])) { 
                    if($_SESSION['user_type']== 'admin') {?>
                <li class="item" id="user">
                    <a href="#user" class="menu-btn">
                        <i class="fas fa-user-edit"></i><span>User Action<i
                                class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="register.php"><i class="far fa-edit"></i><span>Create User</span></a>
                        <a href="edit_user.php"><i class="fas fa-address-card"></i><span>View User</span></a>

                    </div>
                </li>
                <?php } } ?>
                <li class="item" id="messages">
                    <a href="order.php" class="menu-btn">
                        <i class="far fa-clipboard"></i><span>Order</span>
                    </a>
                </li>
                <li class="item" id="settings">
                    <a href="#settings" class="menu-btn">
                        <i class="fas fa-cog"></i><span>Settings<i class="fas fa-chevron-down drop-down"></i></span>
                    </a>
                    <div class="sub-menu">
                        <a href="recover.php"><i class="fas fa-lock"></i><span>Password</span></a>
                        <a href="#"><i class="fas fa-language"></i><span>Language</span></a>

                    </div>
                </li>
                <li class="item">
                    <a href="about_us.php" class="menu-btn">
                        <i class="fas fa-info-circle"></i><span>About</span>
                    </a>
                </li>
            </div>
        </div>

        <!-----  sidebar end------>