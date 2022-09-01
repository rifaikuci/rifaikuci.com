<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (file_exists("utils/db/index.php")) {
    require_once "methods/index.php";
    require_once "forms/index.php";
    require_once "utils/db/index.php";
    require_once "utils/data/index.php";
} else if (file_exists("../utils/db/index.php")) {
    require_once "../utils/methods/index.php";
    require_once "../utils/forms/index.php";
    require_once "../utils/db/index.php";
    require_once "../utils/data/index.php";
} else if (file_exists("../../utils/db/index.php")) {
    require_once "../../utils/methods/index.php";
    require_once "../../utils/forms/index.php";
    require_once "../../utils/db/index.php";
    require_once "../../utils/data/index.php";

} else if (file_exists("../../../utils/db/index.php")) {
    require_once "../../../utils/methods/index.php";
    require_once "../../../utils/forms/index.php";
    require_once "../../../utils/db/index.php";
    require_once "../../../utils/data/index.php";

}



?>
