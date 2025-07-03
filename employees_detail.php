<?php
include 'database.php';
$users = [];
$sql = "SELECT id, name, mobile_number, official_email FROM employee_details ORDER BY id DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo "<p>No records found.</p>";
}

$conn->close();
?>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.6.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



</head>

<body>
    <div class="dashboard-section">
        <div class="left-sidebar">
            <div class="inside-items">
                <div class="top-left-heading">
                    <h1 class="logo-text"><span class="logo-first">L</span><span class="logo-rest">OGO</span></h1>
                </div>
                <ul class="dash-items">
                    <li><a href="dashboard.php">
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

                    <li><a href="create_role.php">
                            <img src="./images/home.png" alt="">
                            <span class="left-icon-hide">Create Role</span></a>
                    </li>
                    <li><a href="assign_rights.php">
                            <img src="./images/home.png" alt="">
                            <span class="left-icon-hide">Assign Rights</span></a>
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
            <div class="client-section">
                <div class="inner-client-sec">
                    <div class="tab-buttons">
                        <button class="active">All Employee</button>
                        <button>Releiving Employee</button>
                        <button>Current Employee</button>
                    </div>

                    <table class="client-table">
                        <thead>
                            <tr>
                                <th>Sr no</th>
                                <th>Name</th>
                                <th>Official Email</th>
                                <th>Contact no</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($users as $user) {
                                echo "<tr>";
                                echo "<td>" . sprintf('%02d', $i) . "</td>";
                                echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['official_email']) . "</td>";
                                echo "<td>" . htmlspecialchars($user['mobile_number']) . "</td>";
                                echo "<td>
        <a href='view-employee.php?id={$user['id']}' class='action-btn'>View</a>
        <a href='delete-employee.php?id={$user['id']}' class='action-btn delete-btn' data-id='{$user['id']}'>Delete</a>
        <a href='edit-employee.php?id={$user['id']}' class='action-btn'>Edit</a>
    </td>";
                                echo "</tr>";
                                $i++;
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const deleteUrl = this.getAttribute('href');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This employee will be permanently deleted.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = deleteUrl;
                        }
                    });
                });
            });
        });
    </script>
</body>
<?php
include('./includes/script.php');
?>

</html>