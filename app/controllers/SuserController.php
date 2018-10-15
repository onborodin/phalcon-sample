<?php

use Phalcon\Mvc\Controller;

class SuserController extends BaseController {

    public function listAction() {
        return $this->view->pick("suser/list");
    }

    public function addFormAction() {
        return $this->view->pick("suser/add-form");
    }
    public function addHandlerAction() {
        return $this->view->pick("suser/add-handler");
    }

    public function updateFormAction() {
        return $this->view->pick("suser/update-form");
    }
    public function updateHandlerAction() {
        return $this->view->pick("suser/update-handler");
    }

    public function deleteFormAction() {
        return $this->view->pick("suser/delete-form");
    }
    public function deleteHandlerAction() {
        return $this->view->pick("suser/delete-handler");
    }

}
#EOF


