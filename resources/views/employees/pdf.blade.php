<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        *{
           font-family: 'Saysettha OT';
       }
    </style>

</head>    
<body>
    <div>
       
        <h4>CIT SOLE CO, LTD</h4>
    </div>
    <p>{{ $date }}</p>
    <h5>Employees:</h5>
    
  
    <table class="table table-bordered">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Position</th>
            <th>salary</th>
            <th>Phone</th>
        </tr>
        @foreach($employees as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->emp_name }}</td>
                <td>{{ $data->staff_type }}</td>
                <td>{{ number_format($data->salary, 2, '.', ',') }}</td>
                <td>{{ $data->contact_no }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>

