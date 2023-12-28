const productsCart = document.querySelectorAll('#cart tbody tr')
let arr_products = []

// Si existen productos en el sessionStorage lo agrega al array y lo pone en el carrito
if (sessionStorage.getItem('productos')) {
    arr_products = JSON.parse(sessionStorage.getItem('productos'))
}

productsCart.forEach(item => {
    const id = item.querySelector('.id').textContent
    const quantityMinus = item.querySelector('.quantity-minus')
    const quantity = item.querySelector('.quantity')
    const quantityPlus = item.querySelector('.quantity-plus')
    const existencia = item.querySelector('.existencia p').textContent
    const cartRemove = item.querySelector('.cart_remove')
    
    const indice = arr_products.findIndex(product => product.id == id.trim());
    // console.log(cartRemove);

    cartRemove.addEventListener('click', () => {
        arr_products.splice(indice, 1)
        sessionStorage.setItem('productos', JSON.stringify(arr_products));
        location.reload()
    })

    estadoBtn()
    quantityPlus.addEventListener('click', () => {
        quantity.value++
        estadoBtn()
        // location.reload()
    })

    quantityMinus.addEventListener('click', () => {
        quantity.value--
        estadoBtn()
        // location.reload()
    })

    function estadoBtn() {
        if (quantity.value == 1) {
            quantityPlus.style = ''
            quantityPlus.disabled = false
    
            quantityMinus.style = 'background: gray; color: white'
            quantityMinus.disabled = true

            cambiarCantidad(indice)
        }
    
        if (quantity.value == existencia) {
            quantityMinus.style = ''
            quantityMinus.disabled = false
    
            quantityPlus.style = 'background: gray; color: white'
            quantityPlus.disabled = true

            cambiarCantidad(indice)
        }

        if (quantity.value != existencia && quantity.value != 1) {
            quantityMinus.style = ''
            quantityMinus.disabled = false
    
            quantityPlus.style = ''
            quantityPlus.disabled = false

            cambiarCantidad(indice)
        }
    }

    function cambiarCantidad(indice) {
        arr_products[indice].cantidad = quantity.value;
        sessionStorage.setItem('productos', JSON.stringify(arr_products));
        // console.log(arr_products);
    }
    
});


const finalizarBtn = document.querySelector('.finalizar-btn')
const ballCarga = document.querySelector('.loanding')
const btnClose = document.querySelector('.close')
const sp1 = document.querySelector('.bolls span:nth-child(1)')
const sp2 = document.querySelector('.bolls span:nth-child(2)')
const sp3 = document.querySelector('.bolls span:nth-child(3)')

finalizarBtn.addEventListener('click', () => {

    ballCarga.classList.add('activo')
    btnClose.click()

    sp1.classList.add('sp1')
    setTimeout(() => {
        sp2.classList.add('sp2')
    }, 750);
    setTimeout(() => {
        sp3.classList.add('sp3')
    }, 1000);
})