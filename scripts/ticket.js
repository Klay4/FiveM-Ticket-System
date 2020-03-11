function openTicket() {
    document.getElementById("openTicket").style.display = "none";
    document.getElementById("submitTicket").style.display = "block";
    document.getElementById("closeTicketForm").style.display = "block";
}

function closeTicketForm() {
    document.getElementById("openTicket").style.display = "block";
    document.getElementById("submitTicket").style.display = "none";
    document.getElementById("closeTicketForm").style.display = "none";
}

function openMyTicket() {
    window.location.replace("myTicket.php");
}

function loadDoc(id) {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tickRectangle" + id.toString()).style.display = "none";
        }
    };

    xhttp.open("GET", "myTicket.php?id=" + id + "&delete=true", true);
    xhttp.send();
}

function insertDoc(doc) {
    var title = doc.getElementById("title").value;
    var content = doc.getElementById("content").value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            doc.location.href="myTicket.php?resultInsert=" + this.responseText;
        }
    };

    xhttp.open("GET", "insert.php?title=" + title + "&content=" + content, true);
    xhttp.send();
}

function hideMessage() {
    document.getElementById("ticketOK").style.display = "none";
};
setTimeout(hideMessage, 2000);

function changePageTitle() {
    document.title = "Admin - FutureServer RP";
}

function refresh() {
    if(new Date().getTime() - time >= 60000) 
        window.location.reload(true);
    else 
        setTimeout(refresh, 10000);
}
