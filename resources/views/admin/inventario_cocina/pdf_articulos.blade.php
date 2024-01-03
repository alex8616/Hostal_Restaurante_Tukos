<body>
 <div id="wrapper">
 <div class="hero">
    <h1 id="htitle"><span id="title">RESTAURANT TUKO´S -  ARTICULOS</span></h1>
    <h5>(Fecha De Descarga:{{now()}})</h5>
    <h5> </h5>
</div><br>
  <table id="keywords" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th><span></span></th>
        <th><span>N°</span></th>
        <th><span>PHOTOS</span></th>
        <th><span>NOMBRE</span></th>
        <th><span>DESCRIPCION</span></th>
        <th><span>BUENO</span></th>
        <th><span>REGULAR</span></th>
        <th><span>MALO</span></th>
        <th><span>TOTAL</span></th>
      </tr>
    </thead>
    <tbody>
    @php
        $i=1;
    @endphp
    @foreach ($articulosArray as $articulo)
      <tr>
        @if($i%2 == 0)
            <td style="background: #e2e2e2;"></td>
            <td style="background: #e2e2e2;">{{$i++}}</td>
            <td style="background: #e2e2e2;">
                @foreach (json_decode($articulo->photos_articulo) as $photo)
                    <img src="{{ $photo }}" alt="Foto del Artículo" style="width:100px;height:100px;">
                @endforeach
            </td>
            <td style="background: #e2e2e2;">{{ $articulo->Nombre_articulo }}</td>
            <td style="background: #e2e2e2;">{{ $articulo->Descripcion_articulo }}</td>
            <td style="background: #e2e2e2; text-align: center;">{{ $articulo->Buen_Estado }}</td>
            <td style="background: #e2e2e2; text-align: center;">{{ $articulo->Mal_Estado }}</td>
            <td style="background: #e2e2e2; text-align: center;">{{ $articulo->Daniado_Estado }}</td>
            <td style="background: #e2e2e2; text-align: center;">{{ $articulo->Total_articulo }}</td>
        @else
            <td></td>
            <td>{{$i++}}</td>
            <td>
                @foreach (json_decode($articulo->photos_articulo) as $photo)
                    <img src="{{ $photo }}" alt="Foto del Artículo" style="width:100px;height:100px;">
                @endforeach
            </td>
            <td>{{ $articulo->Nombre_articulo }}</td>
            <td>{{ $articulo->Descripcion_articulo }}</td>
            <td style="text-align: center;">{{ $articulo->Buen_Estado }}</td>
            <td style="text-align: center;">{{ $articulo->Mal_Estado }}</td>
            <td style="text-align: center;">{{ $articulo->Daniado_Estado }}</td>
            <td style="background: #e2e2e2; text-align: center;">{{ $articulo->Total_articulo }}</td>
        @endif
      </tr>
    @endforeach
    </tbody>
  </table>
 </div> 
</body>
<style>
#htitle{
    font-size: 50px;
    line-height: 1.3;
    font-size: 30px;
    line-height: 1.8;
    text-transform: uppercase;
    font-family: "Montserrat", sans-serif;
}

.hero {
  position: relative;
  background: #333 url(http://srdjanpajdic.com/slike/2.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  text-align: center;
  color: #e8f380;
  padding-top: -60px;
  letter-spacing: 2px;
  font-family: "Montserrat", sans-serif;
}
#title{
    font-size: 25px;
    color: #e8f380;
    border-bottom: 2px solid #e8f380;
    padding-bottom: 12px;
    line-height: 3;
}
#notifi{
  width:100%; 
  height:600px; 
  overflow: scroll;
  overflow-x: hidden;
}
#notifi::-webkit-scrollbar {
  -webkit-appearance: none;
}

#notifi::-webkit-scrollbar:vertical {
  width:10px;
  background-color: floralwhite;
}

#notifi::-webkit-scrollbar-button:increment,.contenedor::-webkit-scrollbar-button {
  display: none;
} 

#notifi::-webkit-scrollbar:horizontal {
  height: 10px;
}

#notifi::-webkit-scrollbar-thumb {
  background-color: #797979;
  border-radius: 20px;
  border: 2px solid #f1f2f3;
}

#notifi::-webkit-scrollbar-track {
  border-radius: 10px;  
}
/** page structure **/
#keywords thead {
  background: #c9dff0;
}
#keywords thead tr th { 
  font-weight: bold;
  padding: 5px;
}
#keywords thead tr th span { 
  padding-right: 20px;
}

#keywords tbody tr { 
  color: #555;
}
#keywords tbody tr td {
  padding: 8px 6px;
  font-size: 13px;
}

</style>