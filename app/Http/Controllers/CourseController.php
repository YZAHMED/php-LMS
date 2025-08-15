<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Professor;
use Illuminate\Http\Request;
use Exception;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Get all courses ordered by latest first with their professor
            $courses = Course::with('professor')->latest()->get();
            
            // Return the courses index view with data
            return view('courses.index', compact('courses'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load courses. Please try again.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Get all available professors for selection
            $professors = Professor::all();
            
            // Return the create course form view with professors
            return view('courses.create', compact('professors'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load create form. Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            // Create a new course with validated data
            Course::create($request->validated());
            
            // Redirect to courses index with success message
            return redirect()->route('courses.index')
                ->with('success', 'Course created successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create course. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        try {
            // Load the course with its professor and students
            $course->load(['professor', 'students']);
            
            // Return the show course view with course data
            return view('courses.show', compact('course'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load course details. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        try {
            // Load the course with its professor
            $course->load('professor');
            
            // Get all available professors for selection
            $professors = Professor::all();
            
            // Return the edit course form view with course data and professors
            return view('courses.edit', compact('course', 'professors'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load edit form. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        try {
            // Update the course with validated data
            $course->update($request->validated());
            
            // Redirect to courses index with success message
            return redirect()->route('courses.index')
                ->with('success', 'Course updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update course. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        try {
            // Detach all students first
            $course->students()->detach();
            
            // Delete the course
            $course->delete();
            
            // Redirect to courses index with success message
            return redirect()->route('courses.index')
                ->with('success', 'Course deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete course. Please try again.');
        }
    }
}
