
<div class="quiz-section">

<div class="quiz-section-problem" id="quiz-section-id">

    

    <h4 class="quiz-title">
   
    </h4>

    <h6 class="quiz-problem">

    If elements 74, 64, 93, 69, 68, 90 are inserted into an empty <br>
    binary search tree (BST) in that sequence, what is the element in the lowest level?

    </h6>

    <h5 class="quiz-hint">
      
    </h5>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="wrongAns-1">
        <label class="form-check-label" for="flexRadioDefault1">
            64
        </label>
        <i class="fas fa-times wrong-mark" id="quiz-wrong-mark-1"></i>
    </div>
    
    
    <div class="form-check <?php if($finished_quiz['finished'] == 1):?> <?php echo 'correct-quiz';?> <?php endif;?>" id="correct-quiz-content">
        
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="correctAns">
        <label class="form-check-label" for="flexRadioDefault1">
            68
        </label>
        <i class="fas fa-check quiz-check" id="quiz-check-mark"></i>
        <?php if($finished_quiz['finished'] == 1):?>
            <i class="fas fa-check quiz-check" id="quiz-check-mark" style="visibility: visible;"></i>
        <?php endif;?>
       
    </div>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="wrongAns-2">
        <label class="form-check-label" for="flexRadioDefault1">
            93
        </label>
        <i class="fas fa-times wrong-mark" id="quiz-wrong-mark-2"></i>
    </div>
        
    
    <?php if($finished_quiz['finished'] != 1):?>
        <input type="hidden" id="quiz_path" value="<?php echo $quiz_path;?>">
        <input type="hidden" id="score" value="<?php echo $user_score + 5;?>">
        <input type="hidden" id="user_id" value="<?php echo $user_id;?>">
        <input type="hidden" id="finished" value="1">
    <?php endif;?>

    <?php if($finished_quiz['finished'] != 1):?>
        <button class="btn btn-light quiz-btn" id="answer-quiz-btn" onclick="checkQuizAnswer()">Answer</button>
    <?php endif;?>
    <button class="btn btn-light quiz-btn" id="reset-quiz-btn" onclick="resetQuiz()" style="display:none">Reset</button>

    <div class="quiz-check-msg correct-message">

        <h5 class="correct-quiz-text" id="correct-message-text">
            👍You got it!👍
        </h5>

        <?php if($finished_quiz['finished'] == 1):?>
            <h5 class="correct-quiz-text correct-server-message">
                👍You got it!👍
            </h5>
        <?php endif;?>
    </div>

    <div class="quiz-check-msg correct-message">
    
        <h5 class="wrong-quiz-text" id="wrong-message-text">
            🤔Wrong, try again!🤔
        </h5>

    </div>

</div>



</div>


<script>

/*QUIZ SCRIPT*/

var correctQuizContainer = document.getElementById('correct-quiz-content');
var checkMark = document.getElementById('quiz-check-mark');
var wrongMarkOne = document.getElementById('quiz-wrong-mark-1');
var wrongMarkTwo = document.getElementById('quiz-wrong-mark-2');
var correctMsg = document.getElementById('correct-message-text');
var wrongMsg =  document.getElementById('wrong-message-text');
var quizBtn = document.getElementById('answer-quiz-btn');
var resetBtn = document.getElementById('reset-quiz-btn');

var quiz_path = $('#quiz_path').val();
var finished = $('#finished').val();
var score = $('#score').val();
var user_id = $('#user_id').val();

function checkQuizAnswer(){
 
    if(document.getElementById('correctAns').checked){
        
        correctQuizContainer.classList.add("correct-quiz"); 
        checkMark.style.visibility = "visible";
        correctMsg.style.display = "block";
        quizBtn.style.display = "none";
        $.ajax({
            url: "<?php echo BASE_URL . '/app/postQuiz.php';?>",
            method: "post",
            data: {quiz_path: quiz_path, finished: finished, score: score, user_id: user_id},
            success: function(){

              console.log('success');
            }
          
        });

    }
    else if(document.getElementById('wrongAns-1').checked){

        wrongMsg.style.display = "block";
        wrongMarkOne.style.visibility = "visible";
        quizBtn.style.display = "none";
        resetBtn.style.display = "block";
    }
    else if((document.getElementById('wrongAns-2').checked)){

        wrongMsg.style.display = "block";
        wrongMarkTwo.style.visibility = "visible";
        quizBtn.style.display = "none";
        resetBtn.style.display = "block";
    }

}

function resetQuiz(){

    wrongMsg.style.display = "none";
    
    if(wrongMarkOne.style.visibility == "visible"){

        wrongMarkOne.style.visibility = "hidden"
    }
    else if(wrongMarkTwo.style.visibility == "visible"){

        wrongMarkTwo.style.visibility = "hidden";
    }
    quizBtn.style.display = "block";
    resetBtn.style.display = "none";
    quizBtn.style.marginLeft = "0px";
}

checkQuizAnswer();

</script>

<style>

/*QUIZ SECTION*/

.quiz-section{

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

.quiz-img, .correct-ans-img{

    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-bottom: 20px;
    margin-top: 10px;
}

.quiz-problem{

    width: 75%;
    line-height: 1.6;
}

.quiz-hint{

    margin-top: 10px;
}

.form-check-label{

    font-size: 17px;
    margin-left: 10px;
    margin-top: 4px;
}


.form-check-input{

    width: 30px;
    height: 30px; 
}

.form-check-input:focus{

    outline: none;
    box-shadow: none;
}

.form-check-input:checked {
background-color: rgb(54,54,54);


}

.form-check-input:checked:after {
display: block;

}

.quiz-btn{

    margin-top: 30px;
    padding-left: 20px;
    padding-right: 20px;
    color: rgb(45,45,45);
    font-weight: 700;
}

#reset-quiz-btn{

    margin-left: 0px;
}

#answer-quiz-btn{

    margin-left: -25px;
}

/*CORRECT ANSWER SECTION CSS*/

.correct-ans-title{

    text-align: center;
}

.answer-quiz-btn{

    display: block;
    margin-left: auto;
    margin-right: auto;
}

/*IF ANSWER IS CORRECT*/

.correct-quiz{

    width: 50%;
    padding-top: 15px;
    padding-bottom: 15px;
    box-shadow: 0 0 8px #C7C7C7;
    /* border-radius: 2%; */
}

.correct-server-message{

    display: block;
}

.quiz-check, .wrong-mark{

    margin-top: auto;
    margin-bottom: auto;
    margin-left: 5%;
    font-size: 25px;
    visibility: hidden;
    
}

.quiz-check-msg {

    margin-top: 3%;
}

#correct-message-text, #wrong-message-text{

    display: none;
}
</style>