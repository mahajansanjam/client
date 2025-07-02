<?php
include 'databaase.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['employee_id'];
        $name = $_POST['name'];
        $mobile_number = $_POST['number'];
        $official_email = $_POST['email'];
        $personal_email = $_POST['personalemail'];
        $home_number = $_POST['homenumber'];
        $employee_id_display = $_POST['employee_id'];
        $department = $_POST['department'];
        $desgination = $_POST['designation'];
        $joning_year = $_POST['joining'];
        $total_expierence = $_POST['experience'];
        $salary = $_POST['salary'];
        $relieving_date = $_POST['relieving_date'];

        $pannumber = $_POST['pannumber'];

        $adhaarnumber = $_POST['adhaarnumber'];

        $bankname = $_POST['bankname'];
        $accountnumber = $_POST['acountnumber'];
        $verifyaccountnumber = $_POST['verifyaccountnumber'];
        $ifsccode = $_POST['ifsccode'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];

        $noc = $_FILES['nocupload']['name'];
        $experience_letter = $_FILES['experienceupload']['name'];

        $targetDir = "uploads/";
        $noc_path = '';
        $experience_path = '';

        if (!empty($noc)) {
            $noc_path = $targetDir . basename($noc);
            move_uploaded_file($_FILES['nocupload']['tmp_name'], $noc_path);
        }

        if (!empty($experience_letter)) {
            $experience_path = $targetDir . basename($experience_letter);
            move_uploaded_file($_FILES['experienceupload']['tmp_name'], $experience_path);
        }

        $updateEmployee = "UPDATE employee_details SET 
            name = '$name',
            mobile_number = '$mobile_number',
            official_email = '$official_email',
            personal_email = '$personal_email',
            home_number = '$home_number',
            employee_id = '$employee_id_display',
            department = '$department',
            desgination = '$desgination',
            joning_year = '$joning_year',
            total_expierence = '$total_expierence',
            salary = '$salary',
            relieving_date = '$relieving_date'";

        if (!empty($noc)) {
            $updateEmployee .= ", noc = '$noc_path'";
        }

        if (!empty($experience_letter)) {
            $updateEmployee .= ", experience_letter = '$experience_path'";
        }

        $updateEmployee .= " WHERE id = '$id'";

        $updateDocuments = "UPDATE mew_document_deatils SET 
            pan_number = '$pannumber', 
            adhar_number = '$adhaarnumber' 
            WHERE employee_id = '$id'";

        $updateBank = "UPDATE new_bank_details_users SET 
            bank_name = '$bankname',
            account_number = '$accountnumber',
            verfify_account_number = '$verifyaccountnumber',
            ifsc_code = '$ifsccode',
            addess_1 = '$address1',
            address2 = '$address2' 
            WHERE employee_id = '$id'";

        if ($conn->query($updateEmployee) === TRUE && $conn->query($updateDocuments) === TRUE && $conn->query($updateBank) === TRUE) {
            header("Location: employees_detail.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM employee_details WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $employee = $result->fetch_assoc();

        $docSql = "SELECT * FROM mew_document_deatils WHERE employee_id = '$id'";
        $docResult = $conn->query($docSql);
        if ($docResult && $docResult->num_rows > 0) {
            $document = $docResult->fetch_assoc();
        } else {
            $document = ['pannumber' => '', 'adhaarnumber' => ''];
        }

        $bankSql = "SELECT * FROM new_bank_details_users WHERE employee_id = '$id'";
        $bankResult = $conn->query($bankSql);
        if ($bankResult && $bankResult->num_rows > 0) {
            $bank = $bankResult->fetch_assoc();
        } else {
            $bank = ['bankname' => '', 'accountnumber' => '', 'verifyaccountnumber' => '', 'ifsccode' => '', 'address1' => '', 'address2' => ''];
        }
    } else {
        echo "Employee not found.";
        exit;
    }
} else {
    echo "No employee ID provided.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="./css/select2.min.css">
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
        <!-- Left Sidebar -->
        <div class="left-sidebar">
            <div class="inside-items">
                <div class="top-left-heading">
                    <h1 class="logo-text"><span class="logo-first">L</span><span class="logo-rest">OGO</span></h1>
                </div>
                <ul class="dash-items">
                    <li><a href="dashboard.php">
                            <img src="./images/home.png" alt="">
                            <span class="left-icon-hide">Dashboard</span></a>
                    </li>
                    <li class="has-dropdown">
                        <a href="#" class="employee-toggle">
                            <img src="./images/group.png" alt="">
                            <span class="left-icon-hide">Employee</span>
                            <i class="fa fa-caret-down dropdown-icon"></i>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="employees_detail.php">
                                    <span class="left-icon-hide">Employee Details</span>
                                </a></li>
                            <li><a href="Schedule_interview.html">
                                    <span class="left-icon-hide">Schedule Interview</span></a></li>
                        </ul>
                    </li>
                    <li class="logout-icon">
                        <a href="#">
                            <img src="./images/out.png" alt="">
                            <span class="left-icon-hide">Logout</span></a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>

        <!-- Right Sidebar -->
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
            </div>

            <!-- Employee Form Section -->
            <div class="employee-main-sec btn-style">
                <form class="forms" action="" method="POST" id="formId" enctype="multipart/form-data">

                    <!-- Employee Details -->
                    <div class="employee-section">
                        <div class="inner-employee-sec">
                            <h2 class="form-section-title">Edit Employee Details</h2>
                            <input type="hidden" name="employee_id" value="<?= htmlspecialchars($employee['id'] ?? '') ?>">

                            <div class="input-fields-group">

                                <!-- Name -->
                                <div class="input-fields">
                                    <label for="name">Name</label>
                                    <div class="input-icon">
                                        <i class="fas fa-user"></i>
                                        <input type="text" name="name" id="name" value="<?= htmlspecialchars($employee['name'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Official Email -->
                                <div class="input-fields">
                                    <label for="email">Official Email</label>
                                    <div class="input-icon">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($employee['official_email'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Personal Email -->
                                <div class="input-fields">
                                    <label for="personalemail">Personal Email</label>
                                    <div class="input-icon">
                                        <i class="fas fa-envelope-open"></i>
                                        <input type="email" id="personalemail" name="personalemail" value="<?= htmlspecialchars($employee['personal_email'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Mobile Number -->
                                <div class="input-fields">
                                    <label for="mobile">Mobile Number</label>
                                    <div class="input-icon">
                                        <i class="fas fa-phone"></i>
                                        <input type="text" id="mobile" name="number" value="<?= htmlspecialchars($employee['mobile_number'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Home Number -->
                                <div class="input-fields">
                                    <label for="homenumber">Home Number</label>
                                    <div class="input-icon">
                                        <i class="fas fa-phone"></i>
                                        <input type="text" id="homenumber" name="homenumber" value="<?= htmlspecialchars($employee['home_number'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Employee ID -->
                                <div class="input-fields">
                                    <label for="employee_id_display">Employee ID</label>
                                    <div class="input-icon">
                                        <i class="fas fa-id-badge"></i>
                                        <input type="text" id="employee_id_display" name="employee_id_display" value="<?= htmlspecialchars($employee['employee_id'] ?? '') ?>" readonly>
                                    </div>
                                </div>

                                <!-- Department -->
                                <div class="input-fields" id="select-field">
                                    <label for="department">Department</label>
                                    <select class="department" name="department" id="department" required>
                                        <option value="">Select Department</option>
                                        <option value="Human Resources" <?= ($employee['department'] ?? '') == 'Human Resources' ? 'selected' : '' ?>>Human Resources</option>
                                        <option value="Development" <?= ($employee['department'] ?? '') == 'Development' ? 'selected' : '' ?>>Development</option>
                                        <option value="Marketing" <?= ($employee['department'] ?? '') == 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                                        <option value="Finance" <?= ($employee['department'] ?? '') == 'Finance' ? 'selected' : '' ?>>Finance</option>
                                        <option value="Support" <?= ($employee['department'] ?? '') == 'Support' ? 'selected' : '' ?>>Support</option>
                                    </select>
                                </div>

                                <!-- Designation -->
                                <div class="input-fields" id="select-field">
                                    <label for="designation">Designation</label>
                                    <select class="designation" name="designation" id="designation" required>
                                        <option value="">Select Designation</option>
                                        <option value="Intern" <?= ($employee['desgination'] ?? '') == 'Intern' ? 'selected' : '' ?>>Intern</option>
                                        <option value="Software Engineer" <?= ($employee['desgination'] ?? '') == 'Software Engineer' ? 'selected' : '' ?>>Software Engineer</option>
                                        <option value="Team Lead" <?= ($employee['desgination'] ?? '') == 'Team Lead' ? 'selected' : '' ?>>Team Lead</option>
                                        <option value="Manager" <?= ($employee['desgination'] ?? '') == 'Manager' ? 'selected' : '' ?>>Manager</option>
                                    </select>
                                </div>

                                <!-- Joining Year -->
                                <div class="input-fields" id="select-field">
                                    <label for="joining">Joining Year</label>
                                    <select class="joining" name="joining" id="joining" required>
                                        <option value="">Select Joining Year</option>
                                        <?php for ($year = 2000; $year <= 2025; $year++): ?>
                                            <option value="<?= $year ?>" <?= ($employee['joning_year'] ?? '') == $year ? 'selected' : '' ?>><?= $year ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <!-- Total Experience -->
                                <div class="input-fields" id="select-field">
                                    <label for="experience">Total Experience</label>
                                    <select class="experience" name="experience" id="experience" required>
                                        <option value="">Select Experience</option>
                                        <?php for ($exp = 1; $exp <= 20; $exp++): ?>
                                            <option value="<?= $exp ?>" <?= ($employee['total_expierence'] ?? '') == $exp ? 'selected' : '' ?>><?= $exp ?> Years</option>
                                        <?php endfor; ?>
                                        <option value="20+" <?= ($employee['total_expierence'] ?? '') == '20+' ? 'selected' : '' ?>>20+ Years</option>
                                    </select>
                                </div>

                                <!-- Salary -->
                                <div class="input-fields">
                                    <label for="salary">Salary</label>
                                    <div class="input-icon">
                                        <i class="fas fa-money-bill"></i>
                                        <input type="text" name="salary" id="salary" value="<?= htmlspecialchars($employee['salary'] ?? '') ?>" required>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="employee-section employee-section-part">
                        <div class="inner-employee-sec">
                            <h2 class="form-section-title">Documents</h2>
                            <div class="input-fields-group">

                                <!-- PAN Number -->
                                <div class="input-fields">
                                    <label for="pannumber_document">PAN Number</label>
                                    <div class="input-icon">
                                        <i class="fas fa-id-card"></i>
                                        <input type="text" name="pannumber" id="pannumber" value="<?= htmlspecialchars($document['pan_number'] ?? '') ?>" placeholder="Your Pan number"required>
                                    </div>
                                </div>

                                <!-- Aadhaar Number -->
                                <div class="input-fields">
                                    <label for="adhaarnumber_document">Aadhaar Number</label>
                                    <div class="input-icon">
                                        <i class="fas fa-id-card-clip"></i>
                                        <input type="text" name="adhaarnumber" id="adhaarnumber" value="<?= htmlspecialchars($document['adhar_number'] ?? '') ?>" placeholder="Your Aadhaar number" required>
                                    </div>
                                </div>

                                <!-- Aadhaar Upload -->
                                <div class="input-fields file-field">
                                    <label for="pic-upload">Upload Aadhaar</label>
                                    <input type="file" id="pic-upload" name="upload">
                                    <label for="pic-upload" class="file-btn"><i class="fas fa-image"></i> Upload Aadhaar</label>
                                    <?php if (!empty($document['upload_adhar'])): ?>
                                        <p>Current Aadhaar: <?= htmlspecialchars($document['upload_adhar']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- PAN Upload -->
                                <div class="input-fields file-field">
                                    <label for="docs-upload">Upload PAN</label>
                                    <input type="file" id="docs-upload" multiple name="uploadpan">
                                    <label for="docs-upload" class="file-btn"><i class="fas fa-upload"></i> Upload PAN</label>
                                    <?php if (!empty($document['upload_pan'])): ?>
                                        <p>Current PAN: <?= htmlspecialchars($document['upload_pan']) ?></p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Bank Details -->
                    <div class="employee-section employee-section-part">
                        <div class="inner-employee-sec">
                            <h2 class="form-section-title">Bank Details</h2>
                            <div class="input-fields-group">

                                <!-- Bank Name -->
                                <div class="input-fields">
                                    <label for="bankname">Bank Name</label>
                                    <div class="input-icon">
                                        <i class="fas fa-university"></i>
                                        <input type="text" name="bankname" id="bankname" value="<?= htmlspecialchars($bank['bank_name'] ?? '') ?>" placeholder="Your bank name" required>
                                    </div>
                                </div>

                                <!-- Account Number -->
                                <div class="input-fields">
                                    <label for="acountnumber">Account Number</label>
                                    <div class="input-icon">
                                        <i class="fas fa-wallet"></i>
                                        <input type="text" id="acountnumber" name="acountnumber" value="<?= htmlspecialchars($bank['account_number'] ?? '') ?>" placeholder="Your account number" required>
                                    </div>
                                </div>

                                <!-- Verify Account Number -->
                                <div class="input-fields">
                                    <label for="verifyaccountnumber">Verify Account Number</label>
                                    <div class="input-icon">
                                        <i class="fas fa-wallet"></i>
                                        <input type="text" name="verifyaccountnumber" id="verifyaccountnumber" value="<?= htmlspecialchars($bank['verfify_account_number'] ?? '') ?>" placeholder="Verify your account number" required>
                                    </div>
                                </div>

                                <!-- IFSC Code -->
                                <div class="input-fields">
                                    <label for="ifsccode">IFSC Code</label>
                                    <div class="input-icon">
                                        <i class="fas fa-code"></i>
                                        <input type="text" id="ifsccode" name="ifsccode" value="<?= htmlspecialchars($bank['ifsc_code'] ?? '') ?>" placeholder="Your IFSC code" required>
                                    </div>
                                </div>

                                <!-- Address 1 -->
                                <div class="input-fields">
                                    <label for="add">Address 1</label>
                                    <div class="input-icon address-input">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" name="address1" id="add" value="<?= htmlspecialchars($bank['addess_1'] ?? '') ?>" placeholder="Your address 1" required>
                                    </div>
                                </div>

                                <!-- Address 2 -->
                                <div class="input-fields">
                                    <label for="address2">Address 2</label>
                                    <div class="input-icon address-input">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input type="text" name="address2" id="address2" value="<?= htmlspecialchars($bank['address2'] ?? '') ?>" placeholder="Your address 2" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Final Uploads -->
                    <div class="employee-section employee-section-part">
                        <div class="inner-employee-sec">
                            <h2 class="form-section-title">Final Uploads</h2>
                            <div class="input-fields-group">

                                <!-- Relieving Date -->
                                <div class="input-fields">
                                    <label for="date">Relieving Date</label>
                                    <div class="input-icon custom-date-wrapper">
                                        <i class="fas fa-calendar-plus"></i>
                                        <input type="date" id="date" name="relieving_date" value="<?= htmlspecialchars($employee['relieving_date'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- NOC Upload -->
                                <div class="input-fields file-field">
                                    <label for="noc-upload">NOC / Withdrawal Letter</label>
                                    <input type="file" id="noc-upload" name="nocupload">
                                    <label for="noc-upload" class="file-btn"><i class="fas fa-file-contract"></i> Upload NOC</label>
                                    <?php if (!empty($employee['noc'])): ?>
                                        <p>Current File: <?= htmlspecialchars($employee['noc']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Experience Letter Upload -->
                                <div class="input-fields file-field">
                                    <label for="exp-upload">Experience Letter</label>
                                    <input type="file" id="exp-upload" name="experienceupload">
                                    <label for="exp-upload" class="file-btn"><i class="fas fa-file-alt"></i> Upload Experience</label>
                                    <?php if (!empty($employee['experience_letter'])): ?>
                                        <p>Current File: <?= htmlspecialchars($employee['experience_letter']) ?></p>
                                    <?php endif; ?>
                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="form-buttons">
                                <button type="submit" class="action-btn">Update</button>
                                <a href="employees_detail.php" class="action-btn">Back to Employee List</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <!-- Scripts -->
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/select2.min.js"></script>
    <script src="./js/script.js" defer></script>
</body>


</html>