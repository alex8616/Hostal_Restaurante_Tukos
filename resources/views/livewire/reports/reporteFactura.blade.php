@section('title', 'Reporte Pedidos')
<div class="wrapper">
<br><br><hr>
    <div class="row">
        
    </div>
    <div class="card" style="width: 90%; margin:auto;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <span hidden>Seleccionar usuario</span>
                            <div class="form-group" hidden>
                                <select class="form-control" wire:model="userId" name="usuario" id="usuario">
                                    <option value="0">Todos</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span>Factura Estado</span>
                            <div class="form-group">
                                <select class="form-control" wire:model="estadofactura">
                                    <option value="0">Ambos</option>
                                    <option value="1">Valido</option>
                                    <option value="2">Anulado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <span>Seleccionar tipo de reporte</span>
                            <div class="form-group">
                                <select class="form-control" wire:model="tipoReportefactura">
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
                                <input class="form-control flatpickr" wire:model="desdefact" type="date"
                                    placeholder="click para elegir">
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <span>Fecha final</span>
                            <div class="form-group">
                                <input class="form-control flatpickr" wire:model="hastafact" type="date"
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
                                    <a href="{{ url('report/pdffactura' . '/' . $userId . '/' . $tipoReportefactura. '/' . $estadofactura . '/' . $desdefact . '/' . $hastafact) }}"
                                        class="btn btn-success btn-sm btn-block {{ count($datafactura) < 1 ? 'disabled' : '' }}"
                                        target="_blank">
                                        Exportar reporte a Excel <i class="fas fa-file-pdf"></i></a>
                                    <a href="{{ url('report/factura_pdf' . '/' . $userId . '/' . $tipoReportefactura. '/' . $estadofactura . '/' . $desdefact . '/' . $hastafact) }}"
                                        class="btn btn-secondary btn-sm btn-block {{ count($datafactura) < 1 ? 'disabled' : '' }}"
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
                                    <th>N° FACTURA</th>
                                    <th>CODIGO DE CONTROL</th>
                                    <th>CI o NIT</th>
                                    <th>CLIENTE</th>
                                    <th>FECHA DE EMISION</th>
                                    <th>IMPORTE</th>
                                    <th>ESTADO</th>
                                    <th>AUTORIZACION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($datafactura) < 1)
                                    <tr>
                                        <td colspan="6">
                                            <h5>Sin Resultados</h5>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($datafactura as $dat)
                                    <tr>
                                        <td><strong>{{ $dat->numFactura }}</strong></td>
                                        <td>{{ $dat->codigo_Control }}</td>
                                        <td>{{ $dat->Nit_cliente }}</td>
                                        <td>{{ $dat->Nombre_cliente }} {{ $dat->Apellidop_cliente }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($dat->fecha_Emision)->format('d-M-y H:i a') }}
                                        </td>
                                        <td>Bs {{ number_format($dat->total, 2) }}</td>
                                        <td>{{ $dat->estado }}</td>
                                        <td>{{ $dat->autorizacion }}</td>
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

