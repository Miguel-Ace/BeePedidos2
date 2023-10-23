const productos = document.querySelectorAll('.productos')
const detalleProducto = document.querySelectorAll('.detalle-producto')

productos.forEach(item => {
    const existencia = item.querySelector('.existencia span')
    const button = item.querySelector('form .button')

    button.onclick = () =>{
        setTimeout(() => {
            button.disabled = true
        }, 1);
    }
    
    if (parseInt(existencia.textContent) == 0 || existencia.textContent == '') {
        button.classList.toggle('activo')
        button.disabled = true
    }
    
    detalleProducto.forEach(detail => {
        if (detail.querySelector('p').textContent == item.querySelector('div:nth-child(2) p').textContent) {
            if (parseInt(detail.querySelector('.count').textContent) >= parseInt(item.querySelector('.existencia span').textContent)) {
                button.classList.toggle('activo')
                button.disabled = true
            }
        }
    });
});