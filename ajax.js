var opt = document.getElementById("options");
var xmlhttp = new XMLHttpRequest(); // response prep

function ajaxHint(str) {
  if (str.length == 0) {
    opt.innerHTML = "";
    return;
  }
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      opt.innerHTML = this.responseText; // echo <div> responds here </div>
    }
  };
  xmlhttp.open("GET", "hint.php?q=" + str, true); // true being async; opens channel
  xmlhttp.send(); // end response
}
