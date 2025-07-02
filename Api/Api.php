<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "new_clients_users";

$conn = new mysqli($servername, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$method = $_SERVER['REQUEST_METHOD'];
$targetDir = "uploads/";

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$upload_pan = '';
if (!empty($_FILES['uploadpan']['name'])) {
    $upload_pan = time() . '_' . basename($_FILES['uploadpan']['name']);
    if (!move_uploaded_file($_FILES['uploadpan']['tmp_name'], $targetDir . $upload_pan)) {
        echo "Failed to upload PAN file.<br>";
    }
}

$noc_upload = '';
if (!empty($_FILES['nocupload']['name'])) {
    $noc_upload = time() . '_' . basename($_FILES['nocupload']['name']);
    if (!move_uploaded_file($_FILES['nocupload']['tmp_name'], $targetDir . $noc_upload)) {
        echo "Failed to upload NOC file.<br>";
    }
}

$experience_upload = '';
if (!empty($_FILES['experienceupload']['name'])) {
    $experience_upload = time() . '_' . basename($_FILES['experienceupload']['name']);
    if (!move_uploaded_file($_FILES['experienceupload']['tmp_name'], $targetDir . $experience_upload)) {
        echo "Failed to upload Experience file.<br>";
    }
}

$upload_adhar_card = '';
if (!empty($_FILES['upload']['name'])) {
    $upload_adhar_card = time() . '_' . basename($_FILES['upload']['name']);
    if (!move_uploaded_file($_FILES['upload']['tmp_name'], $targetDir . $upload_adhar_card)) {
        echo "Failed to upload Adhar file.<br>";
    }
}

switch ($method) {

    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $empResult = $conn->query("SELECT * FROM employee_details WHERE employee_id = '$id'");
            $employment = $empResult->fetch_assoc();

            $bankResult = $conn->query("SELECT * FROM new_bank_details_users WHERE employee_id = '$id'");
            $bank = $bankResult->fetch_assoc();

            $docResult = $conn->query("SELECT * FROM mew_document_deatils WHERE employee_id = '$id'");
            $document = $docResult->fetch_assoc();

            echo json_encode([
                "employment" => $employment,
                "bank" => $bank,
                "document" => $document
            ]);
        } else {
            $result = $conn->query("SELECT * FROM employee_details");
            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            echo json_encode($users);
        }
        break;

    case 'POST':
        $input = $_POST;
        
        if (!is_array($input)) {
            $input = [];
        }

        $employee_id = $input['employee_id'] ?? null;

        $name = $input['name'] ?? null;
        $email = $input['email'] ?? null;
        $personal_email = $input['personalemail'] ?? null;
        $mobile_number = $input['number'] ?? null;
        $home_number = $input['homenumber'] ?? null;
        $select_departmentemployee = $input['department'] ?? null;
        $select_desginations = $input['designation'] ?? null;
        $select_join_year = $input['joining'] ?? null;
        $select_exsperience = $input['experience'] ?? null;
        $salary = $input['salary'] ?? null;
        $releving_date = $input['relevingdata'] ?? null;

        $sql = "INSERT INTO employee_details (
                name, official_email, personal_email, mobile_number, home_number, employee_id, department, desgination, joning_year, total_expierence, salary, relieving_date, noc, experience_letter
            ) VALUES (
                '$name', '$email', '$personal_email', '$mobile_number', '$home_number', '$employee_id', '$select_departmentemployee', '$select_desginations', '$select_join_year', '$select_exsperience', '$salary', '$releving_date', '$noc_upload', '$experience_upload'
            )";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $bank_name = $input['bankname'] ?? null;
            $account_number = $input['acountnumber'] ?? null;
            $verify_account_number = $input['verifyaccountnumber'] ?? null;
            $ifsc_code = $input['ifsccode'] ?? null;
            $address_1 = $input['address1'] ?? null;
            $address_2 = $input['address2'] ?? null;

            $conn->query("INSERT INTO new_bank_details_users (
                        bank_name, account_number, verfify_account_number, ifsc_code, addess_1, address2, employee_id
                    ) VALUES (
                        '$bank_name', '$account_number', '$verify_account_number', '$ifsc_code', '$address_1', '$address_2', '$last_id'
                    )");

            $pan_number = $input['pannumber'] ?? null;
            // print_r($pan_number);
            $adhar_number = $input['adhaarnumber'] ?? null;

            $conn->query("INSERT INTO new_document_users (
                        pan_number, adhar_number, upload_adhar, upload_pan, employee_id
                    ) VALUES (
                        '$pan_number', '$adhar_number', '$upload_adhar_card', '$upload_pan', '$last_id'
                    )");

            echo json_encode(["message" => "Data inserted successfully", "success" => true]);
        } else {
            echo json_encode(["message" => "Error inserting employee data", "success" => false]);
        }

        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $input);
        $employee_id = $_GET['id'];
        $name = $input['name'] ?? null;
        $email = $input['email'] ?? null;
        $personal_email = $input['personalemail'] ?? null;
        $mobile_number = $input['number'] ?? null;
        $home_number = $input['homenumber'] ?? null;
        $select_departmentemployee = $input['department'] ?? null;
        $select_desginations = $input['designation'] ?? null;
        $select_join_year = $input['joining_year'] ?? null;
        $select_exsperience = $input['experience'] ?? null;
        $salary = $input['salary'] ?? null;
        $releving_date = $input['relevingdata'] ?? null;

        $conn->query("UPDATE employee_details SET name='$name', official_email='$email', personal_email='$personal_email', mobile_number='$mobile_number', home_number='$home_number', department='$select_departmentemployee', desgination='$select_desginations', joning_year='$select_join_year', total_expierence='$select_exsperience', salary='$salary', relieving_date='$releving_date' WHERE employee_id = '$last_id'");

        $bank_name = $input['bankname'] ?? null;
        $account_number = $input['acountnumber'] ?? null;
        $verify_account_number = $input['verifyaccountnumber'] ?? null;
        $ifsc_code = $input['ifsccode'] ?? null;
        $address_1 = $input['address1'] ?? null;
        $address_2 = $input['address2'] ?? null;

        $conn->query("UPDATE new_bank_details_users SET bank_name='$bank_name', account_number='$account_number', verfify_account_number='$verify_account_number', ifsc_code='$ifsc_code', addess_1='$address_1', address2='$address_2' WHERE employee_id ='$last_id");

        $pan_number = $input['pannumber'] ?? null;
        $adhar_number = $input['adhaarnumber'] ?? null;

        $conn->query("UPDATE new_document_users SET pan_number='$pan_number', adhar_number='$adhar_number' WHERE employee_id = '$last_id'");

        echo json_encode(["message" => "Data updated successfully", "success" => true]);
        break;

    case 'DELETE':
        $id = $_GET['id'];

        $conn->query("DELETE FROM employee_details WHERE id = '$id'");
        $conn->query("DELETE FROM new_bank_details_users WHERE employee_id = '$id'");
        $conn->query("DELETE FROM new_document_users WHERE employee_id = '$id'");

        echo json_encode(["message" => "Data deleted successfully", "success" => true]);
        break;

    default:
        echo json_encode(["message" => "Invalid request method", "success" => false]);
        break;
}

$conn->close();
