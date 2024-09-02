@extends(themeView('admin', 'layout.main'))
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>@lang("admin/{$folder}.files_title")</h4>
                    <h6>@lang("admin/{$folder}.files_description")</h6>
                </div>
            </div>
            <div class="page-btn">
                <a href="{{ route("admin.{$route}.index") }}" class="btn btn-added"><i data-feather="list"
                        class="me-2"></i>@lang("admin/{$folder}.list")</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        {{ html()->form()->route("admin.{$route}.files", $language)->open() }}
                        {{ html()->hidden('folder', 'admin') }}
                        {{ html()->label(__("admin/{$folder}.form_admin_files")) }}
                        {{ html()->select('filename', $adminFiles, $dir == 'admin' ? $filename : 'default')->placeholder(__('admin/general.select'))->class('form-control')->attribute('onchange', 'this.form.submit()') }}
                        {{ html()->form()->close() }}
                    </div>
                    <div class="col-lg-6">
                        {{ html()->form()->route("admin.{$route}.files", $language)->open() }}
                        {{ html()->hidden('folder', 'front') }}
                        {{ html()->label(__("admin/{$route}.form_site_files")) }}
                        {{ html()->select('filename', $frontFiles, $dir == 'front' ? $filename : 'default')->placeholder(__('admin/general.select'))->class('form-control')->attribute('onchange', 'this.form.submit()') }}
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __("admin/{$folder}.files_title") }}</h3>
            </div>
            <div class="card-body">
                {{ html()->form('PUT')->route("admin.{$route}.updateFileContent", $language)->open() }}
                {{ html()->hidden('filename', $filename) }}
                {{ html()->hidden('folder', $dir) }}
                <table class="table table-responsive mb-3">
                    <tbody>
                        @forelse ($fileContent as $key => $value)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>
                                    {{ html()->text($key, $value)->class('form-control mb-0') }}
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-primary mb-0 text-center">
                                {{ __("admin/{$folder}.files_table_empty") }}
                            </div>
                        @endforelse
                    </tbody>
                </table>
                @if (!empty($fileContent))
                    {{ html()->submit(__('admin/general.save'))->class('btn btn-primary') }}
                @endif
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
@endsection
