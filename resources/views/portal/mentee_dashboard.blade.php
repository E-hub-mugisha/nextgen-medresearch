@extends('layouts.portal')

@section('content')
<div class="container mt-4">

    {{-- Dashboard Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Welcome, {{ $mentee->name }}</h3>
        <span class="text-muted">Analytics Overview</span>
    </div>

    {{-- KPI Cards --}}
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Total Requests</h6>
                <h2 class="fw-bold">{{ $stats['total_requests'] ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Approved Requests</h6>
                <h2 class="fw-bold text-success">{{ $stats['approved'] ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Pending Requests</h6>
                <h2 class="fw-bold text-warning">{{ $stats['pending'] ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="text-muted">Projects</h6>
                <h2 class="fw-bold">{{ $stats['projects'] ?? 0 }}</h2>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row mb-4">
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="fw-bold">Requests Trend</h6>
                <canvas id="requestsChart" height="120"></canvas>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="fw-bold">Projects & Milestones Progress</h6>
                <canvas id="projectChart" height="120"></canvas>
            </div>
        </div>
    </div>

    {{-- Mentors Table --}}
    <div class="card shadow-sm p-3 mb-4">
        <h5 class="fw-bold mb-3">My Mentors</h5>
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Expertise</th>
                    <th>Status</th>
                    <th>Requested On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requestedMentors as $mentor)
                <tr>
                    <td>{{ $mentor->name }}</td>
                    <td>{{ $mentor->mentorProfile->expertise ?? '-' }}</td>
                    <td>
                        <span class="badge 
                            @if($mentor->pivot->status=='approved') bg-success
                            @elseif($mentor->pivot->status=='rejected') bg-danger
                            @else bg-warning text-dark @endif">
                            {{ ucfirst($mentor->pivot->status) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($mentor->pivot->created_at)->format('M d, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

{{-- Styles --}}
<style>
.btn-gradient-primary{
    background: linear-gradient(90deg,#4e54c8,#8f94fb);
    color:#fff;border:none;
}
.btn-gradient-primary:hover{opacity:.9}
.card{border-radius:15px;}
</style>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Requests Line Chart
    const requestsCtx = document.getElementById('requestsChart');
    new Chart(requestsCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($analytics['request_months']) !!},
            datasets: [{
                label: 'Requests',
                data: {!! json_encode($analytics['request_counts']) !!},
                borderWidth: 3,
                borderColor: '#4e54c8',
                backgroundColor: 'rgba(78,84,200,.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options:{
            responsive:true,
            plugins:{legend:{display:false}}
        }
    });

    // Projects & Milestones Progress Chart
    const projectCtx = document.getElementById('projectChart');
    new Chart(projectCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($analytics['projects']) !!}, // project titles
            datasets: [{
                label: 'Milestone Completion %',
                data: {!! json_encode($analytics['milestones_progress']) !!},
                backgroundColor: '#4e54c8'
            }]
        },
        options:{
            responsive:true,
            indexAxis:'y',
            scales:{
                x:{max:100, title:{display:true,text:'Progress (%)'}}
            }
        }
    });
</script>
@endsection
