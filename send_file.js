const input_file = document.getElementById("file");
const send_files_button = document.querySelector("label[for='file']");

input_file.addEventListener("change", function() {
    let files = this.files;
    
    if (textarea.value != null) {
        textarea.value = null;
    }

    for (let i = 0; i < files.length; i++) {
        textarea.value += files[i].name.replace(" ", "") + " ";
    }

    if (files.length > 0) {
        textarea.setAttribute("readonly", "true");
        send_files_button.innerText = "Отменить отправку";
        send_files_button.setAttribute("for", "#");
    }
})

send_files_button.addEventListener("click", (event) => {
    if (send_files_button.innerText == "Отменить отправку") {
        event.preventDefault();
        
        textarea.value = null;
        textarea.removeAttribute("readonly");

        send_files_button.innerText = "Прикрепить файл";
        send_files_button.setAttribute("for", "file");
    }
})
