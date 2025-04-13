@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Student Details</h3>
            <p class="text-slate-500 dark:text-slate-400">View the details of the student.</p>
        </div>
        <a href="{{ route('students.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Back to List</a>
    </div>

    <div class="relative w-full h-full bg-white dark:bg-slate-800 shadow-md rounded-lg p-6">
        <!-- Profile Image -->
        <div class="absolute top-6 right-6">
            @if ($student->profile_image)
                <img src="{{ asset('uploads/students/' . $student->profile_image) }}" alt="Profile Image" class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-slate-800 shadow-lg">
            @else
                <div class="w-32 h-32 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400">
                    No Image
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Basic Information -->
            <div>
                <h4 class="text-md font-semibold text-slate-700 dark:text-slate-300 mb-2">Basic Information</h4>
                <div class="space-y-2">
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                    <p><strong>Email:</strong> {{ $student->email ?? 'N/A' }}</p>
                    <p><strong>Mobile:</strong> {{ $student->mobile ?? 'N/A' }}</p>
                    <p><strong>Date of Birth:</strong> {{ $student->dob ? $student->dob : 'N/A' }}</p>
                    <p><strong>Class:</strong> {{ $student->academicClass->name ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Address Information -->
            <div>
                <h4 class="text-md font-semibold text-slate-700 dark:text-slate-300 mb-2">Address Information</h4>
                <div class="space-y-2">
                    <p><strong>Address:</strong> {{ $student->address ?? 'N/A' }}</p>
                    <p><strong>City:</strong> {{ $student->city ?? 'N/A' }}</p>
                    <p><strong>State:</strong> {{ $student->state ?? 'N/A' }}</p>
                    <p><strong>Zip Code:</strong> {{ $student->zip_code ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Parent Information -->
            <div>
                <h4 class="text-md font-semibold text-slate-700 dark:text-slate-300 mb-2">Parent Information</h4>
                <div class="space-y-2">
                    <p><strong>Father's Name:</strong> {{ $student->parentDetails->father_name ?? 'N/A' }}</p>
                    <p><strong>Father's Contact:</strong> {{ $student->parentDetails->father_contact ?? 'N/A' }}</p>
                    <p><strong>Mother's Name:</strong> {{ $student->parentDetails->mother_name ?? 'N/A' }}</p>
                    <p><strong>Mother's Contact:</strong> {{ $student->parentDetails->mother_contact ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Local Guardian Information -->
            <div>
                <h4 class="text-md font-semibold text-slate-700 dark:text-slate-300 mb-2">Local Guardian Information</h4>
                <div class="space-y-2">
                    <p><strong>Name:</strong> {{ $student->localGuardian->name ?? 'N/A' }}</p>
                    <p><strong>Relation:</strong> {{ $student->localGuardian->relation ?? 'N/A' }}</p>
                    <p><strong>Contact:</strong> {{ $student->localGuardian->contact ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $student->localGuardian->address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <!-- Achievements -->
            <div>
                <h4 class="text-md font-semibold text-slate-700 dark:text-slate-300 mb-2">Achievements</h4>
                @if ($student->achievements->isEmpty())
                    <p>No achievements found.</p>
                @else
                    <ul class="list-disc pl-4">
                        @foreach ($student->achievements as $achievement)
                            <li><strong>{{ $achievement->title }}</strong> - {{ $achievement->description ?? 'No description' }} ({{ $achievement->date }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Fees -->
            <div>
                <h4 class="text-md font-semibold text-slate-700 dark:text-slate-300 mb-2">Fees</h4>
                @if ($student->fees->isEmpty())
                    <p>No fees found.</p>
                @else
                    <ul class="list-disc pl-4">
                        @foreach ($student->fees as $fee)
                            <li><strong>{{ $fee->fee_type }}</strong>: {{ number_format($fee->amount, 2) }} - {{ ucfirst($fee->payment_status) }} (Due: {{ $fee->due_date ?? 'N/A' }})</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Download PDF Button -->
        <div class="fixed bottom-6 right-6">
            <a href="{{ route('students.download-pdf', $student->id) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download PDF
            </a>
        </div>
    </div>
@endsection
