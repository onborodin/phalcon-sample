<?php
#
# $Id$
#
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class IndexController extends BaseHTMLController {

    public function initialize() {
        if (!$this->session->get('username')) {
        }
        $this->view->setLayout('basic');
    }

    public function loginAction() {
        $username = $this->request->get('username');
        $password = $this->request->get('password');
        if ($username) {
            if ($username == 'master' && $password  == '12345') {
                $this->session->set('username', $username);
                return $this->response->redirect('/');
            }
        }

        $this->view->setLayout('login');
        return $this->view->pick("index/login");
    }


    public function logoutAction() {
        $this->session->destroy();
        return $this->response->redirect('/login');
    }


    public function helloAction() {
        $this->flash->error("You must be logged in.");

        return $this->view->pick("index/hello");
    }

    public function indexAction() {
        if ($this->session->get('username')) {
            return $this->helloAction();
        }
        return $this->response->redirect('/login');
    }

    public function notfoundAction() {
        return $this->view->pick("index/notfound");
    }

    public function sendData($file) {
        $response = new Response();
        $path = '/var/www/dev/data/'.$file;
        $filetype = filetype($path);
        $filesize = filesize($path);

        $response->setHeader("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->setHeader("Content-Description", 'File Download');
        $response->setHeader("Content-Type", $filetype);
        $response->setHeader("Content-Length", $filesize);
        $response->setFileToSend($path, str_replace(" ","-",$file), true);
        $response->send();
        die();
    }

    public function downloadAction() {
        $name = $this->request->get('name');
        $this->sendData($name);
    }

}
#EOF
