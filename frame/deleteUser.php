<?php include('../includes/connection.inc.php'); ?>
<?php
    $stmtToDelUser = $conn->prepare("delete from utilisateurs where id=".$_GET['id']);
    
    echo ($stmtToDelUser->execute())? "<br>Suppresion avec succès.<br>" : "<br>La suppresion a échouée.<br>";
?>