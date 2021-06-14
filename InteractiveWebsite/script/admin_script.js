/*Reusable functions*/

function toggleCheck(element){

    if(element.style.display == "none"){

        element.style.display = "block"
    }
    else{

        element.style.display = "none"
    }

}


/*
////////////////////////////////////

    Toggle image function

///////////////////////////////////
*/

function toggleImage(){

    var image = document.getElementById("image-form");
    toggleCheck(image);
    
}

toggleImage();


/*
////////////////////////////////////

    Toggle evaluation function

///////////////////////////////////
*/

function toggleEvaluation(){

    var element = document.getElementById("evaluation-form");
    toggleCheck(element);
    
}

toggleEvaluation();


/*
////////////////////////////////////

    Toggle interactive lessons functions

///////////////////////////////////
*/

function toggleInteractiveEx(){

    var iExInput = document.getElementById("toggle-iex");
    toggleCheck(iExInput);
}

toggleInteractiveEx();


/*
////////////////////////////////////

    Toggle image slider functions

///////////////////////////////////
*/

function toggleSlider(){

    var slider = document.getElementById("slider-form");
    toggleCheck(slider);
}

toggleSlider();