<?php
$input_value = isset($_GET['search']) ? $_GET['search'] : "";
?>
<label for='search'>Search Pets:</label>
<input type='text' name='search' class='search-input input' placeholder='Search Helps' value="<?= $input_value ?>">