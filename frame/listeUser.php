<?php include('../includes/connection.inc.php') ?>
<?php
    //fetching all prof or student
    $stmtOnUser = $conn->prepare("select * from utilisateurs where role=?");

    //fetch profs
    $role = strtolower($_GET["role"]);
    $stmtOnUser->bind_param("s",$role);
    $stmtOnUser->execute();
    $result = $stmtOnUser->get_result();
    $liste = $result->fetch_all(MYSQLI_ASSOC);
    $option = ($role == "professeur")? "Voir_cours" : "Cours_Suivis";
?>
<span style="display: none;"> <!-- mettre ici le resultat --></span>
<table width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom&Prenom</th>
            <th>Mail</th>
            <th><?= $option ?></th>
            <th>Supprimer</th>
        </tr>
    </thead>

    <tbody>
        <?php
            if(count($liste)==0)
                echo "<center><tr style=\"font-size: 1.2rem; color: var(--black);\"> Aucune donnée disponible </tr></center>";
        ?>
        <?php      
            foreach ($liste as $user) 
            {    
        ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $nomComplet =  $user['nom'].' '.$user['prenom']?></td>
                    <td><?= $user['mail'] ?></td>
                    <td onclick="showBox<?= $option ?>(event, <?=$user['id']?>, '<?= $nomComplet?>', '<?= $user['image'] ?>')"><img src="./images/seeCourse.svg" alt="voir cours" width="30rem"></td>
                    <td onclick="confirmDel(<?=$user['id']?>, '<?=$user['role']?>', '<?= $nomComplet?>')"><img src="./images/delete.svg" alt="supprimer" width="35rem"></td>
                </tr>

        <?php } ?> 
    </tbody>
</table>
