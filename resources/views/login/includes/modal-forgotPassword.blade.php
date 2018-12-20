<!-- Modal -->
<div class="modal fade" id="examplePositionCenter" aria-hidden="true" aria-labelledby="examplePositionCenter"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <form class="form-horizontal" role="form" method="post" action="{{ route('password.email') }}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Ingresa tu correo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 form-group">
                            <input type="text" class="form-control" name="email" placeholder="Correo Electronico">
                        </div>
                        <div class="col-md-12 float-right">
                            <button class="btn btn-primary btn-outline" data-dismiss="modal" type="button">Enviar</button>
                            {{ csrf_field() }}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Modal -->