<!DOCTYPE html>
<html>
<head>
    <title>Tu proyecto</title>
    <!-- Incluir librerías de jQuery y DataTables -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <!-- Incluir librería DataTables AJAX -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Ventana modal -->
<div id="pinModal" class="modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ingrese el PIN</h5>
            </div>
            <div class="modal-body">
                <input id="pinInput" type="password" class="form-control">
            </div>
            <div class="modal-footer">
                <button id="pinButton" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<table id="audits-table" class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Modelo</th>
            <th>Evento</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Atributos</th>
            <th>Valores antiguos</th>
            <th>Valores nuevos</th>
        </tr>
    </thead>
</table>
<script>
    // Función para inicializar DataTables y cargar datos
    function initializeDataTable() {
        $('#audits-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("audits.data") }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'auditable_type', name: 'auditable_type' },
                { data: 'event', name: 'event' },
                { data: 'user.name', name: 'user.name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'auditable_id', name: 'auditable_id' },
                {
                    data: 'old_values',
                    name: 'old_values',
                    render: function (data) {
                        return JSON.stringify(data, null, 4);
                    }
                },
                {
                    data: 'new_values',
                    name: 'new_values',
                    render: function (data) {
                        return JSON.stringify(data, null, 4);
                    }
                }
            ]
        });
    }

    $(function() {
        $('#pinModal').modal('show');
        
        $('#pinButton').click(function() {
            var rec = '{{ $pin }}';
            var pin = $('#pinInput').val();
            
            if (pin === rec) {
                $('#pinModal').modal('hide');
                toastr.success("Se ha registrado con éxito.", "Mensaje de éxito", {
                  "iconClass": 'toast-success'
                });
                initializeDataTable();
            } else {
                toastr.error('<i class="fas fa-exclamation-circle"></i> Error: El PIN es incorrecto. Acceso denegado.', 'Error');  
                $('#pinInput').val('');
            }
        });
    });
</script>

</body>
</html>
