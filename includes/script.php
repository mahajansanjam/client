<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/select2.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- validation for schedule interview -->
<script>
    const constraints = {
        full_name: {
            presence: { allowEmpty: false, message: "^Full name is required" },
            length: {
                minimum: 2,
                message: "^Full name must be at least 2 characters"
            }
        },
        department:
        {
            presence:
                { allowEmpty: false, message: "^Department is required" }
        },
        designation: {
            presence:
                { allowEmpty: false, message: "^Designation is required" }
        },
        total_experience:
        {
            presence:
                { allowEmpty: false, message: "^Total experience is required" }
        },
        interview_date:
        {
            presence:
                { allowEmpty: false, message: "^Interview date is required" }
        },
        interview_process:
        {
            presence:
                { allowEmpty: false, message: "^Interview process is required" }
        },
        status:
        {
            presence: {
                allowEmpty: false, message: "^Status is required"
            }
        },
        scheduled_by: {
            presence: {
                allowEmpty: false, message: "^Scheduled by is required"
            }
        },
        links: {
            presence: {
                allowEmpty: false, message: "^Links are required"
            }
        },
        current_salary: {

            presence: {
                allowEmpty: false, message: "^Current salary is required"
            }
        },
        expected_salary: {
            presence: {
                allowEmpty: false, message: "^Expected salary is required"
            }
        },
        notice_period: {
            presence: {

                allowEmpty: false, message: "^Notice period is required"
            }
        },
        referred: {
            presence: {
                allowEmpty: false, message: "^Referred by is required"
            }
        },
        upload_photo: {
            presence: {
                allowEmpty: false, message: "^Photo is required"
            }
        },
        upload_resume: {
            presence: {
                allowEmpty: false, message: "^Resume is required"
            }
        }
    };

    const form = document.getElementById("contactForm");

    // Validation on submit
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = {
            full_name: form.full_name.value.trim(),
            department: form.department.value,
            designation: form.designation.value,
            total_experience: form.total_experience.value,
            interview_date: form.interview_date.value,
            interview_process: form.interview_process.value,
            status: form.status.value,
            scheduled_by: form.scheduled_by.value,
            links: form.links.value.trim(),
            current_salary: form.current_salary.value.trim(),
            expected_salary: form.expected_salary.value.trim(),
            notice_period: form.notice_period.value.trim(),
            referred: form.referred.value.trim(),
            upload_photo: form.upload_photo.value ? "yes" : "",
            upload_resume: form.upload_resume.value ? "yes" : ""
        };

        const errors = validate(formData, constraints);

        document.querySelectorAll(".error").forEach(el => el.textContent = "");

        if (errors) {
            Object.keys(errors).forEach(key => {
                const errorDiv = document.getElementById("error-" + key);
                if (errorDiv) {
                    errorDiv.textContent = errors[key][0];
                }
            });
        } else {
            form.dispatchEvent(new CustomEvent("validatedSubmit"));

            // alert("Form submitted successfully!");
            // form.submit();
        }
    });


    const fields = document.querySelectorAll("input");
    fields.forEach((f) => {
        f.addEventListener("keyup", (e) => {
            const val = e.target.value;
            const errorName = e.target.getAttribute('name');
            const errorElement = document.getElementById(`error-${errorName}`);
            if (val !== "") {
                errorElement.textContent = "";
            }
        });
        f.addEventListener("change", (e) => {
            const val = e.target.value;
            const errorName = e.target.getAttribute('name');
            const errorElement = document.getElementById(`error-${errorName}`);
            if (val !== "") {
                errorElement.textContent = "";
            }
        });
    });

</script>
<!-- for form submitted -->

<script>
    const formforcontact = document.getElementById('contactForm');
    const modalMessage = document.getElementById('modalMessage');
    const resultModal = new bootstrap.Modal(document.getElementById('resultModal'));


    formforcontact.addEventListener("validatedSubmit", () => {
        fetch('Api/save_interview.php', {
            method: "POST",
            body: new FormData(form)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    modalMessage.textContent = data.message;
                } else {
                    if (data.message) {
                        modalMessage.textContent = data.message;
                    } else {
                        modalMessage.textContent = "Failed to schedule interview.";
                    }
                }
                resultModal.show();
            })
            .catch(() => {
                modalMessage.textContent = "Something went wrong.";
                resultModal.show();
            });
    });
</script>

<script>
    const okBtn = document.getElementById('modalOkBtn');

    okBtn.addEventListener('click', () => {
        location.reload();
    });
</script>

<!-- for collapsed -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuBtn = document.getElementById("menu-btn");
        const leftSidebar = document.querySelector(".left-sidebar");
        const rightSidebar = document.querySelector(".right-sidebar");

        menuBtn.addEventListener("click", function () {
            leftSidebar.classList.toggle("collapsed");
            rightSidebar.classList.toggle("collapsed");
        });
    });
</script>

<!-- for active -->
<script>

    const currentPage = window.location.pathname.split("/").pop();
    document.querySelectorAll(".left-sidebar ul li a").forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
</script>

<!-- for dropdown -->
<script>
    document.querySelectorAll('.has-dropdown > a').forEach(menu => {
        menu.addEventListener('click', function (e) {
            e.preventDefault();
            const parentLi = this.parentElement;
            parentLi.classList.toggle('open');
        });
    });
</script>

<!-- for file upload -->
<script>

    document.querySelectorAll('input[type="file"]').forEach((input) => {
        input.addEventListener('change', function () {
            const label = this.nextElementSibling;
            const fileName = this.files.length > 1
                ? `${this.files.length} files selected`
                : this.files[0]?.name || "Choose file";
            label.innerHTML = `<i class="${label.querySelector('i').className}"></i> ${fileName}`;
        });
    });
</script>

<!--  for calender -->
<script>

    document.querySelectorAll('.custom-date-wrapper').forEach(wrapper => {
        wrapper.addEventListener('click', function () {
            const input = this.querySelector('input[type="date"]');
            input.showPicker?.();
            input.focus();
        });
    });
</script>

<!-- for login validation  -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('login-form');
        if (!form) return;

        const username = document.getElementById('username');
        const password = document.getElementById('password');
        const usernameerror = document.getElementById('username-error');
        const passworderror = document.getElementById('password-error');


        username.addEventListener('input', () => {
            if (username.value.trim() !== '') {
                usernameerror.style.display = 'none';
            }
        });

        password.addEventListener('input', () => {
            if (password.value.trim() !== '') {
                passworderror.style.display = 'none';
            }
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            let hasError = false;

            if (username.value.trim() === '') {
                usernameerror.textContent = "Username is required";
                usernameerror.style.display = "block";
                hasError = true;
            } else {
                usernameerror.style.display = "none";
            }

            if (password.value.trim() === '') {
                passworderror.textContent = "Password is required";
                passworderror.style.display = "block";
                hasError = true;
            } else {
                passworderror.style.display = "none";
            }

            if (!hasError) {
                window.location.href = "dashboard.php";
            }
        });
    });
</script>


<!--  for input search field -->
<script>
    $(document).ready(function () {
        $('#department').select2();
        $('#designation').select2();
        $('#joining').select2();
         $('#experience').select2();
        $('#total_experience').select2();
        $('#scheduled_by').select2();
        $('#status').select2();
        $('#interview-process').select2();

        $(document).on("change", 'select', function () {
            const val = $(this).val();
            const errorName = $(this).attr('name');
            const errorElement = $(`#error-${errorName}`);
            if (val !== "" && errorElement) {
                errorElement.text('');
            }
        });
    });
</script>