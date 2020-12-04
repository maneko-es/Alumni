<div class="row">
    <div class="col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('messages.content') }}</div>
            <div class="panel-body">
                @if(!$_GET['registry'])
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
                <?php $registry = App\Registry::find($_GET['registry']); ?>
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'name',
                        'old_input' => $registry->name,
                        'attributes' => ['readonly']
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'email',
                        'old_input' => $registry->email,
                        'attributes' => ['readonly']
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'school',
                        'old_input' => App\School::find($registry->school_id)->title,
                        'attributes' => ['readonly']
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'hidden',
                        'name' => 'school_id',
                        'old_input' => $registry->school_id,
                    ])
                    @include('admin.partials.form-inputs.base', [
                        'type' => 'text',
                        'name' => 'year',
                        'old_input' => $registry->year,
                        'attributes' => ['readonly']
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

    <div class="col-sm-5">

    </div>
</div>
