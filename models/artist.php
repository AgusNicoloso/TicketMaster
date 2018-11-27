<?php namespace models;
class Artist {
    private $name;
    private $id;
    public function __construct($name, $id = '') {
        $this->name = $name;
        $this->id = $id;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
}
?>
