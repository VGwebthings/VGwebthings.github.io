<?php

////////////////////////////////////////
//Will return the current date + time///
////////////////////////////////////////

////////////////////////////////////////
////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
//Perform a LOAD query on a database///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
function db_load_value($id, $columm, $table)
{
    include("settings.php");
    $connection = mysql_connect($setting_db_host, $setting_db_username, $setting_db_password);
    $dbSelect   = mysql_select_db($setting_db_name, $connection);
    $query      = "SELECT * ";
    $query .= "FROM " . $table;
    $query .= " WHERE id=" . $id;
    $queryResult = mysql_query($query, $connection);
    $value       = mysql_fetch_array($queryResult);
    mysql_close($connection);

    return $value["{$columm}"];
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
//Perform a SAVE query on a database///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
function db_save_value($value, $columm, $table)
{
    include("settings.php");
    $connection = mysql_connect($setting_db_host, $setting_db_username, $setting_db_password);
    $dbSelect   = mysql_select_db($setting_db_name, $connection);
    $query      = "INSERT INTO ";
    $query .= "`" . $table . "` ";
    $query .= "( `id` , `" . $columm . "` ) ";
    $query .= "VALUES ( '', '" . $value . "');";
    mysql_query($query, $connection);
    mysql_close($connection);
}

function db_save_two_values($value1, $columm1, $value2, $columm2, $table)
{
    include("settings.php");
    $connection = mysql_connect($setting_db_host, $setting_db_username, $setting_db_password);
    $dbSelect   = mysql_select_db($setting_db_name, $connection);
    $query      = "INSERT INTO ";
    $query .= "`" . $table . "` ";
    $query .= "( `id` , ";
    $query .= "`" . $columm1 . "`";
    $query .= " , ";
    $query .= "`" . $columm2 . "`";
    $query .= ") ";
    $query .= "VALUES ( '', ";
    $query .= "'" . $value1 . "'";
    $query .= " , ";
    $query .= "'" . $value2 . "'";
    $query .= ");";
    mysql_query($query, $connection);
    mysql_close($connection);
}

function db_save_three_values($value1, $columm1, $value2, $columm2, $value3, $columm3, $table)
{
    include("settings.php");
    $connection = mysql_connect($setting_db_host, $setting_db_username, $setting_db_password);
    $dbSelect   = mysql_select_db($setting_db_name, $connection);
    $query      = "INSERT INTO ";
    $query .= "`" . $table . "` ";
    $query .= "( `id` , ";
    $query .= "`" . $columm1 . "`";
    $query .= " , ";
    $query .= "`" . $columm2 . "`";
    $query .= " , ";
    $query .= "`" . $columm3 . "`";
    $query .= ") ";
    $query .= "VALUES ( '', ";
    $query .= "'" . $value1 . "'";
    $query .= " , ";
    $query .= "'" . $value2 . "'";
    $query .= " , ";
    $query .= "'" . $value3 . "'";
    $query .= ");";
    mysql_query($query, $connection);
    mysql_close($connection);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
//Perform a DELETE query on a database///////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
function db_delete_entry($id, $table)
{
    include("settings.php");
    $connection = mysql_connect($setting_db_host, $setting_db_username, $setting_db_password);
    $dbSelect   = mysql_select_db($setting_db_name, $connection);
    $query      = "DELETE FROM " . $table . " WHERE id= '" . $id . "'";
    mysql_query($query, $connection);
    mysql_close($connection);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
//Perform an UPDATE query on a database////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
function db_update_value($id, $value, $columm, $table)
{
    include("settings.php");
    $connection = mysql_connect($setting_db_host, $setting_db_username, $setting_db_password);
    $dbSelect   = mysql_select_db($setting_db_name, $connection);
    $query      = "UPDATE  `" . $table . "` SET  `" . $columm . "` =  '" . $value . "' WHERE  `id` =" . $id;
    mysql_query($query, $connection);
    mysql_close($connection);
}

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////
//Count all Rows in a table////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
function db_count_entries($table)
{
    include("settings.php");
    $connection = mysql_connect($setting_db_host, $setting_db_username, $setting_db_password);
    $dbSelect   = mysql_select_db($setting_db_name, $connection);
    $query      = mysql_query("SELECT * FROM {$table}", $connection);
    $result     = mysql_num_rows($query);

    return $result;
}
