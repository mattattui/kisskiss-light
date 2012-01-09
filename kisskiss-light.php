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
 
    public function render($__file) {
        extract($this->vars, EXTR_SKIP);
        ob_start();
        include($__file);
        return ob_get_clean();
    }
}
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

ob_start();
$view = new Template;

register_shutdown_function(function() use ($view){
    $view->content = ob_get_clean();
    echo $view->render($view->template);
});
