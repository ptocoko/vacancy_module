<?php

declare(strict_types=1);
namespace App\Repository;


use App\Domain\DialogParticipant;

class DialogsRepository
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $rooms;

    public function __construct()
    {
        $this->path = sprintf("%s/data/rooms.json", dirname(dirname(__DIR__)));
        if (!file_exists($this->path)) {
            $file = fopen($this->path, 'w');
            fclose($file);
        }
        $this->rooms = $this->parseChatRooms();
    }

    public function parseChatRooms(): array
    {
        $rooms = json_decode(file_get_contents($this->path), true);
        return isset($rooms) ? $rooms : [];
    }

    public function saveRoom(int $vacancyId, DialogParticipant $director, DialogParticipant $teacher): void
    {
        $newRoom = [
                'roomName' => 'vacancy_' . $vacancyId,
                'roomParticipants' => [
                        1 => [
                                'id' => $director->getId(),
                                'name' => $director->getName()
                        ],
                        2 => [
                                'id' => $teacher->getId(),
                                'name' => $teacher->getName()
                        ]
                ]
        ];
        $this->rooms[] = $newRoom;
        file_put_contents($this->path, json_encode($this->rooms, JSON_PRETTY_PRINT, 512));
    }

    public function findInterlocutorsByParticipantId(int $participantId): array
    {
        $output = [];
        foreach ($this->rooms as $roomId => $room) {
            $temp = [];
            if ((int)$room['roomParticipants'][0] === $participantId || (int)$room['roomParticipants'][1]['id'] === $participantId) {
                foreach ($room['roomParticipants'] as $participant) {
                    if ((int)$participant['id'] !== $participantId) {
                        $output[] = ['id' => $roomId, 'participant' => $participant];
                    }
                }
            }
        }
        return $output;
    }
}
