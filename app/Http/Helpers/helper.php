<?php

function getRoleName($role_id){
   switch ($role_id){
        case "1":
            echo "SuperAdmin";
            break;
        case "2":
            echo "Admin";
            break;
        case "3":
            echo "Employee";        
            break;
        default:
            echo "Guest";
   }
}