<x-filament-panels::page>
  @if ($tipe == 'emergency')
    <div>
      <p class="font-semibold text-lg">{{ Carbon\Carbon::parse($data->tanggal)->format('d M Y') }} - {{ $data->jam }}</p>
      <p class="font-semibold text-lg">Pelapor: {{ $data->nama_pelapor }}</p>
    </div>
  @endif
  <link href="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.js"></script>

  <div id="map" class="w-full h-screen"></div>

  <script>
    mapboxgl.accessToken = '{{ env('MAPBOX_TOKEN') }}';
      const map = new mapboxgl.Map({
          container: 'map',
          // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
          style: 'mapbox://styles/mapbox/streets-v12',
          center: [106.85225016324236,-6.226817006740859],
          zoom: 10
      });
  
      // Create a default Marker and add it to the map.
      const marker1 = new mapboxgl.Marker()
          .setLngLat([{{ $longitude }}, {{ $latitude }}])
          .addTo(map);
  </script>
</x-filament-panels::page>
