<?php 

class Language {
    private $l;
    private $ini;
    private $category;

    public function __construct(){
        $this->l = 'en';

        if(isset($_SESSION['lang']) && file_exists('Lang/'.$_SESSION['lang'].'.ini'))
            $this->l = $_SESSION['lang'];

        $this->ini = parse_ini_file('Lang/'.$this->l.'.ini');

        global $pdo;
        $sql = "SELECT * FROM lang WHERE lang = :lang";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':lang', $this->l);
        $sql->execute();

        if($sql->rowCount() > 0){
            foreach($sql->fetchAll() as $item){
                $this->category[$item['name']] = $item['value'];
            }
        }
    }

    public function get(string $s, bool $return = false){
        if(isset($this->ini[$s]))
            $s = $this->ini[$s];
        elseif(isset($this->category[$s]))
            $s = $this->category[$s];

        if($return)
            return $s;
        else
            echo $s;
    }

    public function getLanguage(){
        return $this->l;
    }

}