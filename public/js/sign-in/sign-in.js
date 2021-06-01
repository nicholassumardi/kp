function showPasswordSignIn() {
    if ($("#password").attr("type") === "password") {
        $("#password").attr("type", "text");
        $("#eye-slash")
            .removeClass("d-block")
            .addClass("d-none");
        $("#eye")
            .removeClass("d-none")
            .addClass("d-block");
    } else {
        $("#password").attr("type", "password");
        $("#eye-slash")
            .removeClass("d-none")
            .addClass("d-block");
        $("#eye")
            .removeClass("d-block")
            .addClass("d-none");
    }
}