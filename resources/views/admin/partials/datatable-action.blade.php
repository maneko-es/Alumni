@foreach($buttons as $button)
    <?php
        $url = checkKey($button, 'url');
        $class = checkKey($button, 'class');
        $attribute = checkKey($button, 'attribute');
        $title = checkKey($button, 'title');
        $text = checkKey($button, 'text');
    ?>
    <a href="{{ $url }}" class="btn btn-sm btn-default {{ $class }}" {{ $attribute }} title="{{ $title }}">
        {{ $text }}
    </a>
@endforeach
