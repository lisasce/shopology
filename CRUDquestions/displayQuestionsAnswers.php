<?php
ob_start();
session_start();
require_once '../DBandFunc/DBaccessQuestion.php';
require_once '../DBandFunc/functions.php';
if(!isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superAdmin'])) {
    header("Location: ../index.php");
    exit;
}
$userID = getUserIDfromSession();


if($_GET['id']){
    $product_id = $_GET['id'];
}


echo ' <textarea class ="form-control" type="text" name="question_msg" id="question_msg" placeholder ="Enter your question:" value="" maxlength ="200" rows="5" cols="10"></textarea><button class="btn btn-dark text-info mb-3 mt-3" type="button" data-url_id="'.$product_id.'" id="askBtn" >Ask</button>';

echo ' <div class="pacifico h4 mt-5 mb-3 text-warning">Q & A : </div>';
$questionArray= getQuestions($product_id);


foreach ($questionArray as $question){
    $question_id = $question['question_id'];
    $answerArray= getAnswers($question_id);

    $buttonDel = '';
    $buttonEdit = '';
    $buttonDel2 = '';
    $buttonEdit2 = '';

    $userAllowedQ = $question['fk_user_id'] == $userID;


    if(isset($_SESSION['admin']) || isset($_SESSION['superAdmin']) || $userAllowedQ ) {
        $buttonDel = "<a class='btn btn-dark text-danger' href='../CRUDquestions/deleteQuestion.php?id=".$question['question_id']."'>Delete</a>";
    } else {
        $buttonDel = '';
    }

    if( $userAllowedQ ) {
        $buttonEdit = "<button class='editBtn btn btn-dark text-warning mr-2' data-quest_id=".$question['question_id']."'>Edit</button>";
    } else {
        $buttonEdit = '';
    }

    echo "<div class='alert alert-warning row d-flex justify-content-between mt-3' role='alert'>
                <div class='text-break'>".$question['first_name'].': '.$question['question_msg']."</div>
                <div><button class='showAnswers btn btn-dark text-info mr-2 '>Answers:</button>".  $buttonEdit . $buttonDel . "</div>
                <div class='col-12 mt-2 hiddenForm emptyDivForUpdatingEntry ml-auto text-center'>
                    <textarea class=' form-control mx-auto w-75' name='editQuest'  placeholder ='' maxlength ='150' rows='5'>".$question['question_msg']."</textarea><button class='updateQBtn btn btn-dark text-success mb-3 mt-3' type='button' data-quest_id='".$question_id."'  >Update</button>
                </div>
          </div><div class='answersDiv hiddenForm'>";
//answerDiv is the hidden div that comes when you toogle btn answers
   foreach ($answerArray as $answer){
       $userAllowedA = $answer['fk_user_id'] == $userID;
       if(isset($_SESSION['admin']) || isset($_SESSION['superAdmin']) || $userAllowedA ) {
           $buttonDel2 = "<a class='btn btn-dark text-danger' href='../CRUDquestions/deleteAnswer.php?id=".$answer['answers_id']."'>Delete</a>";
       } else {
           $buttonDel2 = '';
       }

       if( $userAllowedA ) {
           $buttonEdit2 = "<button class='editBtn btn btn-dark text-warning mr-2' data-ans_id=".$answer['answers_id']."'>Edit</button>";
       } else {
           $buttonEdit2 = '';
       }




        echo "<div class='alert alert-secondary text-primary row d-flex justify-content-between ml-5' role='alert'><div>".$answer['first_name'].': '.$answer['answer_msg']."</div><div>".  $buttonEdit2 . $buttonDel2 . "</div><div class='col-12 mt-2 hiddenForm emptyDivForUpdatingEntry ml-auto text-center'> 
                    <textarea class=' answer_msg form-control mx-auto w-75' name='editQuest'  placeholder ='' maxlength ='150' rows='5'>".$answer['answer_msg']."</textarea><button class='updateABtn btn btn-dark text-success mb-3 mt-3' type='button' data-ans_id='".$answer['answers_id']."'  >Update</button>
                </div></div>";}

    echo ' <textarea class ="answer_msg form-control ml-5 w-75" type="text" name="answer_msg"  placeholder ="Enter your answer:" value="" maxlength ="150" rows="5" cols="10"></textarea><button class="answerBtn ml-5 btn btn-dark text-success mb-3 mt-3" type="button" data-quest_id="'.$question_id.'"  >Add answer</button>';

   echo '</div>';
}
?>
<?php  ob_end_flush(); ?>


