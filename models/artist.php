<?php namespace models;
class Artist {
    private $name;
    private $id;

    /**
     * Artist constructor.
     * @param $name
     * @param $id
     */
    public function __construct($name, $id='')
    {
        $this->name = $name;
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getId() {
        return $this->id;
    }
}
?>
