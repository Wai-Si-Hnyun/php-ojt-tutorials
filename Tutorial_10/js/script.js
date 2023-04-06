const fileUploadBtn = document.querySelector('#fileUploadBtn');
const hiddenFileInput = document.querySelector('#image');

fileUploadBtn.addEventListener('click', function (e) {
    hiddenFileInput.click();
});

hiddenFileInput.addEventListener('change', function () {
    if (hiddenFileInput.files.length > 0) {
        const fileName = hiddenFileInput.files[0].name;
        fileUploadBtn.innerText = fileName;
    } else {
        fileUploadBtn.innerText = "Upload";
    }
});
