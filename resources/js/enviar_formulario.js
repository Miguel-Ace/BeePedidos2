const enviarBtn = document.querySelector('.modal-footer #enviarBtn')
const irBtn = document.querySelector('.ir')
let arr_products
arr_products = JSON.parse(sessionStorage.getItem('productos'))
let arr_idProducts
arr_idProducts = JSON.parse(sessionStorage.getItem('idProducts'))

// Obtener los datos del formulario
const num_pedido = document.querySelector('.form-factura #num_pedido').value;
const fecha_hora = document.querySelector('.form-factura #fecha_hora').value;
const id_cliente = document.querySelector('.form-factura #id_cliente').value;
const sub_total = document.querySelector('.form-factura #sub_total').value;
const descuento = document.querySelector('.form-factura #descuento').value;
const iva = document.querySelector('.form-factura #iva').value;
const id_tipo_pago = document.querySelector('.form-factura #id_tipo_pago').value;
// const id_tipo_pedido = document.querySelector('.form-factura #id_tipo_pedido').value;
// const id_tipo_entrega = document.querySelector('.form-factura #id_tipo_entrega').value;
const tipo_documento = document.querySelector('.form-factura #tipo_documento').value;
const adjuntar_imagen = document.querySelector('.form-factura #adjuntar_imagen').value;
const latitud = document.querySelector('.form-factura #latitud').value;
const longitud = document.querySelector('.form-factura #longitud').value;
const factura_electronica = document.querySelector('.form-factura #factura_electronica').value;
const cerrar_pedido = document.querySelector('.form-factura #cerrar_pedido');

let estadoCerrar = 0
cerrar_pedido.addEventListener('click', () => {
  if (!estadoCerrar) {
    console.log('cerrado');
    estadoCerrar = 1
  }
})

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
  
  const token = '12597|57CDcxxmNvyJlUcTGd4Q7Es3vKn1CO9FyAnhw78j';
  // const token = '3118|ROll9FSAXz2VMl7PzEOjS6tlK13tDAM40R9RZtOv';
  const url = 'http://79.143.94.153/api/pedido/insert';
  // const url = 'http://127.0.0.1:8000/api/pedido/insert';
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
    const result = await response.text();
    console.log(result);
  } catch (error) {
    console.error(error);
  }
}

// Crear los detalles del pedido
async function enviarFormularioDetalle(numPedido, product){
  // Construir el objeto de datos
  const datos = {
    num_pedido: numPedido,
    id_producto: product.id,
    cantidad: product.cantidad,
    precio: product.precio,
    descuento: descuento,
    iva: iva,
    enviada_beesy: 'Si',
    fecha_hora: fecha_hora,
    id_modificador1: null,
    id_modificador2: null,
    id_modificador3: null,
    // Agrega más campos según sea necesario
  };
  
  const token = '12597|57CDcxxmNvyJlUcTGd4Q7Es3vKn1CO9FyAnhw78j';
  // const token = '3118|ROll9FSAXz2VMl7PzEOjS6tlK13tDAM40R9RZtOv';
  const url = 'http://79.143.94.153/api/detalle_pedido/insert';
  // const url = 'http://127.0.0.1:8000/api/detalle_pedido/insert';
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
    const result = await response.text();
    console.log(result);
  } catch (error) {
    console.error(error);
  }
  // for (const product of arr_products) {
  // }
  
}

// Elminar el pedido
async function eliminarPedido(idPedido) {
  try {
    // URL de la API y ID del producto a eliminar
    const apiUrl = `http://79.143.94.153/api/pedido/delete/${idPedido}`;
    // const apiUrl = `http://127.0.0.1:8000/api/pedido/delete/${idPedido}`;
    
    // Token de autorización
    const token = '12597|57CDcxxmNvyJlUcTGd4Q7Es3vKn1CO9FyAnhw78j';
    // const token = '3118|ROll9FSAXz2VMl7PzEOjS6tlK13tDAM40R9RZtOv';

    // Realizar solicitud DELETE con await
    const response = await fetch(apiUrl, {
      method: 'DELETE',
      headers: {
        'content-Type': 'application/json',
        'authorization': `Bearer ${token}`,
      },
    });

    // Verificar si la respuesta es exitosa
    if (!response.ok) {
      throw new Error(`Error al eliminar pedido. Código de estado: ${response.status}`);
    }

    // Aquí puedes manejar la respuesta si es necesario
    const data = await response.json();
    console.log('Pedido eliminado:', data);
  } catch (error) {
    // Manejar errores si los hay
    console.error('Error:', error);
  }
}

// Elminar los detalles del pedido
async function eliminarProducto(idProducto) {
  try {
    // URL de la API y ID del producto a eliminar
    const apiUrl = `http://79.143.94.153/api/detalle_pedido/delete/${idProducto}`;
    // const apiUrl = `http://127.0.0.1:8000/api/detalle_pedido/delete/${idProducto}`;
    
    // Token de autorización
    const token = '12597|57CDcxxmNvyJlUcTGd4Q7Es3vKn1CO9FyAnhw78j';
    // const token = '3118|ROll9FSAXz2VMl7PzEOjS6tlK13tDAM40R9RZtOv';

    // Realizar solicitud DELETE con await
    const response = await fetch(apiUrl, {
      method: 'DELETE',
      headers: {
        'content-Type': 'application/json',
        'authorization': `Bearer ${token}`,
      },
    });

    // Verificar si la respuesta es exitosa
    if (!response.ok) {
      throw new Error(`Error al eliminar producto. Código de estado: ${response.status}`);
    }

    // Aquí puedes manejar la respuesta si es necesario
    const data = await response.json();
    console.log('Producto eliminado:', data);
  } catch (error) {
    // Manejar errores si los hay
    console.error('Error:', error);
  }
}

function arreglo(num_pedido) {
  arr_products.forEach(product => {
    enviarFormularioDetalle(num_pedido,product);
  });
}

enviarBtn.addEventListener('click', (e) => {
  e.preventDefault()

  if (JSON.parse(sessionStorage.getItem('idProducts')).length != 0) {
    eliminarPedido(JSON.parse(sessionStorage.getItem('idPedido')));

    arr_idProducts.forEach(item => {
      eliminarProducto(item.id);
    })

    enviarFormularioOrder(JSON.parse(sessionStorage.getItem('numOrder')));

    arreglo(JSON.parse(sessionStorage.getItem('numOrder')))
    // enviarFormularioDetalle(JSON.parse(sessionStorage.getItem('numOrder')));
  }else{
    enviarFormularioOrder(num_pedido);
    arreglo(num_pedido)
    // enviarFormularioDetalle(num_pedido);
  }

  // if (estadoCerrar == 1) {
    // }
    sessionStorage.removeItem('numOrder')
    sessionStorage.removeItem('productos')
    sessionStorage.removeItem('idProducts')
    sessionStorage.removeItem('idPedido')

  setTimeout(() => {
    irBtn.click();
  }, 300);
})

console.log(JSON.parse(sessionStorage.getItem('numOrder')));
console.log(num_pedido);