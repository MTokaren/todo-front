<?

class Db
{
    protected $pdo;
    protected $chat_id;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=arey103_weatherbot', 'arey103_weatherbot', 'weatherBOT2023');
    }


//bot
    public function checkUser(string $chat_id, string $password): array
    {
        $query = 'SELECT * FROM users WHERE chatId = :chat_id AND password = :password';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':chat_id' => $chat_id, ':password' => $password]);
        return $res = $stmt->fetchAll();
    }

    public function getNotes($chat_id): array
    {
        $query = 'SELECT * FROM notes WHERE chat_id = :chat_id ORDER BY unixtime ASC';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':chat_id' => $_SESSION['chat_id']]);
        return $res = $stmt->fetchAll();
    }

    public function createNote($note): void
    {
        $query = "INSERT INTO notes (chat_id, note) VALUES (:chat_id, :note)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':chat_id' => $_SESSION['chat_id'], ':note' => $note]);
    }

    public function createReminder($note_id, $unixtime): void
    {
        $query = 'UPDATE notes SET unixtime = :unixtime WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':unixtime' => $unixtime, ':id' => $note_id]);
    }
}
