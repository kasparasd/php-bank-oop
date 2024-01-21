const closeButton = document.getElementById("closeBtn");
const infoAlert = document.querySelector(".infoAlert");

if (closeButton) {
  closeButton.addEventListener("click", (e) => {
    infoAlert.remove();
  });
}
