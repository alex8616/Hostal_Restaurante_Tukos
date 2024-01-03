@section('title', 'Reporte Pedidos')
<div class="wrapper">
<br><br><hr>
    <div class="row">

<!-- Button trigger modal -->
<!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buscar Por Hora</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.comanda.rangehour') }}" method="get" target="_blank">
                        @csrf
                        <spam><?php echo date('Y-m-d'); ?> - </spam>
                            <input type="date" id="fecharange" name="fecharange" value="<?php echo date('Y-m-d') ?>">
                            <input type="time" id="desdehour" name="desdehour">
                            <input type="time" id="hastahour" name="hastahour">
                            <br><br>
                        <div class="modal-footer">
                            <div class="col-md-6 grid-margin stretch-card">
                                <button type="submit" class="btn btn-success" tabindex="4" style="width: 100%;" >Buscar </button>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" style="width: 100%;">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="card" style="width: 90%; margin:auto;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-12 col-md-12 text-center">
                                <div class="form-group">
                                    <button  style="width:100%;"
                                            type="button" data-toggle="modal" data-target="#modelId">
                                        Buscar Por Hora
                                    </button>
                                </div>
                            </div>
                            <span>Seleccionar usuario</span>
                            <div class="form-group">
                                <select class="form-control" wire:model="userId" name="usuario" id="usuario">
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
                                <select class="form-control" wire:model="tipoReporte">
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
                                <input class="form-control" wire:model="desde" type="date"
                                    placeholder="click para elegir">
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <span>Fecha final</span>
                            <div class="form-group">
                                <input class="form-control" wire:model="hasta" type="date"
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
                                    <a href="{{ url('report/pdf' . '/' . $userId . '/' . $tipoReporte . '/' . $desde . '/' . $hasta) }}"
                                        class="btn btn-danger btn-sm btn-block {{ count($data) < 1 ? 'disabled' : '' }}"
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
                                @if (count($data) < 1)
                                    <tr>
                                        <td colspan="6">
                                            <h5>Sin Resultados</h5>
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($data as $dat)
                                    <tr>
                                        <td><strong>{{ $dat->id }}</strong></td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($dat->fecha_venta)->format('d-M-y H:i a') }}
                                        </td>
                                        <td>Bs {{ number_format($dat->total, 2) }}</td>
                                        <td>{{ $dat->user }}</td>
                                        <td style="width: 50px;">
                                                <a href="{{ route('admin.comanda.pdf', $dat) }}" class="btn btn-info"><i
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

<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
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

