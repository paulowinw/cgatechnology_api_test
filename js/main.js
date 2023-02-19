function createDataSource(data = null) {
    // Loading data for KendoUiList
    const dataSource = new kendo.data.DataSource({
        transport: {
            read: {
                url: "incidents-list-design-patterns.php",
                data: data,
                dataType: "json",
            },
        },
        pageSize: 4,
    });

    return dataSource;
}

function loadDatePickers() {
    // create DatePicker from input HTML element
    $("#start-date").kendoDatePicker();
    $("#end-date").kendoDatePicker();

    const date = new Date();
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    const currentDate = `${day}/${month}/${year}`;
    $("#end-date").val(currentDate);
}

$(document).ready(function () {

    const dataSource = createDataSource();

    loadDatePickers();

    $("#listView").kendoListView({
        dataSource: dataSource,
        selectable: true,
        navigatable: true,
        pageable: true,
        template: kendo.template($("#template").html())
    }).data("kendoListView");

    $("#btn-filter-incident").click(function() {
        const startDate = $("#start-date").val();
        const endDate = $("#end-date").val();
        const postData = {
            'startDate': startDate,
            'endData': endDate
        };

        let dataSource = createDataSource(postData);
        let listView = $("#listView").data("kendoListView");

        listView.setDataSource(dataSource);
        listView._pageable();
    });
});

$(document.body).keydown(function (e) {
    if (e.altKey && e.keyCode == 87) {
        $("#listView").focus();
    }
});