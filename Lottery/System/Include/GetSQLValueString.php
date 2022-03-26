<?php
   //GetSQLValueString 提拱SQL與prepare函式的參數型別轉型成可提供SQL使用的字串之函式。(型別有"string","int","float","email","url","bool")
   function GetSQLValueString($theValue, $theType){
       switch($theType){
           case "string":
               $theValue = ($theValue != "") ? filter_var($theValue,
            FILTER_SANITIZE_MAGIC_QUOTES) : "";
               break;

           case "int":
                 $theValue = ($theValue != "") ? filter_var($theValue,
             FILTER_SANITIZE_NUMBER_INT) : "";
                break;

           case "float":
                 $theValue = ($theValue != "") ? filter_var($theValue,
             FILTER_VALIDATE_FLOAT) : "";
                break;

           case "email":
                 $theValue = ($theValue != "") ? filter_var($theValue,
              FILTER_VALIDATE_EMAIL) : "";
                break;

           case "url":
                 $theValue = ($theValue != "") ? filter_var($theValue,
              FILTER_VALIDATE_URL) : "";
                break;

           case "bool":
                 $theValue = ($theValue != "") ? filter_var($theValue,
              FILTER_VALIDATE_BOOLEAN) : "";
                break;
       }
       return $theValue;
   }
?>