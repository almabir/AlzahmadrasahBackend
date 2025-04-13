<!DOCTYPE html>
<html>
<head>
    <title>Student Details - {{ $student->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .header p {
            font-size: 14px;
            color: #666;
        }
        .profile-image {
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            border: 2px solid #000;
            border-radius: 50%;
            overflow: hidden;
        }
        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            font-size: 18px;
            border-bottom: 2px solid #000;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        .section p {
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Student Details</h1>
        <p>Generated on: {{ now()->format('d M Y H:i:s') }}</p>
        <!-- Profile Image -->
        @if ($student->profile_image)
            <div class="profile-image">
                <img src="{{ asset('uploads/students/' . $student->profile_image) }}"  alt="Profile Image">
            </div>
        @else
            <div class="profile-image" style="background-color: #f2f2f2; display: flex; align-items: center; justify-content: center;">
                No Image
            </div>
        @endif
    </div>

    <!-- Basic Information -->
    <div class="section">
        <h2>Basic Information</h2>
        <p><strong>Name:</strong> {{ $student->name }}</p>
        <p><strong>Email:</strong> {{ $student->email ?? 'N/A' }}</p>
        <p><strong>Mobile:</strong> {{ $student->mobile ?? 'N/A' }}</p>
        <p><strong>Date of Birth:</strong> {{ $student->dob ? $student->dob : 'N/A' }}</p>
        <p><strong>Class:</strong> {{ $student->academicClass->name ?? 'N/A' }}</p>
    </div>

    <!-- Address Information -->
    <div class="section">
        <h2>Address Information</h2>
        <p><strong>Address:</strong> {{ $student->address ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $student->city ?? 'N/A' }}</p>
        <p><strong>State:</strong> {{ $student->state ?? 'N/A' }}</p>
        <p><strong>Zip Code:</strong> {{ $student->zip_code ?? 'N/A' }}</p>
    </div>

    <!-- Parent Information -->
    <div class="section">
        <h2>Parent Information</h2>
        <p><strong>Father's Name:</strong> {{ $student->parentDetails->father_name ?? 'N/A' }}</p>
        <p><strong>Father's Contact:</strong> {{ $student->parentDetails->father_contact ?? 'N/A' }}</p>
        <p><strong>Mother's Name:</strong> {{ $student->parentDetails->mother_name ?? 'N/A' }}</p>
        <p><strong>Mother's Contact:</strong> {{ $student->parentDetails->mother_contact ?? 'N/A' }}</p>
    </div>

    <!-- Local Guardian Information -->
    <div class="section">
        <h2>Local Guardian Information</h2>
        <p><strong>Name:</strong> {{ $student->localGuardian->name ?? 'N/A' }}</p>
        <p><strong>Relation:</strong> {{ $student->localGuardian->relation ?? 'N/A' }}</p>
        <p><strong>Contact:</strong> {{ $student->localGuardian->contact ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $student->localGuardian->address ?? 'N/A' }}</p>
    </div>

    <!-- Achievements -->
    <div class="section">
        <h2>Achievements</h2>
        @if ($student->achievements->isEmpty())
            <p>No achievements found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->achievements as $achievement)
                        <tr>
                            <td>{{ $achievement->title }}</td>
                            <td>{{ $achievement->description ?? 'No description' }}</td>
                            <td>{{ $achievement->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Fees -->
    <div class="section">
        <h2>Fees</h2>
        @if ($student->fees->isEmpty())
            <p>No fees found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Fee Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->fees as $fee)
                        <tr>
                            <td>{{ $fee->fee_type }}</td>
                            <td>{{ number_format($fee->amount, 2) }}</td>
                            <td>{{ ucfirst($fee->payment_status) }}</td>
                            <td>{{ $fee->due_date ? $fee->due_date : 'N/A' }}</td>
                            <td>{{ $fee->payment_date ? $fee->payment_date : 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>