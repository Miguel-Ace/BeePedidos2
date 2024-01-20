const enviarBtn = document.querySelector('.modal-footer #enviarBtn')
const irBtn = document.querySelector('.ir')
const procesar = document.querySelector('.procesar')

let arr_products = JSON.parse(sessionStorage.getItem('productos'))
let arr_idProducts = JSON.parse(sessionStorage.getItem('idProducts'))

procesar.addEventListener('click', () => {
  arr_products = JSON.parse(sessionStorage.getItem('productos'))
  arr_idProducts = JSON.parse(sessionStorage.getItem('idProducts'))
})
// Obtener los datos del formulario

const fecha_hora = document.querySelector('.form-factura #fecha_hora').value;
const id_cliente = document.querySelector('.form-factura #id_cliente').value;
const sub_total = document.querySelector('.form-factura #sub_total').value;
const descuento = document.querySelector('.form-factura #descuento').value;
const iva = document.querySelector('.form-factura #iva').value;
const id_tipo_pago = document.querySelector('.form-factura #id_tipo_pago').value;
const tipo_documento = document.querySelector('.form-factura #tipo_documento').value;
const adjuntar_imagen = document.querySelector('.form-factura #adjuntar_imagen').value;
const latitud = document.querySelector('.form-factura #latitud').value;
const longitud = document.querySelector('.form-factura #longitud').value;
const factura_electronica = document.querySelector('.form-factura #factura_electronica').value;
const cerrar_pedido = document.querySelector('.form-factura #cerrar_pedido');

let estadoIdProductos

if (JSON.parse(sessionStorage.getItem('idProducts'))) {
  if (JSON.parse(sessionStorage.getItem('idProducts')).length != 0) {
    estadoIdProductos = true
  }else{
    estadoIdProductos = false
  }
}else{
  estadoIdProductos = false
}

let estadoCerrar = 0
cerrar_pedido.addEventListener('click', () => {
  if (!estadoCerrar) {
    // console.log('cerrado');
    estadoCerrar = 1
  }else{
    // console.log('abierto');
    estadoCerrar = 0
  }
})

// Definir la URL del endpoint para obtener el token
const URL_SERVER = 'http://79.143.94.153/api';
const URL_LOCAL = 'http://127.0.0.1:8000/api';
const URL = URL_LOCAL
const tokenEndpoint = `${URL}/login`;

// Definir los datos de autenticación (por ejemplo, nombre de usuario y contraseña)
const credentials = {
  email: 'vendedor@example.com',
  password: '12345678',
  grant_type: 'password'
};

// Configurar la solicitud HTTP para obtener el token
const requestOptions = {
  method: 'POST',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
    // Otros encabezados según sea necesario
  },
  body: new URLSearchParams(credentials),
};

// Realizar la solicitud HTTP
fetch(tokenEndpoint, requestOptions)
  .then(response => response.json())
  .then(data => {
    // Almacenar el token en una variable
    const accessToken = data.access_token;

    // Puedes usar accessToken como necesites aquí

    // Crear el pedido
    async function enviarFormularioOrder(numPedido){
      // Construir el objeto de datos
      const datos = {
        num_pedido: numPedido,
        fecha_hora: fecha_hora,
        id_cliente: id_cliente,
        sub_total: sub_total,
        descuento: descuento,
        iva: iva,
        propina: null,
        factura_electronica: factura_electronica,
        id_tipo_pago: id_tipo_pago,
        id_tipo_pedido: null,
        id_tipo_entrega: null,
        adjuntar_imagen: adjuntar_imagen,
        id_estado: 1,
        direcciones: null,
        latitud: latitud,
        longitud: longitud,
        tipo: null,
        tipo_documento: tipo_documento,
        cerrar_pedido: estadoCerrar,
        // Agrega más campos según sea necesario
      };
      
      const token = accessToken;
      const url = `${URL}/pedido/insert`;
      const options = {
        method: 'POST',
        headers: {
          'content-type': 'application/json',
          'authorization': `Bearer ${token}`,
        },
        body: JSON.stringify(datos)
      };
      
      try {
        const response = await fetch(url, options);
        // const result = await response.text();
        // console.log(result);
      } catch (error) {
        // console.error(error);
      }
    }

    // Crear los detalles del pedido
    async function enviarFormularioDetalle(datos){
      // Construir el objeto de datos
      
      const token = accessToken;
      const url = `${URL}/detalle_pedido/insert`;
      const options = {
        method: 'POST',
        headers: {
          'content-type': 'application/json',
          'authorization': `Bearer ${token}`,
        },
        body: JSON.stringify(datos)
      };

      try {
        const response = await fetch(url, options);
        // const result = await response.text();
        // console.log(result);
      } catch (error) {
        // console.error(error);
      }
      
    }

    // Elminar el pedido
    async function eliminarPedido(idPedido) {
      try {
        // URL de la API y ID del producto a eliminar
        const apiUrl = `${URL}/pedido/delete/${idPedido}`;

        // Realizar solicitud DELETE con await
        const response = await fetch(apiUrl, {
          method: 'DELETE',
          headers: {
            'content-Type': 'application/json',
            'authorization': `Bearer ${accessToken}`,
          },
        });

        // Verificar si la respuesta es exitosa
        // if (!response.ok) {
        //   throw new Error(`Error al eliminar pedido. Código de estado: ${response.status}`);
        // }

        // Aquí puedes manejar la respuesta si es necesario
        // const data = await response.json();
        // console.log('Pedido eliminado:', data);
      } catch (error) {
        // Manejar errores si los hay
        // console.error('Error:', error);
      }
    }

    // Elminar los detalles del pedido
    async function eliminarProducto(idProducto) {
      try {
        // URL de la API y ID del producto a eliminar
        const apiUrl = `${URL}/detalle_pedido/delete`;
        // const apiUrl = `http://127.0.0.1:8000/api/detalle_pedido/delete/${idProducto}`;

        // Realizar solicitud DELETE con await
        const response = await fetch(apiUrl, {
          method: 'DELETE',
          headers: {
            'content-Type': 'application/json',
            'authorization': `Bearer ${accessToken}`,
          },
          body: JSON.stringify(idProducto),
        });

        // Verificar si la respuesta es exitosa
        // if (!response.ok) {
        //   throw new Error(`Error al eliminar producto. Código de estado: ${response.status}`);
        // }

        // Aquí puedes manejar la respuesta si es necesario
        // const data = await response.json();
        // console.log('Producto eliminado:', data);
      } catch (error) {
        // Manejar errores si los hay
        // console.error('Error:', error);
      }
    }

    function arreglo(num_pedido) {
      let datos = []
      arr_products.forEach(product => {
         datos.push({
          num_pedido,
          id_producto: product.id,
          cantidad: product.cantidad,
          precio: product.precio,
          descuento: descuento,
          iva: (product.precio * product.cantidad) * product.iva,
          enviada_beesy: 'Si',
          fecha_hora: fecha_hora,
          id_modificador1: null,
          id_modificador2: null,
          id_modificador3: null,
        })
      })
      enviarFormularioDetalle(datos);
    }

    function arregloDeleteDetalle() {
      let datos = []
      arr_idProducts.forEach(item => {
        datos.push(item.id)
      })
      eliminarProducto(datos); 
    }

    // if (estadoIdProductos == false && JSON.parse(sessionStorage.getItem('pedido'))) {
    //   arreglo(num_pedido_old)
    // }

    enviarBtn.addEventListener('click', (e) => {
      e.preventDefault()

      const num_pedido_new = JSON.parse(sessionStorage.getItem('ordenAl'))
      const num_pedido_old = JSON.parse(sessionStorage.getItem('numOrder'))
      const id_pedido = JSON.parse(sessionStorage.getItem('pedido'))

      enviarBtn.disabled = true
      enviarBtn.style = 'opacity:.5'
      if (estadoIdProductos) {
        eliminarPedido(id_pedido);

        arregloDeleteDetalle()
        
        enviarFormularioOrder(num_pedido_old);
      
        arreglo(num_pedido_old)
      }else{
        enviarFormularioOrder(num_pedido_new);
        arreglo(num_pedido_new)
      }

      // sessionStorage.removeItem('productos')
      // sessionStorage.removeItem('numOrder')
      // sessionStorage.removeItem('idProducts')
      // sessionStorage.removeItem('pedido')

      sessionStorage.setItem('estatus', JSON.stringify(true));
      
      setTimeout(() => {
        irBtn.click();
      }, 4000);
    })


  })
  .catch(error => {
    console.error('Error al obtener el token:', error);
  });