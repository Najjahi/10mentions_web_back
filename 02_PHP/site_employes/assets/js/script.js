
// ------------------------- Partie video --------------------//
//------------------ icone smile------------- //

let iconeSmile = document.querySelector('.bi-emoji-neutral');

iconeSmile.addEventListener('click', () => {

    if (iconeSmile.classList.contains('bi-emoji-neutral')) {

        iconeSmile.classList.remove('bi-emoji-neutral');
        iconeSmile.classList.add("bi-emoji-heart-eyes-fill");

    } else {
        iconeSmile.classList.remove('bi-emoji-heart-eyes-fill');
        iconeSmile.classList.add("bi-emoji-neutral");
    }
})

//------------------  Bouton abonnez-vous------------- //

let btnAbonne = document.querySelector('.btn-abonner');

btnAbonne.addEventListener('click', () => {

    if (btnAbonne.innerText === 'Abonnez-vous') {

        btnAbonne.innerHTML = 'Abonné <i class="bi bi-check"></i>';

    } else {

        btnAbonne.innerText = 'Abonnez-vous';
    }
})

//------------------  carrousel ------------- //

let left = document.querySelector('.left');
let automatic = document.querySelector('.automatic');
let right = document.querySelector('.right');
let img = document.querySelector('.slider img');
let automaticIcon = document.querySelector('.automatic i');
console.log(img);

let i = 1;

right.addEventListener('click', carrousel);

function carrousel() {
    i++;
    if (i == 7) {
        i = 1;
        img.setAttribute('src', `assets/img/${i}.jpg`);
    }
    img.setAttribute('src', `assets/img/${i}.jpg`);// j'appelle automatique les images par leur nom   
}
left.addEventListener('click', () => {
    i--;
    if (i == 0) {
        i = 6;
        img.setAttribute('src', `assets/img/${i}.jpg`);
    }
    img.setAttribute('src', `assets/img/${i}.jpg`);
})
let statut = null; // Initialisation d'une variable pour stocker l'état du slider (lecture ou pause)
automatic.addEventListener('click', () => {

    automaticIcon.classList.toggle('bi-pause-fill');// Inversion sur l'élément automaticIcon à chaque clic

    if (statut == null) { // Vérification de l'état actuel du slider Si le slider est en pause       

        statut = window.setInterval(carrousel, 1500);

    } else {
        window.clearInterval(statut);
        statut = null; // Réinitialisation de la variable statut à null:slider est en pause
    }
})

//------------------  Affichage du mot de passe ------------- //
 
function myFunction() {
    let mdp = document.getElementById("mdp");
    let confirmMdp = document.getElementById("confirmMdp");
    let checkbox = document.getElementById("checkbox");
    
    if (checkbox.checked) {
      mdp.type = "text";
    } else {
      mdp.type = "mdp";
    }
    if (checkbox.checked) {
        confirmMdp.type = "text";
      } else {
        confirmMdp.type = "confirmMdp";
      }
  }
