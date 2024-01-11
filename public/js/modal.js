document.addEventListener("DOMContentLoaded", function() {
    const addBtn = document.getElementById('addBtn');
    const closeAddModalBtn = document.getElementById('closeAddModal');

    if (addBtn && closeAddModalBtn) {
        addBtn.addEventListener('click', showAddModal);
        closeAddModalBtn.addEventListener('click', hideAddModal);
    }

    function showAddModal() {
        const addModal = document.getElementById('addModal');
        if (addModal) {
            addModal.classList.remove('hidden');
        }
    }

    function hideAddModal() {
        const addModal = document.getElementById('addModal');
        if (addModal) {
            addModal.classList.add('hidden');
        }
    }
});

function showeditModal(id) {
    localStorage.setItem("id", id);
    document.getElementById('id-edit').value = id;
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.classList.remove('hidden');
    }
}

function hideeditModal() {
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.classList.add('hidden');
    }
};