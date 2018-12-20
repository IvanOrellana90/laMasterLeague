<div class="example">
    <form class="form-horizontal" method="post" action="{{ route('user.update') }}">
        {{ csrf_field() }}
        <div class="form-group row">
            <label class="col-md-3 form-control-label">Nombre: </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="name" placeholder="Nombre Completo" autocomplete="off" value="{{ auth()->user()->name }}"
                />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 form-control-label">Email: </label>
            <div class="col-md-9">
                <input type="email" class="form-control" name="email" placeholder="@email.com" value="{{ auth()->user()->email }}"
                       autocomplete="on" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 form-control-label">Contraseña: </label>
            <div class="col-md-9">
                <input type="password" class="form-control" pattern="^\S{6,}$" name="password" placeholder="" value=""
                       autocomplete="off" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-9 offset-md-3 ">
                <button type="submit" class="btn btn-primary btn-block btn-round">Ingresar </button>
            </div>
        </div>
    </form>
</div>