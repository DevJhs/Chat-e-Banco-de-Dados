<?php
   require_once "conectBD.php";

   if(!empty($_POST)){
        //esta chegando dados do post entao posso inserir 
        //obter informacoes do formulario
        try{
            //prepara informacoes 
            //mostra o SQL (pgsql)
            $sql = "INSERT INTO users(mensagens,identificador,hora,ips) VALUES (:Mensagens,:Identificador,:Hora,:Ips)";
            //preparar SQL (pdo)
            $stmt=$pdo->prepare($sql);
             
            //definir/organizar os dados para SQL
            $dados=array(
                ':Mensagens'=>$_POST['mgs'],
                ':Identificador'=>$_POST['id'],
                ':Hora'=>time()/ 60 % 60,
                ':Ips'=>$_SERVER['REMOTE_ADDR']
            );

             // pegando minuto atual
                // $HoraAt=time()/ 60 % 60;
                 //apagara todos os dados do banco
                 $sql = "TRUNCATE TABLE users";

                 //verificando se e para resetar o banco ou nao
                /* if($a['hora']!=$HoraAt){
                    $stmt=$pdo->prepare($sql);
                    if($stmt->execute($dados)){
                        header("Location: index.php?msgSucesso=RESETANDO MENSAGENS...");
                    }
                    return '';
                   
                }*/
                if(!empty($_POST)){
                    if($_POST['mgs']=='reset' ){
                        $stmt=$pdo->prepare($sql);
                        if($stmt->execute($dados)){
                            header("Location: index.php?msgSucesso=RESETANDO MENSAGENS...");
                        }
                        return '';
                    }   
                }


            
            if(!empty($_POST["mgs"]&& !empty($_POST["id"]) )){
		//tentar executar o SQL (INSERT)
                if($stmt->execute($dados)){
                                       
                    header ('Location: index.php?msgSucesso=Mensagem enviada!');
                }

            }else{
                
                header('Location: index.php?msgErro=Preencha os campos seguintes...');
            }

        }catch(PDOException $e){
           // die($e->getMenssage());
            header ('Location: index.php?msgErro=Falha ao enviar mensagem!!!');    
        }

   }else{
       
       header('Location: index.php?msgErro=Erro de acesso.');

   }
   die();

   