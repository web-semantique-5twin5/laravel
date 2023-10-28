<!DOCTYPE html>
<html>
<head>
    <title>JSON Data View</title>
</head>
<body>
    <h1>JSON Data View</h1>

    <table>
        <thead>
            <tr>
                <th>nomTrophée</th>
                <th>annéeObtention</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
                <tr>
                    <td>{{ $result->nomTrophée->value }}</td>
                    <td>{{ $result->annéeObtention->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
