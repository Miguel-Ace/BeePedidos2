<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensajes Bee</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <style>
        .contenedor{
            min-height: 100vh;
            background-color: #f1f1f1;
            margin: 0 auto;
            text-align: center;
            /* display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative; */
        }
        .contenedor .imagen-empresa{
            width: 150px;
        }
        .contenedor .gracias{
            font-size: 30px;
            font-family: 'Pacifico', cursive;
            margin-bottom: 10px;
        }
        .contenedor .tamano{
            padding: 2rem;
            margin: 0 auto;
            border: 2px solid goldenrod;
            border-radius: .5rem;
            background-color: white;
            width: 600px;
            position: relative;
        }
        .contenedor .tamano .img{
            text-align: start;
        }
        .contenedor .tamano .img .logo-beesy{
            width: 60px;
            top: 0;
            left: 0;
            margin: 0 auto;
            position: absolute;
        }
        .contenedor .tamano .contenido{
            font-size: 1.3rem;
        }
        .contenedor .tamano .contenido .palabra1{
            font-weight: bolder;
            text-align: center;
            font-size: 20px;
        }
        .contenedor .tamano .contenido .palabra2{
            font-weight: 400;
            text-align: center;
            font-size: 15px;
        }
        .contenedor .tamano .contenido .palabra3{
            font-weight: bold;
            opacity: .6;
            margin-top: 20px;
            font-size: 15px;
        }

        .contenedor .tamano .contenido .despedida{
            text-align: center;
            font-size: 20px;
            font-family: 'Pacifico', cursive;
        }

        .contenedor .tamano .contenido .total{
            margin: 10px 0;
            text-align: right;
        }
        .contenedor .tamano .contenido .total p .span1{
            font-weight: bold;
            opacity: .6;
        }
        .contenedor .tamano .contenido .total p .span2{
            margin-left: 5px;
        }

        .contenedor .tamano .contenido .descuento-pedido{
            margin-top: 10px;
            display: grid;
            grid-template-columns: 1fr
        }
        .contenedor .tamano .contenido .descuento-pedido .info{
            font-size: 1rem;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            font-family: 'Times New Roman', Times, serif;
        }
        .contenedor .tamano .contenido .descuento-pedido .info span{
            font-size: 1rem;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .contenedor .tamano .contenido .desc-pedido{
            margin-top: 10px;
            display: grid;
            grid-template-columns: repeat(2,1fr);
        }
        .contenedor .tamano .contenido .desc-pedido .info{
            font-size: 1rem;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            font-family: 'Times New Roman', Times, serif;
        }
        .contenedor .tamano .contenido .desc-pedido .info span{
            font-size: 1rem;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .contenedor .tamano .contenido .content-info{
            display: grid;
            grid-template-columns: repeat(2,1fr);
            margin-top: 9px;
        }
        .contenedor .tamano .contenido .content-info .info{
            font-size: 1.2rem;
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            font-family: 'Times New Roman', Times, serif;
        }

        .contenedor .tamano .contenido p span{
            font-weight: bold;
        }
        .contenedor .tamano .contenedorlink{
            max-width: 100%;
            margin: 0 auto;
        }
        .contenedor .tamano .contenedorlink .link{
            text-decoration: none;
            display: block;
            background-color: #F39200;
            font-weight: bold;
            margin: 0 auto;
            padding: .7rem 1rem;
            border-radius: .5rem;
            width: 110px;
        }
    </style>
</head>
<body>

    <div class="contenedor">

        <img class="imagen-empresa" src="https://www.logoswilson.com/wp-content/uploads/2022/12/Realizacion-de-tu-logo-para-restaurante.png" alt="">
        <h1 class="gracias">¡Gracias!</h1>

        <div class="tamano">
            
            <div class="img">
                <img class="logo-beesy" style="max-width: 100%" src="https://beesys.net/wp-content/uploads/2022/09/logo.png" alt="logo beesy"/>
                {{-- <img class="logo-pedidos" style="max-width: 100%" src="logo-pedidos.PNG" alt="logo pedido"/> --}}
            </div>

            <div class="contenido">
                <p class="palabra1">Hola Miguel Angel Acevedo Cruz :</p>
                <p class="palabra2">Gracias por tu hacer tu orden en Pedidos.</p>
                <p class="palabra3">INFORMACIÓN DE TU PEDIDO:</p>
                <hr>

                {{-- {{$msg['ticker']}} --}}
                <div class="content-info">
                    <p class="info"><span>ID del pedido:</span>F2306081510324393</p>
                    <p class="info"><span>Facturado a:</span> {{auth()->user()->email}}</p>
                    <p class="info"><span>Estado:</span> {{$msg['id_estado']}}</p>
                    <p class="info"><span>Fecha del pedido:</span> {{date("Y-m-s")}}</p>
                </div>

                {{-- <table class="invoice-table">
                    <thead>
                      <tr>
                        <th>ID del pedido</th>
                        <th>Facturado a</th>
                        <th>Estado</th>
                        <th>Fecha del pedido</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>F2306081510324393</td>
                        <td>{{auth()->user()->email}}</td>
                        <td>{{$msg['id_estado']}}</td>
                        <td>{{date("Y-m-s")}}</td>
                      </tr>
                    </tbody>
                  </table> --}}

                <p class="palabra3">TU PEDIDO:</p>
                <hr>

                <div class="desc-pedido">
                    <p class="info"><span>Descripción:</span> Es una descripciòn</p>
                    {{-- <p class="info"><span>Distribuidora:</span> {{$msg['colaborador']}}</p> --}}
                    <p class="info"><span>Precio:</span> 3934</p>
                </div>

                <div class="descuento-pedido">
                    <p class="info"><span>Descuentos:</span> 439</p>
                </div>

                <hr>

                <div class="total">
                    <p><span class="span1">TOTAL:</span> <span class="span2">3292</span></p> 
                </div>

                <hr>

                <div class="despedida">
                    <p>¡Que tenga un buen día!</p>
                </div>
            </div>
        
        </div>

    </div>

    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>
</html>