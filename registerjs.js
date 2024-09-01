document.addEventListener("DOMContentLoaded", function () {
    // Get the input fields
    const officeInput = document.getElementById("office");
    const passcodeInput = document.getElementById("Office_passcode");

    // Attach event listeners to the input fields for validation
    officeInput.addEventListener("input", validateOffice);
    passcodeInput.addEventListener("input", validatePasscode);

    // Attach event listener to the form submission
    document.getElementById("officeForm").addEventListener("submit", function (event) {
        if (!validateInputs()) {
            event.preventDefault(); // Prevent form submission if inputs are invalid
        }
    });

    function validateOffice() {
        const officePattern = /^(VPAA|vpaa|CITL|citl)$/;
        if (!officePattern.test(officeInput.value)) {
            // Display error message inside the input field
            officeInput.setCustomValidity("Office doesn't exist!"); // Set custom validity message
            officeInput.reportValidity(); // Show the error message as a tooltip
        } else {
            officeInput.setCustomValidity(""); // Clear custom validity
        }
    }

    function validatePasscode() {
        const passcodePattern = /^(123|321)$/;
        if (!passcodePattern.test(passcodeInput.value)) {
            // Display error message inside the input field
            passcodeInput.setCustomValidity("Wrong passcode for office!"); // Set custom validity message
            passcodeInput.reportValidity(); // Show the error message as a tooltip
        } else {
            passcodeInput.setCustomValidity(""); // Clear custom validity
        }
    }

    function validateInputs() {
        // Run individual validation functions
        validateOffice();
        validatePasscode();

        // Return false if either input has invalid state
        return officeInput.checkValidity() && passcodeInput.checkValidity();
    }
});