<div class="row">
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('messages.content') }}</div>
            <div class="panel-body">
               {{--  @if(!$_GET['registry']) --}}
               @if(!$entry)
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'name',
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'email',
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'password',
                        'name' => 'password',
                        'label' => 'Contraseña (mínimo 6 caracteres)'
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'password',
                        'name' => 'password_confirmation',
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'select',
                        'name' => 'roles',
                        'multiple' => true,
                        'elems' => $roles,
                    ])
                @else

                    <label class="control-label">Foto</label>
                    @if($entry->img)
                      <div class="user-thumbnail"  style="margin-bottom:20px;width:150px;height:150px;background-size:cover;background-image: url('{{ url('profile/thumbnail/'. $entry->img) }}')" ></div>
                    @else
                      <div style="margin-bottom:20px;">L'usuari no ha afegit cap foto de perfil</div>
                    @endif

                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'name',
                        'old_input' => $entry->name,

                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'email',
                        'old_input' => $entry->email,
                        'attributes' => ['readonly']
                    ])
{{--                     @include('admin.partials.form-inputs.base', [
                        'type' => 'select',
                        'name' => 'schools',
                        'multiple' => true,
                        'elems' => $schools,
                        'old_input' => $schools,

                    ]) --}}
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'hidden',
                        'name' => 'school_id',
                        'old_input' => $entry->schools->first->id,
                    ])

                    <div class="form-group">
                      <label class="control-label">Promocions</label>
                      <input type="hidden" name="promotions_num" value="{{ $promotions->count()}}">
                      @foreach($entry->promotions as $promotion)
                      <div class="form-inline">
                        <input class="form-control-plaintext" style="width:200px;border:none;" type="text" name="{{"school_" . $loop->index }}" value="{{$promotion->school->title}}" readonly>
                        <input class="form-control" style="width:70px;" type="text" name="{{"promotion_" . $loop->index }}" value="{{$promotion->title}}">
                      </div>
                      @endforeach
                    </div>
{{--                     @include('admin.partials.form-inputs.base', [
                        'type' => 'select',
                        'name' => 'year',
                        'multiple' => true,
                        'elems' => $promotions,
                        'old_input' => $promotions,
                    ]) --}}
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'password',
                        'name' => 'password',
                        'label' => 'Contraseña (mínimo 6 caracteres)'
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'password',
                        'name' => 'password_confirmation',
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'select',
                        'name' => 'roles',
                        'multiple' => true,
                        'elems' => $roles,
                    ])

                @endif
            </div>
        </div>
    </div>

</div>

