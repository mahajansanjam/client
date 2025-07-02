<?php
include 'database.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT id, name, mobile_number, official_email, personal_email, home_number, department, desgination, joning_year, total_expierence, salary, relieving_date, noc, experience_letter FROM employee_details WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        echo "<p>Employee not found.</p>";
        exit;
    }

    $documentQuery = "SELECT id, pan_number, adhar_number, upload_adhar, upload_pan FROM new_documnet_details_users WHERE employee_id = '$id'";
    $docResult = $conn->query($documentQuery);

    if ($docResult && $docResult->num_rows > 0) {
        $document = $docResult->fetch_assoc();
    } else {
        $document = [
            'pan_number' => '',
            'adhar_number' => '',
            'upload_adhar' => '',
            'upload_pan' => ''
        ];
    }
    $bankQuery = "SELECT id, bank_name, account_number, verfify_account_number, ifsc_code, addess_1, address2 FROM new_bank_details_users WHERE employee_id = '$id'";
    $bankResult = $conn->query($bankQuery);

    if ($bankResult && $bankResult->num_rows > 0) {
        $bank = $bankResult->fetch_assoc();
    } else {
        $bank = [
            'bank_name' => '',
            'account_number' => '',
            'verfify_account_number' => '',
            'ifsc_code' => '',
            'addess_1' => '',
            'address2' => ''
        ];
    }
} else {
    echo "<p>Invalid request.</p>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <style>
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: white;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            padding: 15px;
            border: 1px solid #dee2e6;
            text-align: left;
        }

        th {
            width: 30%;
            background-color: #f8f9fa;
        }

        .header-row {
            background-color: rgba(162, 111, 216, 1);
            color: white;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c5ce7;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px auto;
            text-align: center;
        }

        .btn-back:hover {
            background-color: #5a4fcf;
        }

        img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div class="dashboard-section">
        <div class="left-sidebar">
            <div class="inside-items">
                <div class="top-left-heading">
                    <h1 class="logo-text"><span class="logo-first">L</span><span class="logo-rest">OGO</span></h1>
                </div>
                <ul class="dash-items">
                    <li><a href="dashboard.php"><img src="./images/home.png" alt=""><span class="left-icon-hide">Dashboard</span></a></li>
                    <li class="has-dropdown">
                        <a href="#" class="employee-toggle"><img src="./images/group.png" alt=""><span class="left-icon-hide">Employee</span><i class="fa fa-caret-down dropdown-icon"></i></a>
                        <ul class="sub-menu">
                            <li><a href="employees_detail.php"><span class="left-icon-hide">Employee Details</span></a></li>
                            <li><a href="Schedule_interview.html"><span class="left-icon-hide">Schedule Interview</span></a></li>
                        </ul>
                    </li>
                    <li class="logout-icon">
                        <a href="#"><img src="./images/out.png" alt=""><span class="left-icon-hide">Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="right-sidebar">
            <div class="inner-right-items">
                <div class="menu-btn"><span id="menu-btn"><i class="fa-solid fa-bars"></i></span></div>
                <div class="search-bar">
                    <form>
                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" placeholder="Search" id="search" class="hidden-input">
                    </form>
                </div>
                <div class="clients"><a href="addEmployee.php"><span>Add Schedule</span></a></div>
            </div>

            <div class="client-section">
                <div class="inner-client-sec">
                    <table>
                        <tr class="header-row">
                            <td colspan="2">Employee Details</td>
                        </tr>
                        <?php
                        $fields = [
                            'Name' => $employee['name'],
                            'Official Email' => $employee['official_email'],
                            'Personal Email' => $employee['personal_email'],
                            'Mobile Number' => $employee['mobile_number'],
                            'Home Number' => $employee['home_number'],
                            'Department' => $employee['department'],
                            'Designation' => $employee['desgination'],
                            'Joining Year' => $employee['joning_year'],
                            'Salary' => $employee['salary'],
                            'Relieving Date' => $employee['relieving_date']
                        ];

                        foreach ($fields as $label => $value) {
                            echo "<tr><th>{$label}</th><td>" . htmlspecialchars($value) . "</td></tr>";
                        }
                        ?>

                        <tr>
                            <th>NOC</th>
                            <td>
                                <?php if (!empty($employee['noc'])) : ?>
                                    <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $employee['noc'])) : ?>
                                        <img src="api/uploads/<?= htmlspecialchars($employee['noc']) ?>" alt="NOC">
                                    <?php elseif (preg_match('/\.(pdf)$/i', $employee['noc'])) : ?>
                                        <a href="api/uploads/<?= htmlspecialchars($employee['noc']) ?>" target="_blank">View NOC PDF</a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    No file uploaded.
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Experience Letter</th>
                            <td>
                                <?php if (!empty($employee['experience_letter'])) : ?>
                                    <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $employee['experience_letter'])) : ?>
                                        <img src="api/uploads/<?= htmlspecialchars($employee['experience_letter']) ?>" alt="Experience Letter">
                                    <?php elseif (preg_match('/\.(pdf)$/i', $employee['experience_letter'])) : ?>
                                        <a href="api/uploads/<?= htmlspecialchars($employee['experience_letter']) ?>" target="_blank">View Experience Letter PDF</a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    No file uploaded.
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr class="header-row">
                            <td colspan="2">Document Details</td>
                        </tr>
                        <tr>
                            <th>Pan Number</th>
                            <td><?= htmlspecialchars($document['pan_number']) ?></td>
                        </tr>
                        <tr>
                            <th>Aadhar Number</th>
                            <td><?= htmlspecialchars($document['adhar_number']) ?></td>
                        </tr>
                        <tr>
                            <th>Upload Aadhaar</th>
                            <td>
                                <?php if (!empty($document['upload_adhar'])) : ?>
                                    <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $document['upload_adhar'])) : ?>
                                        <img src="api/uploads/<?= htmlspecialchars($document['upload_adhar']) ?>" alt="Aadhaar">
                                    <?php elseif (preg_match('/\.(pdf)$/i', $document['upload_adhar'])) : ?>
                                        <a href="api/uploads/<?= htmlspecialchars($document['upload_adhar']) ?>" target="_blank">View Aadhaar PDF</a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    No file uploaded.
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Upload PAN</th>
                            <td>
                                <?php if (!empty($document['upload_pan'])) : ?>
                                    <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $document['upload_pan'])) : ?>
                                        <img src="api/uploads/<?= htmlspecialchars($document['upload_pan']) ?>" alt="PAN">
                                    <?php elseif (preg_match('/\.(pdf)$/i', $document['upload_pan'])) : ?>
                                        <a href="api/uploads/<?= htmlspecialchars($document['upload_pan']) ?>" target="_blank">View PAN PDF</a>
                                    <?php endif; ?>
                                <?php else : ?>
                                    No file uploaded.
                                <?php endif; ?>
                            </td>
                        </tr>

                        <tr class="header-row">
                            <td colspan="2">Bank Details</td>
                        </tr>
                        <?php
                        $bankFields = [
                            'Bank Name' => $bank['bank_name'],
                            'Account Number' => $bank['account_number'],
                            'Verify Account Number' => $bank['verfify_account_number'],
                            'IFSC Code' => $bank['ifsc_code'],
                            'Address 1' => $bank['addess_1'],
                            'Address 2' => $bank['address2']
                        ];

                        foreach ($bankFields as $label => $value) {
                            echo "<tr><th>{$label}</th><td>" . htmlspecialchars($value) . "</td></tr>";
                        }
                        ?>

                        <tr>
                            <td colspan="2" style="text-align: center;">
                                <a href="employees_detail.php" class="btn-back">Back to Employee List</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

   
</body>
<?php
    include('./includes/script.php');
    ?>
</html>
