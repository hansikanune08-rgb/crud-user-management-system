function validateForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();

    if (name === "") {
        alert("Name is required");
        return false;
    }

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if (!email.match(emailPattern)) {
        alert("Please enter a valid email.");
        return false;
    }

    if (phone.length != 10 || isNaN(phone)) {
        alert("Enter a valid 10-digit phone number.");
        return false;
    }

    return true;
}