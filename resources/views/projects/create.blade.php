<x-app-layout>
    <div class="container mt-4">
        <h2>Add New Project</h2>
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <input type="text" hidden value="{{ auth()->user()->id }}" name="employee_id">
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" name="company_name" id="company_name"
                    class="form-control @error('company_name') is-invalid @enderror"
                    value="{{ old('company_name', $project->company_name ?? '') }}" required>
                @error('company_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="service_required" class="form-label">Service Required</label>
                <input type="text" name="service_required" id="service_required" class="form-control" required>
                @error('service_required')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
                @error('start_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="completion_date" class="form-label">Completion Date</label>
                <input type="date" name="completion_date" id="completion_date" class="form-control" required>
                @error('completion_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="started">Started</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="document" class="form-label">Document</label>
                <input type="file" name="document" id="document" class="form-control" required>
                @error('document')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Project</button>
        </form>
    </div>
</x-app-layout>
