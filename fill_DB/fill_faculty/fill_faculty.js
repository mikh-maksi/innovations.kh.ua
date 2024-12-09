
$(document).ready(function ()
{
    $(document).on("click", "#submit-faculty", function (event)
    {
        event.preventDefault();

        var faculty = $("#faculty").val();
        var specialty = $("#specialty").val();
        var group = $("#group").val();

        var send = "query_type=" + "fill_faculty" + "&faculty=" + faculty + "&specialty=" + specialty + "&group=" + group;

        $.ajax(
            {
                type: 'POST',
                url: 'fill_faculty.php',
                data: send
            }
        ).done(function (response)
        {
            if (response == "200")
            {
                $("#faculty").val("");
                $("#specialty").val("");
                $("#group").val("");

                if ($('#checkbox-faculty').is(':checked'))
                {
                    $("#faculty").val(faculty);
                }

                if ($('#checkbox-specialty').is(':checked'))
                {
                    $("#specialty").val(specialty);
                }

                $("#error").html("Successful!");
            }
            else
            {
                $("#error").html("Server error => " + response);
            }
        });
    });
});