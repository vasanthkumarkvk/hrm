<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



</head>

<body class="free-registraion-form-page">

    <div class="container">
        <div class="row justify-content-center">
            <div class="card-width shadow p-4">
                <h3 class="text-center mb-4">Sign Up for Productivity</h3>

                <form id="signupForm">
                    <div id="errorMessage"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"><span class="must-typed">* </span>First Name</label>
                                <input type="text" class="form-control" id="first_name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><span class="must-typed">* </span>Last Name</label>
                                <input type="text" class="form-control" id="last_name" required>
                            </div>

                            <div class="mb-3">
    <label class="form-label"><span class="must-typed">* </span>Email</label>
    <div class="input-group">
        <input type="email" class="form-control" id="email" required>
    </div>
</div>

                        
                        </div>

                        <div class="col-md-6">

                        <div class="mb-3">
                                <label class="form-label"><span class="must-typed">* </span>Company Name</label>
                                <input type="text" class="form-control" id="company_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><span class="must-typed">* </span>Country</label>
                                <input type="text" class="form-control" id="country" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><span class="must-typed">* </span>Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="mb-3">
    <label class="form-label"><span class="must-typed">* </span>Domain</label>
    <div class="input-group" id="domain-validate">
        <span class="input-group-text">http://</span>
        <input type="text" class="form-control" id="domain" required>
        <span class="input-group-text">.maindomain.in</span>
    </div>
</div>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">I agree to the <a href="#">privacy policy</a> & <a href="#">terms</a>.</label>
                    </div>

                  <div class="submit-button">
                  <button type="submit" class="submit-button ">Sign Up</button>
                  </div>

                </form>

                <div class="google-buttons">
                   <a href="#"><img src="{{ asset('images/google-image.png')}}" loading="lazy" alt="google-logo">Sign Up With Google</a> 
                </div>
            </div>

        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Signup successful!
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/userlogin/login') }}" class="btn btn-primary">OK</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS & Axios -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("signupForm");
    const submitButton = document.querySelector(".submit-button button");
    const inputs = form.querySelectorAll("input[required]");
    const errorMessage = document.getElementById("errorMessage");
    let validationStatus = { email: null, domain: null };

    function checkInputs() {
        let allFilled = true;
        let allValid = true;

        inputs.forEach(input => {
            if (input.value.trim() === "") {
                allFilled = false;
            }
        });

        if (validationStatus.email === false || validationStatus.domain === false) {
            allValid = false;
        }

        submitButton.disabled = !(allFilled && allValid);
    }

    inputs.forEach(input => {
        input.addEventListener("input", checkInputs);
    });

    const emailInput = document.getElementById("email");
    const domainInput = document.getElementById("domain");

    emailInput.addEventListener("input", () => validateField(emailInput, "email"));
    domainInput.addEventListener("input", () => validateField(domainInput, "domain"));

    async function validateField(input, type) {
        const value = input.value.trim();
        if (value === "") {
            setValidationStatus(input, null);
            validationStatus[type] = null;
            checkInputs();
            return;
        }

        try {
            const response = await axios.post("http://127.0.0.1:8000/api/check-field", {
                [type]: value
            });

            if (response.data.exists) {
                setValidationStatus(input, false);
                validationStatus[type] = false;
            } else {
                setValidationStatus(input, true);
                validationStatus[type] = true;
            }

            checkInputs();
        } catch (error) {
            console.error("Validation Error:", error);
        }
    }

    function setValidationStatus(input, status) {
        let parent = input.parentElement;
        let icon = parent.querySelector(".validation-icon");

        if (!icon) {
            icon = document.createElement("span");
            icon.classList.add("validation-icon");
            parent.appendChild(icon);
        }

        if (status === true) {
            icon.innerHTML = "✅";
            icon.style.color = "green";
        } else if (status === false) {
            icon.innerHTML = "❌";
            icon.style.color = "red";
        } else {
            icon.innerHTML = "";
        }
    }

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        let formData = {
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            email: document.getElementById('email').value,
            company_name: document.getElementById('company_name').value,
            country: document.getElementById('country').value,
            mobile: document.getElementById('mobile').value,
            domain: document.getElementById('domain').value,
        };

        try {
    let response = await axios.post('http://127.0.0.1:8000/api/free_user_register', formData);
    console.log("Response:", response); // Debugging
    
    if (response.status === 201) {
        // Show the Bootstrap modal
        let successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();

        // Clear all input fields
        form.reset();
        validationStatus = { email: null, domain: null };
        checkInputs();
    }
} catch (error) {
    console.error("Error:", error);
}

    });

    checkInputs();
});

    </script>

</body>

</html>