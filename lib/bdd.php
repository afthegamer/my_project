<?php
/** Function that returns a PDO type object
 * @param void
 *
 * @return PDO PDO connection object
*/
function dbConnexion() : PDO
{
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASS);
    //PDO is told to send us an exception if it fails to connect or if it encounters an error
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbh;
}

/** Execute an SQL query and return a full record set
 * @param PDO $ dbh a connection PDO object
 * @param string $ sql the request has been executed
 * @param array $ params array containing the elements to bind in the request
 *
 * @return array record set
 */
function dbSelectAll(PDO $dbh , string $sql, array $params = []) : array
{
    /* 1. Prepare a request */
    $sth = $dbh->prepare($sql);

    /* 2. Execute the request */
    $sth->execute($params);

    /* 3. We get the recording game */
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**Execute an SQL query and return a row from the record set
 * @param PDO $ dbh a connection PDO object
 * @param string $ sql the request has been executed
 * @param array $ params array containing the elements to bind in the request
 *
 * @return array record set
 */
function dbSelectOne(PDO $dbh , string $sql, array $params = [])
{
    /* 1. Prepare a request */
    $sth = $dbh->prepare($sql);

    /* 2. Execute the request */
    $sth->execute($params);

    /* 3. We get the recording game */
    return $sth->fetch(PDO::FETCH_ASSOC);
}

/** Execute an INSERT or UPDATE or DELETE SQL query
 * @param PDO $ dbh a connection PDO object
 * @param string $ sql the request has been executed
 * @param array $ params array containing the elements to bind in the request
 *
 * @return array record set
 */
function dbExecute(PDO $dbh , string $sql, array $params = []) : int
{
    /* 1. Prepare a request */
    $sth = $dbh->prepare($sql);

    /* 2. Execute the request */
    if($sth->execute($params))
        return $dbh->lastInsertId();
    else
        return false;
}

/** Function which quickly allows to display all the names of the columns of a table
 *
 * @param string $ table the name of the table
 * @param PDO $ dbh the PDO database connection object
 *
 * @return string a string of the name of the columns of $ table separated by commas
 */
function getColumnName(PDO $dbh, string $table) : string
{
    $q = $dbh->prepare("DESCRIBE ".$table);
    $q->execute();
    $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
    $stringFields = '';
    foreach($table_fields as $field)
        $stringFields .= $field.',';

    return $stringFields;
}