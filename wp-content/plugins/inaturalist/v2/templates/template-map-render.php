<div id="map"></div>
<div id="legend">
    <div class="legend-title">Click to toggle</div>
    <div id="legend-items">

    </div>
</div>
<script>
    var map;
    var observationMarkers = [];
    var partnerMarkers = [];

    function toggleLegend(link, arr) {
        link.addEventListener('click', function () {

            if (this.classList.contains('hidden')) {
                this.classList = 'legend-item';
            } else {
                this.classList = this.classList + ' hidden';
            }

            arr.forEach(function (el) {
                var markerState = el.getVisible();
                el.setVisible(!markerState);
            });
        });
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: new google.maps.LatLng(-26.027536, -13.977898)
        });
        var iconBase = "<?php echo home_url() ?>/wp-content/uploads/icons/";
        var icons = {
            observation: {
                name: "Observation",
                icon: iconBase + "map-pin-observation.png"
            },
            partner: {
                name: "Partner",
                icon: iconBase + "map-pin-partners-blue.png"
            }
        };
        var features = [
            <?php
            foreach ($viewData['observations'] as $id => $obs) {
                if ($obs->latitude != '') {
                    echo "{
                        position: new google.maps.LatLng(" . $obs->latitude . "," . $obs->longitude . "),
                        type: 'observation',
                        bubble:$obs->bubble
                     },";
                }
            }
            foreach ($viewData['partners'] as $id => $par) {
                if ($par['latitude'] != '') {
                    echo "{
                        position: new google.maps.LatLng(" . $par['latitude'] . "," . $par['longitude'] . "),
                        type:'partner',
                        bubble:" . $par['bubble'] . "
                        }";
                    $count = count($viewData['partners']);
                    if ($id + 1 < $count) {
                        echo ',';
                    }
                }
            }
            ?>
        ];


        features.forEach(function (feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                animation: google.maps.Animation.DROP,
                icon: icons[feature.type].icon,
                kind: feature.type,
                map: map
            });
            var infowindow = new google.maps.InfoWindow({
                content: feature.bubble
            })
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
            if (feature.type == 'partner') {
                partnerMarkers.push(marker);
            }
            if (feature.type == 'observation') {
                observationMarkers.push(marker);
            }
        });


        var legend = document.getElementById('legend');
        var legendItems = document.getElementById('legend-items');
        for (var key in icons) {
                var type = icons[key];
                var name = type.name;
                var icon = type.icon;
                var link = document.createElement('div');
                link.className = 'legend-item';
                link.innerHTML = '<span class="legend-icon" id="legend-icon-' + name + '"><img src="' + icon + '"></span>' +
                    '<span class="legend-name"> ' + name + '</span>';


                if (name == 'Partner') {
                    toggleLegend(link, partnerMarkers);
                }
                if (name == 'Observation') {
                    toggleLegend(link, observationMarkers);
                }

                legendItems.appendChild(link);
        }

        map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);


    }
    initMap();

</script>