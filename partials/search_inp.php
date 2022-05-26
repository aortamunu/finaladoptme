<?php
$input_value = isset($_GET['search']) ? $_GET['search'] : "";
?>
<label for='search'>Name</label>
<input type='text' name='search' class='search-input input' placeholder='Search here' value="<?= $input_value ?>">