const add_post_button = document.getElementById("add_post");
const postarea = document.querySelector(".invisible");
const textarea = document.querySelector("textarea");

if (add_post_button != null) {
    add_post_button.addEventListener("click", () => {
        add_post_button.classList.add("invisible");
        postarea.classList.remove("invisible");
    })
    
    add_post_button.addEventListener("keydown", (event) => {
        if (event.key == "Enter") {
            add_post_button.classList.add("invisible");
            postarea.classList.remove("invisible");
        }
    })
}
