  <div class="row" style="margin: auto;">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <table class="table table-striped mt-0.5 table-bordered shadow-lg mt-4 dt-responsive nowrap" id="categoria">
              <thead class=" text-primary">
                <th class="text-center">
                  <strong>ID</strong>
                </th>
                <th class="text-center">
                  <strong>Codigo Atributo</strong>
                </th>
                <th class="text-center">
                  <strong>Nombre De Atributo</strong>
                </th>
                <th class="text-center">
                  <strong>Descripcion</strong>
                </th>
                <th class="text-center">
                  <strong>Ingreso</strong>
                </th>
                <th class="text-center">
                  <strong>Egreso</strong>
                </th>
                <th class="text-center">
                  <strong>Fecha De Registro</strong>
                </th>
              </thead>
              <tbody>
                  @php
                      $i=1;
                  @endphp
                  @if($detallecajas->count() > 0)
                    @foreach ($detallecajas as $caja)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td>{{ ($caja->Codigo_caja) }}</td>
                        <td>{{ ($caja->Nombre_Articulo) }}</td>
                        <td>{{ ($caja->Articulo_description) }}</td>
                        <td>{{ ($caja->Ingreso) }}</td>
                        <td>{{ ($caja->Egreso) }}</td>
                        <td>{{ ($caja->Fecha_registro) }}</td>
                    </tr>
                    @endforeach
                  @else
                    <h1>nada que mostrar</h1>
                  @endif
              </tbody>
          </table>
          @if($detallecajas->count() > 0)
              @php
                $in = $detallecajas->sum('Ingreso');
                $eg = $detallecajas->sum('Egreso');
                $val = (float)$in - (float)$eg;
              @endphp
              <br><br>
            <table style="width:100%">
              <tr>
                <td class="text-center" style="background-color:#70ca58; width:500px; padding: 10px; color:white"><h2><strong>INGRESO TOTAL: {{ $in }}</strong></h2> </td>
                <td class="text-center" style="background-color:#e95747; width:500px; color:white"><h2><strong>EGRESO TOTAL: {{ $eg }}</strong></h2></td>
                <td class="text-center" style="background-color:#52abff; width:500px; color:white"><h2><strong>TOTAL: {{$val}}</strong></h2></td>
              </tr>
            </table>
            <div class="container">
            @else
                  <h2>Nada que mostrar</h2>
            @endif
        </div>
      </div>
    </div>
  </div>
  <link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 

<style>
   .ui-menu .ui-menu-item a {
    font-size: 12px;
    }
    .ui-autocomplete {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1510 !important;
    float: left;
    display: none;
    min-width: 160px;
    width: 160px;
    padding: 4px 0;
    margin: 2px 0 0 0;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
    }
    .ui-menu-item > a.ui-corner-all {
        display: block;
        padding: 3px 15px;
        clear: both;
        font-weight: normal;
        line-height: 18px;
        color: #555555;
        white-space: nowrap;
        text-decoration: none;
    }
    .ui-state-hover, .ui-state-active {
        color: #ffffff;
        text-decoration: none;
        background-color: #0088cc;
        border-radius: 0px;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        background-image: none;
    }
      .demo-card-square1.mdl-card {
      width: 320px;
      height: 320px;
      margin:auto;
    }
    .demo-card-square1 > .mdl-card__title {
      color: #fff;
      background:
        url('https://cdn3.iconfinder.com/data/icons/google-material-design-icons/48/ic_directions_car_48px-128.png') bottom right 15% no-repeat #46B6AC;
    }
    .demo-card-square2.mdl-card {
      width: 320px;
      height: 320px;
    }
    .demo-card-square2 > .mdl-card__title {
      color: #fff;
      background:
        url('') bottom right 15% no-repeat #46B6AC;
    }
    
    ol, ul {
      list-style: none;
    }
    blockquote, q {
      quotes: none;
    }
    blockquote:before, blockquote:after, q:before, q:after {
      content: '';
      content: none;
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
    }
    header h2 {
      margin: 25px 10px;
      font-size: 28px;
      text-align: center;
      color:  #ea5849;
    }
    .container {
      margin: 10px auto;
      display: table;
      max-width: 100%;
      width: 100%;
    }

    nav.menu {
      background: #ea5849;
      position: relative;
      min-height: 45px;
      height: 100%;
    }

    .menu > ul > li {
      list-style: none;
      display: inline-block;
      color: #fff;
      line-height: 45px;
      
    }
    .menu > ul li a, .xs-menu li a {
      text-decoration: none;
      color: #fff;
      display:block;
      padding: 0px 24px;
    }
    .menu > ul li a:hover {
      background:#444;
      color: #fff;
      transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -webkit-transition-duration: 0.3s;
    }

    .displaynone{
      display: none;
    }
    .xs-menu-cont{
    display:none;
    }
    .xs-menu-cont > a:hover{
    cursor: pointer;
    }
      
    .xs-menu li {
    color: #fff;
    padding: 14px 30px;
    border-bottom: 1px solid #ccc;
    background: #FF0000;

    }
    .xs-menu  a{
    text-decoration:none;
    }

    .mega-menu {
      background: none repeat scroll 0 0 #888;
        left: 0;
        margin-top: 3px;
        position: absolute;
        width: 100%;
      padding:15px;
      display:none;
      transition-duration: 0.9s;
        
    }
    #menutoggle i {
        color: #fff;
        font-size: 33px;
        margin: 0;
        padding: 0;
    }


    /*--column--*/
    .mm-6column:after, .mm-6column:before, .mm-3column:after, .mm-3column:before{
    content:"";
    display:table;
    clear:both;


    }
    .mm-6column, .mm-3column {
    float: left;
    position: relative;
    }
    .mm-6column {
        width: 100%;
    }
    .mm-3column {
            width: 25%;
    }
    .responsive-img {
        display: block;
        max-width: 100%;

    }
    .left-images{
    margin-right:25px;
    }
    .left-images, .left-categories-list {
      float: left;
    }
    .categories-list li {
        display: block;
        line-height: normal;
        margin: 0;
        padding: 5px 0;
    }
    .categories-list li :hover{
        background:inherit !important;
    }
    .left-images > p {
        background: none repeat scroll 0 0 #FF0000;
        display: block;
        font-size: 18px;
        line-height: normal;
        margin: 0;
        padding: 5px 14px;
    }
    .categories-list span {
        font-size: 18px;
        padding-bottom: 5px;
        text-transform: uppercase;
    }
    .mm-view-more{
      background: none repeat scroll 0 0 #FF0000;
        color: #fff;
        display: inline !important;
        line-height: normal;
        padding: 5px 8px !important;
      margin-top:10px;
    }
    .display-on{
    display:block;
    transition-duration: 0.9s;
    }
    .drop-down > a:after{
    content:"\f103";
    color:red;
    font-family: FontAwesome;
    font-style: normal;
    margin-left: 5px;
    }
</style>
@notifyCss