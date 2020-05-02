<?php
require_once 'functions.php';
require_once 'DBconnect.php';

function getQuestions($pdtID){
    $conn = connect();
    $sql=mysqli_query($conn, "SELECT * FROM project.questions INNER JOIN project.user ON questions.fk_user_id = user_id WHERE fk_product_id=".$pdtID);
    $questions = $sql ->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $questions;
}

function getAnswers($question_id){
    $conn = connect();
    $sql=mysqli_query($conn, "SELECT * FROM project.answers INNER JOIN project.user ON answers.fk_user_id = user_id WHERE fk_question_id=".$question_id);
    $answers = $sql ->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $answers;
}

function deleteQuestion($question_id,$userID){
    $conn = connect();
    $sql = "DELETE FROM questions WHERE question_id = $question_id";
    $res = mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}

function deleteAnswer($answers_id,$userID){
    $conn = connect();
    $sql = "DELETE FROM answers WHERE answers_id = $answers_id";
    $res = mysqli_query($conn, $sql);
    $conn->close();
    return $res;
}


function createQuestion($userID, $product_id,$question_msg){
    $conn = connect();
    $question_msg = clearString($question_msg);

    $sql = "INSERT INTO project.questions ( `fk_user_id`,`fk_product_id`, `question_msg`) VALUES('$userID', '$product_id','$question_msg')";
    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}

function createAnswer($userID,$question_id , $answer_msg){
    $conn = connect();
    $answer_msg = clearString($answer_msg);

    $sql = "insert into project.answers (`fk_user_id`, `fk_question_id`, `answer_msg`) VALUES ('$userID','$question_id','$answer_msg')";
    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}

function updateQuestion($userID, $question_id, $question_msg){
    $conn = connect();
    $question_msg = clearString($question_msg);

    $sql = "Update project.questions SET `question_msg`='$question_msg'  WHERE `question_id`=$question_id AND `fk_user_id`=$userID";
    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}

function updateAnswer($userID, $answer_id, $answer_msg){
    $conn = connect();
    $answer_msg = clearString($answer_msg);

    $sql = "Update project.answers SET `answer_msg`= '$answer_msg'  WHERE `answers_id`= $answer_id AND `fk_user_id`=$userID";
    $result = mysqli_query($conn, $sql);
    $conn->close();
    return $result;
}



?>
