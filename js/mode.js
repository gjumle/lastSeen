/*
mode.onclick = function() {
    document.body.classList.toggle('dark-theme');
    if (document.body.classList.contains('dark-theme')) {
       
    } else {
        mode.innerHTML = "Dark Mode";
    }
}
*/

var mode = document.getElementById("mode");
const btn = document.getElementById('mode');
const currentTheme = localStorage.getItem("theme");

if (currentTheme == "dark") {
  document.body.classList.add("dark-theme");
}

btn.addEventListener("click", function() {
    document.body.classList.toggle("dark-theme");
    let theme = "light";
    mode.innerHTML = "Dark Mode";
    if (document.body.classList.contains("dark-theme")) {
        mode.innerHTML = "Light Mode";
        theme = "dark";
    }
    localStorage.setItem("theme", theme);
});