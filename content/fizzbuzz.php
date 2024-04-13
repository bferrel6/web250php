<h2>Fizz Buzz</h2>

<form action="" method="post" id="fizzbuzz-form">
    <fieldset>
        <legend>
            <h3>SONAR - Sonic Navigating And Ranging</h3>
        </legend>
        <label for="first-name">First Name</label>
        <input name="first-name" type="text" value="Steve" required>
        <label for="last-name">Last Name</label>
        <input name="last-name" type="text" value="Zissou" required><br>

        <label for="start-range">Starting Frequency</label>
        <input name="start-range" type="number" value="1" min="0" required>
        <label for="end-range">Ending Frequency</label>
        <input name="end-range" type="number" value="250" min="10" required><br>

        <label for="echo1">First Echo</label>
        <input name="echo1" type="number" value="3" required>
        <label for="callback1">First Callback</label>
        <input name="callback1" type="text" value="SALMON" required><br>

        <label for="echo2">Second Echo</label>
        <input name="echo2" type="number" value="5" required>
        <label for="callback2">Second Callback</label>
        <input name="callback2" type="text" value="TUNA" required><br>

        <label for="echo3">Third Echo</label>
        <input name="echo3" type="number" value="7" required>
        <label for="callback3">Third Callback</label>
        <input name="callback3" type="text" value="URCHIN" required><br>

        <input name="submit" type="submit" value="Submit">
    </fieldset>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<div id='fizzbuzz-output'>";

    $name = htmlspecialchars($_POST['first-name'] . " " . $_POST['last-name']);
    echo "Scan requested by $name, standby for echo response... <br>";

    $startRange = $_POST['start-range']; 
    $endRange = $_POST['end-range'];

    if ($startRange >= $endRange) {
        echo "Invalid frequency range, scan failed...";
    } else {
        $echoes = [$_POST['echo1'], $_POST['echo2'], $_POST['echo3']];
        $callbacks = [htmlspecialchars($_POST['callback1']), htmlspecialchars($_POST['callback2']), htmlspecialchars($_POST['callback3'])];
        foreach (range($startRange, $endRange) as $i) {
            $isEcho1 = ($i % $echoes[0] === 0 ? $callbacks[0] : '');
            $isEcho2 = ($i % $echoes[1] === 0 ? $callbacks[1] : '');
            $isEcho3 = ($i % $echoes[2] === 0 ? $callbacks[2] : '');

            if (!$isEcho1 && !$isEcho2 && !$isEcho3) {
                $result[] = $i;
            } else {
                $result[] = "$isEcho1 $isEcho2 $isEcho3";
            }
        }
        echo implode(" &#9781; ", $result);
    }
    echo "</div>";
}
?>