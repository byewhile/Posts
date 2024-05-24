const main = document.querySelector('main');
const blocks = document.querySelectorAll('img');
const button = document.querySelector('button');
const images = ["dora/1.png", "dora/2.png", "dora/3.png", "dora/4.png", "dora/5.png", "dora/6.png", "dora/7.png", "dora/8.png", "dora/9.png"];

let row1 = [];
let row2 = [];
let row3 = [];

for (let i = 0; i < images.length; i++) {
    blocks[i].src = images[i];
}

for (let i = 0; i < 3; i++) {
    row1[i] = images[i];
    row2[i] = images[i + 3];
    row3[i] = images[i + 6];
}

function getRandomInt(max) {
    return Math.floor(Math.random() * max) + 1;
}

function shuffle(array) {
    array.sort(() => Math.random() - 0.5);
}

function check_result(result) {
    if (JSON.stringify(images) == JSON.stringify(result)) {
        main.style.transform = "scale(1.1)";
        window.location.href = "sborka_dora?level_up=true";
    } else {
        button.removeAttribute("disabled");
    }
}

button.addEventListener('click', () => {
    let rolls_count = 0;

    const rolls = setInterval(() => {
        shuffle(row1);
        shuffle(row2);
        shuffle(row3);
        button.setAttribute("disabled", "disabled");

        for (let i = 0; i < 3; i++) {
            blocks[i].src = row1[i];
            blocks[i + 3].src = row2[i];
            blocks[i + 6].src = row3[i];
        }

        for (let i = 0; i < images.length; i++) {
            blocks[i].style.borderRadius = getRandomInt(50) + "%";
        }
        rolls_count++;

        if (rolls_count == 10) {
            clearInterval(rolls);
            
            let result = row1.concat(row2, row3);
            check_result(result);

            for (let i = 0; i < images.length; i++) {
                blocks[i].style.borderRadius = "0%"
            }
        }
    }, 75);
})