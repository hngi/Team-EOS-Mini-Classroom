const name = document.getElementById('name');
const email = document.getElementById('email');
const psw = document.getElementById('psw');
const signupForm = document.getElementById('signupForm');
const psw2 = document.getElementById('psw2');
const errorElement = document.getElementById('error');
const matchName = document.getElementById('matchName');
const matchEmail = document.getElementById('matchEmail');
const matchPassword = document.getElementById('matchPassword');
const confirmPassword = document.getElementById('confirmPassword');
const signupbutton = document.querySelector('signupbutton');

function validateFunction () {
    //removeError();
    var passwordFormat=  /^[A-Za-z]\w{7,14}$/; //password must be between 7 to 14  characters, and first character must be a letter  
    var emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;   

    if (name.value === "" || name.value == null) {
        matchName.className = "wrongInput" 
        matchName.innerHTML = "Username can't be blank"
        signupbutton.disabled = true;
        
        
    }
    

    if (emailFormat.test(email.value) == false) {
        matchEmail.className = "wrongInput";
        matchEmail.innerHTML = "Incorrect email format";

    }

    if (passwordFormat.test(psw.value) == false) {
        matchPassword.className = "wrongInput";
        matchPassword.innerHTML = "password should be between 7 to 14  characters, and first character must be a letter ";

    }

    if (psw.value != psw2.value) {
        
        confirmPassword.className = "wrongInput" 
        confirmPassword.innerHTML = "password does not match"
        signupbutton.disabled = true;
    }
    

}
