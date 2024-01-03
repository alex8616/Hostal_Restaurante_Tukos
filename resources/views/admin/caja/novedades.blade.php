<div style="background: white; width: 100%; height: auto; padding-left: 15px; padding-right: 15px; padding-top: 15px;">
  <div class="table-responsive" id="tabla-responsiva">
  @if($contar > 0)
    <table class="table" id="novedadtable" style="width: 100%;">
      <thead>
        <tr>
          <th padding: 0px;>
            <strong>REGISTRADO POR:</strong><br><br>
            {{ $username->name }} <br><br>
            {{ $username->email }} <br><br>
            {{ $novedades->Fecha_registro }}<br><br>
          </th>
          <th>
            {!! $novedades->detalle !!}
          </th>
          <th style="padding-left: 40px;">
            <div class="container" style="padding: 10px">
                <strong>CONTROLES:</strong>
                <div class="row">
                    @foreach($resultadoscontroles as  $numero => $control)
                        @if($control == 'NO')
                        <div style="text-align: center; background: #E76161; padding: 5px;">{{ $numero }}</div>
                        @else
                        <div style="text-align: center; background: #B6E388; padding: 5px;">{{ $numero }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="container" style="padding: 10px">
                <strong>LLAVES:</strong>
                <div class="row">
                    @foreach($resultadosllaves as  $numero => $control)
                        @if($control == 'NO')
                        <div style="text-align: center; background: #E76161; padding: 5px;">{{ $numero }}</div>
                        @else
                        <div style="text-align: center; background: #B6E388; padding: 5px;">{{ $numero }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div>
                        <strong>TANQUE 1</strong>
                        <div class="progress" data-percentage="{{ $novedades->tanque_1}}"></div>
                    </div>
                    <div>
                        <strong>TANQUE 2</strong>
                        <div class="progress" data-percentage="{{ $novedades->tanque_2}}"></div>
                    </div>
                    <div>
                        <strong>TANQUE 3</strong>
                        <div class="progress" data-percentage="{{ $novedades->tanque_3}}"></div>
                    </div>
                    <div>
                        <p>Para Ver todas las novedades click <a href="{{ route('admin.novedades.index') }}" target="_blank">!!AQUI!!</a></p>
                    </div>
                </div>
            </div>
          </th>
        </tr>
      </thead>
    </table>
  </div>
  @endif
</div>
<style>
    /* Estilo para las celdas de la tabla */
    #novedadtable tr th {
      border: solid 1px #61677A;
    }

    /* Estilo para las barras de progreso */
    .progress {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      border: 10px solid #eee;
      position: relative;
      --percentage: 0;
    }

    .progress::after {
      content: attr(data-percentage) "%";
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 10px solid blue;
      position: absolute;
      top: 0;
      left: 0;
      transform: rotate(-90deg);
      transform-origin: center;
      animation: progress 2s linear forwards;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 24px;
      font-weight: bold;
    }

    .progress::before {
      content: "";
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 10px solid transparent;
      border-top-color: #1abc9c;
      position: absolute;
      top: 0;
      left: 0;
      transform: rotate(-90deg);
      transform-origin: center;
      animation: progress-line 2s linear forwards;
    }

    @keyframes progress {
      from {
        transform: rotate(-90deg);
      }
      to {
        transform: rotate(calc(-90deg + (var(--percentage) * 360 / 100)));
      }
    }

    @keyframes progress-line {
      from {
        stroke-dasharray: 0, 100;
        stroke-dashoffset: 0;
      }
      to {
        stroke-dasharray: calc((var(--percentage) * 360 / 100) - 10) 100, 100;
        stroke-dashoffset: calc((var(--percentage) * 360 / 100) - 10);
      }
    }

    /* Estilo para pantallas pequeñas */
    @media (max-width: 576px) {
      #tabla-responsiva td,
      #tabla-responsiva th {
        display: block;
        width: 100%;
      }
      #tabla-responsiva tbody tr {
        display: block;
      }
      #tabla-responsiva td:before {
        font-weight: bold;
        content: attr(data-label);
        display: inline-block;
        width: 120px;
      }
    }
</style>
  