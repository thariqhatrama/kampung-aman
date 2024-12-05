<x-filament-panels::page>
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.css" rel="stylesheet">
  <script src='https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.js'></script>

  <div id='map' class="w-full h-screen"></div>

  <script>
    mapboxgl.accessToken = '{{ env('MAPBOX_TOKEN') }}';
    const geojson = {!! $geoJson !!};

    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [106.85225016324236,-6.226817006740859], // starting position [lng, lat]. Note that lat must be set between -90 and 90
        zoom: 9 // starting zoom
    });

    for (const marker of geojson.features) {
        // Create a DOM element for each marker.
        const el = document.createElement('div');
        const width = marker.properties.iconSize[0];
        const height = marker.properties.iconSize[1];
        el.className = 'marker marker-' + marker.properties.id;
        el.style.backgroundImage = `url({{ asset('assets/images/${marker.properties.tipe}/pointer.png') }})`;
        el.style.width = `${width}px`;
        el.style.height = `${height}px`;
        el.style.backgroundSize = '100%';
        const message = document.createElement('div');
        message.className = 'marker-message';
        message.textContent = marker.properties.total;
        el.appendChild(message);

        const popup = new mapboxgl.Popup({ offset: 25 })
            .setHTML(`
                <table>
                    <tbody>
                        <tr>
                            <td>Kejadian</td>
                            <td>: </td>
                            <td> ${marker.properties.kejadian}</td>
                        </tr>
                        <tr>
                            <td>Uraian</td>
                            <td>: </td>
                            <td> ${marker.properties.waktu}</td>
                        </tr>
                    </tbody>
                </table>
            `);

        // Add markers to the map.
        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .setPopup(popup)
            .addTo(map);
    }
  </script>
</x-filament-panels::page>
