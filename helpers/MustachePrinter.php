<?php

class MustachePrinter{
    private $mustache;
    private LoginChecker $loginChecker;

    public function __construct($partialsPathLoader, $loginChecker){
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
                'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
            ));

    $this->loginChecker = $loginChecker;
    }

    public function render($template , $data = array() ){
        $contentAsString =  file_get_contents($template);
        $data+= $this->loginChecker->loginCheck();
        return  $this->mustache->render($contentAsString, $data);
    }
}