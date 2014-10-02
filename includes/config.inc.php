<?php
        global $config;
	$config["debug"]=false;
        $config["mysql"] = array(
                "host" => "localhost",
                "user" => "root",
                "password" => "noal4943",
                "database" => "socialize");
        $config["smarty"] = array(
                "template_dir" => "../socialize/templates/template/",
                "compile_dir" => "../socialize/templates/templates_c/",
                "config_dir" => "../socialize/templates/configs/",
                "cache_dir" => "../socialize/templates/cache/",
        );
?>