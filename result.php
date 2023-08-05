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
            <div class="card w-100" style="text-align: left;">

                <?php
                if (isset($_POST["search"])) {
                    echo '<h3>' . $_POST["code"] . '</h1>';
                    $ch = fopen("aircraftDatabase.csv", "r");
                    $header_row = fgetcsv($ch);
                    while ($row = fgetcsv($ch)) {
                        if (in_array($_POST["code"], $row)) {
                            foreach ($row as $key => $value)
                                if (empty($value) or $value == 'false') {
                                    unset($row[$key]);
                                }
                            echo '<div>ICAO24: <strong>' . $row[0] . '</strong></div>';
                            echo '<div>Registration: <strong>' . $row[1] . '</strong></div>';
                            echo '<div>Manufacturer (ICAO): <strong>' . $row[2] . '</strong></div>';
                            echo '<div>Manufacturer name: <strong>' . $row[3] . '</strong></div>';
                            echo '<div>Model: <strong>' . $row[4] . '</strong></div>';
                            //echo '<div>Engines: <strong>' . $row[21] . '</strong></div>';
                            echo '<div>Typecode: <strong>' . $row[5] . '</strong></div>';
                            echo '<div>Serial number: <strong>' . $row[6] . '</strong></div>';
                            echo '<div>Owner: <strong>' . $row[13] . '</strong></div>';
                            echo '<div style="margin-bottom: 1.5em;">More info: <a href="https://www.flightradar24.com/data/aircraft/' . $row[1] . '" target="_blank">Flightradar24</a></div>';
                        }
                    }
                }
                ?>
            </div>
            <button class="btn secondary" style="display: inline;" title="Back" onclick='window.location.href = "index.php"'>Back</button>
        </div>
    </div>
</body>

</html>