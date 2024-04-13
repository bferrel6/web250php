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
        <input name="start-range" type="i" value="1" min="0" required>
        <label for="end-range">Ending Frequency</label>
        <input name="end-range" type="i" value="250" min="10" required><br>

        <label for="number1">First Echo</label>
        <input name="number1" type="i" value="3" required>
        <label for="word1">Callback 1</label>
        <input name="word1" type="text" value="SALMON" required><br>

        <label for="number2">Second Echo</label>
        <input name="number2" type="i" value="5" required>
        <label for="word2">Callback 2</label>
        <input name="word2" type="text" value="TUNA" required><br>

        <label for="number3">Third Echo</label>
        <input name="number3" type="i" value="7" required>
        <label for="word3">Callback 3</label>
        <input name="word3" type="text" value="URCHIN" required><br>

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
        $numbers = [$_POST['number1'], $_POST['number2'], $_POST['number3']];
        $words = [htmlspecialchars($_POST['word1']), htmlspecialchars($_POST['word2']), htmlspecialchars($_POST['word3'])];
        foreach (range($startRange, $endRange) as $i) {
            $isEcho1 = ($i % $numbers[0] === 0 ? $words[0] : '');
            $isEcho2 = ($i % $numbers[1] === 0 ? $words[1] : '');
            $isEcho3 = ($i % $numbers[2] === 0 ? $words[2] : '');

            $addWords = [];
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