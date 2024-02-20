<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Factura de Compra</title>
  @vite(['resources/js/factura_cerrar_pedido.js'])
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    h1 {
      color: #333;
    }

    p {
      color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .footer {
      margin-top: 20px;
      padding-top: 10px;
      border-top: 1px solid #ddd;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Factura de Compra</h1>
    
    <p class="saludo_cliente">Estimado Cliente, {{auth()->user()->name}}</p>
    <table>
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          {{-- <th>Total</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($msg as $pedido)
          <tr>
            <td>{{$pedido->id}}</td>
            <td>{{$pedido->id}}</td>
            <td>{{$pedido->id}}</td>
          </tr>
        @endforeach
        {{-- <tr>
          <td>Producto 1</td>
          <td>2</td>
          <td>$20.00</td>
          <td>$40.00</td>
        </tr>
        <tr>
          <td>Producto 2</td>
          <td>1</td>
          <td>$30.00</td>
          <td>$30.00</td>
        </tr> --}}
        <!-- Agrega más filas según sea necesario -->
      </tbody>
    </table>

    <div class="footer">
      <p>Total: $70.00</p>
      <p>Gracias por tu compra.</p>
    </div>
  </div>
</body>
</html>
