
document.addEventListener("DOMContentLoaded", function() {
    const emploiSection = document.getElementById("emploiSection");
    const emploiCase = emploiSection.querySelectorAll("tr td");
    const eventForm = document.querySelector(".add_event")

    emploiCase.forEach((caseElement) => {
        caseElement.addEventListener("click", ()=> {
            if (!caseElement.classList.contains("hour-case") && !caseElement.classList.contains("occupied")) {
                eventForm.classList.add("show")
            } else {
                alert("Error !!! This case is already occupied")
                
            }
            
        })
    });
});
