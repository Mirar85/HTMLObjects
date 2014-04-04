<?php 
namespace de\chilan\HtmlObjects;

use \Exception as Exception;

class HTMLObjectTypeException extends Exception {

    // Die Exceptionmitteilung neu definieren, damit diese nicht optional ist
    public function __construct($message, $code = 0) {
        // etwas Code

        // sicherstellen, dass alles korrekt zugewiesen wird
        parent::__construct($message, $code);
    }

    // maßgeschneiderte Stringdarstellung des Objektes
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function customFunction() {
        echo "Eine eigene Funktion dieses Exceptiontyps\n";
    }
}


?>