<?php
include 'database.php';
$name_error = $email_Err = $personal_email_error = $mobile_number_error = $home_number_error = $employee_id_error = $select_departmentemployee_error = "";

$select_desginations_error = $select_join_year_error = $select_exsperience_error = $salary_error = "";

$pan_number_error = $adhar_number_error = $upload_adhar_card_error = $upload_pan_error = $bank_name_error = "";

$account_number_error = $verify_account_number_error = $ifsc_code_error = $address_1_error = $address_2_error = "";

$releving_date_error = $noc_upload_error = $experience_upload_error = "";

$errors = [];
$name = $email = $personal_email = $mobile_number = $home_number = $employee_id = $select_devolpmentemployee = "";
$select_desginations = $select_join_year = $select_exsperience = $salary = $select_departmentemployee = "";
$pan_number = $adhar_number = $upload_adhar_card = $upload_pan = $bank_name = "";

$account_number = $verify_account_number = $ifsc_code = $address_1 = $address_2 = "";
$releving_date = $noc_upload = $experience_upload = "";
$isvalid = true;
if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $name = isset($_POST['name']) ? trim($_POST['name']) : null;
  $email = isset($_POST['email']) ? trim($_POST['email']) : null;
  $personal_email = isset($_POST['personalemail']) ? trim($_POST['personalemail']) : null;
  $mobile_number = isset($_POST['number']) ? trim($_POST['number']) : null;
  $home_number = isset($_POST['homenumber']) ? trim($_POST['homenumber']) : null;
  $employee_id = isset($_POST['employee_id']) ? trim($_POST['employee_id']) : null;
  $select_departmentemployee = isset($_POST['department']) ? trim($_POST['department']) : null;
  $select_desginations = empty($_POST['designation']) ? trim($_POST['designation']) : null;

  $select_join_year = empty($_POST['joining']) ? trim(string: $_POST['joining']) : "2020";

  $select_exsperience = !empty($_POST['experience']) ? trim($_POST['experience']) : null;
  $salary = isset($_POST['salary']) ? trim($_POST['salary']) : null;
  $pan_number = isset($_POST['pannumber']) ? trim($_POST['pannumber']) : null;
  $adhar_number = isset($_POST['adhaarnumber']) ? trim($_POST['adhaarnumber']) : null;

  $bank_name = isset($_POST['bankname']) ? trim($_POST['bankname']) : null;
  $account_number = isset($_POST['acountnumber']) ? trim($_POST['acountnumber']) : null;
  $verify_account_number = isset($_POST['verifyaccountnumber']) ? trim($_POST['verifyaccountnumber']) : null;
  $ifsc_code = isset($_POST['ifsccode']) ? trim($_POST['ifsccode']) : null;
  $address_1 = isset($_POST['address1']) ? trim($_POST['address1']) : null;
  $address_2 = isset($_POST['address2']) ? trim($_POST['address2']) : null;
  $releving_date = isset($_POST['relevingdata']) ? trim($_POST['relevingdata']) : null;

  $upload_adhar_card = isset($_FILES['upload']['name']) ? trim($_FILES['upload']['name']) : null;
  $upload_pan = isset($_FILES["uploadpan"]['name']) ? trim($_FILES["uploadpan"]['name']) : null;
  $noc_upload = isset($_FILES['nocupload']['name']) ? trim($_FILES['nocupload']['name']) : null;
  $experience_upload = isset($_FILES['experienceupload']['name']) ? trim($_FILES['experienceupload']['name']) : null;

  $targetDir = "uploads/";

  if (!empty($_FILES['uploadpan']['name'])) {
    $upload_pan = time() . '_' . basename($_FILES['uploadpan']['name']);
    move_uploaded_file($_FILES['uploadpan']['tmp_name'], $targetDir . $upload_pan);
  }

  if (!empty($_FILES['nocupload']['name'])) {
    $noc_upload = time() . '_' . basename($_FILES['nocupload']['name']);
    move_uploaded_file($_FILES['nocupload']['tmp_name'], $targetDir . $noc_upload);
  }

  if (!empty($_FILES['experienceupload']['name'])) {
    $experience_upload = time() . '_' . basename($_FILES['experienceupload']['name']);
    move_uploaded_file($_FILES['experienceupload']['tmp_name'], $targetDir . $experience_upload);
  }

  if (!empty($_FILES['upload']['name'])) {
    $upload_adhar_card = time() . '_' . basename($_FILES['upload']['name']);
    move_uploaded_file($_FILES['upload']['tmp_name'], $targetDir . $upload_adhar_card);
  }
  if ($errors) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
  }
  echo json_encode(['success' => true]);
  exit;
  if (empty($name)) {
    $name_error = "Name is required";
    $isvalid = false;
  }
  if (empty($email)) {
    $email_Err = "Email is required";
    $isvalid = false;
  }
  if (empty($personal_email)) {
    $personal_email_error = "Personal email is required";
    $isvalid = false;
  }
  if (empty($mobile_number)) {
    $mobile_number_error = "Mobile number is required";
    $isvalid = false;
  }

  if (empty($home_number)) {
    $home_number_error = "Home number is required";
    $isvalid = false;
  }
  if (empty($employee_id)) {
    $employee_id_error = "Empoyee id is required";
    $isvalid = false;
  }
  if (empty($select_departmentemployee)) {
    $select_departmentemployee_error = "Department employee is required";
    $isvalid = false;
  }

  if (empty($select_desginations)) {
    $select_desginations_error = "Desginations is required";
    $isvalid = false;
  }

  if (empty($select_join_year)) {
    $select_join_year_error = "Select year is required";
    $isvalid = false;
  }
  if (empty($select_exsperience)) {
    $select_exsperience_error = "Experience is required";
    $isvalid = false;
  }

  if (empty($salary)) {
    $salary_error = "Salary is required";
    $isvalid = false;
  }
  if (empty($pan_number)) {
    $pan_number_error = "Pan number is required";
    $isvalid = false;
  }

  if (empty($adhar_number)) {
    $adhar_number_error = "Adhar number is required";
    $isvalid = false;
  }

  if (empty($upload_adhar_card)) {
    $upload_adhar_card_error = "Upload adhar card is required";
    $isvalid = false;
  }

  if (empty($upload_pan)) {
    $upload_pan_error = "Upload  pan is required";
    $isvalid = false;
  }
  if (empty($bank_name)) {
    $bank_name_error = "Bank  name is required";
    $isvalid = false;
  }

  if (empty($account_number)) {
    $account_number_error = "Account number is required";
    $isvalid = false;
  }

  if (empty($verify_account_number)) {
    $verify_account_number_error = "Verify account number is required";
    $isvalid = false;
  }
  if (empty($ifsc_code)) {
    $ifsc_code_error = "Ifsc code is required";
    $isvalid = false;
  }
  if (empty($address_1)) {
    $address_1_error = "Address 1 is required";
    $isvalid = false;
  }
  if (empty($address_2)) {
    $address_2_error = "Address 2 is required";
    $isvalid = false;
  }
  if (empty($releving_date)) {
    $releving_date_error = "Relieving date is required";
    $isvalid = false;
  }
  if (empty($noc_upload)) {
    $noc_upload_error = "Noc upload is required";
    $isvalid = false;
  }
  if (empty($experience_upload)) {
    $experience_upload_error = "Experience upload is required";
    $isvalid = false;
  }
  if ($isvalid) {

    $sql = "INSERT INTO employee_details (
                name, official_email, personal_email, mobile_number, home_number, employee_id, department, desgination, joning_year, total_expierence, salary, relieving_date, noc, experience_letter
            ) VALUES (
                '$name', ' $email', '$personal_email', '$mobile_number', '$home_number', '$employee_id', '$select_departmentemployee', '$select_desginations', '$select_join_year', '$select_exsperience', '$salary', '$releving_date', '$noc_upload', '$experience_upload'
            )";

    if ($conn->query($sql) === TRUE) {
      $last_id = $conn->insert_id;
      echo "New record created successfully. Last inserted ID is: " . $last_id . "<br>";


      $bankSql = "INSERT INTO new_document_users (
                        pan_number, adhar_number, upload_adhar, upload_pan, employee_id
                    ) VALUES (
                        '$pan_number', '$adhar_number', '$upload_adhar_card','$upload_pan', '$last_id'
                    )";

      if ($conn->query($bankSql) === TRUE) {
        echo "Document details inserted successfully.<br>";
      } else {
        echo "Error in document details: " . $bankSql . "<br>" . $conn->error;
      }

      $docSql = "INSERT INTO new_bank_details_users (
                        bank_name, account_number, verfify_adhar_number, ifsc_code, addess_1, address2, employee_id
                    ) VALUES (
                        '$bank_name', '$account_number', '$verify_account_number', '$ifsc_code', '$address_1', '$address_2', '$last_id'
                    )";

      if ($conn->query($docSql) === TRUE) {
        echo "Bank details inserted successfully.<br>";
      } else {
        echo "Error in bank details: " . $docSql . "<br>" . $conn->error;
      }
    } else {
      echo "Error in employment details: " . $sql . "<br>" . $conn->error;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Dashboard</title>
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
          <a href="addEmployee.php" class="employee-link">
            <!-- <img src="./images/add-user.png" alt=""> -->
            <span>Add Schedule</span>
          </a>
        </div>
      </div>

      <!-- Add employee section -->
      <div class="employee-main-sec btn-style">
        <!--  Employment Details -->
        <form class="forms" action="./Api/Api.php" method="POST" id="formId" enctype="multipart/form-data">
          <div class="employee-section">
            <div class="inner-employee-sec">

              <h2 class="form-section-title">Employee Details</h2>

              <div class="input-fields-group">
                <div class="input-fields">
                  <label>Name</label>
                  <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" id="name" placeholder="Your full name">
                  </div>
                  <span class="text-danger" id="error_name"><?= $name_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Official Email</label>
                  <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Your email address" />
                  </div>
                  <span class="text-danger" id="error_email"><?= $email_Err; ?></span>
                </div>
                <div class="input-fields">
                  <label>Personal Email</label>
                  <div class="input-icon">
                    <i class="fas fa-envelope-open"></i>
                    <input type="email" id="personalemail" name="personalemail" placeholder="Your personal email" />

                  </div>
                  <span class="text-danger" id="error_personalemail"><?= $personal_email_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Mobile Number</label>
                  <div class="input-icon">
                    <i class="fas fa-phone"></i>
                    <input type="text" id="mobile" name="number" placeholder="Your mobile number" />
                  </div>
                  <span class="text-danger" id="errror_mobile_number"><?= $mobile_number_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Home Number</label>
                  <div class="input-icon">

                    <i class="fas fa-phone"></i>
                    <input type="text" id="homenumber" name="homenumber" placeholder="Your home number" />
                  </div>
                  <span class="text-danger" id="errror_home_number"><?= $home_number_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Employee ID</label>
                  <div class="input-icon">
                    <i class="fas fa-id-badge"></i>
                    <input type="text" id="employee_id" name="employee_id" placeholder="Enter your employee_id" />
                  </div>
                  <span class="text-danger" id="error_employee_id"><?= $employee_id_error; ?></span>
                </div>

                <div class="input-fields" id="select-field">
                  <label for="department">Department</label>
                  <select class="department" name="department" id="department">
                    <option value="">Select Department</option>
                    <option value="Human Resources">Human
                      Resources</option>
                    <option value="Development">
                      Development</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Finance">Finance</option>
                    <option value="Support">Support</option>
                  </select>
                  <span class="text-danger" id="error_select_department"><?= $select_departmentemployee_error; ?></span>
                </div>

                <div class="input-fields" id="select-field">
                  <label for="designation">Designation</label>
                  <select class="designation" name="designation" id="designation">
                    <option value="">Select Designation</option>
                    <option value="Intern">Intern</option>
                    <option value="Software Engineer">
                      Software Engineer</option>
                    <option value="Team Lead">Team Lead</option>
                    <option value="Manager">Manager</option>
                  </select>
                  <span class="text-danger" id="error_select_desginations"><?= $select_desginations_error; ?></span>
                </div>

                <div class="input-fields" id="select-field">
                  <label for="joining">Joining Year</label>
                  <select class="joining" name="joining" id="joining">
                    <option value="">Select Joining Year</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                  </select>
                  <span class="text-danger" id="error_select_year"><?= $select_join_year_error; ?></span>
                </div>

                <div class="input-fields" id="select-field">
                  <label for="experience">Total Experience</label>
                  <select class="experience" name="experience" id="experience">
                    <option value="">Select Experience</option>
                    <option value="1">1 Year</option>
                    <option value="2">2 Years</option>
                    <option value="3">3 Years</option>
                    <option value="4">4 Years</option>
                    <option value="5">5 Years</option>
                    <option value="6">6 Years</option>
                    <option value="7">7 Years</option>
                    <option value="8">8 Years</option>
                    <option value="9">9 Years</option>
                    <option value="10">10 Years</option>
                    <option value="11">11 Years</option>
                    <option value="12">12 Years</option>
                    <option value="13">13 Years</option>
                    <option value="14">14 Years</option>
                    <option value="15">15 Years</option>
                    <option value="16">16 Years</option>
                    <option value="17">17 Years</option>
                    <option value="18">18 Years</option>
                    <option value="19">19 Years</option>
                    <option value="20">20 Years</option>
                    <option value="20+">20+ Years</option>
                  </select>
                  <span class="text-danger" id="error_select_exprenece"><?= $select_exsperience_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Salary</label>
                  <div class="input-icon">
                    <i class="fas fa-money-bill"></i>
                    <input type="text" name="salary" id="salary" placeholder="Select salary" />
                  </div>
                  <span class="text-danger" id="error_salary"><?= $salary_error; ?></span>
                </div>
              </div>
            </div>
          </div>

          <!--  Documents -->
          <div class="employee-section employee-section-part">
            <div class="inner-employee-sec">

              <h2 class="form-section-title">Documents</h2>
              <div class="input-fields-group">
                <div class="input-fields">
                  <label>PAN Number</label>
                  <div class="input-icon">
                    <i class="fas fa-id-card"></i>
                    <input type="text" id="pannumber" name="pannumber" placeholder="Your pan number" />

                  </div>
                  <span class="text-danger" id="error_pan_number"><?= $pan_number_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Aadhaar Number</label>
                  <div class="input-icon">
                    <i class="fas fa-id-card-clip"></i>
                    <input type="text" name="adhaarnumber" id="adharnumber" placeholder="Your adhar number" />
                  </div>
                  <span class="text-danger" id="error_adhar_number"><?= $adhar_number_error; ?></span>
                </div>
                <div class="input-fields file-field">
                  <label>Upload Aadhaar</label>
                  <input type="file" id="pic-upload" name="upload" placeholder="Upload Aadhaar" />

                  <label for="pic-upload" class="file-btn">
                    <i class="fas fa-image"></i> Upload
                    Aadhaar</label>
                  <span class="text-danger" id="error_upload_adharcard"><?= $upload_adhar_card_error; ?></span>
                </div>
                <div class="input-fields file-field">
                  <label>Upload PAN</label>
                  <input type="file" id="docs-upload" multiple name="uploadpan" />

                  <label for="docs-upload" class="file-btn"><i class="fas fa-upload"></i> Upload
                    PAN</label>
                  <span class="text-danger" id="error_uplaod_pan"><?= $upload_pan_error; ?></span>
                </div>
              </div>
            </div>
          </div>

          <!-- Bank Details -->
          <div class="employee-section employee-section-part">
            <div class="inner-employee-sec">
              <h2 class="form-section-title">Bank Details</h2>
              <div class="input-fields-group">
                <div class="input-fields">
                  <label>Bank Name</label>
                  <div class="input-icon">
                    <i class="fas fa-university"></i>
                    <input type="text" name="bankname" id="bankname" placeholder="Your bank name" />
                  </div>
                  <span class="text-danger" id="error_bank_name"><?= $bank_name_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Account Number</label>
                  <div class="input-icon">
                    <i class="fas fa-wallet"></i>
                    <input type="text" id="acountnumber" name="acountnumber" placeholder="your acount number" />
                  </div>
                  <span class="text-danger" id="error_account_number"><?= $account_number_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Verify Account Number</label>
                  <div class="input-icon">
                    <i class="fas fa-wallet"></i>
                    <input type="text" name="verifyaccountnumber" id="verifyaccountnumber" placeholder="your verify account number" />
                  </div>
                  <span class="text-danger" id="errror_verifyaccount_number"><?= $verify_account_number_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>IFSC Code</label>
                  <div class="input-icon">
                    <i class="fas fa-code"></i>
                    <input type="text" id="ifsccode" name="ifsccode" placeholder="your ifsc code" />
                  </div>
                  <span class="text-danger" id="error_ifsc_code"><?= $ifsc_code_error; ?></span>
                </div>

                <!-- New Address Field -->
                <div class="input-fields">
                  <label>Address 1</label>
                  <div class="input-icon address-input">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="address1" id="add" placeholder="your address1">
                  </div>
                  <span class="text-danger" id="error_address_1"><?= $address_1_error; ?></span>
                </div>
                <div class="input-fields">
                  <label>Address 2</label>
                  <div class="input-icon address-input">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="address2" id="address2" placeholder="your address 2">
                  </div>
                  <span class="text-danger" id="error_address_2"><?= $address_2_error; ?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- Final Uploads -->
          <div class="employee-section employee-section-part">
            <div class="inner-employee-sec">

              <h2 class="form-section-title">Final Uploads</h2>
              <div class="input-fields-group">
                <div class="input-fields">
                  <label for="relieving-date">Relieving Date</label>
                  <div class="input-icon custom-date-wrapper">
                    <i class="fas fa-calendar-plus"></i>
                    <input type="date" id="date" name="relevingdata" placeholder="your releving data" />
                  </div>
                  <span class="text-danger" id="error_relleving_data"><?= $releving_date_error ?></span>
                </div>

                <div class="input-fields file-field">
                  <label>NOC / Withdrawal Letter</label>
                  <input type="file" id="noc-upload" name="nocupload" placeholder="nocupload" />

                  <label for="noc-upload" class="file-btn"><i class="fas fa-file-contract"></i>
                    Upload
                    NOC</label>
                  <span class="text-danger" id="error_noc_upload"><?= $noc_upload_error; ?></span>
                </div>
                <div class="input-fields file-field">
                  <label>Experience Letter</label>
                  <input type="file" id="exp-upload" name="experienceupload" placeholder="your experience upload" />

                  <label for="exp-upload" class="file-btn"><i class="fas fa-file-alt"></i> Upload
                    Experience</label>
                  <span class="text-danger" id="errorc_experiencec_upload"><?= $experience_upload_error; ?></span>
                </div>
              </div>
            </div>
          </div>
          <div class="submit-btn">
            <button type="submit" id="submitButton">Submit</button>
          </div>
          <div class="messages-section" style="display: none;">
            <h2 style="color: #fff;">Api data stored successfuly</h2>
          </div>
        </form>
      </div>
    </div>
  </div>
 
  <!-- <script src="./js/jquery-3.7.1.min.js"></script>
  <script src="./js/select2.min.js"></script>
  <script src="./js/script.js" defer></script> -->




  <script>
    document.querySelectorAll('.custom-select').forEach(select => {
      const selected = select.querySelector('.selected');
      const dropdown = select.querySelector('.dropdown');
      const input = dropdown.querySelector('input');
      const hiddenInput = select.querySelector('.hidden-select-value');

      const isMultiSelect = hiddenInput?.name === 'department';

      selected.addEventListener('click', (e) => {
        e.stopPropagation();
        document.querySelectorAll('.custom-select').forEach(s => s.classList.remove('open'));
        select.classList.toggle('open');
        input.value = '';
        dropdown.querySelectorAll('.option').forEach(option => option.style.display = 'block');
      });

      if (isMultiSelect) {
        dropdown.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
          checkbox.addEventListener('change', () => {
            const selectedOptions = [];
            dropdown.querySelectorAll('input[type="checkbox"]:checked').forEach(cb => {
              selectedOptions.push(cb.value);
            });

            selected.innerHTML = selectedOptions.length > 0 ?
              selectedOptions.join(', ') + ' <i class="fas fa-caret-down"></i>' :
              'Select Department <i class="fas fa-caret-down"></i>';

            hiddenInput.value = selectedOptions.join(',');
          });
        });
      } else {
        dropdown.querySelectorAll('.option').forEach(option => {
          option.addEventListener('click', (e) => {
            e.stopPropagation();
            const value = option.textContent.trim();
            selected.innerHTML = value + ' <i class="fas fa-caret-down"></i>';
            select.classList.remove('open');
            if (hiddenInput) hiddenInput.value = value;
          });
        });
      }

      input.addEventListener('input', () => {
        const val = input.value.toLowerCase();
        dropdown.querySelectorAll('.option').forEach(option => {
          const labelText = isMultiSelect ?
            option.textContent.toLowerCase() :
            option.textContent.toLowerCase();
          option.style.display = labelText.includes(val) ? 'block' : 'none';
        });
      });
    });

    document.addEventListener('click', function(e) {
      document.querySelectorAll('.custom-select.open').forEach(select => {
        if (!select.contains(e.target)) {
          select.classList.remove('open');
        }
      });
    });
  </script>


  <script>
    let isvalid = true;
    const nameelem = document.getElementById("name");
    const error_name = document.getElementById("error_name");


    nameelem.addEventListener("keyup", function() {
      if (nameelem.value.trim() === "") {
        error_name.textContent = "Name is required";
      } else {
        error_name.textContent = "";
      }
    });

    const emailelem = document.getElementById("email");
    const error_email = document.getElementById("error_email");

    emailelem.addEventListener("keyup", function() {
      if (emailelem.value.trim() === "") {
        error_email.textContent = "Email is required";
      } else {
        error_email.textContent = "";
      }
    });

    const personalemail = document.getElementById("personalemail");
    const error_personalemail = document.getElementById("error_personalemail");

    personalemail.addEventListener("keyup", function() {
      if (personalemail.value.trim() === "") {
        error_personalemail.textContent = "Personal Email is required";
      } else {
        error_personalemail.textContent = "";
      }
    });
    const mobilenumber = document.getElementById("mobile");
    const errror_mobile_number = document.getElementById("errror_mobile_number");

    mobilenumber.addEventListener("input", function() {
      const mobilenumberValue = mobilenumber.value.trim();
      if (mobilenumberValue === "") {
        errror_mobile_number.textContent = "Mobile number is required";
      } else if (!/^\d{10}$/.test(mobilenumberValue)) {
        errror_mobile_number.textContent = "Mobile number must be exactly 10 digits";
      } else {
        errror_mobile_number.textContent = "";
      }
    });

    const homenumber = document.getElementById("homenumber");
    const errror_home_number = document.getElementById("errror_home_number");

    homenumber.addEventListener("input", function() {
      const homenumberValue = homenumber.value.trim();

      if (homenumberValue === "") {
        errror_home_number.textContent = "Home number is required";
      } else if (!/^\d{10}$/.test(homenumberValue)) {
        errror_home_number.textContent = "Home number must be exactly 10 digits";
      } else {
        errror_home_number.textContent = "";
      }
    });


    const employee_id = document.getElementById("employee_id");
    const error_employee_id = document.getElementById("error_employee_id");

    employee_id.addEventListener("keyup", function() {
      if (employee_id.value.trim() === "") {
        error_employee_id.textContent = "Employee id is required";
      } else {
        error_employee_id.textContent = "";
      }
    });


    // const department = document.getElementById("department");
    // console.log('department',department);
    // const error_select_department = document.getElementById("error_select_department");

    // department.addEventListener("select", function() {
    //   console.log('department chnage');
    //   if (department.value.trim() === "") {
    //     console.log('Department is required');
    //     error_select_department.textContent = "Department is required";
    //   } else {
    //      console.log('empty');
    //     error_select_department.textContent = "";
    //   }
    // });

    document.addEventListener("DOMContentLoaded", function() {
      const department = $('#department');
      const error_select_department = document.getElementById("error_select_department");

      department.on('select2:select', function(e) {

        if (department.val().trim() === "") {
          error_select_department.textContent = "Department is required";
        } else {
          error_select_department.textContent = "";
        }
      });
   

    // Designation Validation
    const designation = $('#designation');
    const error_select_desginations = document.getElementById("error_select_desginations");

    designation.on('select2:select', function(e) {
      if (designation.val().trim() === "") {
        error_select_desginations.textContent = "Designation is required";
      } else {
        error_select_desginations.textContent = "";
      }
    });

    

    // Joining Year Validation
    const joining_year = $('#joining');
    const error_select_year = document.getElementById("error_select_year");

    joining_year.on('select2:select', function(e) {
      if (joining_year.val().trim() === "") {
        error_select_year.textContent = "Joining year is required";
      } else {
        error_select_year.textContent = "";
      }
    });

    // Experience Validation
    const experience = $('#experience');
    const error_select_exprenece = document.getElementById("error_select_exprenece");

    experience.on('select2:select', function(e) {
      if (experience.val().trim() === "") {
        error_select_exprenece.textContent = "Experience is required";
      } else {
        error_select_exprenece.textContent = "";
      }
    });


     });

    const salary = document.getElementById("salary");
    const error_salary = document.getElementById("error_salary");

    salary.addEventListener("keyup", function() {
      if (salary.value.trim() === "") {
        error_salary.textContent = "Salary is required";
      } else {
        error_salary.textContent = "";
      }
    });
    const pannumber = document.getElementById("pannumber");
    const error_pan_number = document.getElementById("error_pan_number");

    pannumber.addEventListener("keyup", function() {
      const pannumberValue = pannumber.value.trim();

      if (pannumberValue === "") {
        error_pan_number.textContent = "Pan number is required";
      } else if (!/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(pannumberValue)) {
        error_pan_number.textContent = "Pan number must be in correct format (e.g. ABCDE1234F)";
      } else {
        error_pan_number.textContent = "";
      }
    });



    const adhaarnumber = document.getElementById("adharnumber");
    const error_adhar_number = document.getElementById("error_adhar_number");

    adhaarnumber.addEventListener("keyup", function() {
      const adhaarValue = adhaarnumber.value.trim();

      if (adhaarValue === "") {
        error_adhar_number.textContent = "Aadhaar number is required";
      } else if (!/^\d{12}$/.test(adhaarValue)) {
        error_adhar_number.textContent = "Aadhaar number must be exactly 12 digits";
      } else {
        error_adhar_number.textContent = "";
      }
    });

    const upload = document.getElementById("pic-upload");
    const error_upload_adharcard = document.getElementById("error_upload_adharcard");

    upload.addEventListener("change", function() {
      if (upload.value.trim() === "") {
        error_upload_adharcard.textContent = "Upload Aadhar is required";
      } else {
        error_upload_adharcard.textContent = "";
      }
    });

    const uploadpan = document.getElementById("docs-upload");
    const error_uplaod_pan = document.getElementById("error_uplaod_pan");

    uploadpan.addEventListener("change", function() {
      if (uploadpan.value.trim() === "") {
        error_uplaod_pan.textContent = "Upload PAN is required";
      } else {
        error_uplaod_pan.textContent = "";
      }
    });

    const bankname = document.getElementById("bankname");
    const error_bank_name = document.getElementById("error_bank_name");

    bankname.addEventListener("keyup", function() {
      if (bankname.value.trim() === "") {
        error_bank_name.textContent = "Bank name is required";
      } else {
        error_bank_name.textContent = "";
      }
    });

    const acountnumber = document.getElementById("acountnumber");
    const error_account_number = document.getElementById("error_account_number");

    acountnumber.addEventListener("keyup", function() {
      if (acountnumber.value.trim() === "") {
        error_account_number.textContent = "Account number is required";
      } else {
        error_account_number.textContent = "";
      }
    });

    const verifyaccountnumber = document.getElementById("verifyaccountnumber");
    const errror_verifyaccount_number = document.getElementById("errror_verifyaccount_number");

    verifyaccountnumber.addEventListener("keyup", function() {
      if (verifyaccountnumber.value.trim() === "") {
        errror_verifyaccount_number.textContent = "Verify account number is required";
      } else {
        errror_verifyaccount_number.textContent = "";
      }
    });

    const ifsccode = document.getElementById("ifsccode");
    const error_ifsc_code = document.getElementById("error_ifsc_code");

    ifsccode.addEventListener("keyup", function() {
      if (ifsccode.value.trim() === "") {
        error_ifsc_code.textContent = "IFSC code is required";
      } else {
        error_ifsc_code.textContent = "";
      }
    });

    const address1 = document.getElementById("add");
    const error_address_1 = document.getElementById("error_address_1");

    address1.addEventListener("keyup", function() {
      if (address1.value.trim() === "") {
        error_address_1.textContent = "Address 1 is required";
      } else {
        error_address_1.textContent = "";
      }
    });

    const address2 = document.getElementById("address2");
    const error_address_2 = document.getElementById("error_address_2");

    address2.addEventListener("keyup", function() {
      if (address2.value.trim() === "") {
        error_address_2.textContent = "Address 2 is required";
      } else {
        error_address_2.textContent = "";
      }
    });

    const relevingdata = document.getElementById("date");
    const error_relleving_data = document.getElementById("error_relleving_data");

    relevingdata.addEventListener("change", function() {
      if (relevingdata.value.trim() === "") {
        error_relleving_data.textContent = "Releving date is required";
      } else {
        error_relleving_data.textContent = "";
      }
    });

    const nocupload = document.getElementById("noc-upload");
    const error_noc_upload = document.getElementById("error_noc_upload");

    nocupload.addEventListener("change", function() {
      if (nocupload.value.trim() === "") {
        error_noc_upload.textContent = "NOC upload is required";
      } else {
        error_noc_upload.textContent = "";
      }
    });

    const experienceupload = document.getElementById("exp-upload");
    const errorc_experiencec_upload = document.getElementById("errorc_experiencec_upload");

    experienceupload.addEventListener("change", function() {
      if (experienceupload.value.trim() === "") {
        errorc_experiencec_upload.textContent = "Experience upload is required";
      } else {
        errorc_experiencec_upload.textContent = "";
      }
    });


    document.querySelector('#formId').addEventListener("submit", function(e) {
      e.preventDefault();
      isvalid = true;


      document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');

      if (nameelem.value.trim() === "") {
        error_name.textContent = "Name is required";
        isvalid = false;
      } else {
        error_name.textContent = "";
      }

      if (emailelem.value.trim() === "") {
        error_email.textContent = "Email is required";
        isvalid = false;
      } else {
        error_email.textContent = "";
      }

      if (personalemail.value.trim() === "") {
        error_personalemail.textContent = "Personal Email is required";
        isvalid = false;
      } else {
        error_personalemail.textContent = "";
      }

      if (mobilenumber.value.trim() === "") {
        errror_mobile_number.textContent = "Mobile number is required";
        isvalid = false;
      } else {
        errror_mobile_number.textContent = "";
      }

      if (homenumber.value.trim() === "") {
        errror_home_number.textContent = "Home number is required";
        isvalid = false;
      } else {
        errror_home_number.textContent = "";
      }

      if (employee_id.value.trim() === "") {
        error_employee_id.textContent = "Employee id is required";
        isvalid = false;
      } else {
        error_employee_id.textContent = "";
      }

      if (department.value === "") {
        error_select_department.textContent = "Department is required";
        isValid = false;
      }

      // Designation Check
      if (designation.value === "") {
        error_select_desginations.textContent = "Designation is required";
        isValid = false;
      }

      // Joining Year Check
      if ($('#joining').val().trim() === "") {
        error_select_year.textContent = "Joining year is required";
        isValid = false;
      }

      // Experience Check
      if (experience.value === "") {
        error_select_exprenece.textContent = "Experience is required";
        isValid = false;
      }

      if (salary.value.trim() === "") {
        error_salary.textContent = "Salary is required";
        isvalid = false;
      } else {
        error_salary.textContent = "";
      }

      if (pannumber.value.trim() === "") {
        error_pan_number.textContent = "PAN number is required";
        isvalid = false;
      } else {
        error_pan_number.textContent = "";
      }

      if (adhaarnumber.value.trim() === "") {
        error_adhar_number.textContent = "Aadhar number is required";
        isvalid = false;
      } else {
        error_adhar_number.textContent = "";
      }

      if (upload.value.trim() === "") {
        error_upload_adharcard.textContent = "Upload Aadhar is required";
        isvalid = false;
      } else {
        error_upload_adharcard.textContent = "";
      }

      if (uploadpan.value.trim() === "") {
        error_uplaod_pan.textContent = "Upload PAN is required";
        isvalid = false;
      } else {
        error_uplaod_pan.textContent = "";
      }

      if (bankname.value.trim() === "") {
        error_bank_name.textContent = "Bank name is required";
        isvalid = false;
      } else {
        error_bank_name.textContent = "";
      }

      if (acountnumber.value.trim() === "") {
        error_account_number.textContent = "Account number is required";
        isvalid = false;
      } else {
        error_account_number.textContent = "";
      }

      if (verifyaccountnumber.value.trim() === "") {
        errror_verifyaccount_number.textContent = "Verify account number is required";
        isvalid = false;
      } else {
        errror_verifyaccount_number.textContent = "";
      }

      if (ifsccode.value.trim() === "") {
        error_ifsc_code.textContent = "IFSC code is required";
        isvalid = false;
      } else {
        error_ifsc_code.textContent = "";
      }

      if (address1.value.trim() === "") {
        error_address_1.textContent = "Address 1 is required";
        isvalid = false;
      } else {
        error_address_1.textContent = "";
      }

      if (address2.value.trim() === "") {
        error_address_2.textContent = "Address 2 is required";
        isvalid = false;
      } else {
        error_address_2.textContent = "";
      }

      if (relevingdata.value.trim() === "") {
        error_relleving_data.textContent = "Releving date is required";
        isvalid = false;
      } else {
        error_relleving_data.textContent = "";
      }

      if (nocupload.value.trim() === "") {
        error_noc_upload.textContent = "NOC upload is required";
        isvalid = false;
      } else {
        error_noc_upload.textContent = "";
      }

      if (experienceupload.value.trim() === "") {
        errorc_experiencec_upload.textContent = "Experience upload is required";
        isvalid = false;
      } else {
        errorc_experiencec_upload.textContent = "";
      }

      if (!isvalid) {
        return; // Stop form submission if not valid
      }

      // If all valid, send AJAX
      const formData = new FormData(this);

      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',

        success: function(res) {
          if (res.success) {
            $('.messages-section').show();
            document.querySelector('#formId').reset();
          } else {
            $.each(res.errors || {}, function(field, msg) {
              $('#error_' + field).text(msg);
            });
          }
        },
        error: function(xhr) {
          alert('Server error: ' + xhr.statusText);
        }
      });
    });
  </script>

  <?php
    include('./includes/script.php');
    ?>
</body>

</html>