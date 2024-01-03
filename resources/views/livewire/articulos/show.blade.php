<div wire:ignore.self class="modal fade" id="viewArticuloModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content py-4 text-left px-6">
        <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">DETALLES DEL ARTICULO</p>
                <div class="modal-close cursor-pointer z-50">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID: </th>
                            <td>{{ $view_id_articulo }}</td>
                        </tr>

                        <tr>
                            <th>Nombre Articulo: </th>
                            <td>{{ $view_Nombre_articulo }}</td>
                        </tr>

                        <tr>
                            <th>Descripcion Articulo: </th>
                            <td>{{ $view_Descripcion_articulo }}</td>
                        </tr>

                        <tr>
                            <th>Cantidad De Articulos: </th>
                            <td>{{ $view_Cantidad_articulo }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>