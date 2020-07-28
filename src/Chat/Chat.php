<?php

declare(strict_types=1);

namespace App\Chat;


use App\Config\MessageTypes;
use App\Repository\DialogsRepository;
use App\Repository\MessageRepository;
use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use SplObjectStorage;

class Chat implements MessageComponentInterface
{

    /**
     * @var SplObjectStorage
     */
    private $clients;

    /**
     * @var DialogsRepository
     */
    private $roomsRepository;

    public function __construct()
    {
        $this->clients = new SplObjectStorage();
        $this->roomsRepository = new DialogsRepository();
    }


    public function onOpen(ConnectionInterface $conn): void
    {
        var_dump($_SESSION);
        $conn->type = $_SESSION['work'] === '2' || $_SESSION['work'] === '6' ? 1 : 2;
        $conn->id = (int)$_SESSION['id'];
        $conn->messageRepository = new MessageRepository();
        $this->clients->attach($conn);
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn): void
    {
        $this->clients->detach($conn);
    }

    /**
     * @param ConnectionInterface $conn
     * @param Exception $e
     */
    public function onError(ConnectionInterface $conn, Exception $e): void
    {
        $conn->close();
    }

    /**
     * @param ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg): void
    {
        if ($messageData = json_decode($msg, true)) {
            switch ($messageData['type']) {
                case MessageTypes::INIT:
                    $from->roomId = (int)$messageData['roomId'];
                    $room = $this->roomsRepository->parseChatRooms()[$from->roomId];
                    $participant = $room['roomParticipants'][$from->type];
                    if (isset($room) && isset($participant) && $participant['id'] === $from->id) {
                        $from->name = $participant['name'];
                        $from->messageRepository->setPath(sprintf('room_%s', (string)$from->roomId));
                        $outputData = [
                                'type' => MessageTypes::INIT,
                                'id' => $from->id,
                                'data' => $from->messageRepository->getMessagesByRoom()
                        ];
                        $from->send(json_encode($outputData, 0, 512));
                    } else {
                        $from->close();
                    }
                    break;
                case MessageTypes::MESSAGE:
                    if (!empty($messageData['text'])) {
                        $savedMessage = $from->messageRepository->saveMessage($from, $messageData['text']);
                        foreach ($this->clients as $client) {
                            if ($client->roomId === $from->roomId) {
                                $outputData = ['type' => MessageTypes::MESSAGE, 'message' => $savedMessage];
                                $client->send(json_encode($outputData));
                            }
                        }
                    }
                    break;
                default:
                    $from->close();
                    break;
            }
        } else {
            $from->close();
        }
    }
}
