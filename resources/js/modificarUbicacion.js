
    // obtener la ubicación del usuario
    // navigator.geolocation.getCurrentPosition(function (location) {
    var lat = document.getElementById('latitud').value;
    var lng = document.getElementById('longitud').value;

    console.log(lat, lng);
    var map = L.map('map').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18
}).addTo(map);

    // crear marker con el icono UBICACION que se encuentra en la carpeta /img/logos/UBICACION.png
    var marker = L.marker([lat, lng], {
    icon: L.icon({
    iconUrl: '/img/logos/UBICACION.png',
        iconSize: [60, 60],
        iconAnchor: [30, 60],
        popupAnchor: [0, 0]
})
}).addTo(map);
    // Hacemos que el marcador sea arrastrable y suscribimos al evento 'move'
    marker.dragging.enable();
    marker.on('drag', function (event) {
    var latLng = event.latlng;
    document.getElementById("latitud").value = marker.getLatLng().lat;
    document.getElementById("longitud").value = marker.getLatLng().lng;
});

    // al dar doble clic el marcador se elimina y se coloca en la posición donde se hizo doble clic
    // 1.Sobreescribimos la funcion dobliclick del mapa
    map.doubleClickZoom.disable();
    map.on('dblclick', function (event) {
    // 2. Eliminamos el marcador
    map.removeLayer(marker);
    // 3. Creamos un nuevo marcador en la posición donde se hizo doble clic
    marker = L.marker(event.latlng).addTo(map);
    // 4. Hacemos que el nuevo marcador sea arrastrable y suscribimos al evento 'move'
    marker.dragging.enable();
    marker.on('move', function (event) {
    var latLng = event.latlng;
    document.getElementById("latitud").value = marker.getLatLng().lat;
    document.getElementById("longitud").value = marker.getLatLng().lng;
});

    document.getElementById("latitud").value = marker.getLatLng().lat;
    document.getElementById("longitud").value = marker.getLatLng().lng;

});
// });
