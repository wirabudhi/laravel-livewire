<div>
    <div wire:ignore id="map" style="height: 400px;"></div>

    <script>
        document.addEventListener('livewire:init', function() {
            var map = L.map('map').setView([-0.7893, 113.9213], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            @foreach ($locations as $location)
                // console.log({{ $location->latitude }}, {{ $location->longitude }});
                var marker = L.circle([{{ $location->latitude }}, {{ $location->longitude }}], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.5,
                    radius: 200
                }).addTo(map)
                marker.bindPopup("<b>{{ $location->latitude }}</b><br><b>{{ $location->longitude }}</b>")
                    .openPopup();
            @endforeach
        });
    </script>
</div>
