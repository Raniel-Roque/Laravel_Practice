<?php

use App\Models\Employer;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function() {
    return view('jobs.index', [
        'jobs'=> Job::with('employer')->latest()->simplePaginate(4)
    ]);
});

// Create Job
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Store Job
Route::post('/jobs', function () {
    request()->validate([
        'title'=> ['required','string','min:3'],
        'salary'=> ['required','string'],
    ]);

    Job::create([
        'title'=> request('title'),
        'salary'=> request('salary'),
        'employer_id'=> 1,
    ]);

    return redirect('/jobs');
});

// Show Job
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title'=> ['required','string','min:3'],
        'salary'=> ['required','string'],
    ]);

    $job = Job::findOrFail($id);
    
    $job->update([
        'title'=> request('title'),
        'salary'=> request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {

    Job::findOrFail($id)->delete();
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
