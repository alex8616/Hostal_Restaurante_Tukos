@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<button onclick="habilitarEdicion()">Editar</button>
<button onclick="guardarPosiciones()">Guardar</button>
<div class="row">
  <div class="col-md-8 order-md-1">
    <div style="width: 100%; height: 100%; overflow: auto;">
        <div style="position: relative; width: 100%; height: 100%;">
            <div style="background-image: url('/img/bar.png'); width: 750px; height: 650px; background-size:100%">
            @foreach($mesas as $mesa)
                @if($mesa->id <= 3)
                    @if($mesa->estado == 'FALSE')
                    <a href="{{ route('bar.consumir', ['id' => $mesa->id ?? null]) }}" onclick="return confirm('¿Estás seguro de que deseas consumir esta mesa?')">
                        <div id="seat{{ $mesa->id }}" class="seat available"
                        data-id="{{ $mesa->id }}"
                        style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px; display: flex; justify-content: center; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="150" height="150" viewBox="0 0 150 150" xml:space="preserve">
                            <desc>Created with Fabric.js 5.3.0</desc>
                                <defs>
                                </defs>
                                <g transform="matrix(1 0 0 1 75 75)" id="VqGbZBwb8Lzragui5MJIU"  >
                                    <path style="stroke: rgb(164,247,170); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; 
                                                stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(9,255,0); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke"  transform=" translate(-70.81412, -70.52677)" d="M 22.58404 80.72432 C 20.730300000000003 82.07652 18.447090000000003 82.87472000000001 15.978580000000001 82.87472000000001 C 13.5698 82.87472000000001 11.33745 82.11469000000001 9.50843 80.82151000000002 L 9.50843 86.51631000000002 L 0 86.51631000000002 L 0 56.784390000000016 L 9.50843 56.784390000000016 L 9.50843 62.47920000000002 C 11.33745 61.18602000000002 13.5698 60.42599000000002 15.978580000000001 60.42599000000002 C 18.60798 60.42599000000002 21.027140000000003 61.33162000000002 22.94096 62.84777000000002 C 26.872040000000002 42.88437000000002 42.400130000000004 27.06708000000002 62.208740000000006 22.71241000000002 C 60.79898000000001 20.83619000000002 59.96331000000001 18.50438000000002 59.96331000000001 15.97859000000002 C 59.96331000000001 13.56981000000002 60.72334000000001 11.33746000000002 62.01652000000001 9.50844000000002 L 56.321720000000006 9.50844000000002 L 56.321720000000006 0.000010000000019161348 L 86.05364 0.000010000000019161348 L 86.05364 9.50844000000002 L 80.35883 9.50844000000002 C 81.65201 11.33746000000002 82.41203999999999 13.56981000000002 82.41203999999999 15.97859000000002 C 82.41203999999999 18.21281000000002 81.75816999999999 20.29525000000002 80.63148 22.044840000000022 C 101.44631 25.04676000000002 118.23177 40.56481000000002 123.10495 60.71607000000002 C 123.92264 60.52630000000002 124.77451 60.425980000000024 125.64966 60.425980000000024 C 128.05844 60.425980000000024 130.29079 61.186010000000024 132.11981 62.479190000000024 L 132.11981 56.78439000000002 L 141.62824 56.78439000000002 L 141.62824 86.51631000000002 L 132.11981 86.51631000000002 L 132.11981 80.82150000000001 C 130.29079 82.11468000000002 128.05844 82.87471000000002 125.64966 82.87471000000002 C 124.94457 82.87471000000002 124.2546 82.80959000000003 123.58543999999999 82.68504000000001 C 119.67353999999999 102.69182 104.11674 118.54648000000002 84.26915 122.89491000000001 C 84.40814999999999 123.60019000000001 84.48102 124.32911000000001 84.48102 125.07495000000002 C 84.48102 127.48373000000001 83.72099 129.71608 82.42781 131.54510000000002 L 88.12261 131.54510000000002 L 88.12261 141.05353000000002 L 58.39068999999999 141.05353000000002 L 58.39068999999999 131.54510000000002 L 64.0855 131.54510000000002 C 62.79232 129.71608 62.032289999999996 127.48373000000002 62.032289999999996 125.07495000000002 C 62.032289999999996 124.32911000000001 62.10516 123.60018000000001 62.244159999999994 122.89491000000001 C 41.752449999999996 118.40536000000002 25.834549999999993 101.65064000000001 22.58404999999999 80.72432 z" stroke-linecap="round" />
                                </g>
                                </svg>
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $mesa->id }}</span>
                        </div>
                    </a>
                    @else
                    <a href="{{ route('bar.waitfood', ['id' => $mesa->id]) }}">
                        <div id="seat{{ $mesa->id }}" class="seat available"
                        data-id="{{ $mesa->id }}"
                        style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px; display: flex; justify-content: center; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="150" height="150" viewBox="0 0 150 150" xml:space="preserve">
                            <!-- Contenido del SVG -->
                            <desc>Created with Fabric.js 5.3.0</desc>
                                <defs>
                                </defs>
                                <g transform="matrix(1 0 0 1 75 75)" id="VqGbZBwb8Lzragui5MJIU"  >
                                    <path style="stroke: rgb(164,247,170); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; 
                                                stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,0,0); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke"  transform=" translate(-70.81412, -70.52677)" d="M 22.58404 80.72432 C 20.730300000000003 82.07652 18.447090000000003 82.87472000000001 15.978580000000001 82.87472000000001 C 13.5698 82.87472000000001 11.33745 82.11469000000001 9.50843 80.82151000000002 L 9.50843 86.51631000000002 L 0 86.51631000000002 L 0 56.784390000000016 L 9.50843 56.784390000000016 L 9.50843 62.47920000000002 C 11.33745 61.18602000000002 13.5698 60.42599000000002 15.978580000000001 60.42599000000002 C 18.60798 60.42599000000002 21.027140000000003 61.33162000000002 22.94096 62.84777000000002 C 26.872040000000002 42.88437000000002 42.400130000000004 27.06708000000002 62.208740000000006 22.71241000000002 C 60.79898000000001 20.83619000000002 59.96331000000001 18.50438000000002 59.96331000000001 15.97859000000002 C 59.96331000000001 13.56981000000002 60.72334000000001 11.33746000000002 62.01652000000001 9.50844000000002 L 56.321720000000006 9.50844000000002 L 56.321720000000006 0.000010000000019161348 L 86.05364 0.000010000000019161348 L 86.05364 9.50844000000002 L 80.35883 9.50844000000002 C 81.65201 11.33746000000002 82.41203999999999 13.56981000000002 82.41203999999999 15.97859000000002 C 82.41203999999999 18.21281000000002 81.75816999999999 20.29525000000002 80.63148 22.044840000000022 C 101.44631 25.04676000000002 118.23177 40.56481000000002 123.10495 60.71607000000002 C 123.92264 60.52630000000002 124.77451 60.425980000000024 125.64966 60.425980000000024 C 128.05844 60.425980000000024 130.29079 61.186010000000024 132.11981 62.479190000000024 L 132.11981 56.78439000000002 L 141.62824 56.78439000000002 L 141.62824 86.51631000000002 L 132.11981 86.51631000000002 L 132.11981 80.82150000000001 C 130.29079 82.11468000000002 128.05844 82.87471000000002 125.64966 82.87471000000002 C 124.94457 82.87471000000002 124.2546 82.80959000000003 123.58543999999999 82.68504000000001 C 119.67353999999999 102.69182 104.11674 118.54648000000002 84.26915 122.89491000000001 C 84.40814999999999 123.60019000000001 84.48102 124.32911000000001 84.48102 125.07495000000002 C 84.48102 127.48373000000001 83.72099 129.71608 82.42781 131.54510000000002 L 88.12261 131.54510000000002 L 88.12261 141.05353000000002 L 58.39068999999999 141.05353000000002 L 58.39068999999999 131.54510000000002 L 64.0855 131.54510000000002 C 62.79232 129.71608 62.032289999999996 127.48373000000002 62.032289999999996 125.07495000000002 C 62.032289999999996 124.32911000000001 62.10516 123.60018000000001 62.244159999999994 122.89491000000001 C 41.752449999999996 118.40536000000002 25.834549999999993 101.65064000000001 22.58404999999999 80.72432 z" stroke-linecap="round" />
                                </g>
                                </svg>
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $mesa->id }}</span>
                        </div>
                    </a>
                    @endif
                    @elseif($mesa->id >=4 && $mesa->id <= 8)
                    @if($mesa->estado == 'FALSE')
                    <a href="{{ route('bar.consumir', ['id' => $mesa->id ?? null]) }}" onclick="return confirm('¿Estás seguro de que deseas consumir esta mesa?')">
                        <div id="seat{{ $mesa->id }}" class="seat available"
                        data-id="{{ $mesa->id }}"
                        style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px; display: flex; justify-content: center; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="150" height="150" viewBox="0 0 150 150" xml:space="preserve">
                            <desc>Created with Fabric.js 5.3.0</desc>
                            <defs>
                            </defs>
                            <g transform="matrix(1 0 0 1 74.9999910789 73.8546230567)" id="q5c7h8nkASI1tseSW7pEs"  >
                            <path style="stroke: rgb(1,109,94); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(9,255,0); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke"  transform=" translate(0, 0)" d="M -71.56407 -71.28738 L 71.56409000000001 -71.28738 L 71.56409000000001 -56.60086 L 56.69364000000001 -56.60086 L 56.69364000000001 -38.830169999999995 L -58.286869999999986 -38.830169999999995 L -58.286869999999986 -56.60086 L -71.56406999999999 -56.60086 z M -71.99842 -14.9298 C -71.99842 -21.34421 -66.79852 -26.54411 -60.38410999999999 -26.54411 L 62.37068000000001 -26.54411 L 62.37068000000001 -26.54411 C 67.68794000000001 -26.54411 71.99842000000001 -22.233620000000002 71.99842000000001 -16.91637 L 71.99842000000001 16.57877 L 71.99842000000001 16.57877 C 71.99842000000001 22.2336 67.41427000000002 26.817749999999997 61.75944000000001 26.817749999999997 L -62.82909999999998 26.817749999999997 L -62.82909999999998 26.817749999999997 C -67.89316999999998 26.817749999999997 -71.99840999999998 22.712509999999995 -71.99840999999998 17.648439999999997 z M 71.56409 71.28739 L -71.56407000000002 71.28739 L -71.56407000000002 56.64171 L -56.69362000000002 56.64171 L -56.69362000000002 38.92044 L 58.28688999999998 38.92044 L 58.28688999999998 56.64171 L 71.56408999999998 56.64171 z" stroke-linecap="round" />
                            </g>
                            </svg>
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $mesa->id }}</span>
                        </div>
                    </a>    
                    @else
                    <a href="{{ route('bar.waitfood', ['id' => $mesa->id]) }}">
                        <div id="seat{{ $mesa->id }}" class="seat available"
                        data-id="{{ $mesa->id }}"
                        style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px; display: flex; justify-content: center; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="150" height="150" viewBox="0 0 150 150" xml:space="preserve">
                            <desc>Created with Fabric.js 5.3.0</desc>
                            <defs>
                            </defs>
                            <g transform="matrix(1 0 0 1 74.9999910789 73.8546230567)" id="q5c7h8nkASI1tseSW7pEs"  >
                            <path style="stroke: rgb(1,109,94); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,0,0); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke"  transform=" translate(0, 0)" d="M -71.56407 -71.28738 L 71.56409000000001 -71.28738 L 71.56409000000001 -56.60086 L 56.69364000000001 -56.60086 L 56.69364000000001 -38.830169999999995 L -58.286869999999986 -38.830169999999995 L -58.286869999999986 -56.60086 L -71.56406999999999 -56.60086 z M -71.99842 -14.9298 C -71.99842 -21.34421 -66.79852 -26.54411 -60.38410999999999 -26.54411 L 62.37068000000001 -26.54411 L 62.37068000000001 -26.54411 C 67.68794000000001 -26.54411 71.99842000000001 -22.233620000000002 71.99842000000001 -16.91637 L 71.99842000000001 16.57877 L 71.99842000000001 16.57877 C 71.99842000000001 22.2336 67.41427000000002 26.817749999999997 61.75944000000001 26.817749999999997 L -62.82909999999998 26.817749999999997 L -62.82909999999998 26.817749999999997 C -67.89316999999998 26.817749999999997 -71.99840999999998 22.712509999999995 -71.99840999999998 17.648439999999997 z M 71.56409 71.28739 L -71.56407000000002 71.28739 L -71.56407000000002 56.64171 L -56.69362000000002 56.64171 L -56.69362000000002 38.92044 L 58.28688999999998 38.92044 L 58.28688999999998 56.64171 L 71.56408999999998 56.64171 z" stroke-linecap="round" />
                            </g>
                            </svg>
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $mesa->id }}</span>
                        </div>
                    </a>
                    @endif
                    @elseif($mesa->id >=9 && $mesa->id <= 16)
                    @if($mesa->estado == 'FALSE')
                    <a href="{{ route('bar.consumir', ['id' => $mesa->id]) }}">
                        <div id="seat{{ $mesa->id }}" class="seat available"
                        data-id="{{ $mesa->id }}"
                        style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px; display: flex; justify-content: center; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="150" height="150" viewBox="0 0 150 150" xml:space="preserve">
                            <desc>Created with Fabric.js 5.3.0</desc>
                            <defs>
                            </defs>
                            <g transform="matrix(0.9978168799 0 0 0.9978168799 75 75)" id="lHc5ZKI32_OkSxsD3QzUk"  >
                            <path style="stroke: rgb(222,125,107); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(9,255,0); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke"  transform=" translate(-73.7254201564, -73.6280719607)" d="M 26.54376 46.30787 C 26.54376 35.2277 35.52601 26.245440000000002 46.60619 26.245440000000002 L 101.05652 26.245440000000002 C 112.13669 26.245440000000002 121.11895000000001 35.22769 121.11895000000001 46.30787 L 121.11895000000001 100.7582 C 121.11895000000001 111.83837 112.13670000000002 120.82063 101.05652 120.82063 L 46.606190000000005 120.82063 C 35.52602 120.82063 26.543760000000006 111.83838 26.543760000000006 100.75819999999999 z M 85.41576 20.36818 C 85.41576 23.08258 83.2153 25.28304 80.5009 25.28304 L 67.16175 25.28304 C 64.44735 25.28304 62.24689 23.08258 62.24689 20.36818 L 62.24689 8.804179999999999 L 57.72895 8.804179999999999 L 57.72895 -1.7763568394002505e-15 L 89.93369 -1.7763568394002505e-15 L 89.93369 8.804179999999999 L 85.41575 8.804179999999999 z M 20.36818 61.94858 C 23.08258 61.94858 25.28304 64.14904 25.28304 66.86344 L 25.28304 80.20259 C 25.28304 82.91699 23.08258 85.11745 20.36818 85.11745 L 8.804179999999999 85.11745 L 8.804179999999999 89.63539 L -1.7763568394002505e-15 89.63539 L -1.7763568394002505e-15 57.43065 L 8.804179999999999 57.43065 L 8.804179999999999 61.94859 z M 127.08266 85.11744 C 124.36826 85.11744 122.1678 82.91698 122.1678 80.20258 L 122.1678 66.86343 C 122.1678 64.14903 124.36826 61.94857 127.08266 61.94857 L 138.64666 61.94857 L 138.64666 57.430629999999994 L 147.45084 57.430629999999994 L 147.45084 89.63537 L 138.64666 89.63537 L 138.64666 85.11743 z M 62.2469 126.88796 C 62.2469 124.17356000000001 64.44736 121.9731 67.16176 121.9731 L 80.50091 121.9731 C 83.21531 121.9731 85.41577000000001 124.17356000000001 85.41577000000001 126.88796 L 85.41577000000001 138.45196 L 89.93371 138.45196 L 89.93371 147.25614000000002 L 57.728970000000004 147.25614000000002 L 57.728970000000004 138.45196 L 62.24691000000001 138.45196 z" stroke-linecap="round" />
                            </g>
                            </svg>
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $mesa->id }}</span>
                        </div>
                    </a>
                    @else
                    <a href="{{ route('bar.waitfood', ['id' => $mesa->id]) }}">
                        <div id="seat{{ $mesa->id }}" class="seat available"
                        data-id="{{ $mesa->id }}"
                        style="left: {{ $mesa->posicion_x }}px; top: {{ $mesa->posicion_y }}px; display: flex; justify-content: center; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="150" height="150" viewBox="0 0 150 150" xml:space="preserve">
                            <desc>Created with Fabric.js 5.3.0</desc>
                            <defs>
                            </defs>
                            <g transform="matrix(0.9978168799 0 0 0.9978168799 75 75)" id="lHc5ZKI32_OkSxsD3QzUk"  >
                            <path style="stroke: rgb(222,125,107); stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,0,0); fill-rule: nonzero; opacity: 1;" vector-effect="non-scaling-stroke"  transform=" translate(-73.7254201564, -73.6280719607)" d="M 26.54376 46.30787 C 26.54376 35.2277 35.52601 26.245440000000002 46.60619 26.245440000000002 L 101.05652 26.245440000000002 C 112.13669 26.245440000000002 121.11895000000001 35.22769 121.11895000000001 46.30787 L 121.11895000000001 100.7582 C 121.11895000000001 111.83837 112.13670000000002 120.82063 101.05652 120.82063 L 46.606190000000005 120.82063 C 35.52602 120.82063 26.543760000000006 111.83838 26.543760000000006 100.75819999999999 z M 85.41576 20.36818 C 85.41576 23.08258 83.2153 25.28304 80.5009 25.28304 L 67.16175 25.28304 C 64.44735 25.28304 62.24689 23.08258 62.24689 20.36818 L 62.24689 8.804179999999999 L 57.72895 8.804179999999999 L 57.72895 -1.7763568394002505e-15 L 89.93369 -1.7763568394002505e-15 L 89.93369 8.804179999999999 L 85.41575 8.804179999999999 z M 20.36818 61.94858 C 23.08258 61.94858 25.28304 64.14904 25.28304 66.86344 L 25.28304 80.20259 C 25.28304 82.91699 23.08258 85.11745 20.36818 85.11745 L 8.804179999999999 85.11745 L 8.804179999999999 89.63539 L -1.7763568394002505e-15 89.63539 L -1.7763568394002505e-15 57.43065 L 8.804179999999999 57.43065 L 8.804179999999999 61.94859 z M 127.08266 85.11744 C 124.36826 85.11744 122.1678 82.91698 122.1678 80.20258 L 122.1678 66.86343 C 122.1678 64.14903 124.36826 61.94857 127.08266 61.94857 L 138.64666 61.94857 L 138.64666 57.430629999999994 L 147.45084 57.430629999999994 L 147.45084 89.63537 L 138.64666 89.63537 L 138.64666 85.11743 z M 62.2469 126.88796 C 62.2469 124.17356000000001 64.44736 121.9731 67.16176 121.9731 L 80.50091 121.9731 C 83.21531 121.9731 85.41577000000001 124.17356000000001 85.41577000000001 126.88796 L 85.41577000000001 138.45196 L 89.93371 138.45196 L 89.93371 147.25614000000002 L 57.728970000000004 147.25614000000002 L 57.728970000000004 138.45196 L 62.24691000000001 138.45196 z" stroke-linecap="round" />
                            </g>
                            </svg>
                            <span style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">{{ $mesa->id }}</span>
                        </div>
                    </a>
                    @endif
                @endif
            @endforeach
        </div>
        </div>
    </div>
  </div>
  <div class="col-md-4 order-md-2">
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Total</th>
            <th>Accion</th>
        </tr>
        @foreach($comandaMesa as $listacomanda)
        <tr>
            <td>Mesa #{{ $listacomanda->mesa_id }}</td>
            <td>{{ $listacomanda->fecha_venta }}</td>
            <td>
            @foreach ($detalles as $detallecomanda)
                @if($listacomanda->id == $detallecomanda->comanda_mesa_id)
                    @if ($detallecomanda->plato)
                        {{ Str::ucfirst($detallecomanda->plato->Nombre_plato) }}
                    @endif
                @endif
            @endforeach
            </td>
            <td>{{ $listacomanda->total }}</td>
            <td style="margin: 50%">
                <ul class="wrapper" style="height: 50px; display: inline-flex;">
                    <li class="icon facebook" style="padding:4%" data-toggle="modal" data-target="#tablePdf{{ $listacomanda->id }}">
                        <span class="tooltip" style="font-size: 10px;">IMPRIMIR</span>
                        <span><i class="fa-solid fa-print"></i></span>
                    </li>
                    @include('admin.Bar.tablePdf')
                </ul>
            </td>
        </tr>
    @endforeach
    </table>
  </div>
</div>
@endsection

<!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
    .seat {
        position: absolute;
        width: 95px;
        height: 15px;
        margin: 5px;
        border-radius: 15%;
        cursor: pointer;
        padding: 5px;
        color: black;
    }

    .responsive {
    width: 100%;
    max-width: 100%; /* Opcional: Ajusta esto según tus necesidades */
    box-sizing: border-box; /* Opcional: Asegura que el ancho total incluya padding y border */

    /* Estilos comunes */
    padding: 20px;
    background-color: #f2f2f2;
    color: #333;
    }

    /* Estilos para pantallas de celular */
    @media (max-width: 767px) {
    .responsive {
        font-size: 14px; /* Opcional: Ajusta esto según tus necesidades */
    }
    }

    
</style>
@notifyCss
@push('js')
<!-- JavaScript -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.8/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/interactjs@1.10.11"></script>
<script>
    var isEditMode = false;
    var selectedSeat = null;
    var originalX = 0;
    var originalY = 0;

    function habilitarEdicion() {
        isEditMode = true;
        var seats = document.getElementsByClassName('seat');
        for (var i = 0; i < seats.length; i++) {
            seats[i].draggable = true;
            seats[i].addEventListener('dragstart', iniciarArrastre);
            seats[i].addEventListener('dragend', finalizarArrastre);
        }
    }

    function guardarPosiciones() {
        if (!isEditMode) return;

        var seats = document.getElementsByClassName('seat');
        var posiciones = [];

        for (var i = 0; i < seats.length; i++) {
            var seat = seats[i];
            var id = seat.getAttribute('data-id');
            var left = parseInt(seat.style.left);
            var top = parseInt(seat.style.top);
            posiciones.push({
                id: id,
                left: left,
                top: top
            });
        }

        // Realizar la llamada AJAX para guardar las posiciones en la base de datos
        var data = { posiciones: posiciones };
        fetch('{{ route("admin.bar.guardarPosiciones") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Imprimir la respuesta en la consola (solo para fines de demostración)
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function iniciarArrastre(event) {
        if (!isEditMode) return;

        selectedSeat = event.target;
        originalX = event.clientX;
        originalY = event.clientY;
    }

    function finalizarArrastre(event) {
        if (!isEditMode) return;

        var deltaX = event.clientX - originalX;
        var deltaY = event.clientY - originalY;
        var newLeft = parseInt(selectedSeat.style.left) + deltaX;
        var newTop = parseInt(selectedSeat.style.top) + deltaY;

        selectedSeat.style.left = newLeft + 'px';
        selectedSeat.style.top = newTop + 'px';
        selectedSeat.draggable = false;
        selectedSeat.removeEventListener('dragstart', iniciarArrastre);
        selectedSeat.removeEventListener('dragend', finalizarArrastre);
        selectedSeat = null;
    }
</script>
@notifyJs
@endpush
    

    
