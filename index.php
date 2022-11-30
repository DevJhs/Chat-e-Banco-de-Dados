<?php
  require_once 'conectBD.php';
  
     //pegando informacoe do banco de dados    
     $sql="SELECT * FROM users ";
     $mensagens=array();
     try{
         $stmt=$pdo->prepare($sql);
         
         if($stmt->execute()){
              $mensagens=$stmt->fetchALL();
              foreach ($mensagens as $a) {
                
             }
         }else{
             die("Falha ao executar o SQL...");
         }
     }catch(PDOException $e){
            die($e->getMessage());
     }
  

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="main.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Chat-Online</title>
</head>
<body> 
    <form action="envDb.php" method="post">
        
         <?php  
           
           if(!empty($_GET['msgErro'])){
                echo $_GET['msgErro'];
           };
           if(!empty($_GET['msgSucesso'])){
            echo $_GET['msgSucesso'];
           };
               
           
         ?>

        

    <div id="main">
        <input type="text" id="Id" name='id' placeholder='seu nome:' require>
        <div id="displayMgs" >           
                 <p id="Imgs">Mensagens:</p>
                 <?php  

                    if(!empty($mensagens)){
                            foreach ($mensagens as $a) {

                ?>
                    <p id="User"><?php echo $a['identificador']; ?></p>
                    <p id="Mgu"><?php echo $a['mensagens']; ?></p>                     
                <?php
                    }
                    }
                ?>    
                </div>
        <div id="En1">
            <input type="text" id="mgs" name="mgs" placeholder="mensagem:" require>
            <button id="Bt" onclick="enviar()" >Enviar</button> 
        </div>
    </div>


    </form>
    

</body>
</html>
