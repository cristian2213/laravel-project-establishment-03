document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("mapa")) {
        const lat = 4.441358389095973;
        const lng = -75.21648252029992;

        const mapa = L.map("mapa").setView([lat, lng], 16);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        // Geocode Service
        const geocodeService = L.esri.Geocoding.geocodeService();

        let marker;

        // agregar el pin
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);

        // detectar movimiento
        marker.on("moveend", function (e) {
            marker = e.target;
            const posicion = marker.getLatLng(); // latitud y longitud

            // centrar automaticamente
            mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));


            geocodeService.reverse().latlng(posicion, 16).run(function (error, resultado) {
                console.log(error);
                console.log(resultado);
            });
        });
    }
});
