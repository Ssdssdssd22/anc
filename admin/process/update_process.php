<?php

include("../includes/connection.php");
$query = $_POST["query"];
$result = Database::iud($query);
