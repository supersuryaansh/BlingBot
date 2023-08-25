<?php

require('Scraper.php');

// $scraper = new Scraper($url, $tag );
Class Hashtags{

  public $class;
  public $tags;
  public $html;
  public $dom;

  public function __construct($class,$tags){

    $this->class = $class;
    $this->tags = $tags;
    $this->scraper = new Scraper("https://best-hashtags.com/hashtag",$this->tags);
    $this->html = $this->scraper->parser(); 

  }

  public function getHTML(){
    return $this->html;
  }


//get stored data from elements using class names 
  public function getElementsByClassName($dom, $ClassName, $tagName=null) {

    if($tagName){
        $Elements = $dom->getElementsByTagName($tagName);
    }else {
        $Elements = $dom->getElementsByTagName("*");
    }
    $Matched = array();
    for($i=0;$i<$Elements->length;$i++) {
        if($Elements->item($i)->attributes->getNamedItem('class')){
            if($Elements->item($i)->attributes->getNamedItem('class')->nodeValue == $ClassName) {
                $Matched[]=$Elements->item($i);
            }
        }
    }
    return $Matched;
  }


//parse the dom and return the data
  public function domParser(){

  $dom = new \DOMDocument('1.0'); 
    @$dom->loadHTML($this->html);
    $elementsByClass = $this->getElementsByClassName($dom, $this->class, 'div');
    foreach ($elementsByClass as $element =>$key){
      $array[] = $dom->saveHTML($key);
    }

    $fixHTML = str_replace("<div class=\"tag-box tag-box-v3 margin-bottom-40\">","",$array[0]);
    $fixHTML = str_replace("<p1>","",$fixHTML);
    $fixHTML = str_replace("</p1>","",$fixHTML);
    $fixHTML = str_replace("</div>","",$fixHTML);

   return $fixHTML; 


  }


}

