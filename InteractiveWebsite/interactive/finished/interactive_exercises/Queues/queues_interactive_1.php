<div class="interactive-lesson-section">

    <div class="interactive-lesson" id="test-div">

        <div class="interactive-top">
        
            <div class="interactive-exercise">
            
                <h5 class="introduction">
                
                The thing that you have to do with the following stack <br>
                is to remove one element from it and to add two new ones.

                </h5>

                <ul class="indications">
                
                  
                
                </ul>
            
            </div>
    
            <?php if($finished_ex['finished'] == 1):?>
              <div class="correctAnswer">
                  <h5 class="youGotIt">
                  🏆You already solved this exercise!🏆 <br>
                    But you can always solve it again!
                  </h5>
              </div>
            <?php endif;?>

            <div class="correctAnswer" id="correctAnsId" style="display:none;">
                <h3 class="youGotIt">👍You got it!👍</h3>
            </div>
           
            <div class="wrongAnswer" id="wrongAnsId" style="display:none;">
              <h3 class="tryAgain">🤔Wrong, try again!🤔</h3>
            </div>

        
            
            <div class="reset-exercise">
              
              <h5 class="reset-btn" id="resetBtnId" onclick="resetBtnClick()"><i class="fas fa-redo-alt reset-icon"></i>Reset</h5>

            </div>
            
           
        
        </div>

        <div class="draggable-container">
        <!-- 
            <div class="draggable-zone">

                <div class="draggable" id="red" draggable="true" style="background-color:red;"></div>

            </div>

            
            
            <div class="draggable-zone">

                <div class="draggable" id="yellow" draggable="true" style="background-color:yellow;"></div>

            </div>

            <div class="draggable-zone">

                <div class="draggable" id="orange" draggable="true" style="background-color:orange;"></div>

            </div> -->

        
        </div>

        <div class="block drop-zone-container">
          
            <!-- <div class="drop-zone" id="fit-zone" data-draggable-id="red">
            
            </div>
            <div class="drop-zone" id="fit-zone" data-draggable-id="yellow">

            </div>
            <div class="drop-zone" id="fit-zone" data-draggable-id="orange">
            
            </div> -->
        
        </div>
    
    </div>

    
    <?php if($finished_ex['finished'] != 1):?>          
      <input type="hidden" id="exercise_path" value="<?php echo $exercise_path;?>">
      <input type="hidden" id="score" value="<?php echo $user_score + 10;?>">
      <input type="hidden" id="user_id" value="<?php echo $user_id;?>">
      <input type="hidden" id="finished" value="1">
    <?php endif;?>
    
    <button class="btn btn-light check-btn" id="isDisabled" onclick="verifyExercise()">Check answer</button>
    
    
 
</div>

<script>

let draggableItems = document.querySelector(".draggable-container");
const matchingPairs = document.querySelector(".drop-zone-container");
let draggableElements;
let droppableElements;
const resetBtn = document.getElementById('resetBtnId');
const submitBtn = document.getElementById('isDisabled');
const dropZone = document.getElementsByClassName('drop-zone');
const correctAns = document.getElementById('correctAnsId');
const wrongAns = document.getElementById('wrongAnsId');
submitBtn.disabled = true;

const divs = [

  {
    imgName: "2"
  },

  {
    imgName: "3"
  },

  {
    imgName: "1"
  },

  {
    imgName: "4"
  }

];

var alreadydropped = new Array();
var droppedid = new Array();
var correctOrder = [

  {
    imgName: "1"
  },

  {
    imgName: "2"
  },

  {
    imgName: "3"
  },

  {
    imgName: "4"
  },

];

initiateExercise();

function initiateExercise(){

  for(let i = 0; i < divs.length; i++){

    draggableItems.insertAdjacentHTML("beforeend", 
    
      `<div class="draggable-zone">
        <img src="<?php echo BASE_URL . '/interactive/images/queues/interactive_1/';?>${divs[i].imgName}.png" class="draggable img-fluid" id="${divs[i].imgName}" draggable="true">
      </div>`

    );
  }

  for(let i = 0; i < divs.length; i++){

    matchingPairs.insertAdjacentHTML("beforeend",
    
      `<div class="drop-zone" id="fit-zone" data-draggable-id="${divs[i].divName}"></div>`
    
    );
  }

  draggableElements = document.querySelectorAll(".draggable");
  droppableElements = document.querySelectorAll(".drop-zone");

  
  draggableElements.forEach(elem => {
    elem.addEventListener("dragstart", dragStart); 
  });

  droppableElements.forEach(elem => {
    elem.addEventListener("dragenter", dragEnter);
    elem.addEventListener("dragover", dragOver); 
    elem.addEventListener("dragleave", dragLeave); 
    elem.addEventListener("drop", drop);
  });
}

function dragStart(event) {
  event.dataTransfer.setData("text", event.target.id); // or "text/plain" but just "text" would also be fine since we are not setting any other type/format for data value
}

function dragEnter(event) {
  if(!event.target.classList.contains("dropped")) {
    event.target.classList.add("droppable-hover");
  }
}

function dragOver(event) {
  if(!event.target.classList.contains("dropped")) {
    event.preventDefault(); // Prevent default to allow drop
  }
}

function dragLeave(event) {
  if(!event.target.classList.contains("dropped")) {
    event.target.classList.remove("droppable-hover");
  }
}

function areFieldsEmpty(){

  if(alreadydropped.length == 4){

    submitBtn.disabled = false;

  }

}

function drop(event) {

  event.preventDefault(); // This is in order to prevent the browser default handling of the data
  event.target.classList.remove("droppable-hover");
  const draggableElementData = event.dataTransfer.getData("text"); // Get the dragged data. This method will return any data that was set to the same type in the setData() method
  const droppableElementData = event.target.getAttribute("data-draggable-id");
  alreadydropped.push(draggableElementData);
  droppedid.push(droppableElementData);
  areFieldsEmpty();

  const draggableElement = document.getElementById(draggableElementData);
  event.target.classList.add("dropped");
  // event.target.style.backgroundColor = draggableElement.style.color; // This approach works only for inline styles. A more general approach would be the following: 
  draggableElement.classList.add("dragged");
  draggableElement.setAttribute("draggable", "false");
  event.target.insertAdjacentHTML("afterbegin", `<img src="<?php echo BASE_URL . '/interactive/images/queues/interactive_1/';?>${draggableElementData}.png" class="${draggableElementData} img-fluid"/>`);

}


function verifyExercise(){

    var correct = 0;

    for(var i = 0; i < alreadydropped.length; i++){

        if(correctOrder[i].imgName == alreadydropped[i]){

          correct += 1;
        }
        else{

          correct = 0;
        }
    }

    console.log(correct);

    if(correct != 5){

     for(let i = 0; i < dropZone.length; i++){

            dropZone[i].style.borderColor = "red";
        }

        wrongAns.style.display = "block";
    }
    else{

        for(let i = 0; i < dropZone.length; i++){

            dropZone[i].style.borderColor = "#00FF00";
        }

        correctAns.style.display = "block";
        resetBtn.style.display = "none";

        var exercise_path = $('#exercise_path').val();
        var finished = $('#finished').val();
        var score = $('#score').val();
        var user_id = $('#user_id').val();

        $.ajax({
            url: "<?php echo BASE_URL . '/app/postExercise.php';?>",
            method: "post",
            data: {exercise_path: exercise_path, finished: finished, score: score, user_id: user_id},
            success: function(){

              console.log('success');
            }
          
        });

        

    }
    
}

function resetBtnClick(){

  submitBtn.disabled = true;
  alreadydropped = [];
  droppedid = [];
  wrongAns.style.display = "none";
  while (draggableItems.firstChild) draggableItems.removeChild(draggableItems.firstChild);
  while (matchingPairs.firstChild) matchingPairs.removeChild(matchingPairs.firstChild);
  initiateExercise();

}



</script>

<style>

.interactive-exercise{
  
  margin-top: 20px;
  margin-bottom: 20px;
  border: 1px solid #fff;
}

.introduction{

  margin-top: 10px;
  margin-left: 18px;
}

.indications li{

  list-style-type: disc; 
}

.reset-btn{

  margin-top: 10px;
}

.reset-icon{

  margin-right: 5px;
  transition: 0.3s ease-in-out;
}

.reset-btn, .reset-icon{

  cursor: pointer;
}

.reset-btn:hover .reset-icon{

  transform: rotate(200deg);
}

.draggable-container, .drop-zone-container{

    display: table;
    margin: 0 auto;
}

.drop-zone-container{

    margin-top: 20px;
}

.draggable-zone, .drop-zone{

    display: inline-block;
    width: 120px;
    height: 120px;
    margin: 4px;
    padding: 2px;
    border: 3px solid #ffffff;
}

.interactive-lesson-section{
    
    color: #ffffff;
    margin-top: 30px;
    background-color: rgb(54,54,54);
    border-radius: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 10px;
    padding-right: 10px;
    position: relative;
    transition: transform 0.6s;
    transform-style: preserve-3d;

}

.drop-zone{

    border: 4px dashed #ffffff;
    transition: border-width 0.2s, transform 0.2s, background-color 0.4s;

}

.draggable{

    width: 110px;
    height: 110px;
    cursor: move;
   transition: opacity 0.2s;
}



.draggable:hover {
  opacity: 0.5;
}

.drop-zone.droppable-hover {
  /* background-color: #bee3f0; */
  border-width: 5px;
  transform: scale(1.1);
}

.drop-zone.dropped {
  border-style: solid;
}

.draggable.dragged {
  user-select: none;
  opacity: 0.1;
  cursor: default;
}

.check-btn{

  display: block;
  margin-top: 30px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 80px;
  padding-right: 80px;
  font-weight: 700;
  color: rgb(45, 45, 45);
  
}

</style>
