<?php

namespace App;

use PHPUnit\Util\Exception;

class Quiz
{
    protected Questions $questions;

    protected $currentQuestion = 1;

    public function __construct()
    {
        $this->questions = new Questions();
    }

    public function addQuestion(Question $question)
    {
        $this->questions->add($question);
//        $this->questions[] = $question;
    }

    public function begin()
    {
        return $this->nextQuestion();
    }

    public function nextQuestion()
    {
        return $this->questions->next();
//        if (!isset($this->questions[$this->currentQuestion - 1])) {
//            return false;
//        }
//
//        $question =  $this->questions[$this->currentQuestion - 1];
//
//        $this->currentQuestion++;
//
//        return $question;
    }

    public function questions()
    {
        return $this->questions;
    }

    public function isComplete()
    {
        return count($this->questions->answered()) === $this->questions->count();
    }

    public function grade()
    {
        // if the quiz has not yet been completed
        // throw an exception

        if (!$this->isComplete()) {
            throw new Exception("This quiz has not yet been completed");
        }

        $correct = count($this->questions->solved());

        return ($correct / $this->questions->count()) * 100;
    }

//    public function correctlyAnsweredQuestions()
//    {
//        return array_filter(
//            $this->questions,
//            fn($question) => $question->solved()
//        );
//    }
}