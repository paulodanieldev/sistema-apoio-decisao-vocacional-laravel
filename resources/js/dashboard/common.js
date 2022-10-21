import $ from "jquery";

$("#profile_image").on("change", function (e) {
    for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {
        var file = e.originalEvent.srcElement.files[i];

        var img = document.querySelector("#profile_image_preview");
        var reader = new FileReader();
        reader.onloadend = function () {
            img.src = reader.result;
        };
        reader.readAsDataURL(file);

        var del_checkbox = document.querySelector("#delete_profile_image");
        del_checkbox.checked = false;
    }
});
