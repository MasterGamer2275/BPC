 function emailPO() {
    var to = "pooraniram@gmail.com";
    var subject = "This is the subject";
    var body = "This is the body";
    var url = "https://mail.google.com/mail/?view=cm&fs=1&to=" + encodeURIComponent(to) + "&su=" + encodeURIComponent(subject) + "&body=" + encodeURIComponent(body);
    window.open(url, "_blank");
}