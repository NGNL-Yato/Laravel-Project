


/* ------------------------------------------------------------------------------------------------------------*/
/* --------------------------------------Educational_Service Function------------------------------------------*/
/* ------------------------------------------------------------------------------------------------------------*/

//Users.blade.php Functions 
document.addEventListener('DOMContentLoaded', function () {
    var toggleButton = document.getElementById('toggleFormButton');
    var formLayout = document.getElementById('formLayout');
    var formContainer = document.querySelector('.form-container'); // Assuming your form is in a container with this class
    var demandeBtn = document.getElementById("faireDemande");
    var modalElm = document.getElementById('modal-Content');

    toggleButton.addEventListener('click', function () {
        formLayout.style.display = 'block';
        modalElm.style.display = 'block';   
        console.log(modalElm)

    });

    demandeBtn.addEventListener('click', function () {
        formLayout.style.display = 'block';
    });

    document.addEventListener('click', function (event) {
        var isClickInsideFormContainer = formContainer.contains(event.target);

        if (!isClickInsideFormContainer && event.target !== toggleButton) {
            formLayout.style.display = 'none';
        }
    });
});
function showEditForm(userId, userName, userEmail, userRole) {
    var form = document.getElementById('editForm');
    var editUserForm = document.getElementById('editUserForm');

    // Update the form action URL
    editUserForm.action = '/users/' + userId;
    editUserForm.method = 'post';
    
    // Update form fields
    document.getElementById('name').value = userName;
    document.getElementById('email').value = userEmail;
    document.getElementById('role').value = userRole;

    // Show the form
    form.style.display = 'block';
}
function hideEditForm() {
    console.log('up')
    if(document.getElementById('editForm').style.display == 'block'){
        document.getElementById('editForm').style.display = 'none';
    } else {
        formLayout.style.display = 'none'; 
        document.getElementById('modal-Content').style.display = 'none';   
    }
}
document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var userId = this.getAttribute('data-user-id');
            var userName = this.getAttribute('data-user-name');
            var userEmail = this.getAttribute('data-user-email');
            var userRole = this.getAttribute('data-user-role');
            showEditForm(userId, userName, userEmail, userRole);
        });
    });
    var cancelButtons = document.querySelectorAll('.cancel-btn');
    cancelButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            hideEditForm();
        });
    });
});



