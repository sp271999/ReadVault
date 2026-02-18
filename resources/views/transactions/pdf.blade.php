<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transaction Report</title>

    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2 align="center">Borrowed Books Transactions</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Book</th>
            <th>Borrowed Date</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->book->title ?? '-' }}</td>
            <td>{{ $t->borrowed_at }}</td>
            <td>{{ $t->due_date }}</td>
            <td>{{ $t->returned_at ? 'Returned' : 'Not Returned' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
