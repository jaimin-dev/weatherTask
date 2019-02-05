<?php

$zipCode="28075";
if(!empty($_REQUEST))
{
    foreach($_REQUEST as $zip)
    {
        $zipCode = $zip;
    }
}
$apiKey = "346380135de20e9ad764229263ae90c5";
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?zip=" . $zipCode . "&lang=en&units=metric&APPID=" . $apiKey;


$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Forecast Weather</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <script>
            function validate() 
            {
                var zipCodeValue = document.getElementById("zip_code").value;
                if(isNaN(zipCodeValue))
                {
                    alert("Please enter numeric value.");
                    return false;    
                }
            }
        </script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #3d407a;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            h3 {
                color: #3d407a;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #3d407a;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <form action="store" method="POST">
            {{ csrf_field() }}
            <div>
                <h3>Enter Zip Code : <input type="text" name="zip_code" id="zip_code">
                <input type="submit" value="Submit" onClick="validate()"></h3>
            </div>
            <div class="content">
                <h2><?php echo $data->name; ?> Weather Status</h2>
                <div class="content">
                    <div><h3><?php echo date("l g:i a", $currentTime); ?></h3></div>
                    <div><h3><?php echo date("jS F, Y",$currentTime); ?></h3></div>
                    <div><h3><?php echo ucwords($data->weather[0]->description); ?></h3></div>
                </div>
                <div class="weather-forecast">
                    <img
                        src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                        class="weather-icon" /><h3> <?php echo $data->main->temp_max; ?>°C</h3><span
                        class="min-temperature"><h3><?php echo $data->main->temp_min; ?>°C</span>
                </div>
                <div class="time">
                    <div><h3>Humidity: <?php echo $data->main->humidity; ?> %</h3></div>
                    <div><h3>Wind: <?php echo $data->wind->speed; ?> km/h</h3></div>
                </div>
            </div>
            </form>
        </div>
    </body>
</html>
