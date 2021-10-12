function edit(otherUser, id, content) {
    document.getElementById("form").setAttribute("action", "/chat/edit/" + otherUser + "/" + id);
    document.getElementById("text").innerHTML = content;
    document.getElementById("submit").innerHTML = "Edit";
}