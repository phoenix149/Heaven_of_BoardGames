// Fonction pour gérer l'ajout au panier

let panier = [];
let total = 0;

function addToCart(nom, prix) {
  // quantite = parseInt(quantite);
  panier.push({ nom: nom, prix: prix });
  total += prix * 1;
  console.log("Produit ajouté");
  console.log(total);
  showCart();
}

//Fonction pour afficher le panier
function showCart() {
  let cartList = document.getElementById("cartList");
  cartList.innerHTML = " ";
  panier.forEach((jeu) => {
    let li = document.createElement("li");
    li.textContent = `${jeu.nom}. Prix : ${jeu.prix}€.`;
    cartList.appendChild(li);
    console.log('panier');
    
  });
  document.getElementById("total").textContent = total;
}
