function edit(otherUser, id, content) {
    var e = document.getElementsByClassName("text-danger");
    for(var i=0; i<e.length; ++i) {
        e[i].classList.remove("text-danger");
    }
    document.getElementById("form").setAttribute("action", "/chat/edit/" + otherUser + "/" + id);
    document.getElementById("text").setAttribute("value", content);
    document.getElementById("submit").innerHTML = "Edit";
    document.getElementById(id).classList.add("text-danger");
    document.getElementById("text").focus();
}

function navigate(link) {
    window.location.href = link;
}