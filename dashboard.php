<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <!-- font-awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

</head>


<body>
    <div class="dashboard-section">
        <div class="left-sidebar">
            <div class="inside-items">
                <div class="top-left-heading">
                    <h1 class="logo-text"><span class="logo-first">L</span><span class="logo-rest">OGO</span></h1>
                </div>
                <ul class="dash-items">
                    <li><a href="dashboard.php" class="active">
                            <img src="./images/home.png" alt="">
                            <span class="left-icon-hide">dashboard</span></a>
                    </li>
                    <li class="has-dropdown">
                        <a href="#" class="employee-toggle">
                            <img src="./images/group.png" alt="">
                            <span class="left-icon-hide">Employee</span>
                            <i class="fa fa-caret-down dropdown-icon"></i>
                        </a>
                       <ul class="sub-menu">

                            <li><a href="employees_detail.php">
                                    <span class="left-icon-hide"> Employee Details</span>

                                </a></li>
                            <li><a href="Schedule_interview.php">
                                    <span class="left-icon-hide">
                                        Schedule Interview
                                    </span></a></li>
                        </ul>
                    </li>
                    <li class="logout-icon">
                        <a href="logout.php">
                            <img src="./images/out.png" alt="">
                            <span class="left-icon-hide">Logout</span></a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="right-sidebar">
            <div class="inner-right-items">
                <div class="menu-btn">
                    <span id="menu-btn"><i class="fa-solid fa-bars"></i></span>
                </div>
                <div class="search-bar">
                    <form>
                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" placeholder="Search" id="search" class="hidden-input">
                    </form>
                </div>
                <div class="clients">
                    <a href="addEmployee.php">
                        <!-- <img src="./images/add-user.png" alt=""> -->
                        <span>Add Schedule</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/select2.min.js"></script>
    <script src="./js/script.js" defer></script>
</body>

</html>