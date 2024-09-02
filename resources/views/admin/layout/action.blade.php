<td class="table-action">
    <div class="data-action-button">
        @isset($block)
            {{ html()->form()->route("admin.{$route}.block", $item)->open() }}
            <a class="confirm-btn me-2 p-2">
                <i data-feather="slash" class="feather-icon text-danger"></i>
            </a>
            {{ html()->form()->close() }}
        @endisset
        @isset($show)
            <a class="me-2 p-2" onclick="return!window.open(this.href);" href="{{ $show ?: $item->url }}">
                <i data-feather="eye" class="feather-icon"></i>
            </a>
        @endisset
        @isset($image)
            <a class="me-2 p-2" href="{{ route("admin.{$route}.image", $item) }}">
                <i data-feather="image" class="feather-icon text-secondary"></i>
            </a>
        @endisset
        @isset($comment)
            <a class="me-2 p-2" href="{{ route("admin.{$route}.comment", $item) }}">
                <i data-feather="message-square" class="feather-icon text-info"></i>
            </a>
        @endisset
        @isset($file)
            <a class="me-2 p-2" href="{{ route("admin.{$route}.files", $item) }}">
                <i data-feather="repeat" class="feather-icon text-primary"></i>
            </a>
        @endisset
        @isset($edit)
            <a class="me-2 p-2" href="{{ route("admin.{$folder}.edit", $item) }}">
                <i data-feather="edit" class="feather-icon text-success"></i>
            </a>
        @endisset
        @isset($delete)
            {{ html()->form('DELETE')->route("admin.{$route}.destroy", $item)->open() }}
            <a class="confirm-btn p-2">
                <i data-feather="trash-2" class="feather-icon text-danger"></i>
            </a>
            {{ html()->form()->close() }}
        @endisset
    </div>
</td>
