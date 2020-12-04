<div class="row crud-header">
    <div class="col-md-6">
        @if (isset($title))
            <ol class="breadcrumb">
                @foreach($title as $item)
                    <?php
                        $class = 'active';
                        $url = '';
                        if (isset($item['url'])) {
                            $class = '';
                            $url = 'href=' . url(checkKey($item, 'url'));
                        }
                    ?>
                    <li class="{{ $class }}">
                        <a {{ $url }}>{{ checkKey($item, 'name') }} @if(checkKey($item, 'name') == 'Editar') {{ $entry->title }} @endif</a>
                    </li>
                @endforeach
            </ol>
        @endif
    </div>
    @if (isset($buttons))
        <div class="col-md-6 text-right">
            @foreach ($buttons as $key => $button)
                <?php
                    if ($button) {
                        $url = checkKey($button, 'url');
                        $name = checkKey($button, 'name');
                        $class = checkKey($button, 'class');
                        $attribute = checkKey($button, 'attribute');
                        $icon = checkKey($button, 'icon');
                ?>
                    <a {{ $key == 'delete' ? "data-url=" . url($url) : "href=" . url($url) }} class="btn {{ $class }} btn-md" {{ $attribute }}>
                        <i class="fa fa-btn {{ $icon }}"></i>{{ $name }}
                    </a>
                <?php } ?>
            @endforeach
        </div>
    @endif
</div>
