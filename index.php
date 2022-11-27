<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
   
</head>
<body>
    <?php 
 
 
 /*$has_park_check=isset($_GET['parking']) ? true:false;*/



 $stampa_num=$_GET['hotel-star'] ?? 0;
 $stampa=$_GET['park'] ?? 'no-park-select';

var_dump($stampa);
var_dump((int)$stampa_num);
$hotels_filter=[];
 $hotels = [

     [
         'name' => 'Hotel Belvedere',
         'description' => 'Hotel Belvedere Descrizione',
         'parking' => true,
         'vote' => 4,
         'distance_to_center' => 10.4
     ],
     [
         'name' => 'Hotel Futuro',
         'description' => 'Hotel Futuro Descrizione',
         'parking' => true,
         'vote' => 2,
         'distance_to_center' => 2
     ],
     [
         'name' => 'Hotel Rivamare',
         'description' => 'Hotel Rivamare Descrizione',
         'parking' => false,
         'vote' => 1,
         'distance_to_center' => 1
     ],
     [
         'name' => 'Hotel Bellavista',
         'description' => 'Hotel Bellavista Descrizione',
         'parking' => false,
         'vote' => 5,
         'distance_to_center' => 5.5
     ],
     [
         'name' => 'Hotel Milano',
         'description' => 'Hotel Milano Descrizione',
         'parking' => true,
         'vote' => 2,
         'distance_to_center' => 50
     ],

 ];

var_dump($hotels[0]['vote']);
function filtro($array){
   $user_choice=$GLOBALS['stampa']==="true"? true:false;
    var_dump($user_choice);
    foreach($array as $key=>$hotel){
        if($hotel['parking']===$user_choice){
            $GLOBALS["hotels_filter"][]=$hotel;
        }
           
    };
    

};
function filtroBoth($array){
    $user_choice=$GLOBALS['stampa']==="true"? true:false;
    $num_star=(int)$GLOBALS['stampa_num'];
    foreach($array as $key=>$hotel){
        if($hotel['parking']===$user_choice && $hotel['vote']>=$num_star ){
            $GLOBALS["hotels_filter"][]=$hotel;
        }
           
    };
    
}

function filtroStar($array){
    
    $num_star=(int)$GLOBALS['stampa_num'];
    foreach($array as $key=>$hotel){
        if($hotel['vote']>=$num_star){
            $GLOBALS["hotels_filter"][]=$hotel;
        }
           
    };
}

if(($stampa!=='no-park-select'&&$stampa!=="")&&$stampa_num!=0){
    filtroBoth($GLOBALS['hotels']);
}
else if($stampa!=='no-park-select'&&$stampa!==""){
    filtro($GLOBALS['hotels']);
}
else if($stampa_num!==0){
    filtroStar($GLOBALS['hotels']);
}
else{
    $hotels_filter=$hotels;
}

/*if($stampa!=='no-park-select'&&$stampa!==""){
   filtro($GLOBALS['hotels']);
   var_dump($hotels_filter);
}
else{
$hotels_filter=$hotels;
}
*/


/*$prova=$_GET['parking'];
if(is_null($prova)){
    $GLOBALS[hotel_filter]=$GLOBALS[hotels];
}
else{$hotel_filter=filtro($hotels);
}

var_dump($hotels_filter);
var_dump(count($hotels_filter));
*/

/*foreach($students_sec as $student=> $value){
var_dump($value);
foreach($value as $key=> $val){
    echo "  $key $val <br/>";
}
};  
*/
/*for($i=0;$i<count($students_sec);$i++){
    foreach($students_sec[$i] as $key=> $value){
        echo "$key: $value </br>";
    };
};
*/


?>

<table class="table">
  <thead>
    <tr>
     <?php foreach($hotels[0] as $key=>$value){ ?>
        
        <th scope="col"><?php echo $key ?></th>
        <?php } ?>   
    </tr>
  </thead>
  <tbody>
  <?php for($i=0;$i<count($hotels_filter);$i++){  ?>
  <tr>
    <?php foreach($hotels_filter[$i] as $key =>$value){?>
        <td><?php if($key==='parking'){
            $park=$value===true?"true":"false";
            echo $park;
        }else{
            echo $value;
        }
        
        ?></td>
        <?php } ?>
    </tr>
    <?php } ?>
    </tr>
   
  </tbody>
</table>
<form action ="index.php" method="GET">
    <div class="mb-3">
        <label for="park">Filtra Parcheggio</label>
        <select name="park" id="park">

        <option value=""></option>
        <option value=true>Parcheggio Presente</option>
        <option value=false>Parcheggio Assente</option>
        </select>
    </div>
  <div class="mb-3">
    <label for="hotel-star">filtra per Numero di Stelle</label>
    <input type="number" name="hotel-star" id="hotel-star" min="0" max="5">
</div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>