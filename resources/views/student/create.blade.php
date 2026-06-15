<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
</head>
<body>
    <h1>Create Student</h1>

    <form method="POST" action="{{ route('students.store') }}">
        @csrf
        <div>
            <label>Student ID</label>
            <input type="text" name="student_id" value="{{ old('student_id') }}">
        </div>
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label>Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}">
        </div>
        <button type="submit">Save</button>
    </form>
</body>
</html>
