@extends(themeView('admin', 'layout.list'))
@section('pageTitle', __("admin/{$folder}.list"))
@section('table')
    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>{{ __("admin/{$folder}.table_image") }}</th>
                <th>{{ __("admin/{$folder}.table_title") }}</th>
                <th>{{ __('admin/general.table_created_at') }}</th>
                <th>{{ __('admin/general.table_updated_at') }}</th>
                <th>{{ __('admin/general.table_status') }}</th>
                <th>{{ __('admin/general.table_action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><img class="table-image" src="{{ $item->getFirstMediaUrl($module->COVER_COLLECTION()) }}"></td>
                    <td>{{ $item->titles[config('app.fallback_locale')] ?? null }}</td>
                    <td>{{ $item->created_at->diffForHumans() }}</td>
                    <td>{{ $item->updated_at->diffForHumans() }}</td>
                    @include(themeView('admin', 'layout.status'))
                    @include(themeView('admin', 'layout.action'), ['edit' => '', 'delete' => ''])
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('admin/general.table_no_data') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
