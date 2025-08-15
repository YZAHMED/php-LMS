<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h1 class="h3 mb-0 text-center">Course Details</h1>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Course ID:</label>
                                    <p class="form-control-plaintext">{{ $course->id }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Course Name:</label>
                                    <p class="form-control-plaintext">{{ $course->name }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Description:</label>
                                    <p class="form-control-plaintext">{{ $course->description }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Professor:</label>
                                    @if($course->professor)
                                        <p class="form-control-plaintext">
                                            <span class="badge bg-primary">{{ $course->professor->name }}</span>
                                        </p>
                                    @else
                                        <p class="text-muted">No professor assigned</p>
                                    @endif
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Enrolled Students:</label>
                                    @if($course->students->count() > 0)
                                        <div class="row">
                                            @foreach($course->students as $student)
                                                <div class="col-md-6 mb-2">
                                                    <div class="card border-primary">
                                                        <div class="card-body p-2">
                                                            <h6 class="card-title mb-1">{{ $student->fname }} {{ $student->lname }}</h6>
                                                            <small class="text-muted">{{ $student->email }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <p class="text-muted mt-2">Total: {{ $course->students->count() }} students</p>
                                    @else
                                        <p class="text-muted">No students enrolled</p>
                                    @endif
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Created At:</label>
                                    <p class="form-control-plaintext">{{ $course->created_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Last Updated:</label>
                                    <p class="form-control-plaintext">{{ $course->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Edit Course
                                </a>
                                <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">
                                        <i class="bi bi-trash"></i> Delete Course
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 