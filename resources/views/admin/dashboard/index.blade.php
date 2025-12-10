@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">System Overview</h3>
                        <div class="nk-block-des text-soft">
                            <p>Welcome to {{ config('app.name') }} Dashboard.</p>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle"><a href="#"
                                class="btn btn-icon btn-trigger toggle-expand me-n1"
                                data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                            <div class="toggle-expand-content" data-content="pageMenu">
                                <ul class="nk-block-tools g-3">
                                    <li>
                                        <div class="dropdown"><a href="#"
                                                class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                data-bs-toggle="dropdown"><em
                                                    class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span
                                                        class="d-none d-md-inline">Last</span> 30
                                                    Days</span><em
                                                    class="dd-indc icon ni ni-chevron-right"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><span>Last 30 Days</span></a>
                                                    </li>
                                                    <li><a href="#"><span>Last 6 Months</span></a>
                                                    </li>
                                                    <li><a href="#"><span>Last 1 Years</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nk-block-tools-opt"><a href="#"
                                            class="btn btn-primary"><em
                                                class="icon ni ni-reports"></em><span>Reports</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-xxl-6">
                        <div class="row g-gs">
                            <div class="col-lg-6 col-xxl-12">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Sales Revenue</h6>
                                                <p>In last 30 days revenue from subscription.</p>
                                            </div>
                                            <div class="card-tools"><em
                                                    class="card-hint icon ni ni-help-fill"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="left"
                                                    title="Revenue from subscription"></em></div>
                                        </div>
                                        <div
                                            class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                            <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                <div class="nk-sale-data"><span
                                                        class="amount">14,299.59 <span
                                                            class="change down text-danger"><em
                                                                class="icon ni ni-arrow-long-down"></em>16.93%</span></span><span
                                                        class="sub-title">This Month</span></div>
                                                <div class="nk-sale-data"><span
                                                        class="amount">7,299.59 <span
                                                            class="change up text-success"><em
                                                                class="icon ni ni-arrow-long-up"></em>4.26%</span></span><span
                                                        class="sub-title">This Week</span></div>
                                            </div>
                                            <div class="nk-sales-ck sales-revenue"><canvas
                                                    class="sales-bar-chart"
                                                    id="salesRevenue"></canvas></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xxl-12">
                                <div class="row g-gs">
                                    <div class="col-sm-6 col-lg-12 col-xxl-6">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Active Rescue Sheets</h6>
                                                    </div>
                                                    <div class="card-tools"><em
                                                            class="card-hint icon ni ni-help-fill"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="left"
                                                            title="Active Rescue Sheets"></em>
                                                    </div>
                                                </div>
                                                <div
                                                    class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span
                                                            class="amount">{{ $totalRescue }}</span><span
                                                            class="sub-title"><span
                                                                class="change down text-danger"><em
                                                                    class="icon ni ni-arrow-long-down"></em>{{ $totalRescueScan }}</span>Total Rescue scan</span></div>
                                                    <div class="nk-sales-ck"><canvas
                                                            class="sales-bar-chart"
                                                            id="activeSubscription"></canvas></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-12 col-xxl-6">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Avg Research Downloads</h6>
                                                    </div>
                                                    <div class="card-tools"><em
                                                            class="card-hint icon ni ni-help-fill"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="left"
                                                            title="Avg Research Downloads"></em>
                                                    </div>
                                                </div>
                                                <div
                                                    class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span
                                                            class="amount">{{ $researches->avg('download_count') }}</span><span
                                                            class="sub-title"><span
                                                                class="change up text-success"><em
                                                                    class="icon ni ni-arrow-long-up"></em>{{ $researches->avg('view_count') }}</span>View Count</span></div>
                                                    <div class="nk-sales-ck"><canvas
                                                            class="sales-bar-chart"
                                                            id="totalSubscription"></canvas></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <div class="card card-bordered h-100">
                            <div class="card-inner">
                                <div class="card-title-group align-start gx-3 mb-3">
                                    <div class="card-title">
                                        <h6 class="title">Sales Overview</h6>
                                        <p>In 30 days sales of product subscription. <a href="#">See
                                                Details</a></p>
                                    </div>
                                    <div class="card-tools">
                                        <div class="dropdown"><a href="#"
                                                class="btn btn-primary btn-dim d-none d-sm-inline-flex"
                                                data-bs-toggle="dropdown"><em
                                                    class="icon ni ni-download-cloud"></em><span><span
                                                        class="d-none d-md-inline">Download</span>
                                                    Report</span></a><a href="#"
                                                class="btn btn-icon btn-primary btn-dim d-sm-none"
                                                data-bs-toggle="dropdown"><em
                                                    class="icon ni ni-download-cloud"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><span>Download Mini
                                                                Version</span></a></li>
                                                    <li><a href="#"><span>Download Full
                                                                Version</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><em
                                                                class="icon ni ni-opt-alt"></em><span>More
                                                                Options</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                                    <div class="nk-sale-data"><span class="amount">$82,944.60</span>
                                    </div>
                                    <div class="nk-sale-data"><span class="amount sm">1,937
                                            <small>Subscribers</small></span></div>
                                </div>
                                <div class="nk-sales-ck large pt-4"><canvas
                                        class="sales-overview-chart" id="salesOverview"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-8">
                        <div class="card card-bordered card-full">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title"><span class="me-2">Recent Posts</span> <a
                                                href="{{ route('admin.posts.index') }}" class="link d-none d-sm-inline">See
                                                all</a></h6>
                                    </div>
                                    <div class="card-tools">
                                        <ul class="card-tools-nav">
                                            <li class="active"><a href="#"><span>All</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner p-0 border-top">
                                <div class="nk-tb-list nk-tb-orders">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col"><span>Title</span></div>
                                        <div class="nk-tb-col tb-col-sm"><span>Category</span></div>
                                        <div class="nk-tb-col tb-col-md"><span>Author</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span>Featured</span></div>
                                        <div class="nk-tb-col"><span>Published At</span></div>
                                        <div class="nk-tb-col"><span
                                                class="d-none d-sm-inline">Status</span></div>
                                        <div class="nk-tb-col"><span>&nbsp;</span></div>
                                    </div>
                                    @foreach($posts as $post)
                                    <div class="nk-tb-item">
                                        <div class="nk-tb-col">
                                            <div class="user-card">
                                                <div class="user-avatar user-avatar-sm bg-purple">
                                                    <img src="{{ asset('assets/images/category.png') }}" alt="" class="rounded">
                                                </div>
                                                <div class="user-name"><span class="tb-lead">
                                                        {{ $post->title }}
                                                    </span></div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-sm">
                                            <div class="user-card">
                                                <div class="user-name"><span class="tb-lead">
                                                        {{ $post->category->name }}
                                                    </span></div>
                                            </div>
                                        </div>
                                        <div class="nk-tb-col tb-col-md"><span
                                                class="tb-sub">{{ optional($post->author)->name ?? 'Admin' }}</span></div>
                                        <div class="nk-tb-col tb-col-lg"><span
                                                class="tb-sub text-primary">@if($post->featured)
                                                <span class="badge bg-success">Yes</span>
                                                @else
                                                <span class="badge bg-secondary">No</span>
                                                @endif</span></div>
                                        <div class="nk-tb-col"><span
                                                class="tb-sub tb-amount">{{ $post->publish_at->format('M d, Y') }}</span></div>
                                        <div class="nk-tb-col"><span
                                                class="badge badge-dot badge-dot-xs bg-success">{{ $post->status }}</span>
                                        </div>
                                        <div class="nk-tb-col nk-tb-col-action">
                                            <div class="dropdown"><a
                                                    class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                    data-bs-toggle="dropdown"><em
                                                        class="icon ni ni-more-h"></em></a>
                                                <div
                                                    class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                    <ul class="link-list-plain">
                                                        <li><a href="#">View</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card-inner-sm border-top text-center d-sm-none"><a href="#"
                                    class="btn btn-link btn-block">See History</a></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card card-bordered card-full">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Recent Resources</h6>
                                    </div>
                                    <div class="card-tools">
                                        <ul class="card-tools-nav">
                                            <li class="active"><a href="{{ route('admin.resources.index') }}"><span>All</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <ul class="nk-activity">
                                @foreach($resources as $resource)
                                <li class="nk-activity-item">
                                    <div class="nk-activity-media user-avatar bg-success"><img
                                            src="images/avatar/c-sm.jpg" alt=""></div>
                                    <div class="nk-activity-data">
                                        <div class="label">
                                            {{ $resource->title ?? 'Resource Title' }}
                                        </div>
                                        <span class="time">{{ $resource->created_at->diffForHumans() }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-xxl-4">
                        <div class="card card-bordered card-full">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">New Memberships</h6>
                                        </div>
                                        <div class="card-tools"><a href="{{ route('admin.memberships.index') }}"
                                                class="link">View All</a></div>
                                    </div>
                                </div>
                                @foreach($memberships as $membership)
                                <div class="card-inner card-inner-md">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary-dim"><span>{{ strtoupper(substr($membership->full_name, 0, 2)) }}</span>
                                        </div>
                                        <div class="user-info"><span class="lead-text">{{ $membership->full_name }}</span><span
                                                class="sub-text">{{ $membership->email }}</span></div>
                                        <div class="user-action">
                                            <div class="drodown"><a href="#"
                                                    class="dropdown-toggle btn btn-icon btn-trigger me-n1"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"><em
                                                        class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em
                                                                    class="icon ni ni-setting"></em><span>Action
                                                                    Settings</span></a></li>
                                                        <li><a href="#"><em
                                                                    class="icon ni ni-notify"></em><span>Push
                                                                    Notification</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Recent Projects</h6>
                                    </div>
                                    <div class="card-tools"><a href="{{ route('admin.projects.index') }}" class="link">All Projects</a>
                                    </div>
                                </div>
                            </div>
                            <ul class="nk-support">
                                @foreach($projects as $project)
                                <li class="nk-support-item">
                                    <div class="user-avatar"><img src="images/avatar/a-sm.jpg"
                                            alt=""></div>
                                    <div class="nk-support-content">
                                        <div class="title"><span>{{ $project->title ?? 'Project title' }}</span><span
                                                class="badge badge-dot badge-dot-xs bg-warning ms-1">{{ $project->status ?? 'Pending' }}</span>
                                        </div>
                                        <p>{{ Str::limit($project->summary ?? 'Project summary', 100) }}</p><span
                                            class="time">{{ $project->created_at->diffForHumans() ?? '' }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xxl-4">
                        <div class="card card-bordered h-100">
                            <div class="card-inner border-bottom">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Recent Research</h6>
                                    </div>
                                    <div class="card-tools"><a href="{{ route('admin.research.index') }}" class="link">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner">
                                <div class="timeline">
                                    <ul class="timeline-list">
                                        @foreach($researches as $research)
                                        <li class="timeline-item">
                                            <div class="timeline-status bg-primary is-outline">
                                            </div>
                                            <div class="timeline-date">{{ $research->created_at->format('d M') ?? '' }}<em
                                                    class="icon ni ni-alarm-alt"></em></div>
                                            <div class="timeline-data">
                                                <h6 class="timeline-title">{{ $research->title ?? 'Research Title' }}
                                                </h6>
                                                <div class="timeline-des">
                                                    <p>{{ Str::limit($research->summary ?? 'Research summary', 100) }}</p><span
                                                        class="time">By: {{ $research->created_by ?? 'Author' }}</span>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection