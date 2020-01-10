<?php

define('HOST', 'oracle');
define('PORT', 1521);
define('DATABASE', 'XE');

$userAdmin = 'system';
$passAdmin = 'oracle';

$tableSpace = 'tbs_erp';
$fileDatabase = 'erp.dbf';
$username = "erp";
$password = "erp";
$role = "erp_profile";

function getConnection($user, $pass)
{
    $tns = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS="
        . "(PROTOCOL=TCP)(HOST=".HOST.")"
        . "(PORT=".PORT.")))"
        . "(CONNECT_DATA=(SERVER=DEDICATED)"
        . "(SERVICE_NAME=".DATABASE.")))";
    try {
        $pdo = new PDO("oci:dbname=".$tns, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        return $pdo;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

function executeQuery($user, $pass, $query)
{
    try {
        $conn = getConnection($user, $pass);
        $result = $conn->query($query);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

echo '// Cria tablespace';
$query = "create tablespace ".$tableSpace."
    datafile '/u01/app/oracle/oradata/XE/".$fileDatabase."' size 10M reuse
    autoextend on next 1M maxsize 200M
    online";
executeQuery($userAdmin, $passAdmin, $query);


echo '// Cria o usuario';
$query = 'create user '.$username.'
    identified by "'.$password.'"
    default tablespace '.$tableSpace.'
    temporary tablespace temp';
executeQuery($userAdmin, $passAdmin, $query);


echo '// Cria a role';
$query = "create role ".$role;
executeQuery($userAdmin, $passAdmin, $query);


echo '// Define os privilegios da role';
$query = "grant
    create cluster,
    create database link,
    create procedure,
    create session,
    create sequence,
    create synonym,
    create table,
    create any type,
    create trigger,
    create view
    to ".$role;
executeQuery($userAdmin, $passAdmin, $query);


echo '// Atribui a "role" ao usuario';
$query = "grant ".$role." to ".$username;
executeQuery($userAdmin, $passAdmin, $query);


echo '// Define "unlimited" tablespace para o usuario';
$query = "grant unlimited tablespace to ".$username;
executeQuery($userAdmin, $passAdmin, $query);
