<?php

namespace MolinosForm\Controller;


use MolinosForm\Service\FeedbackService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController implements AdminControllerInterface
{
    /** @var  FeedbackService Сервис */
    protected $service;

    /**
     * @param FeedbackService $service
     */
    public function setService(FeedbackService $service)
    {
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    public function __construct(FeedbackService $service)
    {
        $this->setService($service);
    }
    
    public function indexAction(){
        $list = $this->getService()->getFeedbacks();
        $view = new ViewModel(['list' => $list]);
        return $view;
    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');
        $feedback = $this->getService()->getFeedback($id);

        $request = $this->getRequest();
        if ($request->isPost()){
            $answer = $this->getService()->saveAnswer($feedback, $request->getPost()->toArray());
            if ($answer){
                $view = new ViewModel(['title' => 'Ответ сохранен!', 'text' => 'Спасибо!']);
                $view->setTemplate('molinos-form/admin/result');
                return $view;
            }
        }
        $view = new ViewModel(['feed' => $feedback]);
        return $view;
    }

    public function removeAction()
    {
        $id = $this->params()->fromRoute('id');
        $result = $this->getService()->removeFeedback($id);

        $view = new ViewModel(['title' => 'Операция выполнена!', 'text' => 'Обращение удалено)))!']);
        $view->setTemplate('molinos-form/admin/result');
        return $view;
    }

}