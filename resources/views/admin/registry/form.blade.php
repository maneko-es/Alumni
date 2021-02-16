<div class="row mb-5 registry-form">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('messages.content') }}</div>
            <div class="panel-body">
                <form action="{{ route('accept-registry') }}" method="post">
                                {{ csrf_field() }}
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'name',
                        'old_input' => $entry->name,
                        'attributes' => ['readonly']
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'email',
                        'old_input' => $entry->email,
                        'attributes' => ['readonly']
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'school',
                        'old_input' => App\School::find($entry->school_id)->title,
                        'attributes' => ['readonly']
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'hidden',
                        'name' => 'school_id',
                        'old_input' => $entry->school_id,
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'year',
                        'old_input' => $entry->year,
                    ])
                    <hr>
                    <input type="hidden" name="registry_id" value="{{ $entry->id }}">
                    @if(!$entry->status)
                        <p>
                            <input type="submit" class="btn btn-success btn-md" value="Acceptar registre">
                        </p>
                        <p>Es crearà un usuari i s'enviarà un missatge amb la contrassenya a l'email indicat. Es pot modificar l'any de promoció en cas que no sigui el correcte.</p>
                        <hr>
                        <p>
                        </form>
                        <form action="{{ route('deny-registry') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="registry_id" value="{{ $entry->id }}">
                            <input type="submit" value="Rebutjar registre" class="btn btn-warning btn-md">
                        </form>
                    </p>
                        <p>S'enviarà un correu tipus "Posa't en contacte amb el CIC"</p>

                    @elseif($entry->status == 'accepted' && $entry->user_id)
                        <h3>Aquest registre ha estat acceptat.{{--  S'ha creat l'usuari amb id {{$entry->user_id}}. --}}</h3>
                    @elseif($entry->status == 'denied')
                        <h3>Aquest registre ha estat rebutjat.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-5">

    </div>
</div>
