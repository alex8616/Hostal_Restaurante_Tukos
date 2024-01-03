<div><br><br>
<div class="card" style="width: 80%; margin: auto;"> 
    <div class="card-body">
        <div>
            <button class="btn btn-sm btn-primary" style="float: ringth;"  data-toggle="modal" data-target="#addArticuloModal">Add Articulo</button>
            <a href="{{ route('articulos.articuloxportPDF') }}">
                <button class="btn btn-sm btn-secondary"><span><i class="fa-solid fa-file-pdf"></i></span> Exportar Articulos PDF</button>
            </a>
            <a href="{{ route('articulos.articuloxportEXCEL') }}">
                <button class="btn btn-sm btn-success"><span><i class="fa-solid fa-file-excel"></i></span> Exportar Articulos EXCEL</button>
            </a>
            <nav class="navbar navbar-light bg-light justify-content-between">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar Por Nombre .." aria-label="Search" wire:model="search">
            </nav>    
        </div>
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
        <div class="row">
        @foreach ($articulos as $articulo)
        <div class="col-md-4 col-sm-12 col-12">
            <div class="info-box">
                <span class="info-box-icon" style="background: orange; "><i class="fa-solid fa-kitchen-set" style="width:60; height:60; color:#FFFFFF;"></i></span>
                <div class="info-box-content"  style="background: #FBF6F7" id="divcon">
                    <span class="info-box-text" style="font-size:22px; text-justify: inter-word;">{{$articulo->Nombre_articulo}}</span>
                    <span class="info-box-number">{{$articulo->Cantidad_articulo}}</span>
                    @if ($articulo->estado == 'ACTIVO')
                        <td>
                            <button wire:click="ConfirmarBaja({{$articulo->id}})" class="btn btn-success">
                                ACTIVO
                            </button>
                        </td>
                    @else
                        <style>
                            #divcon{
                                background: red;
                            }
                        </style>
                        <td>
                            <a title="Editar" style="background: #FF5959; text-align: center;">
                                DADO DE BAJA
                            </a>
                        </td>
                    @endif
                </div>
                <span >
                    <button wire:click="ver({{$articulo->id}})" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-eye" style="width:20; height:20;"></i>
                    </button><br>
                    <button wire:click="editar({{$articulo->id}})" class="btn btn-outline-primary">
                        <i class="fa-solid fa-pen-to-square" style="width:20; height:20;"></i>
                    </button><br>
                    <button wire:click="borrar({{$articulo->id}})" class="btn btn-outline-danger">
                        <i class="fa-solid fa-trash" style="width:20; height:20;"></i>
                    </button><br>
                </span>
            <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        @endforeach
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <div class="px-6 py-3">
        {{$articulos->links()}}
    </div>
</div>

<!-- Modal Add Articulo -->
@include('livewire.articulos.crear')  

<!-- Modal Edit Articulo -->
@include('livewire.articulos.edit') 

<!-- Modal Delete Articulo -->
@include('livewire.articulos.delete')

<!-- Modal Ver Articulo -->
@include('livewire.articulos.show')

<!-- Modal confirmar baja Articulo -->
@include('livewire.articulos.baja')

<script src="https://cdn.tailwindcss.com"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
<script>
    window.addEventListener('close-modal', event =>{
        $('#bajaArticuloModal').modal('hide');
        $('#addArticuloModal').modal('hide');
        $('#showArticuloModal').modal('hide');
        $('#editArticulotModal').modal('hide');
        $('#deleteArticuloModal').modal('hide');
        $('#viewArticuloModal').modal('hide');
    });
    window.addEventListener('show-edit-articulo-modal', event =>{
        $('#editArticulotModal').modal('show');
    });
    window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deleteArticuloModal').modal('show');
        });
    window.addEventListener('show-view-articulo-modal', event =>{
        $('#viewArticuloModal').modal('show');
    });
    window.addEventListener('show-delete-confirmationbaja-modal', event =>{
            $('#bajaArticuloModal').modal('show');
        });
</script>

<style>
    #showicon{
        color:#6FD66D;
    }
    #showicon:hover{
        color:white;
    }
    #editicon{
        color:#569EFF;
    }
    #editicon:hover{
        color:white;
    }
    #deleteicon{
        color:#FF5F5F;
    }
    #deleteicon:hover{
        color:white;
    }
    #showbutton:hover {
        background-color: green;
    }
    #editbutton:hover {
        background-color: blue;
    }
    #deletebutton:hover {
        background-color: red;
    }
</style>
