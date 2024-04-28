<h2>HR Forms</h2>

<form action="" method="get" id="left-form">
    <fieldset>
        <legend>
            <h3>Search Candidates</h3>
        </legend>
        <!-- hidden input required to stay on current page with GET method -->
        <input name="p" value="forms" type="hidden">
        <label for="name">Name:</label>
        <input name="name" type="text"><br>
        <label for="dob">Date of Birth:</label>
        <input name="dob" type="date"><br>
        <label for="skills[]">Skills:</label>
        <select name="skills[]" size="6" multiple>
            <option value="Marine Biology">Marine Biology</option>
            <option value="Mechanical Sciences">Mechanical Sciences</option>
            <option value="Medical Sciences">Medical Sciences</option>
            <option value="Horticulture">Horticulture</option>
            <option value="Fishing">Fishing</option>
            <option value="Building">Building</option>
        </select><br>
        <p><em>Hold down Ctrl key in Windows (or Command in MacOS)<br>to select multiple skills.</em></p><br>
        <input name="submitGet" type="submit" value="Search"><br>
    </fieldset>
</form>

<form action="" method="post" id="right-form">
    <fieldset>
        <legend>
            <h3>Candidate Application</h3>
        </legend>
        <label for="name">Name:</label>
        <input name="name" type="text" required><em>required</em><br>
        <label for="dob">Date of Birth:</label>
        <input name="dob" type="date" required><em>required</em><br>
        <label for="skills[]">Skills:</label>
        <select name="skills[]" size="6" multiple>
            <option value="Marine Biology">Marine Biology</option>
            <option value="Mechanical Sciences">Mechanical Sciences</option>
            <option value="Medical Sciences">Medical Sciences</option>
            <option value="Horticulture">Horticulture</option>
            <option value="Fishing">Fishing</option>
            <option value="Building">Building</option>
        </select><br>
        <p><em>Hold down Ctrl key in Windows (or Command in MacOS)<br>to select multiple skills.</em></p><br>
        <input name="submitPost" type="submit" value="Submit"><br>
    </fieldset>
</form>

<?php
// GET FORM PROCESSING
if (isset($_GET['submitGet'])) {
    $name = htmlspecialchars($_GET['name']);
    $dob = date('m-d-Y', strtotime($_GET["dob"]));
    $skills = $_GET['skills'] ?? null;
    echo "<div id='left-output'>";
    if (!$name && !$skills) {
        echo "No search criteria entered,<br>Please try again...</div>";
    } else {
        $getOutput = "Candidate records requested for: <br>";

        if ($name) {
            $getOutput = $getOutput . "Name: $name <br>";
        }

        // blank date entry will convert to 01-01-1970
        if ($dob != '01-01-1970') {
            $getOutput = $getOutput . "Date of Birth: $dob <br>";
        }

        if ($skills) {
            $getOutput = $getOutput . "Skills: <ul>";
            foreach ($skills as $skill) {
                $getOutput = $getOutput . "<li>$skill</li>";
            }
            $getOutput = $getOutput . "</ul>";
        }
        echo $getOutput . "</div>";
    }
}

// POST FORM PROCESSING
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<div id='right-output'>";
    $postOutput = "Application submitted for: <br>";

    $name = htmlspecialchars($_POST['name']);
    $postOutput = $postOutput . "Name: $name <br>";
       
    $dob = date('m-d-Y', strtotime($_POST["dob"]));
    $postOutput = $postOutput . "Date of Birth: $dob <br>";
    
    $skills = $_POST['skills'] ?? null;
    if ($skills) {
        $postOutput = $postOutput . "Skills: <ul>";
        foreach ($skills as $skill) {
            $postOutput = $postOutput . "<li>$skill</li>";
        }
        $postOutput = $postOutput . "</ul>";
    } else {
        $postOutput = $postOutput . 
            "PLEASE SUBMIT A RESUME LISTING SKILLS AND EXPERIENCE";
    }
    echo $postOutput . "</div>";
}
?>