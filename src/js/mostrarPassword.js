/*=============== SHOW HIDDEN - PASSWORD ===============*/
const showHiddenPass = (loginPass, loginEye) =>{
    const input = document.getElementById(loginPass),
          iconEye = document.getElementById(loginEye)
   
   if(!input && !iconEye) return;
 
    iconEye.addEventListener('click', () =>{
       // Change password to text
       if(input.type === 'password'){
         console.log("mostrar contraseña en texto");
          // Switch to text
          input.type = 'text'
 
          // Icon change
          iconEye.classList.add('ri-eye-line')
          iconEye.classList.remove('ri-eye-off-line')
       } else{
         console.log("mostrar contraseña en astericos");
          // Change to password
          input.type = 'password'
 
          // Icon change
          iconEye.classList.remove('ri-eye-line')
          iconEye.classList.add('ri-eye-off-line')
       }
    })
}

showHiddenPass('clave','login-eye1');
showHiddenPass('clave-repetida','login-eye2');
showHiddenPass('login-pass','login-eye');
