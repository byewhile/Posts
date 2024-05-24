const levels = document.querySelectorAll('.level');

levels.forEach(level => {
    if (level.innerText < 5) {
        level.style.backgroundColor = "var(--level-zero)";
    }

    if (level.innerText >= 5) {
        level.style.backgroundColor = "var(--level-one)";
    }

    if (level.innerText >= 10) {
        level.style.backgroundColor = "var(--level-two)";
    }

    if (level.innerText >= 25) {
        level.style.backgroundColor = "var(--level-three)";
    }

    if (level.innerText >= 50) {
        level.style.backgroundColor = "var(--level-four)";
    }
});