var mode = document.getElementById("mode");

mode.onclick = function() {
    document.body.classList.toggle('dark-theme');
    if (document.body.classList.contains('dark-theme')) {
        mode.innerHTML = "Light Mode";
    } else {
        mode.innerHTML = "Dark Mode";
    }
}