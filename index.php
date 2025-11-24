<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- leaflet css -->
    <link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    />

    <title>Web-GIS with Geoserver and Leaflet</title>

    <style>
      body {
        margin: 0;
        padding: 0;
      }
      #map {
        width: 100%;
        height: 100vh;
      }

      /* ======== LEGEND STYLE ========= */
      .legend-box {
        position: absolute;
        bottom: 20px;    /* posisi kiri bawah */
        left: 20px;
        z-index: 9999;
        background: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.3);
        max-height: 320px;
        overflow-y: auto;
        font-family: Arial, sans-serif;
      }

      .legend-title {
        font-weight: bold;
        margin-bottom: 6px;
      }

      .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 4px;
      }

      .legend-color {
        width: 18px;
        height: 18px;
        margin-right: 6px;
        border: 1px solid #000;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>

    <!-- ========== LEGEND HTML ========== -->
    <div class="legend-box">
      <div class="legend-title">Legenda Kecamatan</div>

      <div class="legend-item"><div class="legend-color" style="background:#ff6666;"></div>Gedangsari</div>
      <div class="legend-item"><div class="legend-color" style="background:#c99;"></div>Girisubo</div>
      <div class="legend-item"><div class="legend-color" style="background:#df8;"></div>Karangmojo</div>
      <div class="legend-item"><div class="legend-color" style="background:#f0c;"></div>Ngawen</div>
      <div class="legend-item"><div class="legend-color" style="background:#90f;"></div>Nglipar</div>
      <div class="legend-item"><div class="legend-color" style="background:#3399ff;"></div>Paliyan</div>
      <div class="legend-item"><div class="legend-color" style="background:#66cc00;"></div>Panggang</div>
      <div class="legend-item"><div class="legend-color" style="background:#ccff33;"></div>Patuk</div>
      <div class="legend-item"><div class="legend-color" style="background:#ff99cc;"></div>Playen</div>
      <div class="legend-item"><div class="legend-color" style="background:#0099cc;"></div>Ponjong</div>
      <div class="legend-item"><div class="legend-color" style="background:#0066ff;"></div>Purwosari</div>
      <div class="legend-item"><div class="legend-color" style="background:#ffcc33;"></div>Rongkop</div>
      <div class="legend-item"><div class="legend-color" style="background:#00cc66;"></div>Saptosari</div>
      <div class="legend-item"><div class="legend-color" style="background:#cc9933;"></div>Semanau</div>
      <div class="legend-item"><div class="legend-color" style="background:#996633;"></div>Simin</div>
      <div class="legend-item"><div class="legend-color" style="background:#33cc99;"></div>Tanjungsari</div>
      <div class="legend-item"><div class="legend-color" style="background:#00cc99;"></div>Tepus</div>
      <div class="legend-item"><div class="legend-color" style="background:#33ffcc;"></div>Wonosari</div>
    </div>

    <!-- leaflet js -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
      // ===============================
      // MAP DASAR
      // ===============================
      var map = L.map("map").setView([-7.732521, 110.402376], 11);

      var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "© OpenStreetMap contributors",
      }).addTo(map);

      // ===============================
      // LAYER WMS DARI GEOSERVER
      // ===============================

      var desa = L.tileLayer.wms("http://localhost:8080/geoserver/pgweb/wms", {
        layers: "pgweb:Gunungkidul",
        format: "image/png",
        transparent: true,
      }).addTo(map);

      var jalan = L.tileLayer.wms("http://localhost:8080/geoserver/pgweb/wms", {
        layers: "pgweb:Jalan_Gunungkidul",
        format: "image/png",
        transparent: true,
      }).addTo(map);

      var kecamatan = L.tileLayer.wms("http://localhost:8080/geoserver/pgweb/wms", {
        layers: "pgweb:data_kecamatan_view",
        format: "image/png",
        transparent: true,
      }).addTo(map);

      // ===============================
      // LAYER CONTROL
      // ===============================
      var overlayLayers = {
        "Batas Administrasi Desa": desa,
        "Jalan": jalan,
        "Data Kecamatan": kecamatan,
      };

      L.control.layers(null, overlayLayers).addTo(map);
    </script>
  </body>
</html>
