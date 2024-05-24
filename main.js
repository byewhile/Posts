const form = document.querySelector("form");
const main_text = document.querySelector("h2");
const login_inputs = document.querySelectorAll(".invisible");
const submit_input = document.querySelector("input[type=submit]");
const helper_text = document.getElementById("helper-text");
const change_form_button = document.getElementById("change-form");
const inputs = document.querySelectorAll("input");

// Смена формы
let login_form = false;

["click", "keydown"].forEach(events => {
  change_form_button.addEventListener(events, (event) => {
    if (event.key == "Enter" || event.type == "click") {
      if (!login_form) {
        form.action = "registration.php";
    
        main_text.innerText = "Регистрация";
    
        login_inputs.forEach(login_input => {
          login_input.setAttribute("required", true);
          login_input.classList.remove("invisible");
        })

        inputs.forEach(input => {
          input.value = null;
          input.classList.remove("input-with-problem");
        })
    
        submit_input.removeAttribute("disabled");
        submit_input.value = "Зарегистрироваться";
    
        helper_text.innerText = "Eсть профиль?";
        change_form_button.innerText = "Войти";
    
        login_form = true;
        controllerEventListener(login_form);
      } else {
        form.action = "login.php";
    
        main_text.innerText = "Вход";
    
        login_inputs.forEach(login_input => {
          login_input.removeAttribute("required");
          login_input.classList.add("invisible");
        })

        inputs.forEach(input => {
          input.value = null;
          input.classList.remove("input-with-problem");
        })
    
        submit_input.removeAttribute("disabled");
        submit_input.value = "Войти";
    
        helper_text.innerText = "Нет профиля?";
        change_form_button.innerText = "Зарегистрироваться";
    
        login_form = false;
        controllerEventListener(login_form);
      }
    }
  })
})

// Проверка на подтверждение пароля в форме регистрации
const password_inputs = document.querySelectorAll("input[type=password]");
const error_text = document.querySelector("#error-text");

function checkPasswords() {
  if (password_inputs[0].value != password_inputs[1].value) {
    error_text.innerText = "Пароли не совпадают!";
    error_text.classList.remove("invisible");

    submit_input.setAttribute("disabled", "disabled");

    password_inputs.forEach(password_input => {
      password_input.classList.add("input-with-problem");
    })
  } else {
    error_text.classList.add("invisible");

    submit_input.removeAttribute("disabled");

    password_inputs.forEach(password_input => {
      password_input.classList.remove("input-with-problem");
    })
  }
}

// Скрытие label + input подтверждения пароля и email'а при смене формы
function controllerEventListener(controller) {
  if (controller) {
    password_inputs.forEach(password_input => {
      password_input.addEventListener("input", checkPasswords);
    })
  } else {
    password_inputs.forEach(password_input => {
      password_input.removeEventListener("input", checkPasswords);
    })
  }
  error_text.classList.add("invisible");
}

if (error_text.innerText != null) {
  error_text.classList.remove("invisible");
}