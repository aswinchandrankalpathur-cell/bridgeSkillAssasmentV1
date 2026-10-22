const form = document.getElementById("registrationForm");

form.addEventListener("submit", function (event) {

    let valid = true;

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const contact = document.getElementById("contact").value.trim();

    document.getElementById("nameError").textContent = "";
    document.getElementById("emailError").textContent = "";
    document.getElementById("contactError").textContent = "";

    if (name.length < 3) {
        document.getElementById("nameError").textContent =
            "Name must contain at least 3 characters.";
        valid = false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
        document.getElementById("emailError").textContent =
            "Enter a valid email address.";
        valid = false;
    }

        document.getElementById("contactError").textContent =
     contactPattern = /^[0-9]{10}$/;

    if (!contactPattern.test(contact)) {
        document.getElementById("contactError").textContent =
            "Contact number must contain 10 digits.";
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
    }
});