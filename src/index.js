import { login, submitLogin } from "./functii";

document.querySelector('#login').onclick = login;

const analiza = (eveniment) => {
   eveniment.preventDefault();
   if(eveniment.target.id === "submit_login") {
      submitLogin(eveniment);
      return;
   }
}

 document.querySelector("#continut").addEventListener("click", analiza);


