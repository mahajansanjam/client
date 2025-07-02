<?php
include('../database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Initialize response
    $output_status = false;
    $output_message = "";

    // Get form input values safely
    $fullName = $_POST['full_name'] ?? '';
    $department = $_POST['department'] ?? '';
    $designation = $_POST['designation'] ?? '';
    $experience = $_POST['total_experience'] ?? '';
    $interviewDate = $_POST['interview_date'] ?? '';
    $interviewProcess = $_POST['interview_process'] ?? '';
    $status = $_POST['status'] ?? '';
    $scheduledBy = $_POST['scheduled_by'] ?? '';
    $links = $_POST['links'] ?? '';
    $currentSalary = $_POST['current_salary'] ?? '';
    $expectedSalary = $_POST['expected_salary'] ?? '';
    $noticePeriod = $_POST['notice_period'] ?? '';
    $referred = $_POST['referred'] ?? '';

    // Handle photo upload
    if (isset($_FILES['upload_photo']) && $_FILES['upload_photo']['error'] === 0) {
        $photoName = time() . '_' . basename($_FILES['upload_photo']['name']); // unique name
        $photoPathForDB = 'uploads/photos/' . $photoName;
        $targetPhotoPath = 'uploads/photos/' . $photoName; // Correct path inside Api folder

        move_uploaded_file($_FILES['upload_photo']['tmp_name'], $targetPhotoPath);
    } else {
        $photoPathForDB = '';
    }

    // Handle resume upload
    if (isset($_FILES['upload_resume']) && $_FILES['upload_resume']['error'] === 0) {
        $resumeName = time() . '_' . basename($_FILES['upload_resume']['name']); // unique name
        $resumePathForDB = 'uploads/resume/' . $resumeName;
        $targetResumePath = 'uploads/resume/' . $resumeName; // Correct path inside Api folder

        move_uploaded_file($_FILES['upload_resume']['tmp_name'], $targetResumePath);
    } else {
        $resumePathForDB = '';
    }

    // Prepare SQL statement
    $sql = "INSERT INTO interview_schedule (
        employee_name, department, designation, experience,
        interview_date, interview_process, status, scheduled_by,
        links, current_salary, expected_salary, notice_period,
        referred_by, photo, resume
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param(
            "sssssssssssssss",
            $fullName,
            $department,
            $designation,
            $experience,
            $interviewDate,
            $interviewProcess,
            $status,
            $scheduledBy,
            $links,
            $currentSalary,
            $expectedSalary,
            $noticePeriod,
            $referred,
            $photoPathForDB,
            $resumePathForDB
        );

        // Execute query
        if ($stmt->execute()) {
            $output_status = true;
            $output_message = "Interview scheduled successfully.";
        } else {
            $output_message = "Error while inserting: " . $stmt->error;
        }

        $stmt->close();

    } else {
        $output_message = "Error preparing statement: " . $conn->error;
    }

    // Final response
    $output = [
        'status' => $output_status,
        'message' => $output_message
    ];

    echo json_encode($output);
}
?>
