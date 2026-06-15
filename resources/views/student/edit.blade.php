<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>

    <form method="POST" action="{{ route('students.update', $student->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Student ID</label>
            <input type="text" name="student_id" value="{{ old('student_id', $student->student_id) }}">
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $student->name) }}">
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $student->email) }}">
        </div>
        <div>
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}">
        </div>
        <button type="submit">Update</button>
    </form>
</body>
</html>
