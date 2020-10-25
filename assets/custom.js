$(document).on('click', '.change-img', function (e) {
    e.preventDefault();
    $(this).closest('.user-img-wrap').find('input').click();
});
$(document).on('click', '.remove-tag', function (e) {
    e.preventDefault();
    $(this).closest('.tag-input-item').remove();
});
$(document).on('click', '.imgs-preview a', function (e) {
    e.preventDefault();
    $(this).closest('.item').remove();
});
$(document).on('click', '.new-size', function (e) {
    e.preventDefault();
    if ($(this).closest('.form-group').find('input').val()) {
        $val = $(this).closest('.form-group').find('input').val();
        $('.sizes-tags-input').append('<div class="tag-input-item"><input type="hidden" name="size[]" value="' + $val + '"><a href="#" class="remove-tag"><i class="fas fa-times"></i></a><span>' + $val + '</span></div>');
    }
});
$(document).on('click', '.add-new-time a', function (e) {
    e.preventDefault();
    // var day = $(this).closest('td').find('.time').val();
    var $html = $(this).closest('td').find('.time-items').first().clone();
    $html.find('input').val('');
    $(this).closest('.add-new-time').before($html);
    $(".timepicker").timepicker({
        minuteStep: 1,
        showSeconds: false,
        showMeridian: false,
        snapToStep: true,
        timeFormat: 'h:mm p',
    })
});
$(document).on('change', '.user-img-wrap input', function (e) {
    if ($(this).val()) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.user-img-wrap img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    }
});
$(document).on('click', '.pitch-imgs-anchor', function (e) {
    e.preventDefault();
    $(this).closest('.form-group').find('input').click();
});
$(document).on('change', '#pitch-imgs', function (e) {
    if ($(this).val()) {
        uploadPitchImages(this);
    }
});

function uploadPitchImages(file) {
    var total_file = file.files.length;
    for (var i = 0; i < total_file; i++) {
        $('.imgs-preview').append("<div class='item'><a href='#'><i class='fas fa-times'></i></a><img src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");

    }
}


var map, marker;

function initialize() {


    var latitude = $('#latitude').val();
    var longitude = $('#longitude').val();
    var myLatlng = new google.maps.LatLng(latitude, longitude);
    var myOptions = {
        zoom: 7,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    // map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    placeMarker(myLatlng)
    google.maps.event.addListener(map, 'click', function (event) {
        getAddress(event.latLng)
        placeMarker(event.latLng);
    });
}

function getAddress(latLng) {
    geocoder.geocode({'latLng': latLng},
        function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    document.getElementById("address").value = results[0].formatted_address;
                } else {
                    document.getElementById("address").value = "No results";
                }
            } else {
                document.getElementById("address").value = status;
            }
        });
}

function placeMarker(location) {
    if (!marker) {
        // Create the marker if it doesn't exist
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    } else {
        marker.setPosition(location);
    }

    $('#latitude').val(location.lat());
    $('#longitude').val(location.lng());

    map.setCenter(location);
}

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 0,
    dots: false,
    nav: true,
    rtl: true,
    lazyLoad: true,
    items: 1
});

function initMap() {
    var myLatLng = {lat: -25.363, lng: 131.044};

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: myLatLng
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'ملعب الكامب نو'
    });
}
