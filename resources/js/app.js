import './bootstrap';

const buttonUser = document.querySelector('.nombre-completo');
const settins = document.querySelector('.settins');
const ionIcon = document.querySelector('ion-icon');

if (buttonUser) {
  buttonUser.addEventListener('click', () => {
    settins.classList.toggle('active');
    ionIcon.classList.toggle('active');
  });
}

// buscador texto
const buscadorCategoria = document.querySelector('.buscador-categoria')
const productos = document.querySelectorAll('.productos')

if (buscadorCategoria) {
  buscadorCategoria.addEventListener('change', () => {
    const valorBuscador = buscadorCategoria.value.toLowerCase().replace(/ñ/g, 'n')
    const cantidadLetrasBuscador = valorBuscador.length
    // console.log(cantidadLetrasBuscador);
  
    productos.forEach(item => {
      const nombreProducto = item.querySelector('.descuento p').textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/ñ/g, 'n')
      const codProductoBeesy = item.querySelector('.cadProductoBeesy').textContent
      const existePalabra = nombreProducto.toLowerCase().includes(valorBuscador.toLowerCase())
      // console.log(existePalabra);
  
      // condiciones
      const mismoCodProducto = valorBuscador == codProductoBeesy || valorBuscador == '';
      const mismoTexto = valorBuscador == nombreProducto || valorBuscador == '';
  
      const mismoTextoUnaLetra = valorBuscador.substring(0, 1) == nombreProducto.substring(0, 1) || valorBuscador.substring(0, 1) == '';
      const mismoTextoDosLetra = valorBuscador.substring(0, 2) == nombreProducto.substring(0, 2) || valorBuscador.substring(0, 2) == '';
      const mismoTextoTresLetra = valorBuscador.substring(0, 3) == nombreProducto.substring(0, 3) || valorBuscador.substring(0, 3) == '';
      const mismoTextoCuatroLetra = valorBuscador.substring(0, 4) == nombreProducto.substring(0, 4) || valorBuscador.substring(0, 4) == '';
      const mismoTextoCincoLetra = valorBuscador.substring(0, 5) == nombreProducto.substring(0, 5) || valorBuscador.substring(0, 5) == '';
      const mismoTextoSeisLetra = valorBuscador.substring(0, 6) == nombreProducto.substring(0, 6) || valorBuscador.substring(0, 6) == '';
      const mismoTextoSieteLetra = valorBuscador.substring(0, 7) == nombreProducto.substring(0, 7) || valorBuscador.substring(0, 7) == '';
      const mismoTextoOchoLetra = valorBuscador.substring(0, 8) == nombreProducto.substring(0, 8) || valorBuscador.substring(0, 8) == '';
      const mismoTextoNueveLetra = valorBuscador.substring(0, 9) == nombreProducto.substring(0, 9) || valorBuscador.substring(0, 9) == '';
      const mismoTextoDiezLetra = valorBuscador.substring(0, 10) == nombreProducto.substring(0, 10) || valorBuscador.substring(0, 10) == '';
  
      if (cantidadLetrasBuscador == 1) {
        if (mismoTextoUnaLetra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }
      else if (cantidadLetrasBuscador == 2) {
        if (mismoTextoDosLetra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 3) {
        if (mismoTextoTresLetra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 4) {
        if (mismoTextoCuatroLetra || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 5) {
        if (mismoTextoCincoLetra || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 6) {
        if ((mismoTextoSeisLetra || mismoCodProducto) || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 7) {
        if (mismoTextoSieteLetra || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 8) {
        if (mismoTextoOchoLetra || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 9) {
        if (mismoTextoNueveLetra || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else if (cantidadLetrasBuscador == 10) {
        if (mismoTextoDiezLetra || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }else{
        if (mismoTexto || existePalabra) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      }
  
    })
    
  })
}