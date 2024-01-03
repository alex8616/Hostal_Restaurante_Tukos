<div class="modal fade bd-example-modal-lg" id="ShowReserva{{ $reserva->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"  style="height: 90%;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TICKET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="height: 100%;">
                <div>
                    <embed src="{{ route('admin.ambiente.pdf', $reserva->id) }}" frameborder="0" width="100%" height="100%">
                </div>
            </div>
        </div>
    </div>
</div>