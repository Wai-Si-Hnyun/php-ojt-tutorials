const fileInput = document.getElementById('file');
const importForm = document.getElementById('import-form');
const btn = document.getElementById('import-btn');

btn.addEventListener('click', () => {
    fileInput.click();
})

fileInput.addEventListener('change', () => {
    if (fileInput.files.length) {
        importForm.submit();
    }
});

function confirmDelete() {
    return confirm('Are you sure to delete this item?');
}