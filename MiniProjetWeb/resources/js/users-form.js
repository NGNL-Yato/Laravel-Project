const formLayoutt = document.getElementById("formLayoutt")
const newUser = document.getElementById("toggleFormButton")
const registerBtn = document.querySelector(".registerBtn")

newUser.addEventListener("click", () => {
    formLayoutt.classList.toggle("showForm")
    if (formLayoutt.classList.contains("showForm")) {
        newUser.textContent = "Hide Form"
    } else {
        newUser.textContent = "Add New User"
    }
})
