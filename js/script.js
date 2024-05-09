let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}

toggleBtn.onclick = (e) =>{
   darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   search.classList.remove('active');
}

let search = document.querySelector('.header .flex .search-form');

document.querySelector('#search-btn').onclick = () =>{
   search.classList.toggle('active');
   profile.classList.remove('active');
}

let sideBar = document.querySelector('.side-bar');

document.querySelector('#menu-btn').onclick = () =>{
   sideBar.classList.toggle('active');
   body.classList.toggle('active');
}

document.querySelector('#close-btn').onclick = () =>{
   sideBar.classList.remove('active');
   body.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   search.classList.remove('active');

   if(window.innerWidth < 1200){
      sideBar.classList.remove('active');
      body.classList.remove('active');
   }
}
// Définition de la fonction pour basculer les listes déroulantes
document.addEventListener('DOMContentLoaded', function() {
   toggleDropdowns();
});

function toggleDropdowns() {
   const toggleButtons = document.querySelectorAll('.toggle-dropdown');

   toggleButtons.forEach(button => {
       button.addEventListener('click', function() {
           const dropdownList = this.parentElement.parentElement.nextElementSibling;
           const chapitres = JSON.parse(this.getAttribute('data-chapitres'));

           // Effacer le contenu actuel de la liste déroulante
           dropdownList.innerHTML = '';

           // Vérifier s'il y a des chapitres disponibles
           if (chapitres.length === 0) {
               const messageElement = document.createElement('div');
               messageElement.textContent = 'Aucun élément disponible pour ce cours.';
               dropdownList.appendChild(messageElement);
           } else {
               // Ajouter les chapitres à la liste déroulante
               chapitres.forEach(chapitre => {
                   const chapitreElement = document.createElement('div');
                   chapitreElement.textContent = chapitre.contenu;
                   dropdownList.appendChild(chapitreElement);
               });
           }

           dropdownList.classList.toggle('visible');
       });
   });
}
function confirmDesinscription(idCours) {
   if (confirm("Êtes-vous sûr de vouloir vous désinscrire de ce cours?")) {
      window.location.href = "process/process_desinscription.php?id_cours=" + idCours;
   } else {
      // L'utilisateur a annulé la désinscription, vous pouvez ajouter un traitement supplémentaire ici si nécessaire
   }
}
function toggleDropdowns() {
   const toggleButtons = document.querySelectorAll('.toggle-dropdown');

   toggleButtons.forEach(button => {
       button.addEventListener('click', function() {
           const dropdownList = this.parentElement.parentElement.nextElementSibling;
           const chapitres = JSON.parse(this.getAttribute('data-chapitres'));

           // Effacer le contenu actuel de la liste déroulante
           dropdownList.innerHTML = '';

           // Vérifier s'il y a des chapitres disponibles
           if (chapitres.length === 0) {
               const messageElement = document.createElement('div');
               messageElement.textContent = 'Aucun élément disponible pour ce cours.';
               dropdownList.appendChild(messageElement);
           } else {
               // Ajouter les chapitres à la liste déroulante
               chapitres.forEach(chapitre => {
                   const chapitreElement = document.createElement('div');
                   chapitreElement.textContent = chapitre.contenu;
                   dropdownList.appendChild(chapitreElement);
               });
           }

           dropdownList.classList.toggle('visible');
       });
   });
}

function toggleUnderline(button) {
   let productButtons = document.querySelectorAll('button.productimg');
   productButtons.forEach(btn => {
       if (btn !== button) {
           btn.classList.remove('underline');
       }
   });
   button.classList.toggle('underline');
}
function closeDetails() {
   // Supprimer ou unset le paramètre 'details' de l'URL
   var url = window.location.href.split('?')[0]; // Obtenir l'URL sans les paramètres
   window.location.href = url; // Rediriger vers l'URL sans le paramètre 'details'
}
function markAllAsRead() {
   // Make an AJAX request to update the message status
   var xhr = new XMLHttpRequest();
   xhr.open('POST', '/etudiants_messages.php', true);
   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   // Send additional data to indicate the action
   var formData = new FormData();
   formData.append('action', 'markAllAsRead');
   xhr.send(formData);
}
/*----------------------------- ADMIN FUNCTIONS ---------------------------- */



// messages

// Fonction pour valider le formulaire d'annonce avant soumission
function validateAnnouncementForm() {
   var contenu_annonce = document.getElementById('contenu_annonce').value;

   // Vérifier que le contenu de l'annonce n'est pas vide
   if (contenu_annonce.trim() === '') {
       var errorMessage = document.getElementById('error-message');
       errorMessage.textContent = "Veuillez entrer le contenu de l'annonce.";
       return false; // Empêcher la soumission du formulaire
   }

   return true; // Autoriser la soumission du formulaire
}

// Fonction pour envoyer un message
function sendMessage() {
   // Get the message content from the input field
   var messageContent = document.getElementById('messageContent').value;

   // Check if the message content is not empty
   if (messageContent.trim() !== '') {
       // Create a new message element
       var messageElement = document.createElement('div');
       messageElement.className = 'message';
       messageElement.textContent = messageContent;

       // Append the message to the messages container
       var messagesContainer = document.getElementById('messagesContainer');
       messagesContainer.appendChild(messageElement);

       // Clear the input field after sending the message
       document.getElementById('messageContent').value = '';
   } else {
       alert('Please enter a message.');
   }
}

// Event listener for the send button
document.getElementById('btnSend').addEventListener('click', sendMessage);

