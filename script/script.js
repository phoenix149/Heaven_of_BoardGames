//Récupérons les Ids des éléments HTML du formulaire addGames

let formAdd = document.getElementById("mSForms");
let EAN = document.getElementById("ean");
let gameName = document.getElementById("gameName");
let noteGame = document.getElementById("noteGame");
let selectorGameTheme = document.getElementById("selectorGameTheme");
let addGameThemeChamp = document.getElementById("addGameThemeChamp");
let addGameThemeLabel = document.getElementById("addGameThemeLabel");
let descriptionGame = document.getElementById("descGame");
let gamePrice = document.getElementById("gamePrice");
let gameTime = document.getElementById("gameTime");
let middleAge = document.getElementById("middleAge");
let nbPlayer = document.getElementById("nbPlayer");
let AddAuthorOption = document.getElementById("author");
let AddAuthorschamp = document.getElementById("addAuthor");
let addAuthorLabel = document.getElementById("addAuthorLabel");
let selectorEditor = document.getElementById("selectorEditor");
let addEditorChamp = document.getElementById("addEditorChamp");
let addEditorLabel = document.getElementById("addEditorLabel");
let createDate = document.getElementById("createDate");
let country = document.getElementById("country");
let addCountryChamp = document.getElementById("addCountryChamp");
let addCountryLabel = document.getElementById("addCountryLabel");
let languagesGame = document.getElementById("languagesGame");
let category = document.getElementById("category");
let addCategoryChamp = document.getElementById("addCategoryChamp");
let addCategoryLabel = document.getElementById("addCategoryLabel");
let mechanism = document.getElementById("mechanism");
let addMechanismLabel = document.getElementById("addMechanismLabel");
let addMechanismChamp = document.getElementById("addMechanismChamp");
let stockGame = document.getElementById("stockGame");
let file = document.getElementById("file");
const modal = new bootstrap.Modal(document.getElementById("exampleModal"));

//Récupérons les paragraphe où on voudra afficher nos textes d'erreur

let paraEAN = document.getElementById("paraEAN");
let paraGameName = document.getElementById("paraGameName");
let paraNoteGame = document.getElementById("paraNoteGame");
let paraGametheme = document.getElementById("paraGametheme");
let paraDesc = document.getElementById("paraDesc");
let paraGamePrice = document.getElementById("paraGamePrice");
let paraGameTime = document.getElementById("paraGameTime");
let paraAge = document.getElementById("paraAge");
let paraPlayer = document.getElementById("paraPlayer");
let paraAuthor = document.getElementById("paraAuthor");
let paraEditor = document.getElementById("paraEditor");
let paraDate = document.getElementById("paraDate");
let paraCountry = document.getElementById("paraCountry");
let paraLanguage = document.getElementById("paraLanguage");
let paraCategory = document.getElementById("paraCategory");
let paraMechanism = document.getElementById("paraMechanism");
let paraStock = document.getElementById("paraStock");
let paraFile = document.getElementById("paraFile");

// Cache les champs d'ajout à l'affichage de la page
console.log("Lancement du script");
AddAuthorschamp.style.display = "none";
addAuthorLabel.style.display = "none";
addEditorLabel.style.display = "none";
addEditorChamp.style.display = "none";
addGameThemeLabel.style.display = "none";
addGameThemeChamp.style.display = "none";
addCategoryLabel.style.display = "none";
addCategoryChamp.style.display = "none";
addMechanismLabel.style.display = "none";
addMechanismChamp.style.display = "none";
addCountryLabel.style.display = "none";
addCountryChamp.style.display = "none";

//Ajoutons un événement pour empecher l'envoi du formulaire
formAdd.addEventListener("submit", (event) => {
  event.preventDefault();

  //Déclarons une variable qui permettra d'afficher la modal
  let isValid = true;

  //Posons une condition pour vérifier si l'EAN est renseigné
  if (EAN.value == "") {
    paraEAN.innerText = "Veuillez renseigner l'EAN du Jeu!";
    isValid = false;
  } else {
    paraEAN.innerText = "";
  }

  //Posons une condition pour vérifier si le nom du jeu est renseigné
  if (gameName.value == "") {
    paraGameName.innerText = "Veuillez renseigner  le nom du jeu!";
    isValid = false;
  } else {
    paraGameName.innerText = "";
  }

  //Posons une condition pour vérifier si le thème est renseigné
  if (selectorGameTheme.value == "" && addGameThemeChamp.value == "") {
    paraGametheme.innerText = "Veuillez renseigner un thème!";
    isValid = false;
  } else {
    paraGametheme.innerText = "";
  }

  //Posons une condition pour vérifier si la description est renseignée
  if (descriptionGame.value == "") {
    paraDesc.innerText = "Veuillez remplir une Description!";
    isValid = false;
  } else {
    paraDesc.innerText = "";
  }

  //Posons une condition pour vérifier si le prix est renseigné
  if (gamePrice.value == "") {
    paraGamePrice.innerText = "Veuillez renseigner un Prix!";
    isValid = false;
  } else {
    paraGamePrice.innerText = "";
  }

  //Posons une condition pour vérifier si le temps de jeu est renseigné
  if (gameTime.value == "") {
    paraGameTime.innerText = "Veuilez renseigner le temps de jeu!";
    isValid = false;
  } else {
    paraGameTime.innerText = "";
  }

  //Posons une condition pour vérifier si l'age est renseigné
  if (middleAge.value == "") {
    paraAge.innerText = "Veuillez renseigner l'Age!";
    isValid = false;
  } else {
    paraAge.innerText = "";
  }

  //Posons une condition pour vérifier si nombre de joueur est renseigné
  if (nbPlayer.value === "") {
    paraPlayer.innerText = "Veuillez renseigner le nombre de joueur!";
    isValid = false;
  } else {
    paraPlayer.innerText = "";
  }

  //Posons une condition pour vérifier l'auteur est renseigné
  if (AddAuthorOption.value == "" && AddAuthorschamp.value == "") {
    paraAuthor.innerText = "Veuillez renseigner l'Auteur!";
    isValid = false;
  } else {
    paraAuthor.innerText = "";
  }

  //Posons une condition pour vérifier si l'Éditeur est renseigné
  if (selectorEditor.value == "" && addEditorChamp.value == "") {
    paraEditor.innerText = "Veuillez rennseigner l'Éditeur!";
    isValid = false;
  } else {
    paraEditor.innerText = "";
  }

  //Posons une condition pour vérifier si date est renseignée
  if (createDate.value == "") {
    paraDate.innerText = "Veuillez renseigner l'année!";
    isValid = false;
  } else {
    paraDate.innerText = "";
  }

  //Posons une condition pour vérifier si le Pays est renseigné
  if (country.value == "" && addCountryChamp.value == "") {
    paraCountry.innerText = "Veuillez renseigner le Pays!";
    isValid = false;
  } else {
    paraCountry.innerText = "";
  }

  //Posons une condition pour vérifier si la langue est renseignée
  if (languagesGame.value == "") {
    paraLanguage.innerText = "Veuillez renseigner la Langue!";
    isValid = false;
  } else {
    paraLanguage.innerText = "";
  }

  //Posons une condition pour vérifier si la catégorie est rensignée
  if (category.value == "" && addCategoryChamp.value == "") {
    paraCategory.innerText = "Veuillez renseinger la Catégorie!";
    isValid = false;
  } else {
    paraCategory.innerText = "";
  }

  //Posons une condition pour vérifier si Mécanisme est renseigné
  if (mechanism.value == "" && addMechanismChamp.value == "") {
    paraMechanism.innerText = "Veuillez renseigner un Mécanisme!";
    isValid = false;
  } else {
    paraMechanism.innerText = "";
  }

  //Posons une condition pour vérifier si le stock est renseigné
  if (stockGame.value == "") {
    paraStock.innerText = "Veuillez renseigner le stock!";
    isValid = false;
  } else {
    paraStock.innerText = "";
  }
  //Posons une condition pour vérifier si une image est chargée
  if (file.value == "") {
    paraFile.innerText = "Veuillez charger une image!";
    isValid = false;
  } else {
    paraFile.innerText = "";
  }

  //Si toutes les conditions sont vérifiées on affiche la modal
  if (isValid) {
    modal.show();
  }
});

//On submit le formulaire dès que la modal est fermée
document.getElementById("btnFermer").addEventListener("click", function () {
  formAdd.submit();
});

// écouteur d'évenement change sur le select Auteur qui déclenche la fonction afficheChamp
AddAuthorOption.addEventListener("change", function () {
  afficheChamp(AddAuthorschamp, addAuthorLabel, AddAuthorOption.value);
  console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur auteur");
});
// écouteur d'évenement change sur le select Éditeur qui déclenche la fonction afficheChamp
selectorEditor.addEventListener("change", function () {
  afficheChamp(addEditorChamp, addEditorLabel, selectorEditor.value);
  console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur éditeur");
});
// écouteur d'évenement change sur le select Pays d'origine qui déclenche la fonction afficheChamp
selectorEditor.addEventListener("change", function () {
  afficheChamp(addEditorChamp, addEditorLabel, selectorEditor.value);
  console.log(
    "j'ai effectué l'ecouteur d'évenement sur le sélecteur pays d'origine"
  );
});
// écouteur d'évenement change sur le select thème de jeu qui déclenche la fonction afficheChamp
selectorGameTheme.addEventListener("change", function () {
  afficheChamp(addGameThemeChamp, addGameThemeLabel, selectorGameTheme.value);
  console.log(
    "j'ai effectué l'ecouteur d'évenement sur le sélecteur thème de jeu"
  );
});
// écouteur d'évenement change sur le select catégorie  qui déclenche la fonction afficheChamp
category.addEventListener("change", function () {
  afficheChamp(addCategoryChamp, addCategoryLabel, category.value);
  console.log(
    "j'ai effectué l'ecouteur d'évenement sur le sélecteur Catégorie"
  );
});
// écouteur d'évenement change sur le select Mécanisme de jeu qui déclenche la fonction afficheChamp
mechanism.addEventListener("change", function () {
  afficheChamp(addMechanismChamp, addMechanismLabel, mechanism.value);
  console.log(
    "j'ai effectué l'ecouteur d'évenement sur le sélecteur Catégorie"
  );
});
// écouteur d'évenement change sur le select country qui déclenche la fonction afficheChamp
country.addEventListener("change", function () {
  afficheChamp(addCountryChamp, addCountryLabel, country.value);
  console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur Country");
});
/**
 *
 * @param {insérer ici la variable du champ à faire apparaitre} champ1
 * @param {insérer ici la variable du label à faire apparaitre} labelchamp1
 * @param {insérer ici la variable.value du select concerné} select_param
 */
function afficheChamp(champ1, labelchamp1, select_param) {
  console.log("fonction afficheChamp on");
  if (select_param === "Add") {
    console.log("Je rempli la condition pour afficher les champs");
    champ1.style.display = "block";
    labelchamp1.style.display = "block";
  }
}

// // Fonction pour gérer l'ajout au panier

// let panier = [];
// let total = 0;

// function addToCart(nom, prix) {
//   // quantite = parseInt(quantite);
//   panier.push({ nom: nom, prix: prix });
//   total += prix;
//   showCart();
// }

// //Fonction pour afficher le panier
// function showCart(){
//   const cartList = document.getElementById("cartList");
//   cartList.innerHTML = "";
//   panier.forEach((item) => {
//     const li = document.createElement("li");
//     li.textContent = `${item.nom}. Prix : ${item.prix}€.`;
//     cartList.appendChild(li);
//   });
//   document.getElementById("total").textContent = total;
// }