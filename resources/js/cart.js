async function carrito_de_la_compra() {
    // Variables globales
    let estadoCerrar = 1

    const id_user = parseInt(document.querySelector('.user').textContent)

    const btn_send_factura = document.querySelector('.send-factura')
    const btn_volver = document.querySelector('.ir')
    const finalizarCompra = document.querySelector('#enviarBtn')
    const close_btn_modal = document.querySelector('.close-btn')

    const resumen_iva = document.querySelector('.iva p:nth-child(2)')
    const resumen_sub_total = document.querySelector('.sub-total p:nth-child(2)')
    const resumen_total = document.querySelector('.total p:nth-child(2)')
    const resumen_descuento = document.querySelector('.descuento p:nth-child(2)')

    const total = document.querySelector('.total')

    const tbody = document.querySelector('#cart tbody')

    const URL_SERVER = 'http://79.143.94.153/api';
    const URL_LOCAL = 'http://127.0.0.1:8000/api';
    const URL = URL_LOCAL
    // ==== Fim variables globales ====

    // Generar el token
    const tokenEndpoint = `${URL}/login`;

    const credenciales_get_token = {
        email: 'vendedor@example.com',
        password: '12345678',
    }

    const option_token = {
        method: 'POST',
        body: new URLSearchParams(credenciales_get_token),
    };

    const response_token = await fetch(tokenEndpoint, option_token)
    const result_token = await response_token.json()
    const token = result_token.access_token
    // ===== Fin generar el token =====

    // POO para mejorar la lógica y como están estructurados las funciones
    function Cart() {
        let total_iva = 0
        let total_descuento = 0
        let total_subtotal = 0
        let total_total = 0

        // Mando a llamar la función productos que está en sesión
        this.iterar_productos_sesion = () => {
            for (const p of JSON.parse(localStorage.getItem('productos'))) {
                this.render_html_productos(p)
            }

            // Mandar a cargar todo lo que hay que pagar en pantalla
            this.mostrar_info_a_resumen()

            // Quitar pantalla de carga
            document.querySelector('.loanding').classList.add('desactivar')
        }

        // Creo las etiquetas html para luegos agregarlas al body
        this.render_html_productos = (el) => {
            // precio sin el multiplo de cantidad
            const precio_normal = (el.precio / el.cantidad) 
            
            let iva = 0

            let precio_con_descuento = 0

            if (el.descuento != null) {
                precio_con_descuento = `${precio_normal - ((precio_normal * el.descuento) / 100)}`
                iva = parseFloat((precio_con_descuento * parseFloat(el.iva)) * el.cantidad)
            }


            // contiene todos los td
            const tr = document.createElement('tr')
            tr.setAttribute('data-id',el.id)

            // imagen
            const td_img = document.createElement('td')
            td_img.setAttribute('class','imagen')
            const div_img = document.createElement('div')
            const img = document.createElement('img')
            img.setAttribute('src',el.imagen)
            img.setAttribute('width','100')
            img.setAttribute('height','100')
            img.setAttribute('class','img-responsive')
            // agregar
            div_img.appendChild(img)
            td_img.appendChild(div_img)

            // Nombre producto
            const td_producto = document.createElement('td')
            td_producto.setAttribute('class','producto')
            td_producto.textContent = el.nombre

            // Precio
            const td_precio = document.createElement('td')
            td_precio.setAttribute('class','precio')
            td_precio.textContent = `${el.moneda} ${(precio_normal).toFixed(2)}`

            // Descuento
            const td_descuento = document.createElement('td')
            td_descuento.setAttribute('class','descuento')
            if (el.descuento == null) {
                td_descuento.textContent = '-'
            }else{
                td_descuento.textContent = `${el.descuento}%`
            }

            // Cantidad
            const td_cantidad = document.createElement('td')
            td_cantidad.setAttribute('class','cantidad')
            td_cantidad.textContent = el.cantidad

            // Existencia
            // const td_existencia = document.createElement('td')
            // td_existencia.setAttribute('class','cantidad')
            // td_existencia.textContent = el.cantidad

            // Descripción
            const td_descripcion = document.createElement('td')
            td_descripcion.setAttribute('class','desc')
            td_descripcion.textContent = el.descripcion

            // Subtotal
            const td_subtotal = document.createElement('td')
            td_subtotal.setAttribute('class','subtotal')
            if (el.descuento == null) {
                td_subtotal.textContent = `${parseFloat(el.precio).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            }else{
                td_subtotal.textContent = `${el.moneda} ${(precio_con_descuento * el.cantidad).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            }

            // Iva
            const td_iva = document.createElement('td')
            td_iva.setAttribute('class','iva')
            if (el.descuento == null) {
                td_iva.textContent = `${el.moneda} ${((precio_normal * parseFloat(el.iva)) * el.cantidad).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            }else{
                td_iva.textContent = `${el.moneda} ${iva.toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            }

            // Total
            const td_total = document.createElement('td')
            td_total.setAttribute('class','total')
            if (el.descuento == null) {
                td_total.textContent = `${el.moneda} ${(parseFloat(el.precio) + ((precio_normal * parseFloat(el.iva)) * el.cantidad)).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            }else{
                td_total.textContent = `${el.moneda} ${((precio_con_descuento * el.cantidad) + parseFloat(iva)).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            }
            
            // Icono delete
            // const td_ico_delete = document.createElement('td')
            // td_ico_delete.setAttribute('class','delete-product')
            // const btn_ico_delete = document.createElement('button')
            // btn_ico_delete.setAttribute('class','cart_remove')
            // const ico_delete = document.createElement('i')
            // ico_delete.setAttribute('class','fa-solid fa-trash')
            // Agregar
            // btn_ico_delete.appendChild(ico_delete)
            // td_ico_delete.appendChild(btn_ico_delete)

            // Agregar todos los elementos
            tr.appendChild(td_img)
            tr.appendChild(td_producto)
            tr.appendChild(td_precio)
            tr.appendChild(td_descuento)
            tr.appendChild(td_cantidad)
            tr.appendChild(td_descripcion)
            tr.appendChild(td_subtotal)
            tr.appendChild(td_iva)
            tr.appendChild(td_total)
            // tr.appendChild(td_ico_delete)
            tbody.appendChild(tr)
        }

        // Método para mostrar el total a pagar en pantalla
        this.mostrar_info_a_resumen = () => {
            for (const item of JSON.parse(localStorage.getItem('productos'))) {
                const precio_normal = (item.precio / item.cantidad)

                if (item.descuento != null) {
                    const precio_con_descuento = precio_normal - ((precio_normal * item.descuento) / 100)
                    const iva = parseFloat((precio_con_descuento * parseFloat(item.iva)) * item.cantidad)

                    total_iva += iva
                    total_subtotal += precio_con_descuento * item.cantidad
                    total_total += (precio_con_descuento * item.cantidad) + parseFloat(iva)
                    total_descuento += ((precio_normal * item.descuento) / 100) * item.cantidad
                }else{
                    total_iva += (precio_normal * parseFloat(item.iva)) * item.cantidad
                    total_subtotal += parseFloat(item.precio)
                    total_total +=  parseFloat(item.precio) + ((precio_normal * parseFloat(item.iva)) * item.cantidad)
                }

            }
            
            resumen_iva.textContent = `¢ ${total_iva.toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            resumen_sub_total.textContent = `¢ ${total_subtotal.toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            resumen_total.textContent = `¢ ${total_total.toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            resumen_descuento.textContent = `¢ ${total_descuento.toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            
            // Aqui muestro el total
            total.textContent = `Total: ${(total_total).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
        }

        // Crear el pedido
        this.crear_pedido = () => {
            const datos = {
                num_pedido: null,
                fecha_hora: new Date(),
                id_cliente: id_user,
                sub_total: total_subtotal,
                descuento: total_descuento,
                iva: total_iva,
                propina: null,
                factura_electronica: null,
                id_tipo_pago: null,
                id_tipo_pedido: null,
                id_tipo_entrega: null,
                adjuntar_imagen: null,
                id_estado: 1,
                direcciones: null,
                latitud: null,
                longitud: null,
                tipo: null,
                tipo_documento: null,
                cerrar_pedido: estadoCerrar,
                // Agrega más campos según sea necesario
            };

            const url_insert_pedido = `${URL}/pedido/insert`;

            const option_insert_pedido = {
                method: 'POST',
                headers: {
                  'content-type': 'application/json',
                  'authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(datos)
            }

            fetch(url_insert_pedido, option_insert_pedido)
            .then(response => response.json())
            .then(data => {
                this.crear_detalle_pedido(data.id)
            })
        }

        // Editar el pedido
        this.editar_pedido = (id) => {
            const datos = {
                // sub_total: total_subtotal,
                // descuento: total_descuento,
                // iva: total_iva,
                cerrar_pedido: estadoCerrar,
                // Agrega más campos según sea necesario
            };

            const url_update_pedido = `${URL}/pedido/update/${id}`;

            const option_update_pedido = {
                method: 'PUT',
                headers: {
                  'content-type': 'application/json',
                  'authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(datos)
            }

            fetch(url_update_pedido, option_update_pedido)
            .then(res => {
                this.update_producto()
                // this.eliminar_detalle_pedido()
            })
            .catch(error => {
                console.log(error);
            })
        }

        // Elminar todo el detalle pedido relacionado al user
        this.eliminar_detalle_pedido = () => {
            const ids = JSON.parse(sessionStorage.getItem('idProducts'));

            const url_delete_detalle_pedido = `${URL}/detalle_pedido/delete`;

            const option_delete_detalle_pedido = {
                method: 'DELETE',
                headers: {
                    'content-type': 'application/json',
                    'authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(ids)
            }

            fetch(url_delete_detalle_pedido, option_delete_detalle_pedido)
            .then(res => {
                this.crear_detalle_pedido(JSON.parse(sessionStorage.getItem('pedido')))
            })
            .catch(error => {
                console.log(error);
            })
        }

        // Crear el nuevo detalle del pedido referenciando al pedido
        this.crear_detalle_pedido = (id_p) => {
            const datos = JSON.parse(localStorage.getItem('productos')).map(x => ({
                num_pedido: id_p,
                id_producto: x.id,
                cantidad: x.cantidad,
                precio: (parseFloat(x.precio) / parseInt(x.cantidad)),
                descuento: x.descuento,
                iva: x.iva,
                enviada_beesy: 'Si',
                fecha_hora: new Date(),
                id_modificador1: null,
                id_modificador2: null,
                id_modificador3: null,
            }))

            const url_crear_detalle_pedido = `${URL}/detalle_pedido/insert`;

            const option_crear_detalle_pedido = {
                method: 'POST',
                headers: {
                    'content-type': 'application/json',
                    'authorization': `Bearer ${token}`,
                },
                body: JSON.stringify(datos)
            }

            fetch(url_crear_detalle_pedido, option_crear_detalle_pedido)
            .then(res => {
                // console.log(estadoCerrar);
                // estadoCerrar == 1 ? localStorage.removeItem('productos') : 
                // estadoCerrar == 1 ? this.update_producto() : ''
                sessionStorage.removeItem('id_ca');
                sessionStorage.removeItem('idProducts')
                sessionStorage.removeItem('pedido')
                // Quitar pantalla de carga
                // document.querySelector('.loanding').classList.add('desactivar')
                // btn_send_factura.click()
            })
            
            this.update_producto()
        }

        // Restar a existencias y exis_temp de los productos
        this.update_producto = () => {

            const option_get_productos = {
                method: 'GET',
                headers: {
                    authorization: `Bearer ${token}`
                }
            }
            
            const productosPromises = JSON.parse(localStorage.getItem('productos')).map(async p => {
                const url_get_producto_id = `${URL}/producto/${p.id}`;
                return fetch(url_get_producto_id, option_get_productos)
                .then(res => res.json())
                .then(datos => {
                    return {
                        id: datos.id,
                        existencia: (datos.existencia - p.cantidad),
                        exis_temp: (datos.exis_temp - p.cantidad)
                    };
                });
            });
            
            Promise.all(productosPromises)
                .then(data => {
                    const url_put_productos = `${URL}/producto/update`;
                    const option_put_productos = {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            authorization: `Bearer ${token}`
                        },
                        body: JSON.stringify(data)
                    };
            
                    fetch(url_put_productos, option_put_productos);
                    console.log(data);
                    console.log('Productos actualizados con éxito');
                    localStorage.removeItem('productos')
                    btn_volver.click()
                })
        }
    }

    // Llamar obj Cart
    const c = new Cart()
    c.iterar_productos_sesion()
    
    finalizarCompra.addEventListener('click', () => {
        finalizarCompra.disabled = true

        // c.update_producto()
        if (sessionStorage.getItem('pedido') && sessionStorage.getItem('pedido').length != '') {
            const id_pedido = JSON.parse(sessionStorage.getItem('pedido'))
            c.editar_pedido(id_pedido)
            // Cerrar modal info
            close_btn_modal.click()
            // Agregando pantalla de carga
            document.querySelector('.loanding').classList.remove('desactivar')
            // console.log('hay id');
        }
        // else{
        //     c.crear_pedido()
        //     // console.log('No hay id');
        // }
    })
  
}

carrito_de_la_compra()