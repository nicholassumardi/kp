$(function() {
    $("#show-hide-password").on("click", function() {
        const password = $("#password");
        const eyeSlash = $("#eye-slash");
        const eye = $("#eye");

        if (password.attr("type") === "password") {
            password.attr("type", "text");
            eyeSlash.removeClass("d-block").addClass("d-none");
            eye.removeClass("d-none").addClass("d-block");
        } else {
            password.attr("type", "password");
            eye.removeClass("d-block").addClass("d-none");
            eyeSlash.removeClass("d-none").addClass("d-block");
        }
    });
});