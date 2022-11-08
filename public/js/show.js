$(document).ready(function() {
    $("#show_hide_password a").on("click", function(event) {
        event.preventDefault();
        if ($("#show_hide_password input").attr("type") == "text") {
            $("#show_hide_password input").attr("type", "password");
            $("#show_hide_password i").addClass("fa-eye-slash");
            $("#show_hide_password i").removeClass("fa-eye");
        } else if ($("#show_hide_password input").attr("type") == "password") {
            $("#show_hide_password input").attr("type", "text");
            $("#show_hide_password i").removeClass("fa-eye-slash");
            $("#show_hide_password i").addClass("fa-eye");
        }
    });

    $("#show_hide_re_password a").on("click", function(event) {
        event.preventDefault();
        if ($("#show_hide_re_password input").attr("type") == "text") {
            $("#show_hide_re_password input").attr("type", "password");
            $("#show_hide_re_password i").addClass("fa-eye-slash");
            $("#show_hide_re_password i").removeClass("fa-eye");
        } else if (
            $("#show_hide_re_password input").attr("type") == "password"
        ) {
            $("#show_hide_re_password input").attr("type", "text");
            $("#show_hide_re_password i").removeClass("fa-eye-slash");
            $("#show_hide_re_password i").addClass("fa-eye");
        }
    });

    $("#show_hide_key_id a#a_show_key").on("click", function(event) {
        event.preventDefault();
        if ($("#show_hide_key_id input").attr("type") == "text") {
            $("#show_hide_key_id input").attr("type", "password");
            $("#show_hide_key_id i#show_key").addClass("fa-eye-slash");
            $("#show_hide_key_id i#show_key").removeClass("fa-eye");
        } else if ($("#show_hide_key_id input").attr("type") == "password") {
            $("#show_hide_key_id input").attr("type", "text");
            $("#show_hide_key_id i#show_key").removeClass("fa-eye-slash");
            $("#show_hide_key_id i#show_key").addClass("fa-eye");
        }
    });

    $("#show_hide_key_id a#a_copy_key").on("click", function(event) {
        // event.preventDefault();
        copyText("key_id", "a_copy_key");
    });

    $("#show_hide_access_key a#a_show_access").on("click", function(event) {
        event.preventDefault();
        if ($("#show_hide_access_key input").attr("type") == "text") {
            $("#show_hide_access_key input").attr("type", "password");
            $("#show_hide_access_key i#show_access").addClass("fa-eye-slash");
            $("#show_hide_access_key i#show_access").removeClass("fa-eye");
        } else if (
            $("#show_hide_access_key input").attr("type") == "password"
        ) {
            $("#show_hide_access_key input").attr("type", "text");
            $("#show_hide_access_key i#show_access").removeClass(
                "fa-eye-slash"
            );
            $("#show_hide_access_key i#show_access").addClass("fa-eye");
        }
    });

    $("#show_hide_access_key a#a_copy_access").on("click", function(event) {
        event.preventDefault();
        copyText("access_key", "a_copy_access");
    });
});

function copyText(id, id_button) {
    // Select elements
    const target = document.getElementById(id);
    const button = document.getElementById(id_button);

    // Init clipboard -- for more info, please read the offical documentation: https://clipboardjs.com/
    var clipboard = new ClipboardJS(button, {
        target: target,
        text: function() {
            return target.value;
        }
    });

    // Success action handler
    clipboard.on('success', function(e) {
        const currentLabel = button.innerHTML;

        // Exit label update when already in progress
        if (button.innerHTML === 'Copiado!') {
            return;
        }

        // Update button label
        button.innerHTML = 'Copiado!';

        // Revert button label after 3 seconds
        setTimeout(function() {
            button.innerHTML = currentLabel;
        }, 3000)
    });
}