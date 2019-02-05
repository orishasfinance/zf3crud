<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $table;

    public function __construct($table){
        $this->table = $table;
    }

    public function indexAction()
    {
        $posts = $this->table->fetchAll();
        return new ViewModel(['posts' => $posts]);
    }

    public function addAction(){
        $form = new \Post\Form\PostForm;
        $request = $this->getRequest();
        if (!$request->isPost()){
            return new viewModel(['form'=> $form]);
        }

        $post = new \Post\Model\Post();
        $form->setData($request->getPost());
        if (!$form->isValid()){
            exit('id is not correct');
        }

        $post->exchangeArray($form->getData());
        $this->table->saveData($post);
        return $this->redirect()->toRoute('post', [
            'controller' => 'index',
                'action' => 'add'
        ]);
    }

    public function viewAction(){
        return new viewModel();
    }

    public function editAction(){
        return new viewModel();
    }

    public function deleteAction(){
        return new viewModel();
    }
}
