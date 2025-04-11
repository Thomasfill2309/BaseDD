function initMap() {
            var location = { lat: 19.432608, lng: -99.133209 };
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location
            });
            var marker = new google.maps.Marker({ position: location, map: map });
        }

        function agregarCarrito(nombre, precio) {
            alert(nombre + " ha sido agregado al carrito.");
        }

        document.getElementById("categoria").addEventListener("change", function() {
            let categoriaSeleccionada = this.value;
            let productos = document.querySelectorAll(".producto");

            productos.forEach(producto => {
                if (categoriaSeleccionada === "todos" || producto.dataset.categoria === categoriaSeleccionada) {
                    producto.style.display = "block";
                } else {
                    producto.style.display = "none";
                }
            });
        });