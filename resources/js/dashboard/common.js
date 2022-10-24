require("./components/school-reports-grades-editable-grid");

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

$(".delete").on("click", function () {
    var ulrDel = $(this).attr("url-del");

    $.confirm({
        // theme: "supervan",
        type: "red",
        title: "Confirmar exclusão",
        content:
            "Atenção, após excluir o registro o mesmo não poderá ser recuperado. Deseja excluir o registro?",
        buttons: {
            confirm: {
                text: "Sim, confirmar exclusão",
                action: function () {
                    window.location = ulrDel;
                },
            },
            cancel: {
                text: "Não",
            },
        },
    });
});
