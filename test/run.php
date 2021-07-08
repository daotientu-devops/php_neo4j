<?php
require_once 'vendor/autoload.php';

use Neoxygen\NeoClient\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('neo4j', 'http', 'localhost', 7474, true, 'root', 'admin@123')
    ->setAutoFormatResponse(true)
    ->build();
//$query = "CREATE (user:User{name:'Kenneth'}) RETURN user";
$query = "MATCH (user:User{name:'Kenneth'}) RETURN user";
$result = $client->sendCypherQuery($query)->getResult();
$user = $result->getSingleNode();
$id = $user->getId();
$name = $user->getProperty('name');
echo '<pre/>';
print_r($id);
print_r($name);
///////////////////////////////////////////////////////////
//$query = "CREATE (user:User{name:'Maxime'}) RETURN user";
//$result = $client->sendCypherQuery($query);
//print_r($result);
// Creating relationships
//$query = "MATCH (user1:User{name:'Kenneth'}),(user2:User{name:'Maxime'}) CREATE (user1)-[:FOLLOWS]->(user2)";
//$params = ['name1' => 'Kenneth', 'name2' => 'Maxime'];
// Creating an index
$query = "CREATE INDEX ON:User(user)";
$result = $client->sendCypherQuery($query);
die();
