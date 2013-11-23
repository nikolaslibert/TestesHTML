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
        $nascimento = $this->real_escape_string($nascimento);
        
        $this->query("INSERT INTO Usuario (Email, Senha) VALUES ('" . $email . "', '" . $senha . "')");
        $this->query("INSERT INTO PessoaFisica (Cpf, Nome, Sobrenome, Nascimento) VALUES (\'$cpf\', '$nome\', \'$sobrenome\', \'$nascimento\')");
    }
    
    public function criaPessoaJuridica ($email, $senha, $cnpj, $nome){
        $email = $this->real_escape_string($email);
        $senha = $this->real_escape_string($senha);
        $cnpj = $this->real_escape_string($cnpj);
        $nome = $this->real_escape_string($nome);        
        
        $this->query("INSERT INTO Usuario (Email, Senha) VALUES ('" . $email . "', '" . $senha . "')");
        $this->query("INSERT INTO PessoaJuridica (CNPJ, Nome) VALUES (\'$cnpj\', \'$nome\')");
    }

}
?>
