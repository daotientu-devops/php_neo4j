<?php
require_once 'run.php';
$root = $client->getRoot();
// Sending Cypher
$query = 'MATCH (n) RETURN n';
$query = 'MATCH (user:User{name:"john"}) DELETE user';
// CREATING A NODE
$query = 'CREATE (user:User{name:"john"})';
// RETRIEVING THE NODE
//$query = 'MATCH (user:User{name:"john"}) RETURN user';
$result = $client->sendCypherQuery($query)->getResult();
echo '<pre/>';
print_r($result);die();
// Accessing the user identifier (so the user node) from the result
$john = $result->get('user');
// Managing node objects
// The $john is a wrapped Node object and have some methods
// The node id (STT của node)
echo $john->getId();
// The labels
print_r($john->getLabels());
// The properties
echo $john->getProperty('name');
// CREATING RELATIONSHIPS (with Cypher)
$query = 'MATCH (user:User {name:"john"})
CREATE (friend:User {name:"Judith"})
MERGE (user)-[r:FRIEND]->(friend)
RETURN user, friend, r';
$result = $client->sendCypherQuery($query)->getResult();
$john = $result->get('user');
$judith = $result->get('judith');
// What john has for relationships
print_r($john->getRelationships()); // returns relationships objects
// Get a node connected to john
print_r($john->getConnectedNode());

