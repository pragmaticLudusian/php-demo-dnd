var opt = document.getElementById("options");
var xmlhttp = new XMLHttpRequest(); // response prep

function ajaxHint(string) {
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      opt.innerHTML = this.responseText; // echo html elements responds right here
    }
  };
  xmlhttp.open("GET", "utils/hint.php?q=" + string, true); // true being async; opens channel to insert the needed HTML elements
  xmlhttp.send(); // end response
}

function ajaxDelete(event) {
  const selectedChars = document.querySelectorAll(".form__checkbox");
  const delArray = [];
  selectedChars.forEach((char) => {
    if (char.checked) delArray.push(parseInt(char.id.replace("char-", "")));
  });

  let isConfirmed = confirm(
    `Are you sure you want to delete th${
      delArray.length === 1 ? "is" : "ese"
    } ${delArray.length} character${delArray.length === 1 ? "" : "s"}?`
  );
  if (isConfirmed) {
    if (!delArray.length) return; // assume (delArray.length)
    xmlhttp.open("GET", "utils/delete.php?q=" + delArray.join(","), false);
    xmlhttp.send();
  } else {
    // even if denied, form action will still take effect unless preventDefault is used (passed from onsubmit)
    event.preventDefault();
    return;
  }
}
