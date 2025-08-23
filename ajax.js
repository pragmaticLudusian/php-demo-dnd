var opt = document.getElementById("options");
var xmlhttp = new XMLHttpRequest(); // response prep

function ajaxHint(string) {
  var startOpt = document.getElementById("starter-options");
  if (startOpt) startOpt.remove(); // a bit of a dirty solution but involving js to refresh the table by adding another appears to be the way
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      opt.innerHTML = this.responseText; // echo html elements responds right here
    }
  };
  xmlhttp.open("GET", "hint.php?q=" + string, true); // true being async; opens channel to insert the needed HTML elements
  xmlhttp.send(); // end response
}
