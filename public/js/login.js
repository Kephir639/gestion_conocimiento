$(document).ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('estado') && urlParams.get('estado') === 'false') {
        $.ajax({
            type: "GET",
            url: "/check",
            success: function (data) {
                $('#divContainer').append(data);
            }
        });
    }
});
