<div id="map" style="height: 500px; width: 100%;"></div>

<script>
    // Define the map variable globally
    let map;

    // Google Maps initialization function
    function initMap() {
        // Get vendors passed from Livewire as JSON
        const vendors = @json($vendors);

        // Log vendors to console for debugging
        console.log(vendors);

        const center = { lat: 7.8731, lng: 80.7718 }; // Center the map in Sri Lanka

        // Initialize the map
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 8,
        });

        // Check if there are any vendors to display
        if (vendors.length === 0) {
            console.warn("No vendors found to display on the map.");
        }

        // Add markers for each vendor
        vendors.forEach((vendor) => {
            // Validate latitude and longitude
            if (!vendor.latitude || !vendor.longitude) {
                console.warn(`Invalid coordinates for vendor: ${vendor.business_name}`);
                return;
            }

            const marker = new google.maps.Marker({
                position: { lat: parseFloat(vendor.latitude), lng: parseFloat(vendor.longitude) },
                map: map,
                title: vendor.business_name,
            });

            // Add info window for the marker
            const infoWindow = new google.maps.InfoWindow({
                content: `<div>
                            <h3>${vendor.business_name}</h3>
                            <p>${vendor.business_address}</p>
                          </div>`,
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
