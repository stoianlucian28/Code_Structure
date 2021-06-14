<div class="survey-container">

    <div class="survey-header">
        <span class="survey-num">1-</span>
        <p class="survey-question">How long have you been here ?</p>
       
    </div>

    <div class="survey-body">
        <div class="survey-image-container">
        
        </div>
        <div class="choices">

        </div>

        <div class="survey-footer">
            <div class="survey-buttons">

            </div>
        </div>

        <?php if($finished_practice_quiz['finished'] == 1):?>
            <div class="congrats-msg">
            
                <h3 class="congrats-text">
                
                🏆Congrats you solved this quiz!🏆 <br>
                If you feel like doing it again, you definetly can, <br>
                however you will not get more points from it.

                </h3>
            
            </div>
        <?php endif;?> 


        <?php if($finished_practice_quiz['finished'] != 1):?>
            <input type="hidden" id="practice_quiz_path" value="<?php echo $practice_quiz_path;?>">
            <input type="hidden" id="score" value="<?php echo $user_score + 20;?>">
            <input type="hidden" id="user_id" value="<?php echo $user_id;?>">
            <input type="hidden" id="finished" value="1">
        <?php endif;?>    

    </div>
</div>


<script>

const questionEl = document.querySelector('.survey-question');
const surveyNumEl = document.querySelector('.survey-num');
const choicesEl = document.querySelector('.choices');
const buttonEl = document.querySelector('.survey-buttons');
const containerEl = document.querySelector('.survey-container');
const imageContainerEl =  document.querySelector('.survey-image-container');

const survey = [
    {
        id: 1,
        question: 'How many oscars did the Titanic movie got?',
        choices: ['11', '9', '7', '8'],
        correctAnswer: '11',
        image: 'algorithm_robot.png',
        answer: null
    },
    {
        id: 2,
        question: 'Who was the first American in space?',
        choices: ['Alan Shepard', 'Yuri Gagarin', 'Tesla', 'Einstein'],
        correctAnswer: 'Alan Shepard',
        image: 'algorithm_robot.png',
        answer: null
    },
    {
        id: 3,
        question: 'What is a very cold part of Russia?',
        choices: ['Antarctica', 'Siberia', 'Grönland', 'Moskov'],
        correctAnswer: 'Siberia',
        image: 'problem_solving.png',
        answer: null
    }
];


const surveyState = {
    currentQuestion: 1
};


const navigateButtonClick = (e) => {
    if(e.target.id == 'next') {
        surveyState.currentQuestion++;
        initialSurvey();
    }

    if(e.target.id == 'prev') {
        surveyState.currentQuestion--;
        initialSurvey();
    }
}

const checkBoxHandler = (e, question) => {    
    //Check if the chekbox has selected before if it is remove selected
    if(!e.target.checked) {
        e.target.checked = false;
        question.answer = null;
        return;
    }
    
    const allCheckBoxes = choicesEl.querySelectorAll('input');
    allCheckBoxes.forEach(checkBox => checkBox.checked = false);
    e.target.checked = true;
    question.answer = e.target.value;  
}

const getResults = () => {
    const correctAnswerCount = survey.filter(question => question.answer == question.correctAnswer).length;
    const emptyQuestionCount = survey.filter(question => question.answer === null).length;
    const wrongQuestionCount = survey.filter(question => question.answer !== null && question.answer != question.correctAnswer).length;


    return {
        correct: correctAnswerCount,
        empty: emptyQuestionCount,
        wrong: wrongQuestionCount
    }
};

const getImages = () => {

    for(var i = 0; i < survey.length; i++){

        return {

            image: survey[i].image
        }
    }

};


var practice_quiz_path = $('#practice_quiz_path').val();
var finished = $('#finished').val();
var score = $('#score').val();
var user_id = $('#user_id').val();

const renderQuestion = (question) => {    
    //Last question of survey
    const lastQuestion = survey[survey.length - 1];

    //Check if the all questions are answered if then insert some message
    if(surveyState.currentQuestion > lastQuestion.id) {
        const results = getResults();
        containerEl.innerHTML = `<h1 class="test-completed">Good Job! You have completed the mini quiz</h1>
        <p class="results-info"> You have <strong>${results.correct}</strong> correct, <strong>${results.wrong}</strong> wrong, <strong>${results.empty}</strong> empty answers</p>                        
        <span class="tick"></span>`;
        if(results.correct == 3){

            $.ajax({
                url: "<?php echo BASE_URL . '/app/postPracticeQuiz.php';?>",
                method: "post",
                data: {practice_quiz_path: practice_quiz_path, finished: finished, score: score, user_id: user_id},
                success: function(){

                console.log('success');
                }
          
            });
        }

        return;
                                
    }

    // Clean innerHTML before append
    surveyNumEl.innerHTML = '';
    choicesEl.innerHTML = '';
    buttonEl.innerHTML = '';
    imageContainerEl.innerHTML = '';
    // Render question and question id
    surveyNumEl.textContent = question.id + '-';
    questionEl.textContent = question.question;

    // Render choices
    question.choices.forEach(choice => {
        
        imageContainerEl.innerHTML = `<img src="../images/${survey[question.id - 1].image}" alt="" class="img-fluid survey-image">`;
        
        const questionRowEl = document.createElement('p');
        questionRowEl.setAttribute('class','question-row');
        questionRowEl.innerHTML = `<label class="label">                                        
                                        <span class="choise">${choice}</span>
                                    </label>`;
        //Create checkbox input
        const checkBoxEl = document.createElement('input');
        checkBoxEl.setAttribute('type', 'checkbox');
        // Bind checkboxHandler with event and current question
        checkBoxEl.addEventListener('change', (e) => checkBoxHandler(e, question));
        //Add answer to the input as a value
        checkBoxEl.value = choice;
        //If question has answer already make it checked again
        if(question.answer === choice) {
            checkBoxEl.checked = true;
        }
        //Insert into question row
        questionRowEl.firstChild.prepend(checkBoxEl);
        //Insert row to the wrapper
        choicesEl.appendChild(questionRowEl);                                    
    });

    //Next & Previous Buttons
    const prevButton = document.createElement('button');
    prevButton.classList.add('btn');
    prevButton.classList.add('btn-light');
    prevButton.classList.add('survey-button');
    prevButton.classList.add('prev');
    prevButton.id = 'prev';
    prevButton.textContent = 'Previous';
    prevButton.addEventListener('click', navigateButtonClick);

    const nextButton = document.createElement('button');
    nextButton.classList.add('btn');
    nextButton.classList.add('btn-light');
    nextButton.classList.add('survey-button');
    nextButton.classList.add('next');
    nextButton.id = 'next';
    nextButton.textContent = 'Next';
    nextButton.addEventListener('click', navigateButtonClick);



    //Display buttons according to survey current question
    if(question.id == 1){        
        buttonEl.appendChild(nextButton);
    } else if (surveyState.currentQuestion == lastQuestion) {
        buttonEl.appendChild(prevButton);
    } else {
        buttonEl.appendChild(prevButton);
        buttonEl.appendChild(nextButton);
    }
      
};

const initialSurvey = () => {
    //Get the current question
    const currentQuestion = survey.find(question => question.id === surveyState.currentQuestion);
    // Render the currentQuestion
    renderQuestion(currentQuestion);   

};

initialSurvey();

</script>


<style>
.survey-container {
    width: 100%;
    color: #ffffff; 
    padding-top: 50px;
}


/* CONGRATS MESSAGE */

.congrats-text{

    color: #ffffff;
}

/* HEADER */

.survey-header {
    min-height: 50px;
    border-bottom: 1px solid #ddd;
    padding: 15px 20px 10px 20px;
    display: flex;
    align-items: center;
}

.survey-num {
    font-weight: bold;
    font-size: 15px;
    font-size: 18px;
    margin-right: 8px;
}

.survey-question {
    padding-top: 13px;
    font-size: 20px;
}


/* BODY */

.survey-image-container{

    float: right;
}

.survey-image{

    width: 500px;
    height: 300px;
    padding-bottom: 20px;
    padding-right: 20px;
}

.choices {
    padding: 20px;
    margin-top: 40px;
    display: flex;
    flex-direction: column;
    font-size: 20px;
}

.question-row {
    margin-bottom: 15px;
}

.label {
    display: flex;
}

.label input[type="checkbox"] {
    vertical-align: sub;
    margin-right: 20px;
    align-self: center;
    transform: scale(2);
}


/* FOOTER */

.survey-footer {
    padding: 20px;
    padding-top: 0;
}

.survey-button {
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 5px;
    border:none;
    background: #fff;
    margin-right: 7px;
    cursor: pointer;
    box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.6);
    font-weight: 500;
}

/* TEST COMPLETE */

h1.test-completed {
    font-size: 20px;
    text-align: center;
    margin-top: 50px;
    font-weight: 400;
}

.tick {    
    position: relative;
    display: block;
    margin: 20px auto;     
    /* margin-top: 30px; */
    border: 1px solid green;
    width: 60px;
    height: 60px;
    border-radius: 50%;
}

.tick::before {
    content: '';
    position: absolute;
    top: 16%;
    left: 35%;
    transform: translate(-50%, -50%);
    width: 16px;
    height: 32px;
    border-style: solid;
    border-color: green;
    border-width: 0 4px 4px 0;
    transform: rotate(45deg);
}

.results-info {
    text-align: center;
    margin-top: 20px;
}



</style>