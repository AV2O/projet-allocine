document.addEventListener('DOMContentLoaded', () => {

    // Gestion du bouton "Enregistrer" dans la page Edit
    const editForm = document.querySelector('form[action*="/films/edit/"]');
    if (editForm) {
        editForm.addEventListener('submit', function() {
            const btn = this.querySelector('.btn-primary');
            if (btn) {
                btn.innerHTML = "⏳ Enregistrement...";
                btn.style.opacity = "0.7";
                btn.style.pointerEvents = "none"; // Empêche le double clic
            }
        });
    }

    // Gestion de la suppression
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            if (!confirm('Es-tu sûr de vouloir supprimer ce film ? Cette action est irréversible.')) {
                e.preventDefault(); // Annule l'envoi du formulaire si l'utilisateur clique sur "Annuler"
            }
        });
    });
});