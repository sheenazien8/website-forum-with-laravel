$(document).ready(function() {
    var counter = 0;
    $("#add_tag").on('click', function(event) {
        event.preventDefault();
        /* Act on the event */
        counter++
        if (counter < 3) {
            $("#tag_select").clone().appendTo("#wrap")
        }
    });
});