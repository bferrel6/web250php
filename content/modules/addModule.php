<?php include 'content/components/nav.php'; ?>
<h2>Add a New Module</h2>
<form action="?p=modules/insertRecord" method="post">
    <fieldset>
        <label for="type">Type:</label>
        <input name="type" type="text" required><br>
        <label for="occupancy">Occupancy:</label>
        <input name="occupancy" type="text"><br>
        <label for="deploy_date">Deploy Date:</label>
        <input name="deploy_date" type="date"><br>
        <label for="cost">Cost:</label>
        <input name="cost" type="text" pattern="^\d*(\.\d{0,2})?$"><br>
        <label for="description">Description:</label>
        <textarea name="description"></textarea><br>
        <input name="submit1" type="submit" value="Add Module"><br>
    </fieldset>
</form>