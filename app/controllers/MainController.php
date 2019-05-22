<?php
class MainController extends Controller{

    public function action_index(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $action = filter_input(INPUT_POST,'action');
            //send form
            if($action == 'data'){
                $name = filter_input(INPUT_POST,'name');
                $surname = filter_input(INPUT_POST,'surname');
                $phone = filter_input(INPUT_POST,'phone');
                if(preg_match('/^[\D][^\n]+/',$name) && preg_match('/^[\D][^\n]+/',$surname) && preg_match('/^[\+\d]{8,15}/',$phone)){
                    $_SESSION['name'] = $name;
                    $_SESSION['surname'] = $surname;
                    $_SESSION['phone'] = $phone;
                    header('Location: ' . '/main/address');
                }else{
                    //some errors
                    $this->view->error = 'incorrect field';
                    $this->view->page = 'page_step1';
                    $this->view->render();
                }
            }else if($action == 'back'){
                //previous step
                $this->view->page = 'page_step1';
                $this->view->render();
            }
        //if window was closed but some information was input    
        } else if($_SESSION['name']!='' && $_SESSION['surname']!='' && $_SESSION['phone']!=''){
            if($_SESSION['address']!=''){
                if($_SESSION['comment']!=''){
                    header('Location: '. '/main/result');
                }else{
                    header('Location: ' . '/main/comment');
                }
            }else{
                header('Location: ' . '/main/address');
            }
        }else{
            //render step1
            $this->view->page = 'page_step1';
            $this->view->render();
        }
    }

    public function action_address(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $action = filter_input(INPUT_POST,'action');
            //send form
            if($action == 'data'){
                //if user missed first step
                if($_SESSION['name']=='' || $_SESSION['surname']=='' || $_SESSION['phone']==''){
                    header('Location: ' . '/main/index');
                }else{
                    $street = filter_input(INPUT_POST,'street');
                    $house = filter_input(INPUT_POST,'house');
                    $city = filter_input(INPUT_POST,'city');
                    if($street !== '' && $house !== '' && $city !== ''){
                        $_SESSION['street'] = $street;
                        $_SESSION['house'] = $house;
                        $_SESSION['city'] = $city;
                        header('Location: ' . '/main/comment');
                    }else{
                        //some errors
                        $this->view->error = 'empty field';
                        $this->view->page = 'page_step2';
                        $this->view->render();
                    }
                }
            }else if($action == 'back'){
                //previous step
                $this->view->page = 'page_step2';
                $this->view->render();
            }
        //if window was closed but some information was input  
        }else if($_SESSION['street']!='' && $_SESSION['house']!='' && $_SESSION['city']!=''){
            if($_SESSION['comment']!=''){
                header('Location: '. '/main/result');
            }else{
                header('Location: ' . '/main/comment');
            }
        }else{
            //render step2
            $this->view->page = 'page_step2';
            $this->view->render();
        }
    }
        
    public function action_comment(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //if user missed some steps
            if($_SESSION['name']=='' || $_SESSION['surname']=='' || $_SESSION['phone']==''){
                header('Location: ' . '/main/index');
            }else if($_SESSION['street']=='' || $_SESSION['house']=='' || $_SESSION['city']==''){
                header('Location: ' . '/main/address');
            }else{
                //save comment in session
                $comment = filter_input(INPUT_POST,'comment');
                $_SESSION['comment'] = $comment;

                //save user
                $this->model = new MainModel();
                $address = $_SESSION['street'].' '.$_SESSION['house'].' '.$_SESSION['city'];
                $this->model->addUser($_SESSION['name'],$_SESSION['surname'],$_SESSION['phone'],$address,$_SESSION['comment']);

                header('Location: '. '/main/result');
            }
        }else if($_SESSION['comment']!=''){
            header('Location: '. '/main/result');
        }else{
            $this->view->page = 'page_step3';
            $this->view->render();
        }
    }

    public function action_result(){
        if($_SESSION['name']=='' || $_SESSION['surname']=='' || $_SESSION['surname']==''){
            header('Location: ' . '/main/index');
        } else if($_SESSION['street']=='' || $_SESSION['house']=='' || $_SESSION['city']==''){
            header('Location: ' . '/main/address');
        }
        //desroy session
        session_destroy();
        $this->view->page = 'page_result';
        $this->view->render();
    }
}