<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

class SecurityPlugin extends Plugin {

    public function getAcl() {
        //...
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher) {
        //...
    }
}
