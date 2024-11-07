var baseUrl = APP_URL + "/";
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
let commonFirstDataColumn = [{ data: "id", name: "id" }];

let usersDataColumn = [
    ...commonFirstDataColumn,
    ...[
        { data: "image", name: "image", sClass: "w-10" },
        { data: "name", name: "name", sClass: "w-10" },
        { data: "dob", name: "dob", sClass: "w-10" },
        { data: "class", name: "class", sClass: "w-10" },
        { data: "address", name: "address", sClass: "w-10" },
        { data: "zip_code", name: "zip_code", sClass: "w-10" },
        { data: "country_id", name: "country_id", sClass: "w-10" },
        { data: "state_id", name: "state_id", sClass: "w-10" },
        { data: "city_id", name: "city_id", sClass: "w-10" },
    ],
];
let parentDetailsDataColumn = [
    ...commonFirstDataColumn,
    ...[
        { data: "name", name: "name", sClass: "w-10" },
        { data: "relation", name: "relation", sClass: "w-10" },
        { data: "phone", name: "phone", sClass: "w-10" },
    ],
];
let usersTable = $("#usersTable").DataTable({
    responsive: true,
    searching: false,
    lengthChange: false,
    language: {
        lengthMenu: "Counts per page_MENU_",
        searchPlaceholder: "Search by name",
    },
    autoWidth: false,
    processing: true,
    serverSide: true,
    ajax: {
        url: baseUrl + "ajax/fetchUserDetails",
        dataType: "json",
        type: "get",
        data: function (d) {
            return $.extend({}, d, {});
        },
    },
    columns: usersDataColumn,
    dom: '<".d-flex"<".col-6" l><".col-6 text-right" f>>t<".d-flex"<".col-6" i><".col-6 text-right"p>>',
    ordering: true,
    fnDrawCallback: function (oSettings) {
        let pagination = $(oSettings.nTableWrapper).find(
            ".dataTables_paginate,.dataTables_info,.dataTables_length"
        );
        oSettings._iDisplayLength > oSettings.fnRecordsDisplay()
            ? pagination.hide()
            : pagination.show();
    },
    createdRow: function (row, data, dataIndex) {
        $(row).addClass("manage-enable");
        if (data.is_active) {
            $(row).addClass("block-disable");
        }
    },
});
let parentDetailsTable = $("#parentDetailsTable").DataTable({
    responsive: true,
    searching: false,
    lengthChange: false,
    language: {
        lengthMenu: "Counts per page_MENU_",
        searchPlaceholder: "Search by name",
    },
    autoWidth: false,
    processing: true,
    serverSide: true,
    ajax: {
        url: baseUrl + "ajax/fetchUserParentDetails/" + id,
        dataType: "json",
        type: "get",
        data: function (d) {
            return $.extend({}, d, {
                // id: id,
            });
        },
    },
    columns: parentDetailsDataColumn,
    dom: '<".d-flex"<".col-6" l><".col-6 text-right" f>>t<".d-flex"<".col-6" i><".col-6 text-right"p>>',
    ordering: true,
    fnDrawCallback: function (oSettings) {
        let pagination = $(oSettings.nTableWrapper).find(
            ".dataTables_paginate,.dataTables_info,.dataTables_length"
        );
        oSettings._iDisplayLength > oSettings.fnRecordsDisplay()
            ? pagination.hide()
            : pagination.show();
    },
    createdRow: function (row, data, dataIndex) {
        $(row).addClass("manage-enable");
        if (data.is_active) {
            $(row).addClass("block-disable");
        }
    },
});
