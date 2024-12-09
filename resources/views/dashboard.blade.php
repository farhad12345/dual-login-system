<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 items-right text-right">
                    <h2 class="text-lg font-semibold mb-4">{{ __('Projects List') }}</h2>
                    <div class="text-right items-right">
                        <a href="{{ route('projects.create') }}" class="btn btn-primary text-right">
                            <i class="fas fa-plus"></i> Add Project
                        </a>
                    </div>
                    <table class="table table-striped table-hover align-middle">
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
                                        <a href="{{ route('projects.edit', $project->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                            class="d-inline">
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
            </div>
        </div>
    </div>
</x-app-layout>
