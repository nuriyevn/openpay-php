<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Clients list</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--    Font awesome icons link cdn-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <!--    Local styles-->
    <style>
        #header {
            background-color: #337AB7;
            color: whitesmoke;
            border-radius: 3px;

        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="row">
    <div class="col-md-offset-1 col-md-10">
        <h1><i class="fa fa-users" aria-hidden="true"></i></span> Clients</h1>
        <div class="row">
            <table class="table table-condensed">
                <tr>
                    <td colspan="6" id="header" class="lead"><i class="fa fa-bars" aria-hidden="true"></i> List of
                        clients
                    </td>
                </tr>
                <tr>
                    <td><i class="fa fa-calendar" aria-hidden="true"></i> Start Date <br>
                        <input type="date" class="form-control">
                    </td>
                    <td><i class="fa fa-calendar" aria-hidden="true"></i> End Date <br>
                        <input type="date" class="form-control">
                    </td>
                    <td><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> Amount <br>
                        <input type="number" class="form-control" placeholder="Amount to display">
                    </td>
                    <td></td>
                    <td></td>
                    <td><br>
                        <button type="submit" class="btn btn-primary">Refresh</button>
                    </td>
                </tr>
                <tr>
                    <th>Creation</th>
                    <th>Address</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Balance</th>
                </tr>


                <tr>
                    <td>21 Aug, 2016</td>
                    <td>Kanatnaya str, 55, Odessa, Ukraine, 65000</td>
                    <td><a href="customerDetails.php" title="click for customer details">Some Person Petrovi4</a></td>
                    <td>naum.oleks@gmail.com</td>
                    <td>+380980238180</td>
                    <td><i class="fa fa-usd" aria-hidden="true"></i> 38</td>

                </tr>

                <tr>
                    <td>01 Jan, 1971</td>
                    <td>Mishugi blrd, 55, Kyiv, Ukraine, 65000</td>
                    <td><a href="customerDetails.php" title="click for customer details">Nusrat Nuriev Hikmet</a></td>
                    <td>Nuriyevn@gmail.com</td>
                    <td>+380971234567</td>
                    <td><i class="fa fa-usd" aria-hidden="true"></i> 99</td>
                </tr>
            </table>
        </div>
    </div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
</body>
</html>