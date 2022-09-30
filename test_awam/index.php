<?php
  session_start();
  if(empty($_SESSION['historique'])){
    $_SESSION['historique'] = "";
  }
  if(isset($_POST['calcul'])&&!empty($_POST['value1'])&&!empty($_POST['value2'])){

      $value1 = $_POST['value1'];
      $value2 = $_POST['value2'];
      $devise1 = $_POST['devise1'];
      $devise2 = $_POST['devise2'];
      $devisefinal = "euros";
      $btn = true;
      
        if($devise1 == $devise2){
          $devisefinal = $devise1;
        }
        if($devise1 == "dollars"){
          $value1 = $value1 * 1.02;
        }
        if($devise2 == "dollars"){
          $value2 = $value2 * 1.02;
        }
      $result = $value1 + $value2;
      
    }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Test Awam</title>
</head>
<body>
  <h1>Calcul de taux de change</h1>
  <form method="POST">
    <div class="formulaire">
      <input type="number" name="value1" min="0" step=".01">
      <select name="devise1" class="devise">
        <option value="euros">Euros</option>
        <option value="dollars">Dollars</option>
      </select>
      <p class="operation"> + </p>
      <input type="number" name="value2" min="0" step=".01">
      <select name="devise2" class="devise">
        <option value="euros">Euros</option>
        <option value="dollars">Dollars</option>
      </select>
    </div>
    <div class="historique">
      <?php
      
        if(!empty($value1)&&!empty($devise1)&&!empty($value2)&&!empty($devise2)&&!empty($result)&&!empty($devisefinal)&&($btn)){
          $_SESSION['historique'] .= $value1." ".$devise1." + ".$value2." ".$devise2." = ".$result." ".$devisefinal."<br>";
          echo $_SESSION['historique'];
          $btn = false;
        }
        else
        {
          echo $_SESSION['historique'];
        }
        
       
      ?>
    </div>
    <div class="container_btn">
      <input  class="btn_calculer" type="submit" value="Calculer"     name="calcul">
      <input  class="btn_calculer" type="submit" value="Mail" name="mail">
    </div>
    
    
  </form>

  <?php 
    //session_destroy();


    if(isset($_POST['mail'])&&!empty($_SESSION['historique'])){
      
      $to = 'client@example.com';
      $subject = 'Historique des taux de change';
      $message = $_SESSION['historique'];
      mail($to, $subject, $message);
    }

  ?>

</body>
</html>