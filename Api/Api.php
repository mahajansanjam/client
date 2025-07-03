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

// File Upload Function
function uploadFile($fileInputName, $targetDir)
{
    if (!empty($_FILES[$fileInputName]['name'])) {
        $fileName = time() . '_' . basename($_FILES[$fileInputName]['name']);
        if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetDir . $fileName)) {
            return $fileName;
        }
    }
    return '';
}

if ($method == 'POST') {
    // File uploads
    $upload_pan = uploadFile('uploadpan', $targetDir);
    $noc_upload = uploadFile('nocupload', $targetDir);
    $experience_upload = uploadFile('experienceupload', $targetDir);
    $upload_adhar_card = uploadFile('upload', $targetDir);

    $input = $_POST;

    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $personal_email = $input['personalemail'] ?? '';
    $mobile_number = $input['number'] ?? '';
    $home_number = $input['homenumber'] ?? '';
    $select_departmentemployee = $input['department'] ?? '';
    $select_desginations = $input['designation'] ?? '';
    $select_join_year = $input['joining'] ?? '';
    $select_experience = $input['experience'] ?? '';
    $salary = $input['salary'] ?? '';
    $releving_date = $input['relevingdata'] ?? '';
    $employee_id=$input['employee_id']??'';

    // Insert into employee_details
    $sql = "INSERT INTO employee_details (name, official_email, personal_email, mobile_number, home_number, department, desgination, joning_year, total_expierence, salary, relieving_date, noc, experience_letter,employee_id)
            VALUES ('$name', '$email', '$personal_email', '$mobile_number', '$home_number', '$select_departmentemployee', '$select_desginations', '$select_join_year', '$select_experience', '$salary', '$releving_date', '$noc_upload', '$experience_upload','$employee_id')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

        // Insert bank details
        $bank_name = $input['bankname'] ?? '';
        $account_number = $input['acountnumber'] ?? '';
        $verify_account_number = $input['verifyaccountnumber'] ?? '';
        $ifsc_code = $input['ifsccode'] ?? '';
        $address_1 = $input['address1'] ?? '';
        $address_2 = $input['address2'] ?? '';

        $conn->query("INSERT INTO new_bank_details_users (bank_name, account_number, verfify_account_number, ifsc_code, addess_1, address2, employee_id)
                      VALUES ('$bank_name', '$account_number', '$verify_account_number', '$ifsc_code', '$address_1', '$address_2', '$last_id')");

        // Insert document details
        $pan_number = $input['pannumber'] ?? '';
        $adhar_number = $input['adhaarnumber'] ?? '';

        $conn->query("INSERT INTO new_documnet_details_users (pan_number, adhar_number, upload_adhar, upload_pan, employee_id)
                      VALUES ('$pan_number', '$adhar_number', '$upload_adhar_card', '$upload_pan', '$last_id')");

        echo json_encode(["message" => "Data inserted successfully", "success" => true]);
    } else {
        echo json_encode(["message" => "Error inserting employee data", "success" => false]);
    }
}

elseif ($method == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $empResult = $conn->query("SELECT * FROM employee_details WHERE id = '$id'");
        $employment = $empResult->fetch_assoc();

        $bankResult = $conn->query("SELECT * FROM new_bank_details_users WHERE employee_id = '$id'");
        $bank = $bankResult->fetch_assoc();

        $docResult = $conn->query("SELECT * FROM new_documnet_details_users WHERE employee_id = '$id'");
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
}

elseif ($method == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $employee_id = $_GET['id'];

    $name = $input['name'] ?? '';
    $email = $input['email'] ?? '';
    $personal_email = $input['personalemail'] ?? '';
    $mobile_number = $input['number'] ?? '';
    $home_number = $input['homenumber'] ?? '';
    $select_departmentemployee = $input['department'] ?? '';
    $select_desginations = $input['designation'] ?? '';
    $select_join_year = $input['joining'] ?? '';
    $select_experience = $input['experience'] ?? '';
    $salary = $input['salary'] ?? '';
    $releving_date = $input['relevingdata'] ?? '';

    // Update employee_details
    $conn->query("UPDATE employee_details SET name='$name', official_email='$email', personal_email='$personal_email', mobile_number='$mobile_number', home_number='$home_number', department='$select_departmentemployee', desgination='$select_desginations', joning_year='$select_join_year', total_expierence='$select_experience', salary='$salary', relieving_date='$releving_date' WHERE id = '$employee_id'");

    // Update bank details
    $bank_name = $input['bankname'] ?? '';
    $account_number = $input['acountnumber'] ?? '';
    $verify_account_number = $input['verifyaccountnumber'] ?? '';
    $ifsc_code = $input['ifsccode'] ?? '';
    $address_1 = $input['address1'] ?? '';
    $address_2 = $input['address2'] ?? '';

    $conn->query("UPDATE new_bank_details_users SET bank_name='$bank_name', account_number='$account_number', verfify_account_number='$verify_account_number', ifsc_code='$ifsc_code', addess_1='$address_1', address2='$address_2' WHERE employee_id ='$employee_id'");

    // Update document details
    $pan_number = $input['pannumber'] ?? '';
    $adhar_number = $input['adhaarnumber'] ?? '';

    $conn->query("UPDATE new_documnet_details_users SET pan_number='$pan_number', adhar_number='$adhar_number' WHERE employee_id = '$employee_id'");

    echo json_encode(["message" => "Data updated successfully", "success" => true]);
}

elseif ($method == 'DELETE') {
    $id = $_GET['id'];

    $conn->query("DELETE FROM employee_details WHERE id = '$id'");
    $conn->query("DELETE FROM new_bank_details_users WHERE employee_id = '$id'");
    $conn->query("DELETE FROM new_documnet_details_users WHERE employee_id = '$id'");

    echo json_encode(["message" => "Data deleted successfully", "success" => true]);
}

else {
    echo json_encode(["message" => "Invalid request method", "success" => false]);
}

$conn->close();
?>
