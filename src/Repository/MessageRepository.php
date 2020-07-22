<?php


namespace App\Repository;


use App\Config\Cryptor;
use Exception;
use Ratchet\ConnectionInterface;

class MessageRepository
{

    /**
     * @var string
     */
    private $path;

    /**
     * @return array
     * @throws Exception
     */
    public function getMessagesByRoom(): array
    {
        $messages = json_decode(file_get_contents($this->path), true) !== null ? json_decode(
                file_get_contents($this->path),
                true
        ) : [];
        foreach ($messages as &$message) {
            $message['text'] = Cryptor::Decrypt($message['text'], getenv('SECRET_KEY'));
        }
        return $messages;
    }

    /**
     * @param ConnectionInterface $from
     * @param string $text
     *
     * @return array
     * @throws Exception
     */
    public function saveMessage(ConnectionInterface $from, string $text): array
    {
        $messages = json_decode(file_get_contents($this->path), true);
        $message = [
                'room' => $from->roomId,
                'participantId' => $from->id,
                'name' => $from->name,
                'text' => Cryptor::Encrypt($text, getenv("SECRET_KEY")),
                'date' => time()
        ];
        $messages[] = $message;
        file_put_contents($this->path, json_encode($messages, JSON_PRETTY_PRINT, 512));
        $message['text'] = $text;
        return $message;
    }

    /**
     * @param string $path
     * @return MessageRepository
     */
    public function setPath(string $path)
    {
        $this->path = sprintf("%s/Data/Messages/%s.json", dirname(dirname(__DIR__)), $path);
        if (!file_exists($this->path)) {
            $file = fopen($this->path, 'w');
            fclose($file);
        }
        return $this;
    }
}