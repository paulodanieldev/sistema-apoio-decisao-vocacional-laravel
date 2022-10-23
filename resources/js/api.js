window.api = {
    post: function (FormData, param, return_f) {
        var include_path = $("base").attr("base");
        $.ajax({
            url: include_path + param.api_url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            dataType: "json",
            data: FormData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".button")
                    .html("<i class='fa fa-spinner fa-spin'></i> Carregando...")
                    .prop("disabled", true);
            },
            success: function (json) {
                $(".button").html(`${param.label}`).prop("disabled", false);
                return_f(json);
            },
            error: function (json) {
                $(".button").html(`${param.label}`).prop("disabled", false);
                return_f(json);
            },
        });
    },
    postClick: function (data, param, return_f) {
        var include_path = $("base").attr("base");
        $.ajax({
            url: include_path + param.api_url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function () {
                $(".button-click")
                    .html("<i class='fa fa-spinner fa-spin'></i> Carregando...")
                    .prop("disabled", true);
            },
            success: function (json) {
                $(".button-click")
                    .html(`${param.label}`)
                    .prop("disabled", false);
                return_f(json);
            },
            error: function (json) {
                $(".button-click")
                    .html(`${param.label}`)
                    .prop("disabled", false);
                return_f(json);
            },
        });
    },
    postGeneral: function (data, param, return_f) {
        var include_path = $("base").attr("base");
        $.ajax({
            url: include_path + param.api_url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            dataType: "json",
            data: data,
            success: function (json) {
                return_f(json);
            },
        });
    },
    returnPostClick: function (data, param, return_f) {
        var include_path = $("base").attr("base");
        return $.ajax({
            url: include_path + param.api_url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function () {
                $(".button-click")
                    .html("<i class='fa fa-spinner fa-spin'></i> Carregando...")
                    .prop("disabled", true);
            },
            success: function (json) {
                $(".button-click")
                    .html(`${param.label}`)
                    .prop("disabled", false);
                return_f(json);
            },
            error: function (json) {
                $(".button-click")
                    .html(`${param.label}`)
                    .prop("disabled", false);
                return_f(json);
            },
        });
    },
    returnPromise: function (
        data,
        url,
        type = "POST",
        baseUrl = null,
        headers = null
    ) {
        var include_path = baseUrl ? baseUrl : $("base").attr("base");

        return new Promise((resolve, reject) => {
            $.ajax({
                url: include_path + url,
                headers: !headers
                    ? {
                          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                              "content"
                          ),
                      }
                    : headers,
                type: type,
                dataType: "json",
                data: data,
            })
                .done((json) => resolve(json))
                .fail((error) => reject(error));
        });
    },
};
