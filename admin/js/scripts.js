$(document).ready( function() {


    //CKEDITOR
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    $('#selectAllBoxes').click(function (event) {
        if(this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            });
        }
    });

    var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    $("body").prepend(div_box);

    $('#load-screen').delay(100).fadeOut(500, function () {
        $(this).remove();
    })



});

function loadUsersOnline() {

    $.get("functions.php?onlineusers=result", function (data) {
        $(".usersonline").text(data);


    })

}

loadUsersOnline();
