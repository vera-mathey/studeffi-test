document.querySelectorAll('.edit-reading-btn').forEach(button => {
    button.addEventListener('click', () => {
        const readingId = button.getAttribute('data-id');
        const modalContent = document.getElementById('modalContent');
        modalContent.innerHTML = '<div class="modal-body text-center">Chargement...</div>';
        fetch(`/reading/${readingId}/edit`, {
            headers: { 'X-requested-with': 'XMLHtpRequest'}
        })
        .then(Response => Response.text())
        .then(html => {
            modalContent.innerHTML =html;
        })
        .catch(() => {
            modalContent.innerHTML = '>div class="modal-body text-danger">Erreur du chargement du formulaire</div>';
        });
    });
});