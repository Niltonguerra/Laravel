        // Aula 06
btnEuAmoVc = document.getElementById("btn__euAmoVc");
txt_amo_vc = document.getElementById("txt_amo_vc");
var contadorA = 0;

btnEuAmoVc.addEventListener("click", () => {
    if(contadorA<1){
    txt_amo_vc.innerHTML = txt_amo_vc.innerHTML + " mais que o mundo inteiro!";
    contadorA++;
    }
})



btn_mostra_some = document.getElementById("btn_mostra_some");
img_aula06 = document.getElementById("img_aula06");
var verifica = true;

btn_mostra_some.addEventListener("click", () => {
        console.log("entrou");
    if(verifica == true){
        img_aula06.style.display = "none";
        console.log("desaparece");
        verifica = false;
        return;
    }else{
        img_aula06.style.display = "block";
        console.log("aparece");
        verifica = true;
        return;
    }
})

