<?php include('./includes/connection.inc.php'); ?>
<?php include('./includes/header.inc.php'); ?>

<!-- RECUPERATION DES DONNEES DE LA BASE DE DONNEES -->

<?php
    //fetching total number of profs and students
    $queryOnUser = $conn->prepare("SELECT COUNT(*) as nb from utilisateurs group by role");
    
    $queryOnUser->execute();
    $result = $queryOnUser->get_result();
    $nbUser=$result->fetch_all(MYSQLI_ASSOC);

    //fetching total number of course
    $queryOnModule = $conn->query("SELECT COUNT(*) as nbcours from module");
    $nbCourse = $queryOnModule->fetch_assoc();
?>

<!-- HTML CONTENT -->
<section >
    <?php include('./includes/side_profile.inc.php'); ?>

    <div class="ongletBtn">
        <button class="items-btn active-item" onclick="openTab(event, 'tab1')"> Générales</button>
        <button class="items-btn" onclick="openTab(event, 'tab2')">Professeur</button>
        <button class="items-btn" onclick="openTab(event, 'tab3')">Etudiant</button>
    </div>

    <!-- General information content -->
    <div id="tab1" class="ongletContent" style="display: block;">
        <div class="statistics-content">
            <div id="nbProf" class="adminStat statics-box" style="justify-content: center;">
                <center><img src="./images/teacher.svg" alt="teacher" width="60rem"></center>
                <?php echo (isset($nbUser[0]['nb']))? $nbUser[0]['nb'] : '0'?> <br> 
                Professeurs
            </div>

            <div id="nbEtudiant" class="statics-box adminStat" style="justify-content: center;">
                <center><img src="./images/student.svg" alt="student" width="60rem"></center>
                <?php echo (isset($nbUser[1]['nb']))? $nbUser[1]['nb'] : '0'?> <br> 
                Etudiants
            </div>

            <div id="nbCours" class="statics-box adminStat" style="justify-content: center;">
                <center><img src="./images/course.svg" alt="course" width="60rem"></center>
                <?= $nbCourse['nbcours'] ?> <br> Cours
            </div>

            <div id="nbMessage" class="statics-box adminStat" style="justify-content: center;">
                <center><img src="./images/messages.svg" alt="message" width="60rem"></center>
                56 <br> Message
            </div>
        </div>
     
    </div>

    <!-- Prof information -->
    <div id="tab2" class="ongletContent">
        <div class="tab2Content">
            <div class="listeProf liste">
                <!-- tableau des Profs ici -->
            </div>
            <hr>
            <div class="coursProf" style="display: none;">
                <!-- Liste des cours selon le prof choisi est affichée ici -->
            </div>
        </div>
    </div>

    <!-- Student information -->
    <div id="tab3" class="ongletContent">
        <div class="tab2Content">
            <div class="listeEtudiant liste">
                <!-- tableau des étudiants ici -->
                
            </div>
            <hr>
            <div class="cours_suivis" style="display: none;">
                <!-- Liste des cours selon le prof choisi est affichée ici -->

            </div>
        </div>
    </div>
</section>

<div class="popUp" style="display: none;">
    <div class="content ">
        <input type="number" name="userId" id="userId" value="" hidden>
        <span> <!-- Confirmation text --></span> <br>
        <div>
            <button class="delete-btn" onclick="delUser(parseInt(document.querySelector('.content input').value))">Effacer</button>
            <button class="main-btn" onclick="hidePopUp();">Annuler</button>
        </div>
    </div>
</div>

<?php include('./includes/footer.inc.php'); ?>

<script>
/* --------------------- ADMIN TOGGLE TAB ------------------------ */
function openTab(event, tabName)
{
   let tabs = document.querySelectorAll(".ongletContent");
   let tabs_btn = document.querySelectorAll(".items-btn");
   let targetElt = (event.currentTarget.innerText === "Professeur")? document.querySelector('.listeProf') : document.querySelector('.listeEtudiant');

   //Initialisation de tous les class
   tabs.forEach((tab) => {
      tab.style.display = "none";
   });

   tabs_btn.forEach((btn)=> {
      btn.classList.remove("active-item");
   });

   //affichage de l'onglet voulu

   if(event.currentTarget.innerText != "Générales")
   {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            targetElt.innerHTML = this.response;   
            console.log(this.response);       
        }
        xhttp.open("GET", "frame/listeUser.php?role="+event.currentTarget.innerText);
        xhttp.send(); 
   }

   document.getElementById(tabName).style.display = "block";
   
   event.currentTarget.classList.add("active-item");
}

/*---------------------- SHOW A PROF'S COURSES --------------------- */
function showBoxVoir_cours(event, ...prof){
    let courseBox = document.querySelector('.coursProf');

    courseBox.style.display="none";

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        courseBox.innerHTML = this.response;
        courseBox.style.display="block";
    }
    xhttp.open("GET", "frame/profCourse.php?profId="+prof[0]+"&profName="+prof[1]+"&profImage="+prof[2]);
    xhttp.send();   

}

/*---------------------- SHOW A STUDENT'S FOLLOWED COURSES --------------------- */
function showBoxCours_Suivis(event, ...std){
    let courseBox = document.querySelector('.cours_suivis');

    courseBox.style.display="none";

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        courseBox.innerHTML = this.response;
        courseBox.style.display="block";
    }
    xhttp.open("GET", "frame/studentCourse.php?stdId="+std[0]+"&stdName="+std[1]+"&stdImage="+std[2]);
    xhttp.send();   

}

function confirmDel(...userInfo){
    $inputId = document.querySelector('.content input');
    $spanConfirm = document.querySelector('.content span');

    
    $inputId.value = userInfo[0];

    $spanConfirm.innerHTML = "Voulez-vous vraiment supprimer cet utilisateur?( "+userInfo[1]+" : "+userInfo[2]+")";

    document.querySelector(".popUp").style.display = "block";
}

function hidePopUp(){document.querySelector(".popUp").style.display = "none";}

/*---------------------- DELETE PROF --------------------- */
function delUser(userId){
    let resultMsg = document.querySelector('.liste > span');
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        resultMsg.innerHTML = this.response;
        resultMsg.style = "block";

        setTimeout(()=>{
            resultMsg.innerHTML = "";
            resultMsg.style = "none";
        },5000);
    }
    xhttp.open("GET", "frame/deleteUser.php?id="+userId);
    xhttp.send(); 

    hidePopUp();
}

</script>