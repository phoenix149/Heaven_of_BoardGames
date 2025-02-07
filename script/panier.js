// Fonction pour gérer l'ajout au panier

let panier = [];
let total = 0;

function addToCart(nom, prix) {
  // quantite = parseInt(quantite);
  panier.push({ nom: nom, prix: prix });
  total += prix;
  showCart();
}

//Fonction pour afficher le panier
function showCart(){
  const cartList = document.getElementById("cartList");
  cartList.innerHTML = "";
  panier.forEach((item) => {
    const li = document.createElement("li");
    li.textContent = `${item.nom}. Prix : ${item.prix}€.`;
    cartList.appendChild(li);
  });
  document.getElementById("total").textContent = total;
}

