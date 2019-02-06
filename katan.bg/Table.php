<?php
/**
 * Created by PhpStorm.
 * User: Jana
 * Date: 20.2.2018 г.
 * Time: 19:57 ч.
 */

$count=1;
class Table
{
    private $count_player;
    private $arr_player;

    /**
     * Table constructor.
     */
    public function __construct()
    {
        $this->count_player=0;
        $this->arr_player=array();
    }

    /**
     * @return int
     */
    public function getCountPlayer(): int
    {
        return $this->count_player;
    }

    /**
     * @param int $count_player
     */
    public function setCountPlayer(int $count_player)
    {
        $this->count_player = $count_player;
    }

    /**
     * @return array
     */
    public function getArrPlayer(): array
    {
        return $this->arr_player;
    }

    /**
     * @param array $arr_player
     */
    public function setArrPlayer(array $arr_player)
    {
        $this->arr_player = $arr_player;
    }

    //Initialize Table object
    public function initTable(int $count_player2)
    {
        global $count;
        $arr_table=array();
        $this->setCountPlayer($count_player2);
        for ($i=0;$i<$count_player2;$i++)
        {
            $arr_table[$i]=$count;
            $count++;
        }
        $this->setArrPlayer($arr_table);
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}