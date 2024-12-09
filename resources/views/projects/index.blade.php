@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Projects</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add New Project</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Company Name</th>
                    <th>Service Required</th>
                    <th>Start Date</th>
                    <th>Completion Date</th>
                    <th>Status</th>
                    <th>Document</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->employee->name }}</td>
                        <td>{{ $project->company_name }}</td>
                        <td>{{ $project->service_required }}</td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->completion_date }}</td>
                        <td>
                            <span
                                class="badge
                            {{ $project->status == 'started' ? 'bg-danger' : ($project->status == 'in_progress' ? 'bg-warning' : 'bg-success') }}">
                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </td>
                        <td><a href="{{ Storage::url($project->document) }}" target="_blank">View</a></td>
                        <td>
                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
