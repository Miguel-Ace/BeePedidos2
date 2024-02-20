async function producto() {
    // Array que servirá para la sesión 
    let arr_productos = []

    // Variables globales
    const modal_registro_pedidos = document.querySelector('.registro_pedidos')

    const hola_user = document.querySelector('.nombre-completo')
    const opciones_del_user = document.querySelector('.settins')
    
    const input_buscador = document.querySelector('.buscador-categoria')
    
    const text_precio = document.querySelector('.text-precio')

    const usuario_auth = parseInt(document.querySelector('.user').textContent)

    const dropdownCarrito = document.querySelector('.productos-agregados')
    let id_ca = 0

    // Si hay una categoria en sesión, entonces traela
    if (sessionStorage.getItem('id_ca')) {
        id_ca = parseInt(sessionStorage.getItem('id_ca'))
    }
    const contenedorCategoria = document.querySelector('.contenedor-categoria')
    const tituloCategoria = document.querySelector('.titulo-categoria')
    // const productos = document.querySelectorAll('.productos')

    const contenedor_productos = document.querySelector('.content-all-products')
    const URL_SERVER = 'http://79.143.94.153/api';
    const URL_LOCAL = 'http://127.0.0.1:8000/api';
    const URL = URL_LOCAL
    
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

    // Obtener los productos
    const url_get_productos = `${URL}/producto`;

    const option_get_productos = {
        method: 'GET',
        headers: {
            authorization: `Bearer ${token}`
        }
    }

    const response_get_productos = await fetch(url_get_productos, option_get_productos)
    const result_get_productos = await response_get_productos.json()
    // ==== Fin obtener los productos ====

    // Obtener las categorias
    const url_get_categorias = `${URL}/categoria_producto`
    const option_get_categorias = {
        method: 'GET',
        headers: {
            authorization: `Bearer ${token}`
        }
    }
    const response_get_categorias = await fetch(url_get_categorias, option_get_categorias)
    const result_get_categorias = await response_get_categorias.json()
    // ==== Fin obtener las categorias ====

    // Obtener los pedidos
    const url_get_pedidos = `${URL}/pedido`
    const option_get_pedidos = {
        method: 'GET',
        headers: {
            authorization: `Bearer ${token}`
        }
    }
    const response_get_pedidos = await fetch(url_get_pedidos, option_get_pedidos)
    const result_get_pedidos = await response_get_pedidos.json()
    // ==== Fin obtener los pedidos ====
    
    // Obtener los detalles del pedido
    const url_get_detalle_pedidos = `${URL}/detalle_pedido`
    const option_get_detalle_pedidos = {
        method: 'GET',
        headers: {
            authorization: `Bearer ${token}`
        }
    }
    const response_get_detalle_pedidos = await fetch(url_get_detalle_pedidos, option_get_detalle_pedidos)
    const result_get_detalle_pedidos = await response_get_detalle_pedidos.json()
    // ==== Fin obtener los detalles del pedido ====


    // Usar objetos para un mejor manejo
    function Acciones() {
        // Parte de los productos
        this.iterar_productos = (filtrar = false, count = 0) => {
            contenedor_productos.innerHTML = ''
            fetch(url_get_productos, option_get_productos)
            .then(res => res.json())
            .then(result_get_productos => {
                for (const product of result_get_productos) {
    
                    if (product.existencia - product.exis_temp > 0) {
                        if (filtrar) {
                            if (product.id_categoria == count) {
                                this.render_html(product)
                            }
                        }else{
                            this.render_html(product)
                        }
                    }
    
                    // if (product.id == 50) {
                    //     break
                    // }
    
                }

                // Quitar pantalla de carga
                document.querySelector('.loanding').classList.add('desactivar')
            })
        }

        this.render_html = (el) => {
            // div con toda la información del producto
            const div_contenedor = document.createElement('div')
            div_contenedor.setAttribute('class','productos')
            div_contenedor.setAttribute('data-id',el.id)
            div_contenedor.setAttribute('data-ca',el.id_categoria)
            div_contenedor.setAttribute('data-cp',el.cod_producto_beesy)
            div_contenedor.setAttribute('data-iv',el.iva)
            
            // Imagen del producto
            const div_img = document.createElement('div')
            div_img.setAttribute('class','content-img')
            const img = document.createElement('img')
            img.setAttribute('src',el.url_imagen)
            div_img.appendChild(img)
            
            // Descuento
            const div_descuento = document.createElement('div')
            div_descuento.setAttribute('class','descuento')
            const span_descuento = document.createElement('span')
            span_descuento.textContent = `Hasta un - ${el.descuento}%`
            const p_descuento = document.createElement('p')
            p_descuento.textContent = `${el.producto}`
            if (el.descuento == null || el.descuento == '') {
                div_descuento.appendChild(p_descuento)
                div_descuento.setAttribute('class','sin-descuento')
            }else{
                div_descuento.appendChild(span_descuento)
                div_descuento.appendChild(p_descuento)
            }
            
            // Descripción
            const div_descripcion = document.createElement('div')
            div_descripcion.setAttribute('class','descripcion')
            div_descripcion.textContent = `${el.descripcion}`
            
            // Precio
            const div_precio = document.createElement('div')
            div_precio.setAttribute('class','precio')
            const span_precio = document.createElement('span')
            span_precio.setAttribute('class','moneda')
            span_precio.textContent = '¢'
            const span_precio_dos = document.createElement('span')
            // sacando precio según descuento
            const pd = (el.precio * el.descuento / 100)
            // fin sacando precio según descuento
            span_precio_dos.textContent = parseFloat(pd).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })
            const sub = document.createElement('sub')
            sub.textContent = `¢ ${parseFloat(el.precio).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            const span_precio_sin_descuento = document.createElement('span')
            span_precio_sin_descuento.textContent = `¢ ${parseFloat(el.precio).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            if (el.descuento == null || el.descuento == '') {
                div_precio.appendChild(span_precio_sin_descuento)
            }else{
                div_precio.appendChild(span_precio)
                div_precio.appendChild(span_precio_dos)
                div_precio.appendChild(sub)
            }

            // Existencias
            const div_existencia = document.createElement('div')
            div_existencia.setAttribute('class','existencia')
            div_existencia.textContent = 'Exist:'
            const span_existencia = document.createElement('span')
            span_existencia.textContent = `${el.existencia - el.exis_temp}`
            div_existencia.appendChild(span_existencia)
            
            // Btns seleccionar cantidades
            const div_select_cantidades = document.createElement('div')
            div_select_cantidades.setAttribute('class','selectCantidades')
            const button_menos = document.createElement('button')
            button_menos.setAttribute('class','menos')
            button_menos.textContent = '-'
            const input = document.createElement('input')
            input.setAttribute('type','text')
            input.setAttribute('class','quantity')
            input.setAttribute('placeholder','0')
            input.setAttribute('value','0')
            const button_mas = document.createElement('button')
            button_mas.setAttribute('class','mas')
            button_mas.textContent = '+'
            div_select_cantidades.appendChild(button_menos)
            div_select_cantidades.appendChild(input)
            div_select_cantidades.appendChild(button_mas)

            // Btn enviar
            const btn_enviar = document.createElement('input')
            btn_enviar.setAttribute('class','button')
            btn_enviar.setAttribute('type','submit')
            btn_enviar.setAttribute('value','Agregar')

            // Agregando todas la etiquetas al contenedor
            div_contenedor.appendChild(div_img)
            div_contenedor.appendChild(div_descuento)
            div_contenedor.appendChild(div_descripcion)
            div_contenedor.appendChild(div_precio)
            div_contenedor.appendChild(div_existencia)
            div_contenedor.appendChild(div_select_cantidades)
            div_contenedor.appendChild(btn_enviar)

            contenedor_productos.appendChild(div_contenedor)

            // Lógica
            // Acciones del input
            input.addEventListener('keyup', () => {
                if (input.value > (el.existencia - el.exis_temp)) {
                    input.value = (el.existencia - el.exis_temp)
                    button_menos.disabled = false
                    button_mas.disabled = true
                    btn_enviar.classList.remove('bloquado')
                }

                if (input.value < 0) {
                    input.value = 1
                    button_menos.disabled = true
                    button_mas.disabled = false
                    btn_enviar.classList.remove('bloquado')
                }
            })

            // Acciones btn màs y menos
            button_menos.addEventListener('click', () => {
                input.value--
                logica_input()
            })

            button_mas.addEventListener('click', () => {
                input.value++
                logica_input()
            })

            const logica_input = () => {
                // if (input.value == 0) {
                //     btn_enviar.disabled = true
                //     btn_enviar.classList.add('bloquado')
                //     button_menos.disabled = true
                //     button_mas.disabled = false
                // }

                if (input.value > 0) {
                    btn_enviar.disabled = false
                    btn_enviar.classList.remove('bloquado')
                    button_menos.disabled = false
                }

                if (input.value < (el.existencia - el.exis_temp)) {
                    btn_enviar.disabled = false
                    btn_enviar.classList.remove('bloquado')
                    button_mas.disabled = false
                }

                if (input.value == (el.existencia - el.exis_temp)) {
                    btn_enviar.disabled = false
                    btn_enviar.classList.remove('bloquado')
                    button_menos.disabled = false
                    button_mas.disabled = true
                }

                if (input.value == 0) {
                    btn_enviar.disabled = true
                    btn_enviar.classList.add('bloquado')
                    button_menos.disabled = true
                    button_mas.disabled = false
                }

                if (input.value == 1 && (el.existencia - el.exis_temp) == 1) {
                    btn_enviar.disabled = false
                    btn_enviar.classList.remove('bloquado')
                    button_menos.disabled = true
                    button_mas.disabled = true
                }
            }

            logica_input()

            // Aqui hago una pequeña validación que me permitirá poder
            // saber si el product que se guarda tiene descuento o no
            let precio_sin_con_descuento
            if (el.descuento != null) {
                precio_sin_con_descuento = (el.precio * el.descuento / 100)
            }else{
                precio_sin_con_descuento = el.precio
            }

            // Acciones al presionar el btn agregar
            btn_enviar.addEventListener('click', () => {
                // Bloquear btn para evitar datos duplicados
                btn_enviar.disabled = true

                // Obtener los productos
                const url_get_producto_id = `${URL}/producto/${el.id}`;

                // Validar existencias actual
                fetch(url_get_producto_id, option_get_productos)
                .then(res => res.json())
                .then(datos => {
                    const existencia = datos.existencia - datos.exis_temp

                    if (existencia >= parseInt(input.value)) {
                        // Actualizar existencias del producto en la bd
                        this.update_producto(el.id, (datos.exis_temp + parseInt(input.value)))

                        if (localStorage.getItem('productos')) {
                            arr_productos = JSON.parse(localStorage.getItem('productos'));
                        }

                        const indice = arr_productos.findIndex(product => product.id == el.id);

                        if (indice == -1) {
                            this.agregar_product(el.id, input.value, (el.existencia - el.exis_temp), el.url_imagen, (precio_sin_con_descuento * input.value).toFixed(2), el.producto)
                            arr_productos.push({
                                cantidad: input.value,
                                descripcion: el.descripcion,
                                descuento: el.descuento,
                                existencia: (el.existencia - el.exis_temp),
                                id: el.id,
                                imagen: el.url_imagen,
                                iva: el.iva,
                                moneda: '¢',
                                nombre: el.producto,
                                precio: (precio_sin_con_descuento * input.value).toFixed(2),
                                quantity: input.value
                            })
                        }else{
                            arr_productos[indice].precio = (precio_sin_con_descuento * (parseInt(arr_productos[indice].cantidad) + parseInt(input.value))).toFixed(2)
                            arr_productos[indice].cantidad = parseInt(arr_productos[indice].cantidad) + parseInt(input.value)
                            arr_productos[indice].quantity = parseInt(arr_productos[indice].quantity) + parseInt(input.value)
                            this.iterando_sesion()
                        }

                        // Reflejar el total
                        localStorage.setItem('productos', JSON.stringify(arr_productos))

                        // Reflejar el total
                        this.mostrar_total_en_pantalla()
                    }else{
                        // Alerta
                        Swal.fire({
                            title: "Sin existencias",
                            text: "Seleccione otro producto",
                            // icon: "success"
                        });

                        this.iterar_productos()
                    }
                })
            })
        }

        // Parte de las categorias
        this.iterar_categorias = () => {
            contenedorCategoria.innerHTML = ''
            for (const categ of result_get_categorias) {
                this.render_html_categorias(categ)
            }
        }

        this.render_html_categorias = (el) => {
            const button = document.createElement('button')
            button.setAttribute('class','categorias')
            button.setAttribute('value',el.id)
            button.textContent = el.categoria
            if (id_ca != el.id) {
                button.classList.remove('active');
            }else{
                button.setAttribute('class','active')
                tituloCategoria.textContent = el.categoria
            }
            
            // Agregando la categorias al contenedor
            contenedorCategoria.appendChild(button)

            // Lógica cuando presione a una categoria
            button.addEventListener('click', () => {
                id_ca = el.id
                sessionStorage.setItem('id_ca', JSON.stringify(el.id))
                this.iterar_categorias()
                this.iterar_productos(true, el.id)
            })
        }

        // Al seleccionar un producto se agrega al pedido
        this.agregar_product = (id,cantidad,existencia,imagen,precio,producto) => {
            // Agregar pantalla de carga
            document.querySelector('.loanding').classList.remove('desactivar')

            const div_detalle_carrito = document.createElement('div')
            div_detalle_carrito.setAttribute('class','detalle-carrito')
            div_detalle_carrito.setAttribute('data-id',id)
            div_detalle_carrito.setAttribute('data-ca',cantidad)
            div_detalle_carrito.setAttribute('data-ex',existencia)

            // imagen
            const div_imagen = document.createElement('div')
            div_imagen.setAttribute('class','detalle-img')
            const img = document.createElement('img')
            img.setAttribute('src',imagen)
            img.setAttribute('width',100)
            const ion_icon = document.createElement('ion-icon')
            ion_icon.setAttribute('name','trash-outline')
            ion_icon.setAttribute('class','vaciar md hydrated')
            ion_icon.setAttribute('role','img')
            div_imagen.appendChild(img)
            div_imagen.appendChild(ion_icon)

            // detalle del producto
            const div_detalle = document.createElement('div')
            div_detalle.setAttribute('class','detalle-producto')
            const p = document.createElement('p')
            p.textContent = producto
            const span_precio = document.createElement('span')
            span_precio.setAttribute('class','price')
            span_precio.setAttribute('class','text-info')
            span_precio.textContent = `¢ ${parseFloat(precio).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })}`
            const span_cantidad = document.createElement('span')
            span_cantidad.setAttribute('class','count')
            span_cantidad.textContent = ` Cantidad: ${cantidad}`
            div_detalle.appendChild(p)
            div_detalle.appendChild(span_precio)
            div_detalle.appendChild(span_cantidad)

            // Agregando todo al contenedor
            div_detalle_carrito.appendChild(div_imagen)
            div_detalle_carrito.appendChild(div_detalle)
            dropdownCarrito.appendChild(div_detalle_carrito)

            const sumar_a_existencias = (id, cantidad) => {
                fetch(url_get_productos, option_get_productos)
                .then(res => res.json())
                .then(p => {
                    for (const item of p) {
                        if (item.id == id) {
                            const result = item.exis_temp - cantidad
                            this.update_producto(id, result)
                        }
                    }
                })
            }
            
            // Borrar productos de sesión y mandar a iterar el carrito actualizado
            ion_icon.addEventListener('click', () => {
                const quitando_product_del_array = arr_productos.filter(x => x.id != parseInt(div_detalle_carrito.getAttribute('data-id')))
                arr_productos = quitando_product_del_array
                localStorage.setItem('productos', JSON.stringify(quitando_product_del_array))
                sumar_a_existencias(parseInt(div_detalle_carrito.getAttribute('data-id')), parseInt(div_detalle_carrito.getAttribute('data-ca')))
                this.delete_detalle_pedido(div_detalle_carrito.getAttribute('data-id'))
                this.iterando_sesion()
            })
        }

        // Aqui vamos a obtener pedidos abiertos que pueda tener el usuario
        this.ver_si_hay_pedido_en_bd = () => {
            // Poner el array de product en vacio para que no afecte
            arr_productos = []
            
            const obtener_pedidos_abiertos_del_user = result_get_pedidos.filter(x => x.id_cliente == usuario_auth).filter(x => x.cerrar_pedido == 0)
            
            // Puede que haya usuarios que no tienen pedidos por lo cual puede dar error
            if (obtener_pedidos_abiertos_del_user.length != 0) {
                // Agregando a sesión el id de pedido
                sessionStorage.setItem('pedido', JSON.stringify(obtener_pedidos_abiertos_del_user[0].id))

                let idProducts = []
                const obtener_detalle_pedido_del_user = result_get_detalle_pedidos.filter(x => x.num_pedido == obtener_pedidos_abiertos_del_user[0].id)

                for (const i of obtener_detalle_pedido_del_user) {
                    idProducts.push(i.id)

                    arr_productos.push({
                        id: i.producto.id,
                        imagen: i.producto.url_imagen,
                        nombre: i.producto.producto,
                        precio: i.producto.precio,
                        moneda: '¢',
                        descripcion: i.producto.descripcion,
                        existencia: i.producto.existencia,
                        descuento: i.producto.descuento,
                        cantidad: i.cantidad,
                        iva: i.producto.iva,
                        quantity: i.cantidad
                    })   
                }
                
                // Agregando a sesión los id del detalle pedido
                sessionStorage.setItem('idProducts',JSON.stringify(idProducts))
            }

            if (!(localStorage.getItem('productos') && JSON.parse(localStorage.getItem('productos')).length > 0)) {
                localStorage.setItem('productos', JSON.stringify(arr_productos))
                this.iterando_sesion()
                // console.log('no hay');
            }else{
                // Revisa si es que existe el producto en la sesión
                if (localStorage.getItem('productos')) {
                    arr_productos = JSON.parse(localStorage.getItem('productos'));
                }
                this.iterando_sesion()
                // console.log('si hay');
            }
            // console.log(obtener_detalle_pedido_del_user);
        }

        // Aqui añade los productos al carrito si es que hay en sesión
        this.iterando_sesion = () => {
            // Limpiar el carrito
            dropdownCarrito.innerHTML = ''
            // Recorrer la sesión
            for (const item of arr_productos) {
             this.agregar_product(item.id,item.cantidad,item.existencia,item.imagen,item.precio,item.nombre)
            }

            // Reflejar el total
            this.mostrar_total_en_pantalla()
        }

        // Sumar los resultados para mostrarlos en pantalla
        this.mostrar_total_en_pantalla = () => {
            const total = arr_productos.reduce((acc,el) => {
                acc = acc + parseFloat(el.precio)
                return acc
            }, 0)

            // Mostrando el total precio
            text_precio.textContent = parseFloat(total).toLocaleString('en-US',{ minimumFractionDigits: 2, maximumFractionDigits: 2 })
        }

        // Filtrar productos usando el buscador de la página
        this.buscador = () => {
            // Elemino la sesión de las categorias para que traiga los productos
            // al momento de filtrar y cuando reinicie la página
            sessionStorage.removeItem('id_ca')
            tituloCategoria.textContent = ''
            const palabra_a_encontrar = (input_buscador.value).toLowerCase().trim()
            contenedor_productos.innerHTML = ''

            for (const product of result_get_productos) {

                const cod_producto = product.cod_producto_beesy
                const palabra = (product.producto).toLocaleLowerCase()

                const existe_palabra = palabra.includes(palabra_a_encontrar)
                const existe_cod = cod_producto.includes(palabra_a_encontrar)

                if (product.existencia > 0) {
                    if (existe_palabra || existe_cod) {
                        this.render_html(product)
                    }
                }
            }
        }

        // Actualizar un producto
        this.update_producto = (id, new_existencia) => {
            const url_put_productos = `${URL}/producto/update/${id}`;

            const credenciales_put_productos = {
                exis_temp: new_existencia
            }

            const option_put_productos = {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    authorization: `Bearer ${token}`
                },
                body: JSON.stringify(credenciales_put_productos)
            }
            
            fetch(url_put_productos, option_put_productos)

            // Luego que ya se actualizó la bd mando a recorrer los productos de nuevo
            if (sessionStorage.getItem('id_ca')) {
                if (parseInt(sessionStorage.getItem('id_ca')) != 0) {
                    id_ca = parseInt(sessionStorage.getItem('id_ca'))
                    as.iterar_productos(true, id_ca)
                }
            }else{
                as.iterar_productos()
            }
        }

        // Borrar un producto
        this.delete_detalle_pedido = (id) => {
            // Agregar pantalla de carga
            document.querySelector('.loanding').classList.remove('desactivar')

            const obtener_pedidos_abiertos_del_user = result_get_pedidos.filter(x => x.id_cliente == usuario_auth).filter(x => x.cerrar_pedido == 0)

            if (obtener_pedidos_abiertos_del_user.length != 0) {
                const obtener_detalle_pedido_del_user = result_get_detalle_pedidos.filter(x => x.num_pedido == obtener_pedidos_abiertos_del_user[0].id)
                
                for (const i of obtener_detalle_pedido_del_user) {
                    if (i.id_producto == id) {
                        const url_delete_detalle_pedido = `${URL}/detalle_pedido/delete`;

                        const arr_id = [i.id]
            
                        const option_delete_detalle_pedido_ = {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                authorization: `Bearer ${token}`
                            },
                            body: JSON.stringify(arr_id)
                        }
                        
                        fetch(url_delete_detalle_pedido, option_delete_detalle_pedido_)
                    }
                }
            }
        }

        this.render_html_registro = () => {
            for (const pedido of result_get_pedidos) {
                if (pedido.cliente.id == usuario_auth) {
                    const tr = document.createElement('tr')
                    const td_num_pedido = document.createElement('td')
                    td_num_pedido.textContent = pedido.id
                    const td_fecha_hora = document.createElement('td')
                    td_fecha_hora.textContent = pedido.fecha_hora
                    const td_cliente = document.createElement('td')
                    td_cliente.textContent = pedido.cliente.name
                    const td_descuento = document.createElement('td')
                    td_descuento.textContent = pedido.descuento
                    const td_iva = document.createElement('td')
                    td_iva.textContent = pedido.iva
                    const td_sub_total = document.createElement('td')
                    td_sub_total.textContent = pedido.sub_total
                    const td_cerrar_pedido = document.createElement('td')
                    if (pedido.cerrar_pedido == 1) {
                        td_cerrar_pedido.textContent = 'Cerrado'
                    }else{
                        td_cerrar_pedido.textContent = 'Abierto'
                    }
    
                    tr.appendChild(td_num_pedido)
                    tr.appendChild(td_fecha_hora)
                    tr.appendChild(td_cliente)
                    tr.appendChild(td_descuento)
                    tr.appendChild(td_iva)
                    tr.appendChild(td_sub_total)
                    tr.appendChild(td_cerrar_pedido)
                    modal_registro_pedidos.appendChild(tr)
                }
            }
        }
    }
    // ==== Fin usar objetos ====

    // Llamar obj
    const as = new Acciones()
    as.render_html_registro()
    if (sessionStorage.getItem('id_ca')) {
        if (parseInt(sessionStorage.getItem('id_ca')) != 0) {
            id_ca = parseInt(sessionStorage.getItem('id_ca'))
            as.iterar_productos(true, id_ca)
        }
    }else{
        as.iterar_productos()
    }
    as.iterar_categorias()
    as.ver_si_hay_pedido_en_bd()
    input_buscador.addEventListener('change', () => {
        as.buscador()
    })
    hola_user.addEventListener('click', () => {
        opciones_del_user.classList.toggle('active')
    })
    // ==== Fin llamar obj ====
}

// Llamando la fun async
producto()

// // Llamando la fun async
// producto()
// if (existencia >= 0) {
//     // Actualizar existencias del producto en la bd
//     this.update_producto(el.id, existencia)

//     if (localStorage.getItem('productos')) {
//         arr_productos = JSON.parse(localStorage.getItem('productos'));
//     }

//     const indice = arr_productos.findIndex(product => product.id == el.id);

//     if (indice == -1) {
//         this.agregar_product(el.id, input.value, el.exis_temp, el.url_imagen, (precio_sin_con_descuento * input.value).toFixed(2), el.producto)
//         arr_productos.push({
//             cantidad: input.value,
//             descripcion: el.descripcion,
//             descuento: el.descuento,
//             existencia: el.exis_temp,
//             id: el.id,
//             imagen: el.url_imagen,
//             iva: el.iva,
//             moneda: '¢',
//             nombre: el.producto,
//             precio: (precio_sin_con_descuento * input.value).toFixed(2),
//             quantity: input.value
//         })
//     }else{
//         arr_productos[indice].precio = (precio_sin_con_descuento * (parseInt(arr_productos[indice].cantidad) + parseInt(input.value))).toFixed(2)
//         arr_productos[indice].cantidad = parseInt(arr_productos[indice].cantidad) + parseInt(input.value)
//         arr_productos[indice].quantity = parseInt(arr_productos[indice].quantity) + parseInt(input.value)
//         this.iterando_sesion()
//     }

//     // console.log(arr_productos[indice]);
//     localStorage.setItem('productos', JSON.stringify(arr_productos))

//     // Reflejar el total
//     this.mostrar_total_en_pantalla()
// }else{
//     // Igualando existencias con la bd
//     span_existencia.textContent = filtrar[0].exis_temp

//     // Bloquear el btn de agregar
//     btn_enviar.classList.add('bloquado')
//     button_menos.disabled = true

//     // Alerta
//     Swal.fire({
//         title: "Sin existencias",
//         text: "Seleccione otro producto",
//         // icon: "success"
//     });
// }