@extends('layouts.main', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
<br><br><hr>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/elements/infobox.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />

<body style="background: #eeeeee;">

    <div class="form-row" style="margin:auto; width:97%">
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%; margin-top: 30px;">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="infobox-3" style="width: 100%;">
                                <div class="info-icon">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 15.315 15.315" xml:space="preserve" width="256px" height="256px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path style="fill:#ffffff;" d="M3.669,3.71h0.696c0.256,0,0.464-0.165,0.464-0.367V0.367C4.829,0.164,4.621,0,4.365,0H3.669 C3.414,0,3.206,0.164,3.206,0.367v2.976C3.205,3.545,3.413,3.71,3.669,3.71z"></path> <path style="fill:#ffffff;" d="M10.95,3.71h0.696c0.256,0,0.464-0.165,0.464-0.367V0.367C12.11,0.164,11.902,0,11.646,0H10.95 c-0.256,0-0.463,0.164-0.463,0.367v2.976C10.487,3.545,10.694,3.71,10.95,3.71z"></path> <path style="fill:#ffffff;" d="M14.512,1.42h-1.846v2.278c0,0.509-0.458,0.923-1.021,0.923h-0.696 c-0.563,0-1.021-0.414-1.021-0.923V1.42H5.384v2.278c0,0.509-0.458,0.923-1.021,0.923H3.669c-0.562,0-1.02-0.414-1.02-0.923V1.42 H0.803c-0.307,0-0.557,0.25-0.557,0.557V14.76c0,0.307,0.25,0.555,0.557,0.555h13.709c0.308,0,0.557-0.248,0.557-0.555V1.977 C15.069,1.67,14.82,1.42,14.512,1.42z M14.316,9.49v4.349c0,0.096-0.078,0.176-0.175,0.176H7.457H1.174 c-0.097,0-0.175-0.08-0.175-0.176V10.31V5.961c0-0.096,0.078-0.176,0.175-0.176h6.683h6.284l0,0c0.097,0,0.175,0.08,0.175,0.176 V9.49z"></path> <rect x="2.327" y="8.93" style="fill:#ffffff;" width="1.735" height="1.736"></rect> <rect x="5.28" y="8.93" style="fill:#ffffff;" width="1.735" height="1.736"></rect> <rect x="8.204" y="8.93" style="fill:#ffffff;" width="1.734" height="1.736"></rect> <rect x="11.156" y="8.93" style="fill:#ffffff;" width="1.736" height="1.736"></rect> <rect x="2.363" y="11.432" style="fill:#ffffff;" width="1.736" height="1.736"></rect> <rect x="5.317" y="11.432" style="fill:#ffffff;" width="1.735" height="1.736"></rect> <rect x="8.241" y="11.432" style="fill:#ffffff;" width="1.734" height="1.736"></rect> <rect x="11.194" y="11.432" style="fill:#ffffff;" width="1.735" height="1.736"></rect> <rect x="8.215" y="6.47" style="fill:#ffffff;" width="1.735" height="1.735"></rect> <rect x="11.17" y="6.47" style="fill:#ffffff;" width="1.734" height="1.735"></rect> </g> </g> </g></svg>
                                </div>
                                <h5 class="info-heading">REPORTE POR RANGO DE FECHA</h5>
                                <p class="info-text">Puedes Hacer Una Consulta De Una Fecha N a otra Fecha N.</p>
                                <a class="info-link" href="" data-toggle="modal" data-target="#ReporteFechas">Consultar <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ReporteFechas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">REPORTE FECHAS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hostal.reportesHostal.ReporteRangeDate') }}" method="get" target="_blank">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="">HABITACIONES</label><br>
                                    <select class="form-control" id="habitacion_id" name="habitacion_id" style="width: 100%; height: 45px;">
                                        <option value="0">TODAS</option>
                                        @foreach($habitaciones as $habitacione)
                                        <option value="{{$habitacione->id}}">{{$habitacione->Nombre_habitacion}}</option>            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">TIPO</label><br>
                                    <select class="form-control" name="TipoAlquiler" id="TipoAlquiler" style="width: 100%; height: 45px;">
                                        <option value="HospedajeID">Hospedaje</option>
                                        <option value="ReservaID">Reserva</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="">DESDE</label>
                                    <input class="form-control" type="date" id="Inicio_Fecha" name="Inicio_Fecha">
                                </div>
                                <div class="col-md-6">
                                    <label for="">HASTA</label>
                                    <input class="form-control" type="date" id="Final_Fecha" name="Final_Fecha">
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >CONSULTAR </button>                 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN - Modal -->
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%; margin-top: 30px">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="infobox-3" style="width: 100%;">
                                <div class="info-icon">
                                    <svg fill="#ffffff" height="256px" width="256px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 331.37 331.37" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g id="Layer_5_15_"> <g> <g> <path d="M111.374,188.961c0,4.956-4.055,9.01-9.01,9.01H57.313c-4.955,0-9.01-4.055-9.01-9.01v-30.113 c0-4.956,4.055-9.01,9.01-9.01h45.051c4.956,0,9.01,4.055,9.01,9.01V188.961z"></path> <path d="M111.374,268.091c0,4.956-4.055,9.01-9.01,9.01H57.313c-4.955,0-9.01-4.055-9.01-9.01v-30.113 c0-4.956,4.055-9.01,9.01-9.01h45.051c4.956,0,9.01,4.055,9.01,9.01V268.091z"></path> </g> <g> <path d="M197.222,188.961c0,4.956-4.055,9.01-9.01,9.01H143.16c-4.956,0-9.01-4.055-9.01-9.01v-30.113 c0-4.956,4.055-9.01,9.01-9.01h45.052c4.956,0,9.01,4.055,9.01,9.01V188.961z"></path> <path d="M197.222,268.091c0,4.956-4.055,9.01-9.01,9.01H143.16c-4.956,0-9.01-4.055-9.01-9.01v-30.113 c0-4.956,4.055-9.01,9.01-9.01h45.052c4.956,0,9.01,4.055,9.01,9.01V268.091z"></path> </g> <g> <path d="M282.018,188.961c0,4.956-4.055,9.01-9.01,9.01h-45.052c-4.956,0-9.01-4.055-9.01-9.01v-30.113 c0-4.956,4.055-9.01,9.01-9.01h45.052c4.956,0,9.01,4.055,9.01,9.01V188.961z"></path> <path d="M282.018,268.091c0,4.956-4.055,9.01-9.01,9.01h-45.052c-4.956,0-9.01-4.055-9.01-9.01v-30.113 c0-4.956,4.055-9.01,9.01-9.01h45.052c4.956,0,9.01,4.055,9.01,9.01V268.091z"></path> </g> <path d="M70.786,82.453c-5.383,0-9.787-4.404-9.787-9.788V19.697c0-5.384,4.404-9.788,9.787-9.788h20.361 c5.383,0,9.788,4.404,9.788,9.788v52.968c0,5.383-4.404,9.788-9.788,9.788H70.786z"></path> <path d="M240.301,82.453c-5.383,0-9.787-4.404-9.787-9.788V19.697c0-5.384,4.404-9.788,9.787-9.788h20.361 c5.383,0,9.788,4.404,9.788,9.788v52.968c0,5.383-4.404,9.788-9.788,9.788H240.301z"></path> <path d="M321.917,49.935c0,0-16.16,0-28.491,0c-1.628,0-4.64,0-4.64,3.753v16.754c0,15.996-8.86,29.01-29.01,29.01h-18.745 c-19.106,0-29.01-13.014-29.01-29.01l0.001-15.879c0-3-2.096-4.628-4.596-4.628c-23.869,0-58.035,0-82.751,0 c-1.836,0-5.326,0-5.326,4.753v15.754c0,15.996-7.976,29.01-29.01,29.01H71.594c-23.292,0-29.01-13.014-29.01-29.01V55.313 c0-4.25-3.826-5.378-5.909-5.378c-12.187,0-27.221,0-27.221,0C4.254,49.935,0,54.189,0,66.393v252.618 c0-1.804,4.254,2.45,9.454,2.45h312.462c5.2,0,9.454-4.254,9.454-2.45V66.393C331.37,54.189,327.116,49.935,321.917,49.935z M310.362,290.998c0,5.2-4.254,9.454-9.454,9.454H30.463c-5.2,0-9.454-4.254-9.454-9.454V134.464c0-5.2,4.254-9.454,9.454-9.454 h270.445c5.2,0,9.454,4.254,9.454,9.454V290.998z"></path> </g> </g> </g> </g></svg>
                                </div>
                                <h5 class="info-heading">REPORTE POR MESES</h5>
                                <p class="info-text">Puedes Hacer Una Consulta De Un Mes En Especifico.</p>
                                <a class="info-link" href="" data-toggle="modal" data-target="#ReporteMeses">Consultar <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ReporteMeses" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">REPORTE POR MES</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hostal.reportesHostal.ReporteMeses') }}" method="get" target="_blank">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="">HABITACIONES</label><br>
                                <select class="form-control" id="habitacion_id" name="habitacion_id" style="width: 100%; height: 45px;">
                                    <option value="0">TODAS</option>
                                    @foreach($habitaciones as $habitacione)
                                    <option value="{{$habitacione->id}}">{{$habitacione->Nombre_habitacion}}</option>            
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">TIPO</label><br>
                                <select class="form-control" name="TipoAlquiler" id="TipoAlquiler" style="width: 100%; height: 45px;">
                                    <option value="HospedajeID">Hospedaje</option>
                                    <option value="ReservaID">Reserva</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="">SELECCIONA MES</label>
                                <input class="form-control" type="month" id="monthID" name="monthID">
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >CONSULTAR </button> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN - Modal -->
        <div class="col-md-4">
            <div class="main-container" id="container" style="width: 100%; margin-top: 30px;">
                <div id="infobox3" class="col-xl-12 col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="infobox-3" style="width: 100%;">
                                <div class="info-icon">
                                    <svg fill="#ffffff" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 253 260" enable-background="new 0 0 253 260" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M194.221,2c-5.959,0-10.814,4.855-10.814,10.814V46.8c0,5.959,4.855,10.814,10.814,10.814s10.814-4.855,10.814-10.814 V12.814C205.035,6.855,200.179,2,194.221,2 M250.938,33.338v57.159V258H2V90.276V33.338h33.766v13.683 c0,12.579,10.152,22.952,22.952,22.952C71.297,69.972,81.669,59.6,81.669,47.021V33.338h89.6v13.683 c0,12.579,10.372,22.952,22.952,22.952c12.579,0,22.952-10.372,22.952-22.952V33.338H250.938z M237.476,90.497H15.462v153.6h172.579 l49.434-48.772V90.497H237.476z M58.717,2c-5.958,0-10.814,4.855-10.814,10.814V46.8c0,5.959,4.855,10.814,10.814,10.814 c5.959,0,10.814-4.855,10.814-10.814V12.814C69.531,6.855,64.676,2,58.717,2 M194.221,2c-5.959,0-10.814,4.855-10.814,10.814V46.8 c0,5.959,4.855,10.814,10.814,10.814s10.814-4.855,10.814-10.814V12.814C205.035,6.855,200.179,2,194.221,2 M114.175,222.938 l-53.158-53.159l21.213-21.213l31.976,31.976l59.594-59.423l21.184,21.244L114.175,222.938z"></path> </g></svg>
                                </div>
                                <h5 class="info-heading">REPORTE POR SEMANAS</h5>
                                <p class="info-text">Puedes Hacer Una Consulta Por Semanas.</p>
                                <a class="info-link" href="" data-toggle="modal" data-target="#ReporteSemanas">Consultar <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Modal -->
        <div class="modal fade" id="ReporteSemanas" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">REPORTE POR SEMANAS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hostal.reportesHostal.ReporteSemanas') }}" method="get" target="_blank">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="">HABITACIONES</label><br>
                                    <select class="form-control" id="habitacion_id" name="habitacion_id" style="width: 100%; height: 45px;">
                                        <option value="0">TODAS</option>
                                        @foreach($habitaciones as $habitacione)
                                        <option value="{{$habitacione->id}}">{{$habitacione->Nombre_habitacion}}</option>            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">TIPO</label><br>
                                    <select class="form-control" name="TipoAlquiler" id="TipoAlquiler" style="width: 100%; height: 45px;">
                                        <option value="HospedajeID">Hospedaje</option>
                                        <option value="ReservaID">Reserva</option>
                                    </select>
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="">SELECCIONA MES</label>
                                    <input type="week" onchange="getWeekDates()" id="weekID" name="weekID" class="form-control"> 
                                    <input type="date" id="inicioweek" name="inicioweek" hidden> 
                                    <input type="date" id="finweek" name="finweek" hidden>                            
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >CONSULTAR </button> 
                        </form>
                    </div>                
                </div>
            </div>
        </div>
        <!-- FIN - Modal -->
    </div>

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container" style="width: 95%; margin: auto;">


<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            
            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">RESERVAS TODAS LAS HABITACIONES</h5>                            
                    </div>
  
                    <div class="widget-content">
                        <div class="tabs tab-content">
                            <div id="content_1" class="tabcontent"> 
                                <canvas id="myChartline"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-activity-three">

                    <div class="widget-heading">
                        <h5 class="">RESERVAS MENSUALES</h5>
                    </div>

                    <div class="widget-content">

                        <div class="mt-container mx-auto">
                            <div class="timeline-line">
                                @foreach($ReservaMes as $totalres)
                                <div class="item-timeline timeline-new">
                                    <div class="t-dot">
                                        <div class="t-success">
                                            <svg viewBox="-0.5 0 15 15" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ffffff" fill-rule="evenodd" d="M107,154.006845 C107,153.45078 107.449949,153 108.006845,153 L119.993155,153 C120.54922,153 121,153.449949 121,154.006845 L121,165.993155 C121,166.54922 120.550051,167 119.993155,167 L108.006845,167 C107.45078,167 107,166.550051 107,165.993155 L107,154.006845 Z M108,157 L120,157 L120,166 L108,166 L108,157 Z M116.5,163.5 L116.5,159.5 L115.757485,159.5 L114.5,160.765367 L114.98503,161.275112 L115.649701,160.597451 L115.649701,163.5 L116.5,163.5 Z M112.5,163.5 C113.412548,163.5 114,163.029753 114,162.362119 C114,161.781567 113.498099,161.473875 113.110266,161.433237 C113.532319,161.357765 113.942966,161.038462 113.942966,160.550798 C113.942966,159.906386 113.395437,159.5 112.505703,159.5 C111.838403,159.5 111.359316,159.761248 111.051331,160.115385 L111.456274,160.632075 C111.724335,160.370827 112.055133,160.231495 112.425856,160.231495 C112.819392,160.231495 113.13308,160.382438 113.13308,160.690131 C113.13308,160.974601 112.847909,161.102322 112.425856,161.102322 C112.28327,161.102322 112.020913,161.102322 111.952471,161.096517 L111.952471,161.839623 C112.009506,161.833817 112.26616,161.828012 112.425856,161.828012 C112.956274,161.828012 113.190114,161.967344 113.190114,162.275036 C113.190114,162.565312 112.93346,162.768505 112.471483,162.768505 C112.10076,162.768505 111.684411,162.605951 111.427757,162.327286 L111,162.87881 C111.279468,163.227141 111.804183,163.5 112.5,163.5 Z M110,152.5 C110,152.223858 110.214035,152 110.504684,152 L111.495316,152 C111.774045,152 112,152.231934 112,152.5 L112,153 L110,153 L110,152.5 Z M116,152.5 C116,152.223858 116.214035,152 116.504684,152 L117.495316,152 C117.774045,152 118,152.231934 118,152.5 L118,153 L116,153 L116,152.5 Z" transform="translate(-107 -152)"></path> </g></svg>                                        </div>
                                        </div>
                                    <div class="t-content">
                                        <div class="t-uppercontent">
                                            <h5>{{ \Carbon\Carbon::createFromFormat('m', $totalres->mes)->format('F')}} - Bs. {{ number_format($totalres->totalmes, 2) }}</h5>
                                            <span class="">{{ \Carbon\Carbon::parse($totalres->fecha)->diffForHumans() }}</span>
                                        </div>
                                        <p>Hospedaje Total Por <a href="javascript:void(0);">MESES</a> ver  <a href="{{route('hostal.habitacion.ReservasLista')}}">Detalle</a></p>
                                        <div class="tags">
                                            <div class="badge badge-primary">{{auth()->user()->name}}</div>
                                            <div class="badge badge-success">{{auth()->user()->email}}</div>
                                        </div>
                                    </div>
                                </div>                                                                  
                                @endforeach   
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-activity-three">

                    <div class="widget-heading">
                        <h5 class="">HOSPEDAJES MENSUALES</h5>
                    </div>

                    <div class="widget-content">

                        <div class="mt-container mx-auto">
                            <div class="timeline-line">
                                @foreach($HospedajeMes as $total)
                                <div class="item-timeline timeline-new">
                                    <div class="t-dot">
                                        <div class="t-success">
                                            <svg viewBox="-0.5 0 15 15" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#ffffff" fill-rule="evenodd" d="M107,154.006845 C107,153.45078 107.449949,153 108.006845,153 L119.993155,153 C120.54922,153 121,153.449949 121,154.006845 L121,165.993155 C121,166.54922 120.550051,167 119.993155,167 L108.006845,167 C107.45078,167 107,166.550051 107,165.993155 L107,154.006845 Z M108,157 L120,157 L120,166 L108,166 L108,157 Z M116.5,163.5 L116.5,159.5 L115.757485,159.5 L114.5,160.765367 L114.98503,161.275112 L115.649701,160.597451 L115.649701,163.5 L116.5,163.5 Z M112.5,163.5 C113.412548,163.5 114,163.029753 114,162.362119 C114,161.781567 113.498099,161.473875 113.110266,161.433237 C113.532319,161.357765 113.942966,161.038462 113.942966,160.550798 C113.942966,159.906386 113.395437,159.5 112.505703,159.5 C111.838403,159.5 111.359316,159.761248 111.051331,160.115385 L111.456274,160.632075 C111.724335,160.370827 112.055133,160.231495 112.425856,160.231495 C112.819392,160.231495 113.13308,160.382438 113.13308,160.690131 C113.13308,160.974601 112.847909,161.102322 112.425856,161.102322 C112.28327,161.102322 112.020913,161.102322 111.952471,161.096517 L111.952471,161.839623 C112.009506,161.833817 112.26616,161.828012 112.425856,161.828012 C112.956274,161.828012 113.190114,161.967344 113.190114,162.275036 C113.190114,162.565312 112.93346,162.768505 112.471483,162.768505 C112.10076,162.768505 111.684411,162.605951 111.427757,162.327286 L111,162.87881 C111.279468,163.227141 111.804183,163.5 112.5,163.5 Z M110,152.5 C110,152.223858 110.214035,152 110.504684,152 L111.495316,152 C111.774045,152 112,152.231934 112,152.5 L112,153 L110,153 L110,152.5 Z M116,152.5 C116,152.223858 116.214035,152 116.504684,152 L117.495316,152 C117.774045,152 118,152.231934 118,152.5 L118,153 L116,153 L116,152.5 Z" transform="translate(-107 -152)"></path> </g></svg>                                        </div>
                                        </div>
                                    <div class="t-content">
                                        <div class="t-uppercontent">                                    
                                            <h5>{{ \Carbon\Carbon::createFromFormat('m', $total->mes)->formatLocalized('%B')}} - Bs. {{ number_format($total->totalmes, 2) }}</h5>
                                            <span class="">{{ \Carbon\Carbon::parse($total->fecha)->diffForHumans() }}</span>
                                        </div>
                                        <p>Hospedaje Total Por <a href="javascript:void(0);">MESES</a> ver  <a href="{{route('hostal.habitacion.HospedajesLista')}}">Detalle</a></p>
                                        <div class="tags">
                                            <div class="badge badge-primary">{{auth()->user()->name}}</div>
                                            <div class="badge badge-success">{{auth()->user()->email}}</div>
                                        </div>
                                    </div>
                                </div>                                                                  
                                @endforeach   
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">HOSPEDAJE TODAS LAS HABITACIONES</h5>                            
                    </div>

                    <div class="widget-content">
                        <div class="tabs tab-content">
                            <div id="content_1" class="tabcontent"> 
                                <canvas id="myChartline2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">

                    <table>
                        <tr>
                            <td >
                                <h4>Seleccionar Un Mes Para Graficar Automaticamente</h4>
                            </td>
                            <td style="width: 20px;">
                                <h4> : </h4>
                            </td>
                            <td>
                                <input class="form-control" type="month" id="input-month" style="width: 100%; height: 30px;">
                            </td>
                        </tr>
                    </table><br>

                </div>
            </div>
                       
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="myChart1Container">
                <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h5 class="">HOSPEDAJE HABITACION</h5>
                    <button id="fullscreen-btn" onclick="launchIntoFullscreen(document.getElementById('myChart1Container')); toggleButton()">
                        <i class="fa-solid fa-compress"></i>
                    </button>
                    <button id="close-fullscreen-btn" onclick="closeFullscreen(); toggleButton()" style="display: none;">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </button>
                </div>
                <canvas id="myChart1"></canvas>
                </div>
                <div id="message-container" style="display:none;">
                <p>Selecciona un mes para ver los datos de hospedaje por habitación</p>
                </div>
            </div>
            
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing" id="myChart1Container2">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">RESERVA HABITACION</h5>   
                        <button id="fullscreen-btn" onclick="launchIntoFullscreen(document.getElementById('myChart1Container2')); toggleButton()">
                            <i class="fa-solid fa-compress"></i>
                        </button>
                        <button id="close-fullscreen-btn2" onclick="closeFullscreen(); toggleButton()" style="display: none;">
                            <i class="fa-sharp fa-solid fa-xmark"></i>
                        </button>                     
                    </div>
                    <canvas id="myChart2"></canvas>
                </div>
                <div id="message-container" style="display:none;">
                    <p>Selecciona un mes para ver los datos de hospedaje por habitación</p>
                </div>
            </div>
                       
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                
                <div class="widget widget-activity-four">

                    <div class="widget-heading">
                        <h5 class="">HOSPEDAJES MENSUALES</h5>
                    </div>

                    <div class="widget-content">

                        <div class="mt-container mx-auto">
                            <div class="timeline-line"> 
                                @foreach($HospedajeMes as $total)
                                    <div class="item-timeline timeline-success">
                                        <div class="t-dot" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">
                                            <p>{{ \Carbon\Carbon::createFromFormat('m', $total->mes)->formatLocalized('%B')}} <a href="javascript:void(0);"></a> Bs. {{ number_format($total->totalmes, 2) }} <a href="{{ route('admin.comanda.index') }}">Ver Informacion</a></p>
                                            <span class="badge badge-success">Completed</span>                                            
                                            <p class="t-time">{{ \Carbon\Carbon::parse($total->fecha)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach                                                               
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                
                <div class="widget widget-activity-four">

                    <div class="widget-heading">
                        <h5 class="">Recent Activities</h5>
                    </div>

                    <div class="widget-content">

                        <div class="mt-container mx-auto">
                            <div class="timeline-line">                                
                                <div class="item-timeline timeline-primary">
                                    <div class="t-dot" data-original-title="" title="">
                                    </div>
                                    <div class="t-text">
                                        <p><span>Updated</span> Server Logs</p>
                                        <span class="badge badge-danger">Pending</span>
                                        <p class="t-time">Just Now</p>
                                    </div>
                                </div>
                            </div>                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="plugins/apex/apexcharts.min.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>
</html>

@endsection
@notifyCss
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{asset('css/bottonfooder.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/>

@push('js')
@notifyJs
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
<script>
    function toggleButton() {
        var fullscreenBtn = document.getElementById("fullscreen-btn");
        var closeFullscreenBtn = document.getElementById("close-fullscreen-btn");
        var closeFullscreenBtn2 = document.getElementById("close-fullscreen-btn2");

        if (fullscreenBtn.style.display === "inline") {
            fullscreenBtn.style.display = "none";
            closeFullscreenBtn.style.display = "inline";
            closeFullscreenBtn2.style.display = "inline";
        } else {
            fullscreenBtn.style.display = "inline";
            closeFullscreenBtn.style.display = "none";
            closeFullscreenBtn2.style.display = "none";
        }
    }
    function launchIntoFullscreen(element) {
      if(element.requestFullscreen) {
        element.requestFullscreen();
      } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
      } else if(element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
      } else if(element.msRequestFullscreen) {
        element.msRequestFullscreen();
      }
    }
    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) { /* Firefox */
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE/Edge */
            document.msExitFullscreen();
        }
    }
</script>
<script>
    var myChart1;
    var myChart2;
    $(document).ready(function() {
        $('#input-month').on('change', function() {
            if ($(this).val() === "") {
                $("#myChart1Container").hide();
                $("#myChart2").hide();
                $("#message").html("Por favor seleccione un mes para ver los datos de hospedaje y reserva por habitación.");
            } else {
                $("#mensaje").hide();
                $("#myChart1").show();
                $("#myChart2").show();
                let month = $(this).val();
                updateChart1(month);
                updateChart2(month);
            }
        });
    });

    function updateChart1(month) {
        $.ajax({
            url: '/getDataByMonth/' + month,
            success: function(response) {
                // Actualizar los datos del gráfico con los datos recibidos de la respuesta del servidor
                let labels = []
                let data = []
                let backgroundColor = []
                response.forEach(r => {
                    labels.push(r.NombreHab)
                    data.push(r.hospedajes)
                    backgroundColor.push(randomColor())
                });
                var ctx = document.getElementById("myChart1").getContext("2d");
                if (myChart1 !== undefined) {
                    myChart1.destroy();
                }
                myChart1 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Hospedaje',
                            data: data,
                            backgroundColor: backgroundColor,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                ticks: {
                                    min: 0
                                }
                            },
                            y: {
                                ticks: {
                                    min: 0
                                }
                            }
                        }
                    }
                });

                myChart1.update();
            },
            error: function(xhr,error) {
                console.log(xhr.responseText);
            }
        });
    }
    
    function updateChart2(month) {
        $.ajax({
            url: '/getDataByMonthRes/' + month,
            success: function(response) {
                // Actualizar los datos del gráfico con los datos recibidos de la respuesta del servidor
                let labels = []
                let data = []
                let backgroundColor = []
                response.forEach(r => {
                    labels.push(r.NombreHab)
                    data.push(r.reservas)
                    backgroundColor.push(randomColor())
                });
                var ctx = document.getElementById("myChart2").getContext("2d");
                if (myChart2 !== undefined) {
                    myChart2.destroy();
                }
                myChart2 = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Reservas',
                            data: data,
                            backgroundColor: backgroundColor,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                ticks: {
                                    min: 0
                                }
                            },
                            y: {
                                ticks: {
                                    min: 0
                                }
                            }
                        }
                    }
                });

                myChart2.update();
            },
            error: function(xhr,error) {
                console.log(xhr.responseText);
            }
        });
    }

    function randomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>
<script>
    var reservasPorHabitacion = <?php echo json_encode($reservasPorHabitacion); ?>;
    var ctx = document.getElementById("myChartline").getContext("2d");

    let labels = []
    let data = []
    let dataLine = []
    reservasPorHabitacion.forEach(r => {
        labels.push(r.NombreHab)
        data.push(r.reservas)
        dataLine.push(r.reservas)
    });

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Reservas:',
                data: data,
                backgroundColor: '#DC3535',
                borderColor: '#DC3535',
                borderWidth: 1
            }, {
                label: 'My Line Dataset',
                type: 'line',
                borderColor: "#F49D1A",
                data: dataLine,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    var hospedajesPorHabitacion = <?php echo json_encode($hospedajesPorHabitacion); ?>;
    var ctx = document.getElementById("myChartline2").getContext("2d");

    let labels2 = []
    let data2 = []
    let dataLine2 = []
    hospedajesPorHabitacion.forEach(r => {
        labels2.push(r.NombreHab)
        data2.push(r.hospedajes)
        dataLine2.push(r.hospedajes)
    });

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels2,
            datasets: [{
                label: 'Total Reservas:',
                data: data2,
                backgroundColor: '#293462',
                borderColor: '#293462',
                borderWidth: 1
            }, {
                label: 'My Line Dataset',
                type: 'line',
                borderColor: "#D61C4E",
                data: dataLine2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    $('#ReporteFechas').on('hidden.bs.modal', function (e) {
        $('.modal-backdrop').remove();
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            minimumResultsForSearch: Infinity
        });
    });
</script>
<script>
    $(document).ready(function(){
        $("#datepicker").datepicker();
    });
</script>
<script>
    function getWeekDates() {
        var week = document.getElementById("weekID").value;
        var parts = week.split("-W");
        var year = parts[0];
        var weekNumber = parts[1];

        var weekStart = moment().year(year).isoWeek(weekNumber).startOf('isoWeek').format('YYYY-MM-DD');
        var weekEnd = moment().year(year).isoWeek(weekNumber).endOf('isoWeek').format('YYYY-MM-DD');

        document.getElementById("inicioweek").value = weekStart;
        document.getElementById("finweek").value = weekEnd;
    }

</script>
@endpush