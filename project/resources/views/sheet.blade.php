<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>DRC Systems</title>
  </head>
  <body>
    <div class="container mt-5">
      <h1>Profit/Loss Sheet</h1>
      <table class="table table-success table-striped table-bordered" style="text-align: center;">
        <thead>
          <tr>
            <th rowspan ="2">Month/Year</th>
            <th colspan="3">Buy</th>
            <th colspan="3">Sell</th>
            <th rowspan="2">Remain Stock</th>
            <th rowspan="2">Profit/Loss</th>
          </tr>
          <tr>
            <th>Qty</th>
            <th>Rate</th>
            <th>Total</th>
            <th>Qty</th>
            <th>Rate</th>
            <th>Total</th>
          </tr>

        </thead>
        <tbody>
          @foreach($calculated_data as $key=>$data)
            <tr>
              <td>{{$key}}</td>
              <td>{{$calculated_data[$key]['Buy']['Qty']}}</td>
              <td>{{$calculated_data[$key]['Buy']['Rate']}}</td>
              <td>{{$calculated_data[$key]['Buy']['Total']}}</td>
              <td>{{$calculated_data[$key]['Sell']['Qty']}}</td>
              <td>{{$calculated_data[$key]['Sell']['Rate']}}</td>
              <td>{{$calculated_data[$key]['Sell']['Total']}}</td>
              <td>{{$calculated_data[$key]['Remain_Stock']}}</td>
              <td>{{$calculated_data[$key]['P_L']}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>