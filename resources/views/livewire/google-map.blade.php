<div id="map" style="height: 500px; width: 100%;"></div>

<script>
    // Define the map variable globally
    let map;

    // Google Maps initialization function
    function initMap() {
        const vendors = @json($vendors); // Get vendors from Livewire
        const center = { lat: 7.8731, lng: 80.7718 }; // Sri Lanka center

        // Initialize the map
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 8,
        });

        // Add markers for each vendor
        vendors.forEach((vendor) => {
            const marker = new google.maps.Marker({
                position: { lat: vendor.latitude, lng: vendor.longitude },
                map: map,
                title: vendor.business_name,
            });

            // Add info window for the marker
            const infoWindow = new google.maps.InfoWindow({
                content: `<div><h3>${vendor.business_name}</h3><p>${vendor.business_address}</p></div>`,
            });

            // Show info window on marker click
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });
        });
    }
</script>

<!-- Load Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>
