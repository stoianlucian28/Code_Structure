<div class="interactive-lesson-section">

    <div class="interactive-lesson" id="test-div">

        <div class="interactive-top-section">
        
            <div class="exercise-question">
            
                <h5 class="introduction">
                
                Construct an algorithm so that, when the algorithm finishes, the <br>
                variable total will contain the sum of all the numbers <br>
                present in the array

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

            <div class="wrongAnswer" id="wrongAnsId">
                <h3 class="tryAgain">🤔Wrong, try again!🤔</h3>
            </div>

            <div class="correctAnswer" id="correctAnsId">
                <h3 class="youGotIt">👍You got it!👍</h3>
            </div>
                
            <div class="reset-exercise">
                
                <h5 class="reset-btn" id="resetBtnId" onclick="reset()"><i class="fas fa-redo-alt reset-icon"></i>Reset</h5>

            </div>

        </div>
        
    </div>

    <div class="interactive-exercise">
        
            <!-- <div class="box" draggable="true" style="background-color: #ffffff;" id="box-a"><span>A</span></div>
            <div class="box" draggable="true" style="background-color: #ffffff;" id="box-b"><span>B</span></div>
            <div class="box" draggable="true" style="background-color: #ffffff;" id="box-c"><span>C</span></div>
            <div class="box" draggable="true" style="background-color: #ffffff;" id="box-d"><span>D</span></div>
            <div class="box" draggable="true" style="background-color: #ffffff;" id="box-e"><span>E</span></div> -->

        
     </div>

    <div class="verifyExercise">

          
      <?php if($finished_ex['finished'] != 1):?>          
        <input type="hidden" id="exercise_path" value="<?php echo $exercise_path;?>">
        <input type="hidden" id="score" value="<?php echo $user_score + 10;?>">
        <input type="hidden" id="user_id" value="<?php echo $user_id;?>">
        <input type="hidden" id="finished" value="1">
      <?php endif;?>
    
    
        <button class="btn btn-light check-btn" onclick="isCorrect()">Check answer</button>

    </div>

</div>

<script>

// const boxElements = document.querySelectorAll(".box");
const elementsContainer = document.querySelector(".interactive-exercise");
const wrongAnswer = document.getElementById('wrongAnsId');
const correctAnswer = document.getElementById('correctAnsId');
const resetBtn = document.getElementById('resetBtnId');
let boxElements;
const boxArray = [

    {
        id: "addition",
        text: "total += num[i]"
    },

    {
        id: "for",
        text: "for i from 1 to n"
    },

    {
        id: "set_total",
        text: "total = 0"
    },

    {
        id: "display",
        text: "display total"
    }
    
];

var isMatching = [

    {
        id: "set_total"
    },

    {
        id: "for"
    },

    {
        id: "addition"
    },

    {
        id: "display"
    }
];


initiateExercise();

function initiateExercise(){

       for(let i = 0; i < boxArray.length; i++){

        elementsContainer.insertAdjacentHTML("beforeend", 
        

            `<div class="box" draggable="true" style="background-color: #ffffff;" id="${boxArray[i].id}"><span>${boxArray[i].text}</span></div>`
        );
    }

    boxElements = document.querySelectorAll(".box");

    boxElements.forEach(elem => {
    elem.addEventListener("dragstart", dragStart);
    // elem.addEventListener("drag", drag);
    elem.addEventListener("dragend", dragEnd);
    elem.addEventListener("dragenter", dragEnter);
    elem.addEventListener("dragover", dragOver);
    elem.addEventListener("dragleave", dragLeave);
    elem.addEventListener("drop", drop);
    });

}


// Drag and Drop Functions

function dragStart(event) {
  event.target.classList.add("drag-start");
  event.dataTransfer.setData("text", event.target.id);
}

function dragEnd(event) {
  event.target.classList.remove("drag-start");
}

function dragEnter(event) {
  if(!event.target.classList.contains("drag-start")) {
    event.target.classList.add("drag-enter");
  }
}

function dragOver(event) {
  event.preventDefault();
}

function dragLeave(event) {
  event.target.classList.remove("drag-enter");
}


function drop(event) {
  event.preventDefault();
  event.target.classList.remove("drag-enter");
  const draggableElementId = event.dataTransfer.getData("text");
  const droppableElementId = event.target.id;
  
  if(draggableElementId !== droppableElementId) {

    const draggableElement = document.getElementById(draggableElementId);
    
    const droppableElementBgColor = event.target.style.backgroundColor;
    const droppableElementTextContent = event.target.querySelector("span").textContent;
    event.target.style.backgroundColor = draggableElement.style.backgroundColor;
    event.target.querySelector("span").textContent = draggableElement.querySelector("span").textContent;
    event.target.id = draggableElementId;
    draggableElement.style.backgroundColor = droppableElementBgColor;
    draggableElement.querySelector("span").textContent = droppableElementTextContent;
    draggableElement.id = droppableElementId;
  }

}



function isCorrect(){  
        
    var boxes = document.querySelectorAll('.box');   
    var correct = 0;

    for(var i = 0; i < isMatching.length; i++){

        if(isMatching[i].id == boxes[i].id){

            correct += 1;
        }
        else{

            correct = 0;
        }
    }

    if(correct != 4){

        for(let i = 0; i < boxElements.length; i++){

            boxElements[i].style.borderColor = "red";
            boxElements[i].style.boxShadow = "0px 10px 3px -1px red";
            wrongAnswer.style.display = "block";
        }
    }
    else{
        for(let i = 0; i < boxElements.length; i++){

            boxElements[i].style.borderColor = "green";
            boxElements[i].style.boxShadow = "0px 10px 3px -1px green";
            correctAnswer.style.display = "block";
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
}


function reset(){

    wrongAnswer.style.display = "none";
    while (elementsContainer.firstChild) elementsContainer.removeChild(elementsContainer.firstChild);
    initiateExercise();
}

</script>

<style>


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

.interactive-exercise{

    display: table;
    margin: 0 auto;
}

.box {

  width: 200px;
  height: 50px;
  border: 3px solid #000000;
  color: #000000 !important;
  border-radius: 0.5rem;
  margin: 1.25rem;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  font-size: 15px;
  font-weight: bold;
  user-select: none;
  cursor: move;
  transition: 0.5s;
  box-shadow: 0px 10px 3px -1px #000000;
}
.box span {
  pointer-events: none;
}

/* Drag and Drop Related Styling */

.drag-start {
  opacity: 0.4;
}
.drag-enter {
  border-style: dashed;
}
.box:nth-child(odd).drag-enter {
  transform: rotate(15deg);
}
.box:nth-child(even).drag-enter {
  transform: rotate(-15deg);
}
.box:nth-child(odd).drag-start {
  transform: rotate(15deg) scale(0.75);
}
.box:nth-child(even).drag-start {
  transform: rotate(-15deg) scale(0.75);
}

@media (max-width: 600px) {
  html { 
    font-size: 14px; 
  }
  .box {
    width: 4rem; 
    height: 4rem; 
    font-size: 2rem;
    margin: 0.5rem;
  }
}


.exercise-question{
  
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

#wrongAnsId, #correctAnsId{

    display: none;
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