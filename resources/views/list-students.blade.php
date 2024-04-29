<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
    <style>
        table, th, td {
          border: 1px solid black;
        }
        </style>
</head>
<body>
    
    <h1>Students</h1>
    @if (count($students) > 0)
        <table>
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Mark</th>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{$student->st_name}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->mark}}</td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    @else
        <p>No data, Please attend exam.</p>
    @endif
</body>
</html>