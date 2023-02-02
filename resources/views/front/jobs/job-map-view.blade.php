@extends('front.layouts.Dispatch-layout')

@section('page-title',"Jobs Map View")

@section('css')
    <style>
        /*my css*/
    </style>
@stop

@section('content')
    <main id="main" class="page-dispatch" data-page="dispatch">
        <div class="pg-container container-fluid">
            <div id="main_content_area" class="style_2">
                <div class="heading_area">
                    <div class="container">
                        <div class="hgroup divider-after center align-center">
                            <h1 class="lh-10">Joey Route View</h1>
                        </div>
                    </div>
                </div>
                <div class="disp_map_view_wrap">
                    <div class="row no-gutters">
                        <aside id="left_sidebar" class="col-12 col-lg-4">
                            <div class="inner">
                                <div class="widget_sidebar widget_filter">
                                    <div class="widgetInfo">
                                        <form action="" id="filter-summary" class="needs-validation" novalidate>
                                            <div class="form-group no-min-h">
                                                <label for="endDate">Job Route</label>
                                                <select id="job_id" name="job_id[]"
                                                        data-placeholder="Please Select Option"
                                                        class="form-control">
                                                    @foreach($joeys as $joey)
                                                        <option value="{{ $joey->id }}">{{ $joey->first_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="btn-group nomargin align-right">
                                                <button type="button" id="go" value="Draw Path"
                                                        class="btn btn-primary btn-xs submitButton mb-fluid mb-align-center">
                                                    Filter
                                                </button>
                                            </div>
                                            <div class="orders_result"></div>
                                        </Form>
                                    </div>
                                </div>
                            </div>
                        </aside>
                        <aside id="right_content" class="col-12 col-lg-8">
                            <div id="map-layer" class="inner google_map">
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
            @include('front.layouts.includes.footer')
        </div>
    </main>
@stop

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCjLC_NDa34ly8UcT9xMd8tXiPdaLP2FE&callback=initMap&libraries=&v=weekly&channel=2"
            async></script>
    <script>
        var map;
        var waypoints;
        var locations = [];

        function initMap() {
            var mapLayer = document.getElementById("map-layer");
            var centerCoordinates = new google.maps.LatLng(43.822455717638356, -79.53075990399391);
            var defaultOptions = {center: centerCoordinates, zoom: 8}
            map = new google.maps.Map(mapLayer, defaultOptions);

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
            directionsDisplay.setMap(map);


            $("#go").on("click", function () {
                var selected = [];
                for (var option of document.getElementById('job_id').options) {
                    if (option.selected) {
                        selected.push(option.value);
                    }
                }

                waypoints = [];
                $.ajax({
                    url: "jobs/" + selected,
                    type: "GET",
                    success: function (result) {
                        result = JSON.parse(result)
                        if(result.output.length == 0){

                            return alert('This Joy Has No Routes');

                        }

//                        console.log(result.output)

                        result.output.forEach(function (element, index) {
                            locations.push([element.lat, element.lng, element.location_name, element.type]);
                            waypoints.push({
                                location: element.location_name,
                                stopover: true,
                            });
                        });

//                        if (locations.length == 0) {
//                            alert('This Joy Has No Routes');
//                        }

                        var locationCount = locations.length;
                        if (locationCount > 0) {
                            var start = locations[0][2];
                            var end = locations[locationCount - 1][2];
                            drawPath(directionsService, directionsDisplay, start, end);
                        }

                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        }


        function drawPath(directionsService, directionsDisplay, start, end) {

            directionsService.route({
                origin: start,
                destination: end,
                waypoints: waypoints,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'

            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                    for (i = 0; i < locations.length; i++) {

//
                        var icon = '';
                        if (locations[i][3] == 'pickup') {
                            console
                            icon = "<?=url('/')?>/assets/front/assets/images/default.png";
                            makeMarker(new google.maps.LatLng(locations[i][0], locations[i][1]), icon, "Pick Up Point");
                        }
                        else {
                            icon = "<?=url('/')?>/assets/front/assets/images/pet-store.png";
                            makeMarker(new google.maps.LatLng(locations[i][0], locations[i][1]), icon, "Drop Off Point");
                        }
                    }
//                    console.log(locations)
                } else {
                    window.alert('Problem in showing direction due to ' + status);
                }
            });
        }

        function makeMarker(position, icon, title) {
            new google.maps.Marker({
                position: position,
                map: map,
                icon: icon,
                title: title
            });
        }
    </script>

@stop