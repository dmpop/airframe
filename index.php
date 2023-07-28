<!DOCTYPE html>
<html lang="en">
<!-- Author: Dmitri Popov, dmpop@cameracode.coffee
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
      <title>Airframe</title>
      <meta charset="utf-8">
      <link rel="shortcut icon" href="favicon.png" />
      <link rel="shortcut icon" href="favicon.png" />
      <link rel="stylesheet" href="css/lit.css">
      <link rel="stylesheet" href="css/styles.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Suppress form re-submit prompt on refresh -->
      <script>
            if (window.history.replaceState) {
                  window.history.replaceState(null, null, window.location.href);
            }
      </script>
</head>

<body>
      <div class="c">
            <div style="text-align: center;">
                  <div style="margin-top: 1em; margin-bottom: 1em;">
                        <img style="display: inline; height: 3em; vertical-align: middle; margin-right: 0.5em;" src="favicon.svg" alt="logo" />
                        <h1 style="display: inline; margin-top: 0em; vertical-align: middle;">Airframe</h1>
                  </div>
                  <div class="card w-100">

                        <form method='POST' action='result.php'>
                              <label for='weight'>Aircraft registration number:</label>
                              <input class="card w-50" type='text' name='code'>
                              <input class="btn primary" style='display: inline; margin-left: 0.5em; margin-right: 0.5em;' type='submit' name='search' value='Search'>
                        </form>
                  </div>
                  <?php

                  $aircraftDatabase = "aircraftDatabase.csv";
                  $url = "https://opensky-network.org/datasets/metadata/aircraftDatabase.csv";

                  $local_db_date = date("Y-m-d", filemtime($aircraftDatabase));
                  $h = get_headers($url, 1);
                  if ($h && (strpos($h[0], '200') !== FALSE)) {
                        $time = strtotime($h['Last-Modified']);
                        $remote_db_date = date("Y-m-d", $time);
                  }
                  if ($local_db_date < $remote_db_date or !file_exists($aircraftDatabase)) {
                        unlink($aircraftDatabase);
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $data = curl_exec($ch);
                        curl_close($ch);
                        file_put_contents($aircraftDatabase, $data);
                        echo "Database has been updated";
                  } else {
                        echo "<div style='font-size: 85%;'><span style='margin-right: .3em;'>Last database update: </span>" . $local_db_date . "</div>";
                        echo "<div style='font-size: 85%;'><a href='https://github.com/dmpop/airframe'>Source code</a></div>";
                  }
                  ?>
            </div>
      </div>
</body>

</html>