@section('title', 'Reporte Mesas')
<div class="wrapper">
    <div class="hero">
            <h1 id="htitle"><span id="title">RESTAURANT TUKO´S</span><br>REPORTE DE VENTAS ALL</h1>
    </div>
 
    <div class="row">
        
    </div>
    <div class="card">
        <div class="card-body">
        <div class="row">
        <div class="col-sm-12 col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <span>Seleccionar usuario</span>
                    <div class="form-group">
                        <select class="form-control" wire:model="userIdventa" name="usuario" id="usuario">
                            <option value="0">Todos</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <span>Seleccionar tipo de reporte</span>
                    <div class="form-group">
                        <select class="form-control" wire:model="tipoReporteventa">
                            <option value="0">Reporte del día</option>
                            <option value="1">Reporte por fecha </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12 col-md-12">
                    <span>Fecha inicial</span>
                    <div class="form-group">
                        <input class="form-control flatpickr" wire:model="desdeventa" type="date"
                            placeholder="click para elegir">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <span>Fecha final</span>
                    <div class="form-group">
                        <input class="form-control flatpickr" wire:model="hastaventa" type="date"
                            placeholder="click para elegir">
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 text-center">
                    <div class="form-group">
                        <button type="submit" id="consultar" wire:click="$refresh"
                            class="btn btn-primary btn-sm btn-block" hidden>Consultar <i class="fas fa-search" hidden></i>
                        </button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                            <a href="{{ url('report/pdfmesa' . '/' . $userIdventa . '/' . $tipoReporteventa. '/' . $desdeventa . '/' . $hastaventa) }}"
                                class="btn btn-danger btn-sm btn-block {{ count($dataventa) < 1 ? 'disabled' : '' }}"
                                target="_blank">
                                Exportar reporte a PDF <i class="fas fa-file-pdf"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="table-responsive">
                <table id="order-listing" class="table table-striped mt-0.5 table-bordered shadow-lg mt-4">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Usuario</th>
                            <th style="width:50px;">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($dataventa) < 1)
                            <tr>
                                <td colspan="6">
                                    <h5>Sin Resultados</h5>
                                </td>
                            </tr>
                        @endif
                        @foreach ($dataventa as $dat)
                            <tr>
                                <td><strong>{{ $dat->id }}</strong></td>
                                <td>
                                    {{ \Carbon\Carbon::parse($dat->fecha_venta)->format('d-M-y H:i a') }}
                                </td>
                                <td>Bs {{ number_format($dat->total, 2) }}</td>
                                <td>{{ $dat->user }}</td>
                                <td style="width: 50px;">
                                        <a href="{{ route('admin.comandamesa.show', $dat) }}" class="btn btn-info"><i
                                                class="far fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>

@section('content_top_nav_right')
@include('notificaciones')
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@livewireStyles

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr(document.getElementsByClassName('flatpickr'), {
            enableTime: false,
            dateFormat: 'Y-m-d',
            locale: {
                firstDayofWeek: 1,
                weekdays: {
                    shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                    longhand: [
                        "Domingo",
                        "Lunes",
                        "Martes",
                        "Miércoles",
                        "Jueves",
                        "Viernes",
                        "Sábado",
                    ],
                },

                months: {
                    shorthand: [
                        "Ene",
                        "Feb",
                        "Mar",
                        "Abr",
                        "May",
                        "Jun",
                        "Jul",
                        "Ago",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dic",
                    ],
                    longhand: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ],
                },
            }
        })
    })
</script>
@livewireScripts

