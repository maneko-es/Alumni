<div class="form-group">
    <div class="dropdown uppercase">

        {!! Form::label('', $label, ['class' => 'show']) !!}

        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            {{ $name }}
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            @foreach($elems as $elem)
                <li>
                    <a href="{{ $elem['url'] }}">
                        {{ $elem['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
