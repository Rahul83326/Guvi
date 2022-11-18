<?php
// mangodb
// $con2 =new MongoDB\Driver\Manager("mongodb://localhost:27017");
// echo "Connection Sucessfully!!!!";
require 'C:\xampp\htdocs\Guvi\vendor\autoload.php';
   
    use MongoDB\Driver\Exception\Exception;
use Mongodb\Driver\serverApi;
//use MongoDB\Exception\Exception;
// use MongoDB\Exception\Exception;
    
$con =mysqli_connect('localhost','root','','guvi_db');

if(!$con){
    // echo "Connection Successful!!";
   
    die(mysqli_error($con));
}
    
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_birthday=$_POST['user_birthday'];
    $user_password=$_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];

    // $user_ip=getIPAddress();
    echo "hello";



$select_query="select * from `login_data` where email_id='$user_email'";
$result=mysqli_query($con,$select_query);
$row_count=mysqli_num_rows($result);
if($row_count>0){
    echo "<script>alert('UserName and Email Already exits')</script>";
}else if($user_password!=$conf_user_password){
    echo "<script>alert('Password does not matches')</script>";
    
}else{

    // insert query
$stmt = $con->prepare("insert into `login_data` (email_id, password) VALUES (?, ?)");
$stmt->bind_param("ss", $user_email, $user_password);
    echo "<script>alert('insert the values')</script>";
    // $insert_query="insert into `login_data`(email_id,password) values ('$user_email','$hash_password')";
    // $sql_execute=mysqli_query($con,$insert_query);
        if($stmt->execute()){
            echo "<script>alert('Data insert Successfully')</script>";
        }
        try {
            
            $serverApi = new ServerApi(ServerApi::V1);
            $client = new MongoDB\Client(
                'mongodb+srv://RahulThangamani:rahulT83326@cluster0.jvfx7tt.mongodb.net/Guvi?retryWrites=true&w=majority', [], ['serverApi' => $serverApi]);
            $db = $client->test;

            $coll = $db->users;

            // $client = new MongoClient('mongodb+srv://RahulThangamani:rahulT83326@cluster0.jvfx7tt.mongodb.net/Guvi?retryWrites=true&w=majority'); 
            // echo "Connection to database successfully"; 
            // // select a database 
            // $db = $client->test;
            //  echo "Database mydb selected"; 
            //  $coll = $db->users; 
            //  echo "Collection selected succsessfully";
            
            $coll->insertOne([
                'email_id' => $user_username,
                'user_email'=>$user_email,
                'user_dateofbirth'=>$user_birthday,
                'user_contact'=>$user_contact,
                'user_address'=>$user_address
            ]);
            
            
        }  catch (\MongoDB\Driver\Exception\Exception $e) {
            echo $e;
        }

}
    

?>
