<?php
class agendamentoDB extends mysqli {
    
    // Variável que apontará para a única instância da classe.
    private static $instance = null;

    // Dados para conexão com o banco de dados
    private $user = "usuarioPHP";
    private $pass = "123";
    private $dbName = "AgendamentoEsportes";
    private $dbHost = "localhost";
    
    // Inicializa a classe caso ainda não haja nenhuma instância ou retorna a instância existente.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // Não permite a duplicação da classe, já que ela é singleton.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }
    
    // private constructor
    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf8');
    }
    
    public function __destruct() {
        parent::close();
    }
    
    // Faz a autenticação
    public function autentica($email,$senha){
        $email = $this->real_escape_string($email);
        $senha = $this->real_escape_string($senha);
        $busca = $this->query("SELECT idUsuario FROM Usuario WHERE Email = '"
                . $email . "' AND Senha = '" . $senha . "'");
        
        if ($busca->num_rows > 0){
            $linha = $busca->fetch_row();
            $idUsuario = $linha[0];
            $busca->close();            
            return $idUsuario;
        } else {
            $busca->close();
            return null;
        }
    }
    
    // Verifica se o usuário está na lista de administradores
    public function usuarioAdministrador($idUsuario){
        $busca = $this->query("SELECT 1 FROM Administrador WHERE idUsuario = '"
                . $idUsuario . "'");
        $resultado = $busca->data_seek(0);
        $busca->close();
        return $resultado;
    }


    // Verifica se o e-mail já está cadastrado no servidor
    public function emailCadastrado($email) {
        $email = $this->real_escape_string($email);
        $busca = $this->query("SELECT idUsuario FROM Usuario WHERE Email = '"
                . $email . "'");        
        if ($busca->num_rows > 0){
            $busca->close();
            return true;
        } else {
            $busca->close();
            return false;
        }
    }
    
    public function criaPessoaFisica ($email, $senha, $cpf, $nome, $sobrenome, $nascimento){        
        $email = $this->real_escape_string($email);
        $senha = $this->real_escape_string($senha);
        $cpf = $this->real_escape_string($cpf);
        $nome = $this->real_escape_string($nome);
        $sobrenome = $this->real_escape_string($sobrenome);
        $nascimento = $nascimento[0] + $nascimento[1]*100 + $nascimento[2]*10000;
        
        try{
            $this->autocommit(false);
        
            $queryOK = $this->query("INSERT INTO Usuario (Email, Senha) VALUES ('$email', '$senha')");
            if (!$queryOK){
                throw new Exception($this->error);  
            }
            
            $idUsuario = $this->insert_id;
            $queryOK = $this->query("INSERT INTO PessoaFisica (Cpf, Nome, Sobrenome, Nascimento, idUsuario) VALUES ('$cpf', '$nome', '$sobrenome', '$nascimento', '$idUsuario')");
            if (!$queryOK){
                throw new Exception($this->error);  
            }
            
            $this->commit();
            $this->autocommit(true);
        } catch (Exception $e){
            $this->rollback();
            $this->autocommit(true);
            return null;
        }
        return $idUsuario;        
    }
    
    public function criaPessoaJuridica ($email, $senha, $cnpj, $nome){
        $email = $this->real_escape_string($email);
        $senha = $this->real_escape_string($senha);
        $cnpj = $this->real_escape_string($cnpj);
        $nome = $this->real_escape_string($nome);        
        
        try {
            $this->autocommit(false);
            
            $queryOK = $this->query("INSERT INTO Usuario (Email, Senha) VALUES ('$email', '$senha')");
            if (!$queryOK){
                throw new Exception($this->error);  
            }
            
            $idUsuario = $this->insert_id;
            $queryOK = $this->query("INSERT INTO PessoaJuridica (CNPJ, Nome, idUsuario) VALUES ('$cnpj', '$nome', '$idUsuario')");
            if (!$queryOK){
                throw new Exception($this->error);  
            }
            
            $this->commit();
            $this->autocommit(true);
        } catch (Exception $e) {
            $this->rollback();
            $this->autocommit(true);
            return null;
        }               
        return $idUsuario;       
    }

}
?>