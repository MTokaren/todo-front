<?

class Table
{
    public function showNotes(array $notes): void
    {
        foreach ($notes as $note) {

            echo '<tr>';
            echo  '<td>' . $note['id'] . '</td>';
            echo '<td>' . $note['note'] . '</td>';
            if ($note['unixtime']) {
                echo '<td>' . date('Y-m-d H:i:s', $note['unixtime']) . '</td>';
            } else {
                echo '<td>' . 'This note has no setup reminder' . '</td>';
            }
            echo '</tr>';
        }
    }

    public function showNotesId(array $notes): void
    {
        foreach ($notes as $note) {
            echo "<option value=" . $note['id'] . '>' . 'Note ID:' . $note['id'] . '</option>';
        }
    }

    public function logout(): void
    {
        $_SESSION['auth'] = false;
        header('Location:index.php');
    }
}
