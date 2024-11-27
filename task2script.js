const body = document.querySelector("body");

function adjustLayout() {
    if (window.innerWidth <= 768) { 
        body.classList.remove('horizontal-layout');
    } else {
        body.classList.add('horizontal-layout'); 
    }
}

window.addEventListener('resize', adjustLayout);


function loadDarkMode() {
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add("darkmode");
    }
}

const theme = document.getElementById("toggleDark")

if (theme) {
    theme.addEventListener("click", () => {
        document.body.classList.toggle("darkmode");
        
        // Save dark mode state
        if (document.body.classList.contains("darkmode")) {
            localStorage.setItem('darkMode', 'enabled');
        } else {
            localStorage.removeItem('darkMode');
        }
    });
}

loadDarkMode();
