@extends('layouts.app')

@section('title', 'Users Selected Topic')

@section('content')
<div class="container py-4">
    <h4>Users who selected: {{ $researchSpace->title }}</h4>

    @if($users->isEmpty())
        <div class="alert alert-info">No users have selected this topic yet.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Selected At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->pivot->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('admin.research_spaces.index') }}" class="btn btn-secondary mt-2">Back</a>
</div>
@endsection
