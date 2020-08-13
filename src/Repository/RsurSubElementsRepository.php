<?php


namespace App\Repository;


use App\Config\TableNames;

class RsurSubElementsRepository extends AbstractRepository
{

    public function findSubElementsByElementId(int $elementId)
    {
        $sql = sprintf('SELECT * FROM %s WHERE element_id = :elementid', $this::getTableName());
        $stmt = $this->dbo->prepare($sql);
        $stmt->execute(['elementid' => $elementId]);
        return $stmt->fetchAll();
    }

    public static function getTableName(): string
    {
        return TableNames::RSUR['sub_elements'];
    }
}