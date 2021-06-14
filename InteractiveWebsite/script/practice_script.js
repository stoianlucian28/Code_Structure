//transform: rotate(180deg);


//Getting html elements
var quiz_container = document.querySelectorAll('#practice-quiz-container-id');
var list_quizes_btn = document.querySelectorAll('#list-quizes-button-id');


//Listing or hiding all quizes from a respective course

// for(let i = 0; i < list_quizes_btn.length; i++){

//     list_quizes_btn[i].addEventListener('click', function(){
        
//         if(list_quizes_btn[i].classList.contains('list-off')){

//             quiz_container[i].style.display = "block";
//             list_quizes_btn[i].style.transform = "rotate(180deg)";
//             list_quizes_btn[i].classList.remove('list-off');

//         }
//         else{

//             quiz_container[i].style.display = "none";
//             list_quizes_btn[i].style.transform = "";
//             list_quizes_btn[i].classList.add('list-off');
//         }
    
//     });
// }


function toggleQuizList(button, container){

    var toggleBtn = document.getElementById(button);
    var containers = document.querySelectorAll(container);

    if(toggleBtn.classList.contains('list-off')){
           
        toggleBtn.style.transform = "rotate(180deg)";
        toggleBtn.classList.remove('list-off');
        for(let i = 0; i < containers.length; i++){

            containers[i].style.display = "block";
        }
    }
    else{

        toggleBtn.style.transform = "";
        toggleBtn.classList.add('list-off');
        for(let i = 0; i < containers.length; i++){

            containers[i].style.display = "none";
        }
      
    }   
}

