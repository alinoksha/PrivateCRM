<?php

class Order extends Entity
{
    public function create(array $data): bool
    {
        $comment = trim($data['comment']);
        return $this->db->exec('
            INSERT INTO `order` 
                (`start`, `end`, `weekday`, `comment`, `client_id`, `schedule_id`, `diet_id`)
                VALUES (:start, :end, :weekday, :comment, :client_id, :schedule_id, :diet_id);
        ', [
            ':start' => $data['start'], 
            ':end' => $data['end'], 
            ':weekday' => $data['weekday'], 
            ':comment' => $comment === '' ? null : $comment, 
            ':client_id' => $data['client_id'], 
            ':schedule_id' => $data['schedule_id'], 
            ':diet_id' => $data['diet_id']
        ]);
    }

    public function getAll(): array
    {
        $orders = [];
        foreach ($this->db->findAll(
                'SELECT `c`.`name`, `c`.`surname`, `c`.`patronymic`, `c`.`phone`, `o`.`date`, `o`.`start`, `o`.`end`,`o`.`comment`, `o`.`weekday`, `d`.`name` as `diet`, `s`.`name` as `schedule`  
                FROM `client` AS `c`
                    JOIN `order` AS `o` ON `c`.`id`=`o`.`client_id`
                    JOIN `diet` AS `d` ON `d`.`id`=`o`.`diet_id`
                    JOIN `schedule` AS `s` ON `s`.`id`=`o`.`schedule_id`;'
            ) as $order) {
            $orders[] = $order;
        }
        return $orders;
    }

    public function getByID(int $id): false|array
    {
        return $this->db->findOne('SELECT * FROM `order` WHERE `id`=:id;', ['id' => $id]);
    }
}
