 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Hello Bee Code</title>
 </head>
 <body>
 	<?php 
// create a database in your MySQL by the name you want,Here is the default name oop_mysqli.

// create a table, name the table student and give id,name,email and phone number as rows. 

// use the object for insert,update or delete data by oop method. 	

// including the main class file name	
include "database.php";

// created a object
$obj  = new database();

// Use This For Insert Data by uncomment it.
// $obj->insert('student',['name'=>'write name here','email'=>'write email here','phone'=>'write phone number here']);
// echo "Insert result is : ";
// echo "<pre>";
// print_r($obj->getresult());
// echo "</pre>";


// Use This For Update Data by uncomment it.

// $obj->update('student',['name'=>'write new name','email'=>'write new email','phone'=>'write new phone'],'id= "write id number"');
// echo "Update result is : ";
// echo "<pre>";
// print_r($obj->getresult());
// echo "</pre>";

// Use This For Delete Data by id number.

// $obj->delete('student','id= "write the id number here"');

// Use This For Fetch All Data from database by raw sql.

// Can be add Where condition after table name like (WHERE name = "Abid Hasan").

// $obj->sql('SELECT * FROM student ');
// echo "SQL result is : ";
// echo "<pre>";
// print_r($obj->getresult());
// echo "</pre>";

// Use This For Fetch All Data from database by Select .

// BY ROWS $obj->select('student','id',null,null,null,null);
// BY LIMIT $obj->select('student','*',null,null,null,2);
// BY ODER BY $obj->select('student','*',null,null,name,null);

// $obj->select('student','*',null,null,null,null);
// echo "Student Select result is : ";
// echo "<pre>";
// print_r($obj->getresult());
// echo "</pre>";


 ?>
 </body>
 </html>