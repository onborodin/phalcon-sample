<?php
#
# $Id$
#
use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class BaseJSONController extends Controller {

    public function initialize() {
        $this->view->disable();
    }

    public function sendJson($data) {
        $this->response->setJsonContent($data);
        return $this->response;
    }

    public function sendSuccess($id = null) {
        return $this->sendJson([ 
                        'result' => 'success', 
                        'id' => $id
        ]);
    }

    public function sendError() {
        return $this->sendJson([
                        'result' => 'error' 
        ]);
    }

    public function sendNotFound($id = null) {
        return $this->sendJson([
                        'result' => 'notfound',
                        'id' => $id
        ]);
    }


    public function sendRPCInvalidRequest() {
        return $this->sendJson([
                    "jsonrpc" => "2.0", 
                    "error" => [
                        "code" => -32600, 
                        "message"=> "Invalid Request"
                    ],
                    "id" => null
        ]);
    }
}
#EOF
