<?php
/**
 * Created by PhpStorm.
 * User: Рустам
 * Date: 05.02.2017
 * Time: 19:43
 */

namespace MolinosForm\View\Helper;


use MolinosForm\Entity\Feedback;
use Zend\Form\View\Helper\AbstractHelper;

class Grid extends AbstractHelper
{
    public function __invoke($data)
    {
        return $this->getRows($data);
    }

    public function getRow($rowData){
        $template = "<div class='row'>%s</div><hr>";
        $name = "<div class='col-md-4'>{$rowData["name"]}</div>";
        $question = "<div class='col-md-4'>{$rowData["question"]}</div>";
        $actions = "<div class='col-md-4'><a href='admin/view/{$rowData["id"]}'>Подробнее/Ответ</a><br>
            <a href='admin/remove/{$rowData["id"]}'>Удалить</a></div>";
        return sprintf($template, $name.$question.$actions);
    }

    public function getRows($data){
        $rows = "";
        foreach ($data as $row){
            $rows.= $this->getRow($row);
        }
        return $rows;
    }
}