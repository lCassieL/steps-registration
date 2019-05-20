<?php
class MainController extends Controller{

    public function action_index(){
        // if($_SESSION['name']!='' && $_SESSION['surname']!='' && $_SESSION['phone']!=''){
        //     if($_SESSION['address']!=''){
        //         if($_SESSION['comment']!=''){
        //             header('Location: '. '/main/result');
        //         }else{
        //             header('Location: ' . '/main/comment');
        //         }
        //     }else{
        //         header('Location: ' . '/main/address');
        //     }
        // }
        // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //     $name = filter_input(INPUT_POST,'name');
        //     $surname = filter_input(INPUT_POST,'surname');
        //     $phone = filter_input(INPUT_POST,'phone');
        //     $_SESSION['name'] = $name;
        //     $_SESSION['surname'] = $surname;
        //     $_SESSION['phone'] = $phone;
        //     header('Location: ' . '/main/address');
        // }else{
        //     $this->view->page = 'page_step1';
        //     $this->view->render();
        // }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $action = filter_input(INPUT_POST,'action');
            if($action == 'data'){
                $name = filter_input(INPUT_POST,'name');
                $surname = filter_input(INPUT_POST,'surname');
                $phone = filter_input(INPUT_POST,'phone');
                $_SESSION['name'] = $name;
                $_SESSION['surname'] = $surname;
                $_SESSION['phone'] = $phone;
                header('Location: ' . '/main/address');
            }else if($action == 'back'){
                $this->view->page = 'page_step1';
                $this->view->render();
            }
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
            $this->view->page = 'page_step1';
            $this->view->render();
        }
    }

    public function action_address(){

    //     if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         if($_SESSION['name']=='' || $_SESSION['surname']=='' || $_SESSION['phone']==''){
    //             header('Location: ' . '/main/index');
    //         }
            
    //         $street = filter_input(INPUT_POST,'street');
    //         $house = filter_input(INPUT_POST,'house');
    //         $city = filter_input(INPUT_POST,'city');
    //         $_SESSION['address'] = $street.' '.$house.' '.$city;
    //         header('Location: ' . '/main/comment');
    //     }else{
    //         $this->view->page = 'page_step2';
    //         $this->view->render();
    //     }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $action = filter_input(INPUT_POST,'action');
            if($action == 'data'){
                if($_SESSION['name']=='' || $_SESSION['surname']=='' || $_SESSION['phone']==''){
                    header('Location: ' . '/main/index');
                }else{
                    $street = filter_input(INPUT_POST,'street');
                    $house = filter_input(INPUT_POST,'house');
                    $city = filter_input(INPUT_POST,'city');
                    $_SESSION['street'] = $street;
                    $_SESSION['house'] = $house;
                    $_SESSION['city'] = $city;
                    header('Location: ' . '/main/comment');
                }
            }else if($action == 'back'){
                $this->view->page = 'page_step2';
                $this->view->render();
            }
        }else if($_SESSION['street']!='' && $_SESSION['house']!='' && $_SESSION['city']!=''){
            if($_SESSION['comment']!=''){
                header('Location: '. '/main/result');
            }else{
                header('Location: ' . '/main/comment');
            }
        }else{
            $this->view->page = 'page_step2';
            $this->view->render();
        }
    }
        
    public function action_comment(){
        // if($_SESSION['name']=='' || $_SESSION['surname']=='' || $_SESSION['surname']==''){
        //     header('Location: ' . '/main/index');
        // } else if($_SESSION['street']=='' || $_SESSION['house']=='' || $_SESSION['city']==''){
        //     header('Location: ' . '/main/address');
        // }
        // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //     //save comment in session
        //     $comment = filter_input(INPUT_POST,'comment');
        //     $_SESSION['comment'] = $comment;

        //     //save user
        //     $this->model = new MainModel();
        //     $this->model->addUser($_SESSION['name'],$_SESSION['surname'],$_SESSION['phone'],$_SESSION['address'],$_SESSION['comment']);

        //     header('Location: '. '/main/result');
        // }else{
        //     $this->view->page = 'page_step3';
        //     $this->view->render();
        // }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
        } else if($_SESSION['comment']==''){
            header('Location: ' . '/main/comment');
        }
        //desroy session
        session_destroy();
        $this->view->page = 'page_result';
        $this->view->render();
    }
}