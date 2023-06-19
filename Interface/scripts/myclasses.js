let popup = document.getElementById("pp");
let assignPopup = document.getElementById("ap");

function openPopup() {
  popup.classList.remove("close-popup");
  popup.classList.add("open-popup");
  closeAssignPopup();
}

function closePopup() {
  popup.classList.remove("open-popup");
  popup.classList.add("close-popup");
}

function openAssignPopup() {
  assignPopup.classList.remove("close-popup");
  assignPopup.classList.add("open-popup");
  closePopup();
}

function closeAssignPopup() {
  assignPopup.classList.remove("open-popup");
  assignPopup.classList.add("close-popup");
}
