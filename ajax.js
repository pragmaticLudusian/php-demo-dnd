var opt = document.getElementById("options");
var xmlhttp = new XMLHttpRequest(); // response prep

function ajaxHint(string) {
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      opt.innerHTML = this.responseText; // echo html elements responds right here
    }
  };
  xmlhttp.open("GET", "hint.php?q=" + string, true); // true being async; opens channel to insert the needed HTML elements
  xmlhttp.send(); // end response
}

function ajaxDelete() {
  // console.log(string);
  const selectedChars = document.querySelectorAll(".char-checkbox");
  const delArray = [];
  selectedChars.forEach((char) => {
    if (char.checked) delArray.push(parseInt(char.id.replace("char-", "")));
  });
  if (delArray.length) {
    xmlhttp.open("GET", "delete.php?q=" + delArray.join(","), false);
    xmlhttp.send();
  } else {
    event.preventDefault(); // how else to refer to the Window.event..?
  }
}
