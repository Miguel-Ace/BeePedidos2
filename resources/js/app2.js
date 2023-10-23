  // Obtener el campo "id_especialidad"
  var pedidoSelect = document.getElementById('id_tipo_pedido');

  // Agregar un evento de cambio al campo "id_especialidad"
  if (pedidoSelect) {
    pedidoSelect.addEventListener('change', () => {
      var selectedValue = pedidoSelect.options[pedidoSelect.selectedIndex].text;
      var direcciones = document.getElementById('direcciones');
      const opt1 = document.getElementById('option1') 
      const opt2 = document.getElementById('option2') 
      const opt3 = document.getElementById('option3') 
  
      // Si el valor seleccionado es "Odontología", mostrar los campos "nombre_diente" y "descripcion"
      if (selectedValue === 'A domicilio') {
        direcciones.style.display = 'block';
      } else {
        direcciones.style.display = 'none';
        opt1.value = null;
        opt2.value = null;
        opt3.value = null;
      }
    })
  }


  // Obtener Coordenadas
  window.onload = obtenerCoordenadas;

  function obtenerCoordenadas() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;
        // document.getElementById('coordenadas').value = latitud + ', ' + longitud;
        document.getElementById('latitud').value = latitud;
        document.getElementById('longitud').value = longitud;
      });
    } else {
      alert('La geolocalización no es compatible con este navegador.');
    }
  }
