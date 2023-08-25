<?php

// $scraper = new Scraper($url, $tag );
Class Scraper{

  public $url;
  public $tags;
  
  protected $html;

  public function __construct($url,$tags){
    $this->url = $url;
    $this->tags = $this->fixTags($tags);
  } 

  public function fixTags($tags){
    $this->tags = $tags;
    $this->tags = str_replace(" ","",$this->tags);
    $this->tags = str_replace("#","",$this->tags);
    return $this->tags;
  }

  public function parser(){
    $this->html = file_get_contents($this->url."/".$this->tags);
    return $this->html;
  }

}



