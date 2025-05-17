<?php
class ofp_first_plugin{

function __construct(){
    add_filter("the_content", array($this,"title_upper_case"));   

}

function title_upper_case($content){
    return strtoupper($content);
}
}