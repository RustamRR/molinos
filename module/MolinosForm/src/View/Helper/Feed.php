<?php
/**
 * Created by PhpStorm.
 * User: Рустам
 * Date: 05.02.2017
 * Time: 20:29
 */

namespace MolinosForm\View\Helper;


use Zend\Form\View\Helper\AbstractHelper;

class Feed extends AbstractHelper
{
    public function __invoke($feed)
    {
        return $this->getRow($feed);
    }

    public function getFeed($data){
        $template = "<div class='col-md-6 col-xs-12'>%s</div>";
        $nameAndEmail = "<div class='topLineFeed'><strong>Имя: {$data["name"]}</strong>
            | <a href='mailto:{$data["email"]}'>{$data["email"]}</a></div>";
        $question = "<div class='questionLine'>Вопрос:<br>{$data["question"]}</div>";
        $image = "<div class='imageLine'><img width='450' src='/uploads/{$data["image"]}'></div>";
        $actions = "<div class='bottomLineActions'><a href='/admin/remove/{$data["id"]}'>Удалить</a> 
        | <a href='/admin'>Вернуться к списку</a> </div>";
        return sprintf($template, $nameAndEmail.$question.$image.$actions);
    }

    public function getAnswer($data){
        $template = "<div class='col-md-6 col-xs-12'>%s</div>";
        $content = "";
        if (!isset($data["answer"])){
            $openForm = "<form name='molinos_answer' role='form' method='POST' id='molinos_answer'>";
            $answerTextGroup = "<div class='form-group'><label><span>Ответ на обращение</span>
            <textarea name='answerText' id='answerText'></textarea></label></div>";
            $button = '<input type="submit" name="send" value="Отправить">';
            $closeForm = "</form>";
            $content = $openForm.$answerTextGroup.$button.$closeForm;
        }else{
            $answerBlock = "<div class='answerBlock'><strong>Ответ на обращение:</strong>
            <div class='answerText'>{$data["answer"]}</div></div>";
            $content = $answerBlock;
        }
        return sprintf($template, $content);
    }

    public function getRow($data){
        $template = "<div class='row'>%s</div>";
        return sprintf($template, $this->getFeed($data).$this->getAnswer($data));
    }
}