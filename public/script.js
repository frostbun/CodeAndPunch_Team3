function edit(otherUser, id, content) {
    reset_text_to_normal();
    document.getElementById("form").setAttribute("action", "/chat/edit/" + otherUser + "/" + id);
    document.getElementById("text").setAttribute("value", content);
    document.getElementById("submit").innerHTML = "Edit";
    document.getElementById("delete").style.visibility = "visible";
    document.getElementById("cancel").style.visibility = "visible";
    document.getElementById("delete").setAttribute("href", "/chat/delete/" + otherUser + "/" + id);
    document.getElementById(id).classList.add("text-danger");
    document.getElementById("text").focus();
}

function cancel(otherUser) {
    reset_text_to_normal();
    document.getElementById("form").setAttribute("action", "/chat/query/" + otherUser);
    document.getElementById("text").setAttribute("value", "");
    document.getElementById("submit").innerHTML = "Send";
    document.getElementById("delete").style.visibility = "hidden";
    document.getElementById("cancel").style.visibility = "hidden";
    document.getElementById("text").focus();
}

function navigate(link) {
    window.location.href = link;
}

function reset_text_to_normal() {
    var e = document.getElementsByClassName("text-danger");
    for(var i=0; i<e.length; ++i) {
        e[i].classList.remove("text-danger");
    }
}