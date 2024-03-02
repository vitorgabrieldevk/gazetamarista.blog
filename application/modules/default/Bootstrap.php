<?php

/**
 * Inicializador do modulo default
 *
 * @name Default_Bootstrap
 */
class Default_Bootstrap extends Zend_Application_Module_Bootstrap {
    /**
     * Inicia os plugins do módulo admin
     *
     * @name _initPlugins
     */
    protected function _initPlugins() {
        $bootstrap = $this->getApplication();
        $bootstrap->bootstrap('frontcontroller');
        $front = $bootstrap->getResource('frontcontroller');

        $router = new Zend_Controller_Router_Rewrite();
        $request =  new Zend_Controller_Request_Http();
        $router->route($request);
        $module = $request->getModuleName();

        // Register the plugin
        $front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(array('module' => $module)));
    }
}
