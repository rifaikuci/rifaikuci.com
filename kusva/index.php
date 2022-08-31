<?php
if (file_exists("utils/index.php")) {
    require_once "utils/index.php";
} else if (file_exists("../utils/index.php")) {
    require_once "../utils/index.php";
} else if (file_exists("../../utils/index.php")) {
    require_once "../../utils/index.php";
} else if (file_exists("../../../utils/index.php")) {
    require_once "../../../utils/index.php";
} else if(file_exists("../../../../utils/index.php")){
    require_once "../../../../utils/index.php";
}

require_once "info/index.php";
require_once "smedia/index.php";
require_once "education/index.php";
require_once "books/index.php";
require_once "languages/index.php";
require_once "certificate/index.php";

?>