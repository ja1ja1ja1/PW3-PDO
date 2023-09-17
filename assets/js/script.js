//Variaveis
var form = document.frm;
var span = [...document.querySelectorAll("span")];
var submitCad = document.querySelector("#input-cad");
var senha0 = document.querySelector("#senha0");
var senha1 = document.querySelector("#senha1");
var verificacao = [...document.querySelectorAll("#login-form input[type='text']")];
//funcoes

verifica =()=>{
    if(senha0.value == senha1.value){
        for(var i=0;i<verificacao.length;i++){
            if(!verificacao[i]){
                verificacao[i].classList.add("error")
                verificacao[i].nextElementSibling.classList.add("aviso")
                verificacao[i].focus();
                return
            }else{
                verificacao[i].classList.remove("error")
                verificacao[i].nextElementSibling.classList.remove("aviso")
            }
        }
        document.frm.submit();
    }else{
        
        span[1].classList.add("aviso")
        span[1].innerHTML = "Senha diferente uma da outra!"
    }
}

//eventos
submitCad.addEventListener("click", (e)=>{
    e.preventDefault()
    verifica();
})
