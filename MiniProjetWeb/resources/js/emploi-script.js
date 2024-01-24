document.addEventListener("DOMContentLoaded", function() {
    const emploiSection = document.getElementById("emploiSection");
    const emploiCase = emploiSection.querySelectorAll("tr td");
    const eventForm = document.querySelector(".add_event");
    const overlay = document.createElement('div'); // Create a new div for the overlay

    // Style the overlay
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)'; // Semi-transparent black
    overlay.style.display = 'none'; // Hide it by default
    document.body.appendChild(overlay); // Add it to the body

    emploiCase.forEach((caseElement) => {
        // Check if the td element is empty
        if (caseElement.innerHTML.trim() === '') {
            caseElement.addEventListener("click", (event) => {
                event.stopPropagation(); // Stop the event from bubbling up to the document
                if (!caseElement.classList.contains("hour-case") && !caseElement.classList.contains("occupied")) {
                    eventForm.classList.add("show");
                    overlay.style.display = 'block'; // Show the overlay when the form is shown
                }
            });
        } else {
            // If the td element is not empty, add a class to it
            caseElement.classList.add("no-hover");
        }
    });

    // Listen for clicks on the document
    document.addEventListener("click", (event) => {
        // If the click event target is outside of the form and the form is visible
        if (!eventForm.contains(event.target) && eventForm.classList.contains("show")) {
            // Hide the form
            eventForm.classList.remove("show");
            overlay.style.display = 'none'; // Hide the overlay when the form is hidden
        }
    });
});
