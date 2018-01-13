//alert("as");
//$.ajaxSetup({
//    headers: {
//        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//    }
//});
function checkInPositionRecieved(position) {
        var _token = $('input[name="_token"]').val();
        var lat =position.coords.latitude;
        var long =position.coords.longitude;
        var data_token = {'_token': _token,'lat':lat,'long':long};
        console.log(data_token);
        $.ajax({
            type: "POST",
            url: "/checkin",
            data: data_token,
            success: function (data) {
                alert("ok");
                if (data == 1)
                {
                    $("#login_tag").html('<a href="/logout"><i class="fa fa-picture-o"> </i>Logout</a>');
                    $('#myModal').modal('hide');
                } else {

                }
            }
        });
}
function checkOutPositionRecieved(position) {
        var _token = $('input[name="_token"]').val();
        var lat =position.coords.latitude;
        var long =position.coords.longitude;
        var data_token = {'_token': _token,'lat':lat,'long':long};
        console.log(data_token);
        $.ajax({
            type: "POST",
            url: "/checkout",
            data: data_token,
            success: function (data) {
                alert("ok");
                if (data == 1)
                {
                    $("#login_tag").html('<a href="/logout"><i class="fa fa-picture-o"> </i>Logout</a>');
                    $('#myModal').modal('hide');
                } else {

                }
            }
        });
}
function check_in() {
    $('#checkin_form').submit(function (e) {
        console.log( "========" );
        console.log( $( this ).serialize() );
        e.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(checkInPositionRecieved);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });
}
function check_out() {
    $('#checkout_form').submit(function (e) {
        console.log( "========" );
        console.log( $( this ).serialize() );
        e.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(checkOutPositionRecieved);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });
}

function showPosition(position) {
    console.log("working Here");
    console.log("position: ");
    console.log(position);
    console.log("Latitude: " + position.coords.latitude);
    console.log("Longitude: " + position.coords.longitude);
    return position;
}
