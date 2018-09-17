<?php
#
# $Id$
#
use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class BaseHTMLController extends Controller {

    public function initialize() {
        $this->view->setTemplateAfter('basic');
    }

}
#EOF
