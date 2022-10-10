addEventListener('click', () => {

    document.getElementById('mode').onclick = (e) => {
        if (mode == 'light') {
            document.documentElement.classList.remove("light")
            document.documentElement.classList.add("dark")
        } else {
            document.documentElement.classList.remove("dark")
            document.documentElement.classList.add("light")
        }
    }
});