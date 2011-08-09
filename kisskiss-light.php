<?php
class Template {
    private $vars  = array(
        'template' => 'template.php',
    );
 
    public function __get($name) {
        return $this->vars[$name];
    }
 
    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }
 
    public function render($file) {
        function e($string) { return htmlspecialchars($e, ENT_COMPAT, 'UTF-8'); }
        
        extract($this->vars);
        ob_start();
        include($file);
        return ob_get_clean();
    }
}

ob_start();
$view = new Template;

register_shutdown_function(function() use ($view){
    $view->content = ob_get_clean();
    echo $view->render($view->template);
});