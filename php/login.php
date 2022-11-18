<?php
   // connect to mongodb
   $client = new Mongo\Client(
    'mongodb+srv://RahulThangamani:rahulT83326@cluster0.jvfx7tt.mongodb.net/Guvi?retryWrites=true&w=majority'
   );
   echo "Connection to database successfully";
	
   // select a database
   $db = $client->test;
   echo "Database mydb selected";
   $coll = $db->users;
   echo "Collection selected succsessfully";
   $cursor = $coll->find();
   // iterate cursor to display title of documents
	
   foreach ($cursor as $document) {
      echo $document["title"] . "\n";
   }
?>