@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Edit Student</h3>
            <p class="text-slate-500 dark:text-slate-400">Update the details of the student.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('name', $student->name) }}" placeholder="Enter student name" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('email', $student->email) }}" placeholder="Enter student email">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Mobile -->
            <div class="mb-4">
                <label for="mobile" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Mobile</label>
                <input type="text" name="mobile" id="mobile" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('mobile', $student->mobile) }}" placeholder="Enter student mobile number">
                @error('mobile') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Date of Birth -->
            <div class="mb-4">
                <label for="dob" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('dob', $student->dob) }}">
                @error('dob') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Profile Image -->
            <div class="mb-4">
                <label for="profile_image" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Profile Image</label>
                @if ($student->profile_image)
                    <div class="mb-2">
                        <img src="{{ asset('uploads/students/' . $student->profile_image) }}" alt="Profile Image" class="w-20 h-20 rounded-full object-cover">
                    </div>
                @endif
                <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none">
                @error('profile_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Address</label>
                <input type="text" name="address" id="address" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('address', $student->address) }}" placeholder="Enter student address">
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-slate-700 dark:text-slate-300">City</label>
                <input type="text" name="city" id="city" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('city', $student->city) }}" placeholder="Enter student city">
                @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block text-sm font-medium text-slate-700 dark:text-slate-300">State</label>
                <input type="text" name="state" id="state" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('state', $student->state) }}" placeholder="Enter student state">
                @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Zip Code -->
            <div class="mb-4">
                <label for="zip_code" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('zip_code', $student->zip_code) }}" placeholder="Enter student zip code">
                @error('zip_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Class ID -->
            <div class="mb-4">
                <label for="class_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Class</label>
                <select name="class_id" id="class_id" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none">
                    <option value="">Select Class</option>
                    @foreach($academicClasses as $class)
                        <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('class_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Student</button>
            </div>
        </form>
    </div>
@endsection