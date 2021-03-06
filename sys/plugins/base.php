<?php
class PluginBase {
   
   public $name;
   public $author;
   public $version;
   public $website;
   public $depends=array();
   public $pluginBaseType;
   
   public $elementInfo;
   
   private $pluginBaseDir;
   private $pluginDir;
   private $pluginInfo=array();
   
   private $id;
   
   function __construct($dir,$id) {
       $this->pluginBaseDir=str_replace("/data/","",$dir.DS.DS);
       $this->pluginDir=str_replace(str_replace("sys/","",HERE),"",$this->pluginBaseDir);
       $this->pluginInfo=$this->getPluginInfo($this->getFile("plugin.info"));
       $info=$this->pluginInfo;
       
       $this->name=$info["Name"];
       $this->author=$info["Author"];
       /*$this->version=$info["Version"];*/
       $this->website=$info["Website"];
       
       $this->elementInfo=array($info["type"],$info["arg"]);
       $this->pluginBaseType=explode("/",$this->pluginBaseDir)[1];
       $this->id=$id;
   }
   
   function getFile($file) {
       return $this->pluginBaseDir.$file;
   }
   
   
   function getPluginInfo($file) {
     $text=file_get_contents($file);
     $ar=explode("
",$text);
     $data=array();
     foreach ($ar as $line) {
     if ($line != "") {
     $a=explode(": ",$line);
     $data[$a[0]]=$a[1];
     }
     }
     return $data;
   }
   
   function __destruct() {
       //Destruct
   }
}
?>
