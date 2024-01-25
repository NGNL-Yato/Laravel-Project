
document.addEventListener("DOMContentLoaded", function() {
    const emploiSection = document.getElementById("emploiSection");
    const emploiCase = emploiSection.querySelectorAll("tr td");
    const eventForm = document.querySelector(".add_event")
    const layerForm = document.querySelector(".layer-form")

    emploiCase.forEach((caseElement) => {
        caseElement.addEventListener("click", ()=> {
            if (!caseElement.classList.contains("hour-case") && !caseElement.classList.contains("occupied")) {
                layerForm.classList.add("show")
            } else {
                alert("Error !!! This case is already occupied")
                
            }
            
        })
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains("layer-form")) {
            layerForm.classList.remove("show")
        }
    });
});
