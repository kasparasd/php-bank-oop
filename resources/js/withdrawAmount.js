const funds = document.querySelector(".funds-input");
const fundsInAccount = document.querySelector(".fundsInAccount");

if (funds) {
  funds.addEventListener("input", (e) => {
    if (parseFloat(fundsInAccount.innerText) < parseFloat(e.target.value)) {
      document
        .querySelector(".messageAboutFunds")
        .classList.remove("hiddenMessage");
    } else {
      document
        .querySelector(".messageAboutFunds")
        .classList.add("hiddenMessage");
    }
  });
}
