const login = () => {
    const htmlForm = `
       <div class="d-flex justify-content-center">
          <div style="margin-top: 50px;" class="redus">
             <h2>Formular de conectare</h2>
             <form id="formlogin">
                <div class="form-group">
                   <label for="numelogin">Numele de conectare</label>
                   <input type="text" class="form-control" id="numelogin" name="numelogin">
                </div>
                <div class="form-group">
                   <label for="parola">Parola</label>
                   <input type="password" class="form-control" id="parola" name="parola">
                </div>
                <p class="textsuplimentar"><a id="parolapierduta" href="#">Parolă pierdută?</a></p>
                <div id="mesaj" class="mesaj ascuns"></div>
                <div class="d-flex justify-content-center">
                   <button id="submit_login" type="submit" class="btn btn-primary">Conectare</button>
                </div>
             </form>
             <p class="textsuplimentar" style="border-top: 1px solid #21759B; margin-top: 15px;"><a id="creazacont" href="#">Crează un cont nou...</a></p>
          </div>
       </div> 
     `;
  
     document.querySelector('#continut').innerHTML = htmlForm;
  }
  
  const submitLogin = (evt) => {
     evt.preventDefault();
     const formular = document.querySelector('#formlogin');
     const formDATA = new FormData(formular);
  
     const config = {
        method: 'POST',
        body: formDATA
     }
  
     fetch('https://tribliodoc.000webhostapp.com/api/login.php', config)
     .then( raspuns => raspuns.json())
     .then( raspunsjs => {
           //console.log(raspunsjs);  //  Afisez raspunsul
         console.log(raspunsjs.logat);
         if(raspunsjs.logat === "OK") {
            document.querySelector('#numepren').innerHTML = raspunsjs.prenume + ' ' + raspunsjs.nume;
            document.querySelector('#nelog').classList.remove('vizibil');
            document.querySelector('#nelog').classList.add('ascuns');
            document.querySelector('#log').classList.remove('ascuns');
            document.querySelector('#log').classList.add('vizibil');
            document.querySelector("#continut").innerHTML = "";
         } else {
            document.querySelector('#mesaj').classList.remove('ascuns');
            document.querySelector('#mesaj').classList.add('vizibil');
            document.querySelector('#mesaj').innerHTML = raspunsjs.mesaj;
         }
     });
  };
  
  export { login, submitLogin };