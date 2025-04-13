@extends('layouts.dashboard')

@section('content')
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
        <div>
            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200">Add New Fee</h3>
            <p class="text-slate-500 dark:text-slate-400">Fill in the details to create a new fee record.</p>
        </div>
    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 dark:text-gray-200 bg-white dark:bg-slate-800 shadow-md rounded-lg bg-clip-border p-6">
        <form action="{{ route('fees.store') }}" method="POST">
            @csrf

            <!-- Student -->
            <div class="mb-4">
                <label for="student_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Student</label>
                <select name="student_id" id="student_id" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Fee Type -->
            <div class="mb-4">
                <label for="fee_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Fee Type</label>
                <input type="text" name="fee_type" id="fee_type" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('fee_type') }}" placeholder="Enter fee type" required>
                @error('fee_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Amount</label>
                <input type="number" name="amount" id="amount" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('amount') }}" placeholder="Enter amount" required>
                @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Payment Status -->
            <div class="mb-4">
                <label for="payment_status" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Payment Status</label>
                <select name="payment_status" id="payment_status" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" required>
                    <option value="pending">Pending</option>
                    <option value="paid">Paid</option>
                </select>
                @error('payment_status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Due Date -->
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Due Date</label>
                <input type="date" name="due_date" id="due_date" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('due_date') }}">
                @error('due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Payment Date -->
            <div class="mb-4">
                <label for="payment_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Payment Date</label>
                <input type="date" name="payment_date" id="payment_date" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('payment_date') }}">
                @error('payment_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Payment Method -->
            <div class="mb-4">
                <label for="payment_method" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Payment Method</label>
                <input type="text" name="payment_method" id="payment_method" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('payment_method') }}" placeholder="Enter payment method">
                @error('payment_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Transaction ID -->
            <div class="mb-4">
                <label for="transaction_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Transaction ID</label>
                <input type="text" name="transaction_id" id="transaction_id" class="mt-1 block w-full border border-slate-300 dark:border-slate-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 focus:outline-none" value="{{ old('transaction_id') }}" placeholder="Enter transaction ID">
                @error('transaction_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create Fee</button>
            </div>
        </form>
    </div>
@endsection