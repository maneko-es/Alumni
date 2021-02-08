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
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'select',
                        'name' => 'schools',
                        'multiple' => true,
                        'elems' => $schools,
                        'old_input' => $schools,

                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'hidden',
                        'name' => 'school_id',
                        'old_input' => $entry->schools->first->id,
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'select',
                        'name' => 'year',
                        'multiple' => true,
                        'elems' => $promotions,
                        'old_input' => $promotions,
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
                @endif
            </div>
        </div>
    </div>

</div>
{{-- <div class="form-group">
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-btn fa-save"></i>
        {{ trans('messages.save') }}
    </button>
</div> --}}