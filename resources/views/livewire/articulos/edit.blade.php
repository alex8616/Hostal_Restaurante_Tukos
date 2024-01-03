<div wire:ignore.self class="modal fade relative md:absolute fixed w-full h-100 inset-0 justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);" id="editArticulotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">EDITAR ARTICULO</p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
				</div>
                <hr>
            <div class="modal-body">
                <form wire:submit.prevent="editArticuloData">                   
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="Nombre_articulo" >Nombre Articulo</label>
                            <input type="text" id="Nombre_articulo" class="form-control" wire:model="Nombre_articulo" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            @error('Nombre_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row" wire:ignore>
                        <div class="col-12">
                        <label for="Descripcion_articulo" >Descripcion Articulo</label>
                            <textarea type="text" id="editor" class="form-control" wire:model="Descripcion_articulo" cols="25" rows="6" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            @error('Descripcion_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Cantidad_articulo">Cantidad Articulo</label>
                            <input type="number" id="Cantidad_articulo" class="form-control" wire:model="Cantidad_articulo">
                            @error('Cantidad_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <center>
                    <div >
                            <button type="submit" class="focus:outline-none px-4 bg-teal-500 p-2 ml-3 rounded-lg text-white hover:bg-teal-400">Registrar</button>
                            <button wire:click="limpiarCampos()" data-dismiss="modal" type="button" class="focus:outline-none modal-close px-4 bg-gray-400 p-2 rounded-lg text-black hover:bg-gray-300" class="close">Cancelar</button>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </div> 
</div>