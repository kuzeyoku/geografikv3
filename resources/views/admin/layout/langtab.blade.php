<ul class="nav nav-tabs tab-style-1 d-sm-flex d-block" role="tablist">
    @foreach (LanguageList() as $lang)
        <li class="nav-item" role="presentation">
            <a class="nav-link @if ($loop->first) active @endif" data-bs-toggle="tab" aria-current="page"
                href="#{{ $lang->code }}" aria-selected="false" role="tab" tabindex="-1">{{ $lang->title }}</a>
        </li>
    @endforeach
</ul>
