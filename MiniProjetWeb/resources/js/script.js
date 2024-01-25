document.addEventListener("DOMContentLoaded", function() {
    const loginModal = document.querySelector(".login-modal");
    const loginBtn = document.querySelector(".login-btn");
    const MyHomeButton = document.getElementById("redirectButton");
    const fullPost = document.querySelector(".full-post")
    const postBtns = document.querySelectorAll(".post-btn")

    let container = document.createElement("div")

    postBtns.forEach(btn => {
        btn.addEventListener("click", () => {
          const currentPost =  btn.parentElement.parentElement 
          currentPost.after(container)

          container.classList.add("full-post")
          container.classList.add("show")
          container.innerHTML = `<div class="post-full-image">
          <h4 class="post-title"><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit.</a></h4>
          <p class="post-date">January 1st, 2024</p>
      </div>
      <div class="full-post-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi nostrum ab rerum esse soluta quod quos minima at possimus maiores molestias aut, accusantium deserunt nobis perferendis facilis fugiat dolor repudiandae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus rerum quod quisquam! Asperiores labore minima distinctio quaerat, ducimus similique neque facere suscipit laboriosam fugit, dolore consectetur! Dolores delectus excepturi tenetur? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit ad animi atque voluptatem incidunt molestiae dolorem repudiandae corrupti provident soluta at commodi excepturi, inventore quasi pariatur eos quo veritatis suscipit. </p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi nostrum ab rerum esse soluta quod quos minima at possimus maiores molestias aut, accusantium deserunt nobis perferendis facilis fugiat dolor repudiandae. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus rerum quod quisquam! Asperiores labore minima distinctio quaerat, ducimus similique neque facere suscipit laboriosam fugit, dolore consectetur! Dolores delectus excepturi tenetur? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit ad animi atque voluptatem incidunt molestiae dolorem repudiandae corrupti provident soluta at commodi excepturi, inventore quasi pariatur eos quo veritatis suscipit. </p></div>`
       
       
       
       
        })
    })


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
