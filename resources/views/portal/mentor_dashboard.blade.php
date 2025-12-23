@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4">Welcome, {{ $mentor->name }}</h3>

    <!-- Pending Requests -->
    <div class="mb-4">
        <h5>Pending Mentorship Requests</h5>
        <div class="row">
            @foreach($mentorshipRequests as $request)
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h6>{{ $request->name }}</h6>
                    <p>{{ $request->menteeProfile->research_goals ?? '-' }}</p>
                    <button class="btn btn-success btn-sm accept-btn" data-id="{{ $request->pivot->id }}">Accept</button>
                    <button class="btn btn-danger btn-sm reject-btn" data-id="{{ $request->pivot->id }}">Reject</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Overview -->
    <div class="mb-4">
        <h5>My Profile</h5>
        <p><strong>Expertise:</strong> {{ $mentor->mentorProfile->expertise ?? '-' }}</p>
        <p><strong>Bio:</strong> {{ $mentor->mentorProfile->bio ?? '-' }}</p>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('.accept-btn, .reject-btn').click(function() {
            let btn = $(this);
            let id = btn.data('id');
            let action = btn.hasClass('accept-btn') ? 'accept' : 'reject';

            $.ajax({
                url: '/mentor/requests/' + id + '/' + action,
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        btn.closest('.card').fadeOut();
                    }
                }
            });
        });
    });
</script>
@endsection