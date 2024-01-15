document.addEventListener("DOMContentLoaded", function() {
    const loginModal = document.querySelector(".login-modal");
    const loginBtn = document.querySelector(".login-btn");
    const MyHomeButton = document.getElementById("redirectButton");

    if (loginBtn) {
        loginBtn.addEventListener("click", () => {
            loginModal.classList.add("show");
        });
    }

    window.addEventListener("click", (event) => {
        if (event.target === loginModal) {
            loginModal.classList.remove("show");
        }
    });

    if (MyHomeButton) {
        MyHomeButton.addEventListener("click", redirect);
    }

    function redirect() { 
        console.log("Redirected ...");
        window.location.href = "/Student/home";
    }
});
