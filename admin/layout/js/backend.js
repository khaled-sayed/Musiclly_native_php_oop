// const form = document.getElementById('form');
// const username = document.getElementById('username');
// const password = document.getElementById('password');

// // Show labal Message

// function showError(input, message){
//     const formControl = input.parentElement;
//     formControl.className = "form-control-login error";
//     const small = formControl.querySelector('small');
//     small.innerText = message;
// }

// function showSuccess(input){
//     const formControl = input.parentElement;
//     formControl.className = "form-control-login success";
// }


// // Check Required Fields
// function checkRequired(inputArr){
//     inputArr.forEach(function(input){
//         if(input.value.trim() ===''){
//             showError(input, `${getFieldName(input)} is required`);
//             return false;
//         } else {
//             showSuccess(input);
//             return true;
//         }
//     });
// }

// // check Input Length
// function checkLength(input, min, max){
//     if(input.value.length < min){
//         showError(input, `${getFieldName(input)} Must be at least ${min}
//         characters`);
//         return false;
//     } else if (input.value.length > max){
//         showError(input, `${getFieldName(input)} Must be less than ${max}
//         characters`);
//         return false;
//     } else{
//         showSuccess(input);
//         return true;
//     }
// }


// // Get Field Name 
// function getFieldName(input){
//     return input.id.charAt(0).toUpperCase() + input.id.slice(1);
// }

// // Event Listener
// form.addEventListener('submit', function(){
    
    
//  checkRequired([username, password]);
// checkLength(username, 3, 15);
// ccheckLength(password, 6, 25);


// });

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});