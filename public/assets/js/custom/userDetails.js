$(document).on("change", ".select_country", function () {
    let country = $(this).val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: APP_URL + "/ajax/state-by-country",
        data: {
            id: country,
        },
        success: function (response) {
            var statehtml = "";
            if (response.status == true) {
                response.data.forEach((element) => {
                    statehtml +=
                        `<option value="` +
                        element.id +
                        `">` +
                        element.name +
                        `</option>`;
                });
                $(".select_state").html(statehtml);
            } else {
                $(".select_state").html(
                    `<option value="">---Select---</option>`
                );
            }
        },
        error: function (errorResponse) {
            $(".select_state").html(`<option value="">---Select---</option>`);
        },
    });
});

$(document).on("change", ".select_state", function () {
    let state = $(this).val();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: APP_URL + "/ajax/city-by-state",
        data: {
            id: state,
        },
        success: function (response) {
            var cityhtml = "";
            if (response.status == true) {
                response.data.forEach((element) => {
                    cityhtml +=
                        `<option value="` +
                        element.id +
                        `">` +
                        element.name +
                        `</option>`;
                });
                $(".select_city").html(cityhtml);
            } else {
                $(".select_city").html(
                    `<option value="">---Select---</option>`
                );
            }
        },
        error: function (errorResponse) {
            $(".select_city").html(`<option value="">---Select---</option>`);
        },
    });
});

$(document).ready(function () {
    if ($("#userDetails").length > 0) {
        $("#userDetails").validate({
            errorClass: "text-danger",
            errorElement: "span",
            rules: {
                name: {
                    required: true,
                },
                city_id: {
                    required: true,
                },
                state_id: {
                    required: true,
                },
                select_country: {
                    required: true,
                },
                zip_code: {
                    required: true,
                    minlength: 7,
                    maxlength: 7,
                    digits: true,
                },
                class: {
                    required: true,
                },
                date: {
                    required: true,
                    date: true,
                },
                address: {
                    required: true,
                },
                profile_images: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Please enter your name.",
                },
                city_id: {
                    required: "Please select a city.",
                },
                state_id: {
                    required: "Please select a state.",
                },
                select_country: {
                    required: "Please select a country.",
                },
                zip_code: {
                    required: "Please enter your zip code.",
                    digits: "Please enter a valid zip code.",
                    minlength: "Zip code must be at least 7 digits.",
                    maxlength: "Zip code cannot be more than 7 digits.",
                },
                class: {
                    required: "Please enter your class.",
                },
                date: {
                    required: "Please enter your date of birth.",
                    date: "Please enter a valid date.",
                },
                address: {
                    required: "Please enter your address.",
                },
                profile_images: {
                    required: "Please upload a profile image.",
                },
            },
            submitHandler: function (form) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                });
                var data = new FormData($("#userDetails")[0]);
                $.ajax({
                    url: APP_URL + "/ajax/add-user-details",
                    type: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $("#submit").attr("disabled", false);
                        swal.fire(
                            "User Details Successfully",
                            response.message,
                            "success"
                        ).then(function () {
                            location.href = APP_URL + "/";
                        });
                    },
                    error: function (response) {
                        $(".control-sidebar").hide();
                        swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            error: response,
                        });
                    },
                });
            },
        });
    }
});
