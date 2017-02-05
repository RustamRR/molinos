<?php

namespace MolinosForm\Controller;

use MolinosForm\Entity\Feedback;
use MolinosForm\Form\FeedbackForm;
use MolinosForm\Service\FeedbackService;
use Zend\File\Transfer\Adapter\Http;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Validator\File\Size;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package MolinosForm\Controller
 */
class IndexController extends AbstractActionController
{
    /** @var FeedbackService  */
    protected $feedbackService;

    public function indexAction()
    {
        $request = $this->getRequest();
        
        $form = $this->getServiceLocator()
            ->get('formElementManager')
            ->get(FeedbackForm::class, 'form', []);

        $form->setHydrator(new \Zend\Stdlib\Hydrator\ArraySerializable());
        $form->bind(new Feedback());

        if($request->isPost()){

            //$dataForm = $request->getPost()->toArray();
            //$fileData = $request->getFiles()->toArray();
            $dataForm = array_replace_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $file = $this->params()->fromFiles('feedback');
            $form->setData($dataForm);

            if ($form->isValid()){

                $data = $form->getData();

                $size = new Size(array('max' => 10194304));
                $extensionvalidator = new \Zend\Validator\File\Extension(array('extension'=>array('jpg','png')));

                $adapter = new Http();

                $adapter->setValidators(array($size));
                $adapter->setValidators(array($extensionvalidator));

                if ($adapter->isValid()) {
                    $adapter->setDestination(dirname(__DIR__) . '../../../../public/uploads');
                    if($adapter->receive($file['image']['name'])){
                        $image = $this->getService()->saveFile($data->getImage());
                        $data->setImage($image);
                        $this->getService()->saveFeedback($data);

                        $view = new ViewModel(['title' => 'Обращение сохранено!', 'text' => 'Спасибо!']);
                        $view->setTemplate('molinos-form/index/result');
                        return $view;
                    }
                }else{
                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach($dataError as $key=>$row)
                    {
                        $error[] = $row;
                    }
                    $form->setMessages(array('fileupload'=>$error ));
                }
            }else{
                $form->getMessages();
                $view = new ViewModel([
                    'title' => 'Форма обратной связи',
                    'form' => $form
                ]);
                return $view;
            }
        }

        $view = new ViewModel([
            'title' => 'Форма обратной связи',
            'form' => $form
        ]);

        return $view;
    }

    /**
     * @return FeedbackService
     */
    public function getService()
    {
        return $this->feedbackService;
    }

    /**
     * IndexController constructor.
     * @param FeedbackService $feedbackService
     */
    public function __construct(FeedbackService $feedbackService)
    {
        $this->feedbackService = $feedbackService;
    }
}
