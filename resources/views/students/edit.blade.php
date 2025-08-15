<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h1 class="h3 mb-0 text-center">Edit Student</h1>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form action="{{ route('students.update', $student) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="fname" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('fname') is-invalid @enderror" 
                                       id="fname" name="fname" value="{{ old('fname', $student->fname) }}" required>
                                @error('fname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="lname" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('lname') is-invalid @enderror" 
                                       id="lname" name="lname" value="{{ old('lname', $student->lname) }}" required>
                                @error('lname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $student->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Enroll in Courses</label>
                                <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                    @forelse($courses as $course)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="course_ids[]" value="{{ $course->id }}" 
                                                   id="course_{{ $course->id }}"
                                                   {{ in_array($course->id, old('course_ids', $student->courses->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="course_{{ $course->id }}">
                                                <strong>{{ $course->name }}</strong>
                                                @if($course->professor)
                                                    <br><small class="text-muted">Prof. {{ $course->professor->name }}</small>
                                                @endif
                                            </label>
                                        </div>
                                    @empty
                                        <p class="text-muted">No courses available.</p>
                                    @endforelse
                                </div>
                                @error('course_ids')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-secondary me-md-2">Cancel</a>
                                <button type="submit" class="btn btn-warning">Update Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 