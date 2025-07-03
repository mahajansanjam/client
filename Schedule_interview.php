<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php
    include('./includes/css.php');
    ?>
</head>

<body>
    <?php include('./includes/sidebar.php'); ?>
    <div class="interview-section">
        <div class="inner-interview-sec">

            <!-- Interview Schedule Form -->
            <div class="employee-section btn-style">
                <div class="inner-employee-sec">
                    <h2 class="form-section-title"> Interview Schedule</h2>

                    <form id="contactForm" method="POST" enctype="multipart/form-data">

                        <div class="input-fields-group">
                            <!-- Full Name -->
                            <div class="input-fields">
                                <label for="full-name">Name of Employee</label>
                                <div class="input-icon"><i class="fas fa-user"></i>
                                    <input type="text" id="full-name" name="full_name" placeholder="Enter Full Name"
                                        autocomplete="off">
                                </div>
                                <div class="error" id="error-full_name"></div>
                            </div>

                            <!-- Department -->
                            <div class="input-fields" id="select-field">
                                <label for="department">Department</label>
                                <select class="department" name="department" id="department">
                                    <option value="">Select Department</option>
                                    <option value="Human Resources">HR</option>
                                    <option value="Development">Development</option>
                                    <option value="Sales">Sales</option>
                                </select>
                                <div class="error" id="error-department"></div>
                            </div>

                            <!-- Designation -->
                            <div class="input-fields" id="select-field">
                                <label for="designation">Designation</label>
                                <select class="designation" name="designation" id="designation">
                                    <option value="">Select Designation</option>
                                    <option value="Intern">Intern</option>
                                    <option value="Developer">Developer</option>
                                    <option value="Manager">Manager</option>
                                </select>
                                <div class="error" id="error-designation"></div>
                            </div>

                            <!-- Total Experience -->
                            <div class="input-fields" id="select-field">
                                <label for="total_experience">Total Experience</label>
                                <select class="experience" name="total_experience" id="total_experience">
                                    <option value="">Select Experience</option>
                                    <option value="1 Year">1 Year</option>
                                    <option value="2 Years">2 Years</option>
                                    <option value="3 Years">3 Years</option>
                                    <option value="4 Years">4 Years</option>
                                    <option value="5 Years">5 Years</option>
                                    <option value="6 Years">6 Years</option>
                                    <option value="7 Years">7 Years</option>
                                    <option value="8 Years">8 Years</option>
                                    <option value="9 Years">9 Years</option>
                                    <option value="10 Years">10 Years</option>
                                    <option value="11 Years">11 Years</option>
                                    <option value="12 Years">12 Years</option>
                                    <option value="13 Years">13 Years</option>
                                    <option value="14 Years">14 Years</option>
                                    <option value="15 Years">15 Years</option>
                                    <option value="16 Years">16 Years</option>
                                    <option value="17 Years">17 Years</option>
                                    <option value="18 Years">18 Years</option>
                                    <option value="19 Years">19 Years</option>
                                    <option value="20+ Years">20+ Years</option>
                                </select>

                                <div class="error" id="error-total_experience"></div>
                            </div>

                            <!-- Interview Date -->
                            <div class="input-fields">
                                <label for="interview_date">Interview Date</label>
                                <div class="custom-date-wrapper">
                                    <i class="fa fa-calendar"></i>
                                    <input type="date" id="interview_date" name="interview_date" autocomplete="off" />
                                </div>
                                <div class="error" id="error-interview_date"></div>
                            </div>

                            <!-- Interview Process -->
                            <div class="input-fields" id="select-field">
                                <label for="interview-process">Interview Process</label>
                                <select class="interview" name="interview_process" id="interview-process">
                                    <option value="">Select Process</option>
                                    <option value="Face to Face">Face to Face</option>
                                    <option value="Machine Test">Machine Test</option>
                                    <option value="Telephonic">Telephonic</option>
                                </select>
                                <div class="error" id="error-interview_process"></div>
                            </div>

                            <!-- Status -->
                            <div class="input-fields" id="select-field">
                                <label for="status">Status</label>
                                <select class="status" name="status" id="status">
                                    <option value="">Select Status</option>
                                    <option value="Selected">Selected</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="On Hold">On Hold</option>
                                </select>
                                <div class="error" id="error-status"></div>
                            </div>

                            <!-- Scheduled By -->
                            <div class="input-fields" id="select-field">
                                <label for="scheduled_by">Scheduled By</label>
                                <select class="scheduled" name="scheduled_by" id="scheduled_by">
                                    <option value="">Select Person</option>
                                    <option value="HR">HR</option>
                                    <option value="Department Head">Department Head</option>
                                    <option value="Employee">Employee</option>
                                </select>
                                <div class="error" id="error-scheduled_by"></div>
                            </div>

                            <!-- Links -->
                            <div class="input-fields">
                                <label for="links">Links (LinkedIn, GitHub, etc)</label>
                                <div class="input-icon">
                                    <i class="fas fa-link"></i>
                                    <input type="text" id="links" name="links" autocomplete="off" />
                                </div>
                                <div class="error" id="error-links"></div>
                            </div>

                            <!-- Current Salary -->
                            <div class="input-fields">
                                <label for="current-salary">Current Salary</label>
                                <div class="input-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <input type="text" name="current_salary" id="current-salary"
                                        placeholder="Enter current salary" autocomplete="off">
                                </div>
                                <div class="error" id="error-current_salary"></div>
                            </div>

                            <!-- Expected Salary -->
                            <div class="input-fields">
                                <label for="expected-salary">Expected Salary</label>
                                <div class="input-icon">
                                    <i class="fas fa-money-check-alt"></i>
                                    <input type="text" id="expected-salary" name="expected_salary"
                                        placeholder="Enter expected salary" autocomplete="off">
                                </div>
                                <div class="error" id="error-expected_salary"></div>
                            </div>

                            <!-- Notice Period -->
                            <div class="input-fields">
                                <label for="notice-period">Notice Period</label>
                                <div class="input-icon">
                                    <i class="fas fa-clock"></i>
                                    <input type="text" name="notice_period" id="notice-period"
                                        placeholder="Enter notice period" autocomplete="off">
                                </div>
                                <div class="error" id="error-notice_period"></div>
                            </div>

                            <!-- Referred By -->
                            <div class="input-fields">
                                <label for="referred">Referred By</label>
                                <div class="input-icon">
                                    <i class="fas fa-user-friends"></i>
                                    <input type="text" id="referred" name="referred" placeholder="Enter referrer name"
                                        autocomplete="off">
                                </div>
                                <div class="error" id="error-referred"></div>
                            </div>

                            <!-- Upload Photo -->
                            <div class="input-fields file-field">
                                <label for="upload-photo">Upload Photo</label>
                                <input type="file" id="upload-photo" name="upload_photo" autocomplete="off">
                                <label for="upload-photo" class="file-btn"><i class="fas fa-image"></i> Upload
                                    Photo</label>
                                <div class="error" id="error-upload_photo"></div>
                            </div>

                            <!-- Upload Resume -->
                            <div class="input-fields file-field">
                                <label for="upload-resume">Upload Resume</label>
                                <input type="file" id="upload-resume" name="upload_resume" autocomplete="off">
                                <label for="upload-resume" class="file-btn"><i class="fas fa-file-upload"></i> Upload
                                    Resume</label>
                                <div class="error" id="error-upload_resume"></div>
                            </div>
                        </div>

                        <div class="submit-btn">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- left-sidebar close div -->
    </div>
    <!-- right-sidebar close div -->
    </div>
    
    <!-- success modal  -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Submission Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalMessage">
                    Interview scheduled successfully.
                </div>
                <div class="modal-footer">
                    <button type="button" id="modalOkBtn" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('./includes/script.php');
    ?>

</body>

</html>