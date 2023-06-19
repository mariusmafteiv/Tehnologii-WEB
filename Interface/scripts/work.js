let popup = document.getElementById("pp");
let solutionPopup = document.getElementById("sp");

function openPopup() {
    popup.classList.remove("close-popup");
    popup.classList.add("open-popup");
    closeSolutionPopup()
}

function closePopup() {
  popup.classList.remove("open-popup");
  popup.classList.add("close-popup");
}

function openSolutionPopup() {
    solutionPopup.classList.remove("close-popup");
    solutionPopup.classList.add("open-popup");
    closePopup();
}

function closeSolutionPopup() {
    solutionPopup.classList.remove("open-popup");
    solutionPopup.classList.add("close-popup");
}
