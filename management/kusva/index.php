<?
 session_start();

if (file_exists("utils/index.php")) {
    require_once "utils/index.php";
} else if (file_exists("../utils/index.php")) {
    require_once "../utils/index.php";
} else if (file_exists("../../utils/index.php")) {
    require_once "../../utils/index.php";
} else if (file_exists("../../../utils/index.php")) {
    require_once "../../../utils/index.php";
} else if (file_exists("../../../../utils/index.php")) {
    require_once "../../../../utils/index.php";
}

require_once "login/index.php";

if (isset($_SESSION['management'])) {


    require_once "info/index.php";
    require_once "smedia/index.php";
    require_once "education/index.php";
    require_once "books/index.php";
    require_once "languages/index.php";
    require_once "certificate/index.php";
    require_once "skills/index.php";
    require_once "experience/index.php";
    require_once "projects/index.php";
    require_once "about/index.php";
    require_once "favIcon/index.php";
    require_once "stockItem/index.php";
    require_once "myStockList/index.php";
    require_once "stockListHistory/index.php";
} else{
    session_destroy();
    header("Location:" . "http://localhost/rifaikuci.com/management/src/login/?session=no");
}

?>