const userInsertOrUpdate = ({ data }) => {
    let apiUrl = !!data.id
        ? `/api/publics/school/report/grades/${data.id}`
        : `/api/publics/school/report/grades`;
    let type = data.id ? "PUT" : "POST";
    let baseUrl = window.location.origin;

    return api.returnPromise(data, apiUrl, type, baseUrl);
};

const userDelete = ({ data }) => {
    let apiUrl = `/api/publics/school/report/grades/${data.id}`;
    let type = "DELETE";
    let baseUrl = window.location.origin;

    return api.returnPromise(data, apiUrl, type, baseUrl);
};

//bootstable.js
/*
    Bootstable
    @description  Javascript library to make HMTL tables editable, using Bootstrap
    @version 1.1
    @autor Tito Hinostroza
    */
("use strict");
//Global variables
let params = null; //Parameters
let colsEdi = null;
const newColHtml =
    '<div class="btn-group pull-right">' +
    '<button id="bEdit" type="button" class="btn btn-sm btn-default" onclick="rowEdit(this);">' +
    '<span class="bi bi-pencil h6"> </span>' +
    "</button>" +
    '<button id="bElim" type="button" class="btn btn-sm btn-default" onclick="rowElim(this);">' +
    '<span class="bi bi-trash h6"> </span>' +
    "</button>" +
    '<button id="bAcep" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowAcep(this);">' +
    '<span class="bi bi-check-circle h6"> </span>' +
    "</button>" +
    '<button id="bCanc" type="button" class="btn btn-sm btn-default" style="display:none;" onclick="rowCancel(this);">' +
    '<span class="bi bi-x-circle h6"> </span>' +
    "</button>" +
    "</div>";
const colEdicHtml =
    '<td name="buttons" class="table-buttons">' + newColHtml + "</td>";

$.fn.SetEditable = function (options) {
    const defaults = {
        columnsEd: null, //Index to editable columns. If null all td editables. Ex.: "1,2,3,4,5"
        $addButton: null, //Jquery object of "Add" button
        onEdit: function () {}, //Called after edition
        onBeforeDelete: function () {}, //Called before deletion
        onDelete: function () {}, //Called after deletion
        onAdd: function () {}, //Called when added a new row
    };

    params = $.extend(defaults, options);
    this.find("thead tr").append(
        '<th name="buttons" class="col-lg-1 text-center">Ações</th>'
    );

    this.find("tbody tr").append(colEdicHtml);
    const $tabedi = this;
    if (params.$addButton != null) {
        params.$addButton.click(function () {
            rowAddNew($tabedi.attr("id"));
        });
    }

    if (params.columnsEd != null) {
        colsEdi = params.columnsEd.split(",");
    }
};

const IterarCamposEdit = (cols, tarea) => {
    const EsEditable = (idx) => {
        if (colsEdi == null) {
            return true;
        } else {
            for (const i = 0; i < colsEdi.length; i++) {
                if (idx == colsEdi[i]) return true;
            }
            return false;
        }
    };

    var n = 0;
    cols.each(function () {
        n++;
        if ($(this).attr("name") == "buttons") return;
        if (!EsEditable(n - 1)) return;
        tarea($(this));
    });
};
const FijModoNormal = (but) => {
    $(but).parent().find("#bAcep").hide();
    $(but).parent().find("#bCanc").hide();
    $(but).parent().find("#bEdit").show();
    $(but).parent().find("#bElim").show();
    const row = $(but).parents("tr");
    row.attr("id", "");
};

const FijModoEdit = (but) => {
    $(but).parent().find("#bAcep").show();
    $(but).parent().find("#bCanc").show();
    $(but).parent().find("#bEdit").hide();
    $(but).parent().find("#bElim").hide();
    const row = $(but).parents("tr");
    row.attr("id", "editing");
};

const ModoEdicion = (row) => {
    if (row.attr("id") == "editing") {
        return true;
    } else {
        return false;
    }
};

window.rowAcep = (but) => {
    const table = $("#table-coop-details");
    const row = $(but).parents("tr");
    const cols = row.find("td");

    if (!ModoEdicion(row)) return;

    let fields = {};
    IterarCamposEdit(cols, function (td) {
        let cont =
            td.data("type") == "select"
                ? td.find(td.data("type")).val()
                : td.find("input").val();
        fields[td.data("name")] = cont;
    });

    if (!!Object.keys(fields).length) {
        const ulrId = row.attr("data-url-uuid");
        if (!!ulrId) fields["id"] = ulrId;
        fields["user_id"] = table.attr("data-school-report-id");
        userInsertOrUpdate({ data: fields })
            .then((json) => {
                IterarCamposEdit(cols, function (td) {
                    let cont =
                        td.data("type") == "select"
                            ? td.find(td.data("type")).val()
                            : td.find("input").val();
                    if (td.data("type") == "input") {
                        td.html(cont);
                        td.attr("data-val", cont);
                    } else if (td.data("type") == "select") {
                        const dataMaster = td.attr("for");
                        const data = $(`#${dataMaster}`).data("val");

                        td.html(data[cont] ?? "");
                        // td.html(cont == 1 ? "Master admin" : "Admin");
                        td.attr("data-val", cont);
                    } else if (td.data("type") == "password") {
                        td.html("");
                    }
                });
                if (!row.attr("data-url-uuid")) {
                    row.attr("data-url-uuid", json.user.id || json.id);
                }
                FijModoNormal(but);
                params.onEdit(row);
            })
            .catch((error) => {
                if (error.status === 400) {
                    $.alert({
                        title: "Atenção!",
                        type: "orange",
                        content: error.responseJSON.join("<br> "),
                    });
                } else if (error.status === 500) {
                    $.alert({
                        title: "Erro!",
                        type: "red",
                        content: error.responseJSON.message,
                    });
                } else {
                    $.alert({
                        title: `Erro ${error.status}`,
                        type: "red",
                        content:
                            "Tente novamente mais tarde, ou entre em contato com o suporte.",
                    });
                }
            });
    }
};

window.rowCancel = (but) => {
    const row = $(but).parents("tr");
    const cols = row.find("td");

    if (!ModoEdicion(row)) return;

    IterarCamposEdit(cols, function (td) {
        let cont = td.find(td.data("type")).val();
        if (td.data("type") == "input") {
            td.html(cont);
            td.attr("data-val", cont);
        } else if (td.data("type") == "select") {
            const dataMaster = td.attr("for");
            const data = $(`#${dataMaster}`).data("val");

            td.html(data[cont] ?? "");
            td.attr("data-val", cont);
        } else if (td.data("type") == "password") {
            td.html("");
        }
    });

    const ulrId = row.attr("data-url-uuid");
    if (!!ulrId) {
        FijModoNormal(but);
    } else {
        rowElim(but);
    }
};

window.rowEdit = (but) => {
    const row = $(but).parents("tr");
    const cols = row.find("td");

    if (ModoEdicion(row)) return;

    IterarCamposEdit(cols, function (td) {
        const cont = td.attr("data-val") ?? "";
        const classTd = td.attr("class") ?? "";
        const div = `<div style="display: none;">${cont}</div>`;

        if (td.data("type") == "input") {
            const field = `<input class="form-control input-sm ${classTd}" value="${cont}">`;
            td.html(div + field);
            // td.attr("data-val", cont);
        } else if (td.data("type") == "select") {
            const dataMaster = td.attr("for");
            const data = $(`#${dataMaster}`).data("val");

            const options = Object.keys(data)
                .map((key) => {
                    return `<option value="${key}"${
                        cont == key ? "selected" : ""
                    }>${data[key]}</option>`;
                })
                .join("");

            const field = `<select class="form-control input-sm ${classTd}"><option value=""></option>${options}</select>`;

            td.html(div + field);
            // td.attr("data-val", cont);
        } else if (td.data("type") == "password") {
            td.html("");
        }
    });
    FijModoEdit(but);
};

window.rowElim = (but) => {
    const table = $("#table-coop-details");
    const row = $(but).parents("tr");
    const cols = row.find("td");
    const ulrId = row.attr("data-url-uuid");

    if (!!ulrId) {
        $.confirm({
            type: "red",
            title: "Confirmar exclusão",
            content:
                "Atenção, após excluir o registro o mesmo não poderá ser recuperado. Deseja excluir o registro?",
            buttons: {
                confirm: {
                    text: "Sim, confirmar exclusão",
                    action: () => {
                        let fields = {};
                        if (!!ulrId) fields["id"] = row.attr("data-url-uuid");
                        fields["user_id"] = table.attr("data-school-report-id");

                        userDelete({ data: fields })
                            .then((json) => {
                                params.onBeforeDelete(row);
                                row.remove();
                                params.onDelete();
                            })
                            .catch((error) => {
                                if (error.status === 400) {
                                    $.alert({
                                        title: "Atenção!",
                                        type: "orange",
                                        content:
                                            error.responseJSON.join("<br> "),
                                    });
                                } else if (error.status === 500) {
                                    $.alert({
                                        title: "Erro!",
                                        type: "red",
                                        content: error.responseJSON.message,
                                    });
                                } else {
                                    $.alert({
                                        title: `Erro ${error.status}`,
                                        type: "red",
                                        content:
                                            "Tente novamente mais tarde, ou entre em contato com o suporte.",
                                    });
                                }
                            });
                    },
                },
                cancel: {
                    text: "Não",
                },
            },
        });
    } else {
        params.onBeforeDelete(row);
        row.remove();
        params.onDelete();
    }
};

window.rowAddNew = (tabId) => {
    const tab_en_edic = $("#" + tabId);
    const filas = tab_en_edic.find("tbody tr");

    if (!filas.length) {
        const row = tab_en_edic.find("thead tr");
        const cols = row.find("th");
        let htmlDat = "";
        cols.each(function () {
            if ($(this).attr("name") == "buttons") {
                htmlDat = htmlDat + colEdicHtml;
            } else {
                htmlDat =
                    htmlDat +
                    `<td data-name="${$(this).attr(
                        "data-name"
                    )}" data-type="${$(this).attr(
                        "data-type"
                    )}" data-val=""></td>`;
            }
        });
        tab_en_edic.find("tbody").append("<tr>" + htmlDat + "</tr>");
    } else {
        let ultFila = tab_en_edic.find("tr:last");
        ultFila.clone().appendTo(ultFila.parent());
        ultFila = tab_en_edic.find("tr:last").removeAttr("data-url-uuid");
        const cols = ultFila.find("td");
        cols.each(function () {
            if (!($(this).attr("name") == "buttons")) {
                $(this).html("");
                // $(this).data("val", "");
                $(this).removeAttr("data-val");
            }
        });
    }
    params.onAdd();
    rowEdit(tab_en_edic.find("tbody tr").last().find("#bEdit"));
};

$("#school-reports-grades-table-list").SetEditable({
    $addButton: $("#add"),
});
