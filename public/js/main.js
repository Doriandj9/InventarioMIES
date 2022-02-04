import { queryServer } from "./moduls.js";
(function(){
    
const selectionBienes = document.getElementById('selection-bienes');
const buttonCustodio = document.getElementById('ingresar-custodio');
if(selectionBienes == null)  return;
const pathUrl = document.URL.split('/')[2];
///window.open('http://localhost/add/custodio');
selectionBienes.addEventListener('click', upBienes);
buttonCustodio.addEventListener('click',verifyBienes);

function verifyBienes(e) {
    e.preventDefault();
    if(!document.querySelector('.options-ckecked-list')){
        alert('Debe seleccionar al menos un bien');
    }else{
        alert('Debe seleccionar al menos un bien');
    }
}

function upBienes(e){
    
    e.preventDefault();
    const listaBienes = document.querySelector('.lista-bienes');
    

        const xhr = queryServer({method:'GET',url:`http://${pathUrl}/print/bienes`});
        xhr.onreadystatechange = () =>{

            if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200 ){
                let json = JSON.parse(xhr.response);
                pictureDataBienes(json,listaBienes);
               
            }
        }
   
    

}

function pictureDataBienes(response,elementPadre) {
    const newSelectionBienes = document.querySelector('.lista-bienes');

    if(!newSelectionBienes.children.length > 0){
        const div_options = document.createElement('div');
        const div_ckecked = document.createElement('div');
        const button = document.createElement('button');
        const inputBuscar = document.createElement('input');

        inputBuscar.setAttribute('type','search');
        inputBuscar.setAttribute('id','buscar-bienes');
        inputBuscar.setAttribute('placeholder','Ingrese una descripcion');

        button.innerText = 'Salir';
        button.setAttribute('id','salir-evidencias');

        div_options.classList.add('option-bienes-list');
        div_ckecked.classList.add('options-ckecked-list');
        div_ckecked.setAttribute('id','lista-checkeds');

        div_options.append(inputBuscar);
        div_options.append(button);

        elementPadre.append(div_options);
        elementPadre.append(div_ckecked);

        response.forEach(element => {
            if(element.cantidad >=1){
            const ckec = document.createElement('input');
            const label = document.createElement('label');
            const labe2 = document.createElement('label');
            labe2.innerHTML = `Cantidad:${element.cantidad}
             <input type="number"  min="1" max="${element.cantidad}" value="1" name="cant[]">
             <a class="open-a" href="http://${pathUrl}/bienes/detalle?id=${element.codigo}"
             >Ver Detalle </a>
             `;
            label.innerText = element.descripcion;
            ckec.setAttribute('type','checkbox');
            ckec.setAttribute('value',element.codigo);
            ckec.setAttribute('name','bienes[]');
            label.append(ckec);
            label.append(labe2);
            div_ckecked.append(label);
            }

            
            
        });
        
            
        
        verDetallesEvidencia();
        newSelectionBienes.style.zIndex = '10';
        newSelectionBienes.style.opacity = '1';
        searchBienes();
        salirEvidencia();

    }else{
        verDetallesEvidencia();
        newSelectionBienes.style.opacity = '1';
        newSelectionBienes.style.zIndex = '5';
        searchBienes();
        salirEvidencia();
    }

    function verDetallesEvidencia(){
        // esta funcion se le a todos los elementos a de html para que 
        //abra en otra ventana mas pequenia los detalles de ese bien
        
        const arrayA = document.querySelectorAll('a.open-a');
        const izq  = (window.outerWidth / 2) - 375;
            let opewWindow;
            const opciones = `height=500,width=900,left=${izq}`;
        arrayA.forEach(elm => {
            elm.onclick =  () => {
                opewWindow = window.open(elm.href,"Detalles",opciones);
                return false;
            }
        })
    }

    function salirEvidencia(){
        const salir_evidencia = document.getElementById('salir-evidencias');
        salir_evidencia.addEventListener('click', e  => {
            e.preventDefault();
                newSelectionBienes.style.opacity = '0';
                newSelectionBienes.style.zIndex = '-1';
                const padre = document.querySelector('.options-ckecked-list');
                let arrayHijos = padre.querySelectorAll('input:checked')
            if(arrayHijos.length > 0){
                buttonCustodio.removeEventListener('click',verifyBienes);
                const elementosEliminar  = Array.from(padre.querySelectorAll('input:not(:checked)'));
                elementosEliminar.forEach(element => {
                    if(element.getAttribute('type') == 'checkbox'){
                        element.parentElement.remove();
                    }
                })
                
            }
        })
    }
    function searchBienes(){
        const buscarinput = document.getElementById('buscar-bienes');
        const elementsHTMLCheck = Array.from(document.getElementById('lista-checkeds').children);
        const elementsList = Array.from(document.getElementById('lista-checkeds').children)
        .map(element => {
            let end = element.textContent.trimEnd().length - 49;
            return element.textContent.trimEnd().substring(0,end);
            
        });
        buscarinput.addEventListener('input',e =>{
            e.preventDefault();
            let value = e.target.value.toLowerCase();
            for (let i = 0; i < elementsList.length; i++) {
                let invisible =  elementsList[i].toLowerCase().includes(value);
                elementsHTMLCheck[i].classList.toggle('hide',!invisible);
            }
        })
              
        
    }


}


})();

(function(){

    const button = document.getElementById('button-generate-acta-final');
    if(button == null) return;
    button.addEventListener("click",convertPDF );
    function convertPDF(){
    let nombre = prompt('Ingrese un nombre para el archivo a descargar');
    if(nombre.length == 0) {
        alert("No se descargo el archivo");
        return
    }
    const HTML = document.getElementById('acta-final');
       let pdf =  html2pdf()
        .set({magin: 1,
              filename: nombre,
              image: {
                  type: 'jpeg',
                  quality: 0.98
              },
              html2canvas: {
                  scale: 3,
                  letterRendering: true,
              },
              jsPDF: {
                  unit: "in",
                  format: "a4",
                  orientation: 'portrait'
              },
              pagebreak: { mode: ['css', 'legacy']
            }
        })
        .from(HTML)
        .save()
        .catch(e => console.log(e))
        .finally()
        .then(alert("Se ha descargado correctamente"));
        console.log(pdf);
    }

    

})();
// const izq  = (window.outerWidth / 2) - 375;
// let referenciaObjetoVentana;
// const strCaracteristicasVentana = `height=750,width=750,left=${izq}`;

// function abrirPopupSolicitado() {
//   referenciaObjetoVentana = window.open("http://localhost", "fCC_WindowName", strCaracteristicasVentana);
// }

// abrirPopupSolicitado();

