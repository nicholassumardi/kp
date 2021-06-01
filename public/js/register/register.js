function showPasswordRegister() {
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

function changeProfilePictureInput() {
    var input = $("#profile-picture-browse")[0];

    if (input.files && input.files[0]) {
        var fileReader = new FileReader();

        fileReader.onload = function (e) {
            $("#profile-picture-view")
                .attr("src", e.target.result)
                .width(250)
                .height(250);
        };

        fileReader.readAsDataURL(input.files[0]);
    }
}