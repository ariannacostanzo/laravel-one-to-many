const deleteForms = document.querySelectorAll('.delete-form')
const modalCloseButton = document.getElementById("close-btn");
const modalConfirmButton = document.getElementById("confirm-btn");
const deleteModal = document.getElementById('delete-modal');
const modalText = document.getElementById('modal-text')

//let activeForm = null;

deleteForms.forEach((form) => {
    form.addEventListener('submit', (e) => {
        e.preventDefault()
        const projectTitle = form.getAttribute('data-project')
        const typeLabel = form.getAttribute('data-type')
        if (projectTitle) {
            modalText.innerText = projectTitle + "?";
        }
        if (typeLabel) {
            modalText.innerText = typeLabel + '?';
        }
        modalConfirmButton.addEventListener("click", () => { //e questo si toglie
            form.submit();
        });
    })
})

//modalConfirmButton.addEventListener('click', () => {
//  if (activeForm) activeForm.submit();
//})

// deleteModal.addEventListener('hidden.bs.modal', () => {
//     activeForm = null; 
// })