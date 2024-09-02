@extends(themeView('admin', 'layout.list'))
@section('table')
    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>{{ __("admin/{$folder}.table_email") }}</th>
                <th>{{ __("admin/{$folder}.table_ip") }}</th>
                <th>{{ __('admin/general.table_created_at') }}</th>
                <th>{{ __('admin/general.table_action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->created_at->diffForHumans() }}</td>
                    <td class="table-action">
                        <div class="data-action-button">
                            {{ html()->form('DELETE')->route("admin.{$route}.unblock", $item->id)->open() }}
                            <a href="javascript:void(0);" class="confirm-btn me-2 p-2">
                                <i data-feather="slash" class="feather-icon text-danger"></i>
                            </a>
                            {{ html()->form()->close() }}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">{{ __('admin/general.table_no_data') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
