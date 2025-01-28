function ouvrirModal() {
    document.getElementById('modal').style.display = 'block';
  }
  
  function fermerModal() {
    document.getElementById('modal').style.display = 'none';
  }

function confirmerSuppression () {
    document.getElementById('delete').submit();
    // if (confirm("Êtes-vous sûr de vouloir supprimer ce jeu ?")) {
    //   }
}