
// ----------------Formulaire AddGame----------------------------

let AddAuthorOption = document.getElementById('author');
let AddAuthorschamp = document.getElementById('addAuthor');
let addAuthorLabel = document.getElementById('addAuthorLabel');
let selectorEditor = document.getElementById('selectorEditor');
let addEditorLabel = document.getElementById('addEditorLabel');
let addEditorChamp = document.getElementById('addEditorChamp');
let selectorGameTheme = document.getElementById('selectorGameTheme');
let addGameThemeLabel = document.getElementById('addGameThemeLabel');
let addGameThemeChamp = document.getElementById('addGameThemeChamp');
let category = document.getElementById('category');
let addCategoryLabel = document.getElementById('addCategoryLabel');
let addCategoryChamp = document.getElementById('addCategoryChamp');
let mechanism = document.getElementById('mechanism');
let addMechanismLabel = document.getElementById('addMechanismLabel');
let addMechanismChamp = document.getElementById('addMechanismChamp');
let country = document.getElementById('country');
let addCountryLabel = document.getElementById('addCountryLabel');
let addCountryChamp = document.getElementById('addCountryChamp');


// Cache les champs d'ajout à l'affichage de la page 
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

// écouteur d'évenement change sur le select Auteur qui déclenche la fonction afficheChamp
AddAuthorOption.addEventListener("change", function()  {
afficheChamp(AddAuthorschamp, addAuthorLabel, AddAuthorOption.value);
console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur auteur");
    
});
// écouteur d'évenement change sur le select Éditeur qui déclenche la fonction afficheChamp
selectorEditor.addEventListener("change", function()  {
afficheChamp(addEditorChamp, addEditorLabel, selectorEditor.value);
console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur éditeur");
    
});
// écouteur d'évenement change sur le select Pays d'origine qui déclenche la fonction afficheChamp
selectorEditor.addEventListener("change", function()  {
afficheChamp(addEditorChamp, addEditorLabel, selectorEditor.value);
console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur pays d'origine");
    
});
// écouteur d'évenement change sur le select thème de jeu qui déclenche la fonction afficheChamp
selectorGameTheme.addEventListener("change", function()  {
afficheChamp(addGameThemeChamp, addGameThemeLabel, selectorGameTheme.value);
console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur thème de jeu");
    
});
// écouteur d'évenement change sur le select catégorie  qui déclenche la fonction afficheChamp
category.addEventListener("change", function()  {
afficheChamp(addCategoryChamp, addCategoryLabel, category.value);
console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur Catégorie");
    
});
// écouteur d'évenement change sur le select Mécanisme de jeu qui déclenche la fonction afficheChamp
mechanism.addEventListener("change", function()  {
afficheChamp(addMechanismChamp, addMechanismLabel, mechanism.value);
console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur Catégorie");
    
});
// écouteur d'évenement change sur le select country qui déclenche la fonction afficheChamp
country.addEventListener("change", function()  {
afficheChamp(addCountryChamp, addCountryLabel, country.value);
console.log("j'ai effectué l'ecouteur d'évenement sur le sélecteur Country");
    
});
/**
 * 
 * @param {insérer ici la variable du champ à faire apparaitre} champ1 
 * @param {insérer ici la variable du label à faire apparaitre} labelchamp1 
 * @param {insérer ici la variable.value du select concerné} select_param 
 */
function afficheChamp (champ1, labelchamp1, select_param) {
console.log("fonction afficheChamp on");
    if(select_param==="Add") { 
        console.log("Je rempli la condition pour afficher les champs");
    champ1.style.display = "block";
    labelchamp1.style.display = "block";
}
}