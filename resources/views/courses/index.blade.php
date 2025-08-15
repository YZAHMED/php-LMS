<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h1 class="h3 mb-0 text-center">Courses Management</h1>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">All Courses</h5>
                            <a href="{{ route('courses.create') }}" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Add New Course
                            </a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Course Name</th>
                                        <th>Description</th>
                                        <th>Professor</th>
                                        <th>Students</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($courses as $course)
                                        <tr>
                                            <td>{{ $course->id }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ Str::limit($course->description, 100) }}</td>
                                            <td>
                                                @if($course->professor)
                                                    <span class="badge bg-primary">{{ $course->professor->name }}</span>
                                                @else
                                                    <span class="text-muted">No professor assigned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($course->students->count() > 0)
                                                    <span class="badge bg-info">{{ $course->students->count() }} students</span>
                                                @else
                                                    <span class="text-muted">No students</span>
                                                @endif
                                            </td>
                                            <td>{{ $course->created_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-info btn-sm">
                                                        <i class="bi bi-eye"></i> View
                                                    </a>
                                                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?')">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="bi bi-book display-4"></i>
                                                    <p class="mt-2">No courses found.</p>
                                                    <a href="{{ route('courses.create') }}" class="btn btn-success">Add your first course</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary">
                                <i class="bi bi-house"></i> Back to Home
                            </a>
                            <a href="{{ route('students.index') }}" class="btn btn-primary ms-2">
                                <i class="bi bi-people"></i> View Students
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 