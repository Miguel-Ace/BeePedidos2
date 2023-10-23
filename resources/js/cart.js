const tableCart = document.querySelectorAll('.table-cart tbody tr')
const btnFinalizarCompra = document.querySelector('.finalizar-compra-cart .acciones button')

tableCart.forEach(item => {
    const cantidadInput = item.querySelector('.cantidad div .quantity')
    const botonMas = item.querySelector('.cantidad div button:nth-child(3)')
    const existencia = item.querySelector('.existencia p')
    
    if (cantidadInput.value > parseInt(existencia.textContent)) {
        cantidadInput.style = 'background: red; color:white; text-align:center'

        botonMas.disabled = true
        botonMas.style = 'background: gray; color:white'
        
        btnFinalizarCompra.disabled = true
        btnFinalizarCompra.style = 'opacity:.7'
    }else if (cantidadInput.value == parseInt(existencia.textContent)) {
        cantidadInput.style = 'background: #D4AC0D; color:white; text-align:center'
        botonMas.disabled = true
        botonMas.style = 'background: gray; color:white'
    }
});