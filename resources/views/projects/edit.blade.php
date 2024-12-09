<x-app-layout>
    <div class="container mt-4">
        <h2>Edit Project</h2>
        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')



            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name" id="company_name" class="form-control"
                    value="{{ $project->company_name }}" required>
                @error('company_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="service_required" class="form-label">Service Required</label>
                <input type="text" name="service_required" id="service_required" class="form-control"
                    value="{{ $project->service_required }}" required>
                @error('service_required')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ $project->start_date }}" required>
                @error('start_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="completion_date" class="form-label">Completion Date</label>
                <input type="date" name="completion_date" id="completion_date" class="form-control"
                    value="{{ $project->completion_date }}" required>
                @error('completion_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="started" {{ $project->status == 'started' ? 'selected' : '' }}>Started</option>
                    <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="document" class="form-label">Document</label>
                <input type="file" name="document" id="document" class="form-control">
                <a href="{{ Storage::url($project->document) }}" target="_blank">View File</a>
            </div>

            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
    </div>
</x-app-layout>
