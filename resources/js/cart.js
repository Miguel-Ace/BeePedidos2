const tablaCart = document.querySelector('#cart tbody')
const mostrarTotalCart = document.querySelector('.total')
// Datos de la info
const infoSubTotal = document.querySelector('.info .content-info:nth-child(2) p:nth-child(2)')
const infoDescuento = document.querySelector('.info .content-info:nth-child(3) p:nth-child(2)')
const infoIva = document.querySelector('.info .content-info:nth-child(4) p:nth-child(2)')
const infoTotal = document.querySelector('.info .content-info:nth-child(5) p:nth-child(2)')
// Datos del formulario
const formuSub_total = document.querySelector('#sub_total')
const formuDescuento = document.querySelector('#descuento')
const formuIva = document.querySelector('#iva')

let ivaCart = 0
let descuentoCart = 0
let totalCart = 0
let subTotalCart = 0
let arr_products = []

if (sessionStorage.getItem('productos')) {
    arr_products = JSON.parse(sessionStorage.getItem('productos'))

    for (const producto of arr_products) {
        const precio = producto.precio
        const iva = (producto.precio * 0.10) * producto.cantidad
        const subtotal = producto.precio * producto.cantidad
        const total = iva + subtotal
        let descuento

        if (producto.descuento == null) {
            descuento = '-'    
        }else{
            descuento = producto.descuento
        }

        subTotalCart += subtotal
        descuentoCart += producto.descuento == null ? '' : producto.descuento
        ivaCart += iva
        totalCart += total

        tablaCart.innerHTML += `
            <tr>
                <td class="imagen">
                    <span style="display:none" class="id">${producto.id}</span>
                    <div>
                        <img src="${producto.imagen}" width="100" height="100" class="img-responsive" alt="">
                    </div>
                </td>
                
                <td data-th="producto" class="producto">
                    <div>
                        <h4 class="nomargin">${producto.nombre}</h4>
                    </div>
                </td>

                <td data-th="precio" class="precio">${producto.moneda} ${precio}</td>

                <td data-th="descuento" class="descuento">${descuento}</td>

                <td data-th="cantidad" class="cantidad">
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary quantity-minus">-</button>
                        <input type="text" disabled="" value="${producto.cantidad}" class="form-control quantity cart_update" min="1">
                        <button type="button" class="btn btn-outline-secondary quantity-plus">+</button>
                    </div>
                </td>

                <td data-th="existencia" class="existencia">
                    <p>${producto.existencia}</p>
                </td>
                
                <td data-th="desc" class="desc">
                    <p>${producto.descripcion}</p>
                </td>
                
                <td data-th="subtotal" class="subtotal">${producto.moneda} ${subtotal.toFixed(2)}</td>

                <td data-th="iva" class="iva">${producto.moneda} ${iva.toFixed(2)}</td>

                <td data-th="total" class="total">${producto.moneda} ${total.toFixed(2)}</td>

                <td class="delete-product" data-th="">
                    <button class="cart_remove"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        `

        // Agregar datos al formulario y a la info

        // Info
        infoSubTotal.textContent = `${producto.moneda} ${subTotalCart}`
        infoDescuento.textContent = `${descuentoCart}`
        infoIva.textContent = `${producto.moneda} ${ivaCart.toFixed(2)}`
        infoTotal.textContent = `${producto.moneda} ${totalCart.toFixed(2)}`

        // Formulario
        formuSub_total.value = subTotalCart
        formuDescuento.value = descuentoCart
        formuIva.value = ivaCart.toFixed(2)
    }
}

mostrarTotalCart.textContent = `Total: ${totalCart.toFixed(2)}`