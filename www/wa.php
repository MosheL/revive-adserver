<?php header("Location: whatsapp://send?text=" .urlencode($_GET["text"])); echo ($_GET["text"]);  ?>