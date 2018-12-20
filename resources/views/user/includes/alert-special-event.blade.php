@if($user->id == '12' && $user->achievements()->where('achievement_id', 4)->first()->unlocked_at == null)
    <div role="alert" class="alert alert-success alert-dismissible">
        <button aria-label="Close" data-dismiss="alert" class="close" type="button">
            <span aria-hidden="true">×</span>
        </button>
        <p>
            <strong>FELICITACIONES!</strong> Ganaste un evento especial! Ingresa al siguiente link para reclamar tu premio:
            <a class="ml-10 btn btn-success" href="{{ route('specialEvent1') }}">Ingresar</a>
        </p>
    </div>
@endif