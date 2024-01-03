<body>
 <div id="wrapper">
  <table id="keywords" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th colspan="6" style="text-align: center; font-size: 25px; background: #c9dff0;">
            <strong>RESTAURANT TUKO´S -  ARTICULOS REGISTRADOS</strong>
        </th>
      </tr>
      <tr>
        <th style="text-align: center;"><strong>N°</strong></th>
        <th style="text-align: center;"><strong>NOMBRE</strong></th>
        <th style="text-align: center;"><strong>DESCRIPCION</strong></th>
        <th style="text-align: center;"><strong>CANTIDAD</strong></th>
        <th style="text-align: center;"><strong>FECHA/REGISTRO</strong></th>
        <th style="text-align: center;"><strong>FECHA/ACTUALIZACION</strong></th>
      </tr>
    </thead>
    <tbody>
    @php
        $i=1;
    @endphp
    @foreach ($articulos as $articulo)
      <tr>
      @if($articulo->estado == 'ACTIVO')
          @if($i%2 == 0)
              <td style="background: #e2e2e2; text-align: center;">{{$i++}}</td>
              <td style="background: #e2e2e2; text-align: justify;">{{$articulo->Nombre_articulo}}</td>
              <td style="text-align: justify; background: #e2e2e2; text-justify: inter-word; width: 300px">{{$articulo->Descripcion_articulo}}</td>
              <td style="text-align: center; background: #e2e2e2;">{{$articulo->Cantidad_articulo}}</td>
              <td style="text-align: center; background: #e2e2e2;">{{$articulo->created_at}}</td>
              <td style="text-align: center; background: #e2e2e2;">{{$articulo->updated_at}}</td>
          @else
              <td style="text-align: center;">{{$i++}}</td>
              <td style="text-align: justify;">{{$articulo->Nombre_articulo}}</td>
              <td style="text-align: justify; text-justify: inter-word; width: 300px">{{$articulo->Descripcion_articulo}}</td>
              <td style="text-align: center;">{{$articulo->Cantidad_articulo}}</td>
              <td style="text-align: center;">{{$articulo->created_at}}</td>
              <td style="text-align: center;">{{$articulo->updated_at}}</td>
          @endif
      </tr>
      @endif
    @endforeach
    </tbody>
  </table>
 </div> 
</body>
<style>
    table, th, td {
        border: 1px solid;
    }
</style>