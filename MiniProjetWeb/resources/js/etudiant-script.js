const  emploiTemps = document.getElementById("emploiSection");
const  announcesSection = document.getElementById("announcesSection");
const  demandeSection = document.getElementById("demandeSection");
const  sidbarBtns = document.querySelectorAll(".sidebar ul li a");

sidbarBtns.forEach( btn => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();
       let clickedBtnId  = btn.dataset.id;
       if (clickedBtnId === "announces") {
        emploiTemps.style.display = "none";
        demandeSection.style.display = "none";
        announcesSection.style.display = "block";
        
       } 

       if (clickedBtnId === "demande") {
        emploiTemps.style.display = "none";
        demandeSection.style.display = "block";
        announcesSection.style.display = "none";
       }

       if (clickedBtnId === "emploi") {
        emploiTemps.style.display = "block";
        demandeSection.style.display = "none";
        announcesSection.style.display = "none";
       }


    })
    
})