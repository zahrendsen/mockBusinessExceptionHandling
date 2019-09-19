"use strict";

window.addEventListener("load", setForm);

window.addEventListener("load", function () {
    document.getElementById("subButton").onclick = runSubmit;
    document.getElementById("fname").oninput = validateFirstName;
    document.getElementById("lname").oninput = validateLastName;
    document.getElementById("email").oninput = validateEmail;
    document.getElementById("comments").oninput = validateComments;
});


function runSubmit() {
    validateFirstName();
    validateLastName();
    validateEmail();
    validateReason();
    validateComments();
}

function validateFirstName() {
    var firstName = document.getElementById("fname");
    if (firstName.validity.valueMissing) {
        firstName.setCustomValidity("Enter your first name");
    } else {
        firstName.setCustomValidity("");
    }
}

function validateLastName() {
    var lastName = document.getElementById("lname");
    if (lastName.validity.valueMissing) {
        lastName.setCustomValidity("Enter your last name");
    } else {
        lastName.setCustomValidity("");
    }
}

function validateEmail() {
    var email = document.getElementById("email");
    if (email.validity.valueMissing) {
        email.setCustomValidity("Enter your email address");
    }
    else if (/[A-Za-z0-9\.\_\-]+\@[A-Za-z0-9\.\_\-]{2,}\.[a-z]{2,3}/.test(email.value) === false) {
        email.setCustomValidity("Enter a valid email address");
    }
    else {
        email.setCustomValidity("");
    }
}


function validateReason() {
    var reason = document.getElementById("reason");
    if (reason.selectedIndex === 0) {
        reason.setCustomValidity("Please select a reason for contact");
    } else {
        reason.setCustomValidity("");
    }
}


function setForm() {
    document.forms[0].onsubmit = function () {
        if (this.checkValidity()) alert("Thank you for submitting. All data appears to be valid.");
        return false;
    }
}
