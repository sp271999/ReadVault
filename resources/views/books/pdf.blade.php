<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Books List</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>ReadVault - Books List</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $index => $book)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
