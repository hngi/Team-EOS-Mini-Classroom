const name = document.getElementById('name');
const email = document.getElementById('email');
const psw1 = document.getElementById('psw1');
const signupForm = document.getElementById('signupForm');
const psw2 = document.getElementById('psw2');
const errorElement = document.getElementById('error');

signupForm.addEventListener('submit', (e) => {
    let messages = [];
    if (name.value === "" || name.value == null) {
        messages.push('Name is required')
    }

    if (email.value === "" || email.value == null) {
        messages.push('email is required')
    }

    if (psw1.value.length <=7) {
        messages.push('Password must be longer than 7 characters')
    }

    if (psw1.value != psw2.value) {
        messages.push("Password does not match")
    }
    
    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')

    }
    
})