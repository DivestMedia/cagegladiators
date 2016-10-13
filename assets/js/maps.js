
jQuery(document).ready(function(){

    /**
    @MULTIPLE MARKERS GOOGLE MAP
    **/
    map3 = new GMaps({
        div: '#map3',
        lat: 14.5415872,
        lng: 121.0130077
    });

    // Marker 2
    map3.addMarker({
        lat: 14.5415872,
        lng: 121.0130077,
        title: 'Divest Media',
        infoWindow: {
            content: '<p><b>Manila Office:</b><br/>Fort Legend Tower, 3rd Ave and 31st Street, <br/>Bonifacio Global City, Taguig, Philippines <br/><b>Phone: </b>+63 917 887 8376</p>'
        }
    });


});
