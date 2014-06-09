$(document).ready(function(e) {
               
    var form = document.getElementById("form_upload"),
        input = document.getElementById("file"),
        formdata = false;

    if(window.FormData) {
        formdata = new FormData();
        var btn = document.getElementById("btn");
        btn.style.display = "none";
    }

    if (input.addEventListener) {
      input.addEventListener("change", function (evt) {
          btn.click();      
          formdata.append('file', input);
        }, false);
    }
});