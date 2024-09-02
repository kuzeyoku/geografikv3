@extends(themeView('admin', 'layout.main'))
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>{{ auth()->user()->name }}</h4>
                        <h5>@lang('admin/home.welcome', ['ip' => $userData->ip, 'location' => $userData->city ?? null, 'country' => $userData->country ?? null])</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{ $visits['todaySingleVisits'] }}</h4>
                        <h5>@lang('admin/home.today_visits')</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>{{ $visits['totalSingleVisits'] }}</h4>
                        <h5>@lang('admin/home.total_visits')</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="users"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>{{ $visits['totalPageViews'] }}</h4>
                        <h5>@lang('admin/home.total_page_views')</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="eye"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">@lang('admin/home.visits')</h5>
                        <div class="badge badge-lineinfo">@lang('admin/home.visits_chart_info')</div>
                    </div>
                    <div class="card-body">
                        <div id="s-line-area" class="chart-set"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">@lang('admin/home.popular_posts')</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @foreach ($popularPosts as $post)
                                        <tr>
                                            <td>
                                                <a onclick="return!window.open(this.href);" href="{{ $post->url }}">
                                                    <i data-feather="file-text"></i>
                                                    {{ Str::limit($post->title, 50, '...') }}
                                                </a>
                                            </td>
                                            <td>{{ $post->view_count }} @lang('admin/home.view')</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4 log-card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title mb-0">@lang('admin/home.info_logs')</h4>
                        {{-- <button data-url="{{ route('admin.log_clear', 'info') }}"
                            class="clear-log btn btn-danger btn-sm">@lang('admin/home.clear')</button> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @foreach ($infoLogs as $message)
                                        <tr>
                                            <td>#</td>
                                            <td>{{ $message }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4 log-card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title mb-0">@lang('admin/home.error_logs')</h4>
                        {{-- <button data-url="{{ route('admin.log_clear', 'errors') }}"
                            class="clear-log btn btn-danger btn-sm">@lang('admin/home.clear')</button> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    @foreach ($errorLogs as $message)
                                        <tr>
                                            <td>#</td>
                                            <td>{{ $message }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ themeAsset('admin', 'js/apexcharts.min.js') }}"></script>
    <script>
        'use strict';
        $(document).ready(function() {
            if ($('#s-line-area').length > 0) {
                var sLineArea = {
                    chart: {
                        height: 260,
                        type: 'area',
                    },
                    dataLabels: {
                        enabled: true,
                    },
                    series: [{
                        name: "{{ __('admin/home.single_visits') }}",
                        data: {{ json_encode($visits['chart']['singleVisits']) }}
                    }, {
                        name: "{{ __('admin/home.unique_visits') }}",
                        data: {{ json_encode($visits['chart']['uniqueVisits']) }}
                    }],
                    xaxis: {
                        labels: {
                            datetimeUTC: false,
                            format: 'dd/MM/yyyy'
                        },
                        type: 'datetime',
                        categories: {{ json_encode($visits['chart']['dates']) }},
                    },
                    tooltip: {
                        x: {
                            format: 'dd/MM/yyyy'
                        },
                    }
                }
                var chart = new ApexCharts(document.querySelector("#s-line-area"), sLineArea);
                chart.render();
            }
        });
    </script>
@endpush
