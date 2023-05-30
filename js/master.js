document.getElementById("delete").onclick = function () {
    let text = "Are you sure you want to delete this?";
    if (confirm(text) == true) {
        text = "Record deleted successfully";
        alert(text);
    }
    else {
        text = "Delete cancelled";
        alert(text);
    }
}
