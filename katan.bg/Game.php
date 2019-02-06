<?php
/**
 * Created by PhpStorm.
 * User: Jana
 * Date: 20.2.2018 г.
 * Time: 13:18 ч.
 */

require "Table.php";

class Game
{
    private $players;
    private $rounds;
    private $count_tables;
    private $array_tables;
    private $array_players_table;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->players = 0;
        $this->rounds = 0;
        $this->count_tables = 0;
        $this->array_tables = array();
        $this->array_players_table = array();
    }

    /**
     * @return int
     */
    public function getPlayers(): int
    {
        return $this->players;
    }

    /**
     * @param int $players
     */
    public function setPlayers(int $players)
    {
        $this->players = $players;
    }

    /**
     * @return int
     */
    public function getRounds(): int
    {
        return $this->rounds;
    }

    /**
     * @param int $rounds
     */
    public function setRounds(int $rounds)
    {
        $this->rounds = $rounds;
    }

    /**
     * @return int
     */
    public function getCountTables(): int
    {
        return $this->count_tables;
    }

    /**
     * @param int $count_tables
     */
    public function setCountTables(int $count_tables)
    {
        $this->count_tables = $count_tables;
    }

    /**
     * @return array
     */
    public function getArrayTables(): array
    {
        return $this->array_tables;
    }

    /**
     * @param array $array_tables
     */
    public function setArrayTables(array $array_tables)
    {
        $this->array_tables = $array_tables;
    }

    /**
     * @return array
     */
    public function getArrayPlayersTable(): array
    {
        return $this->array_players_table;
    }

    /**
     * @param array $array_players_table
     */
    public function setArrayPlayersTable(array $array_players_table)
    {
        $this->array_players_table = $array_players_table;
    }

    //Initialize Game object
    public function initGame(int $players2)
    {
        $tables = 0;
        $tables_array = array();
        $array_players = array();
        $this->setPlayers($players2);
        for ($i = 0; $i < $this->getPlayers(); $i++) {
            if ((($players2 >= 4) && ($players2 != 6) && ($players2 != 9)) || (($players2 % 3 != 0) && ($players2 % 4 == 0))) {
                $tables++;
                $tables_array[$i] = 4;
                $players2 = $players2 - 4;
            } elseif (($players2 >= 3) && (($players2 % 3 == 0) || ($players2 % 5 == 0))) {
                $tables++;
                $tables_array[$i] = 3;
                $players2 = $players2 - 3;
            } else {
                continue;
            }
            $array_players[$i] = new Table();
            $array_players[$i]->initTable($tables_array[$i]);
        }
        $this->setCountTables($tables);
        $this->setArrayTables($tables_array);
        $this->setArrayPlayersTable($array_players);
    }

    //Allocate players at tables
    public function distribution(int $players, int $rounds2)
    {
        $arr_tables = $this->getArrayTables();
        $arr_table_players = $this->getArrayPlayersTable();
        $arrays = array(array());
        $arrays2 = array(array());
        for ($i = 0; $i < count($arr_tables); $i++) {
            $arrays[$i] = $arr_table_players[$i]->getArrPlayer();
        }
        switch ($players) {
            case 9:
                for ($rounds = 2; $rounds <= $rounds2; $rounds++) {
                    if ($rounds == 2) {
                        for ($i = 0; $i < count($arr_tables); $i++) {
                            for ($j = 0; $j < count($arrays[$i]); $j++) {
                                if ($i <= $j) {
                                    list($arrays[$i][$j], $arrays[$j][$i]) = array($arrays[$j][$i], $arrays[$i][$j]);
                                } else {
                                    continue;
                                }
                            }
                        }
                        print "<b>Round " . $rounds . ": </b>";
                        $this->printGame2($arrays);
                    } elseif ($rounds > 2) {
                        for ($i = 0; $i < count($arr_tables); $i++) {
                            for ($j = 0; $j < count($arrays[$i]); $j++) {
                                if ($i == $j) {
                                    $arrays2[0][$j] = $arrays[$i][$j];
                                } elseif (($i == 1) && ($j == 0)) {
                                    $arrays2[1][$j] = $arrays[$i][$j];
                                    $arrays2[1][$j + 1] = $arrays[$i + 1][$j + 1];
                                    $arrays2[1][$j + 2] = $arrays[$i - 1][$j + 2];
                                } elseif (($i == 2) && ($j == 0)) {
                                    $arrays2[2][$j] = $arrays[$i][$j];
                                    $arrays2[2][$j + 1] = $arrays[$i - 2][$j + 1];
                                    $arrays2[2][$j + 2] = $arrays[$i - 1][$j + 2];
                                }
                            }
                        }
                        for ($i = 0; $i < count($arr_tables); $i++) {
                            for ($j = 0; $j < count($arrays[$i]); $j++) {
                                $arrays[$i][$j] = $arrays2[$i][$j];
                            }
                        }
                        print "<b>Round " . $rounds . ": </b>";
                        $this->printGame2($arrays2);
                    }
                }
                break;
            case 16:
                for ($rounds = 2; $rounds <= $rounds2; $rounds++) {
                    if ($rounds == 2) {
                        for ($i = 0; $i < count($arr_tables); $i++) {
                            for ($j = 0; $j < count($arrays[$i]); $j++) {
                                if ($i <= $j) {
                                    list($arrays[$i][$j], $arrays[$j][$i]) = array($arrays[$j][$i], $arrays[$i][$j]);
                                } else {
                                    continue;
                                }
                            }
                        }
                        print "<b>Round " . $rounds . ": </b>";
                        $this->printGame2($arrays);
                    } elseif ($rounds > 2) {
                        for ($i = 0; $i < count($arr_tables); $i++) {
                            for ($j = 0; $j < count($arrays[$i]); $j++) {
                                if ($i == $j) {
                                    $arrays2[0][$j] = $arrays[$i][$j];
                                } elseif (($i == 1) && ($j == 0)) {
                                    $arrays2[$i][$j] = $arrays[$i][$j];
                                    $arrays2[$i][$j + 1] = $arrays[$i + 1][$j + 1];
                                    $arrays2[$i][$j + 2] = $arrays[$i + 2][$j + 2];
                                    $arrays2[$i][$j + 3] = $arrays[$i - 1][$j + 3];
                                } elseif (($i == 2) && ($j == 0)) {
                                    $arrays2[$i][$j] = $arrays[$i][$j];
                                    $arrays2[$i][$j + 1] = $arrays[$i + 1][$j + 1];
                                    $arrays2[$i][$j + 2] = $arrays[$i - 2][$j + 2];
                                    $arrays2[$i][$j + 3] = $arrays[$i - 1][$j + 3];
                                } elseif (($i == 3) && ($j == 0))
                                {
                                    $arrays2[$i][$j] = $arrays[$i][$j];
                                    $arrays2[$i][$j + 1] = $arrays[$i - 3][$j + 1];
                                    $arrays2[$i][$j + 2] = $arrays[$i - 2][$j + 2];
                                    $arrays2[$i][$j + 3] = $arrays[$i - 1][$j + 3];
                                }
                            }
                        }
                        for ($i = 0; $i < count($arr_tables); $i++) {
                            for ($j = 0; $j < count($arrays[$i]); $j++) {
                                $arrays[$i][$j] = $arrays2[$i][$j];
                            }
                        }
                        print "<b>Round " . $rounds . ": </b>";
                        $this->printGame2($arrays2);
                    }
                }
                break;
            default:
                print "<strong>Vavedenia broi igrachi v igrata KATAN trabva da budat 9 ili 16!</strong>";
                break;
        }
    }

    //Print Game object
    public
    function printGame()
    {
        print "Players: ";
        print $this->getPlayers();
        print "<br />";
        print "Tables: ";
        print $this->getCountTables();
        print "<br />";
        $arr_tables = $this->getArrayTables();
        $arr_table_players = $this->getArrayPlayersTable();
        $arrays = array(array());
        print "Distribution tables: ";
        print "<br />";
        for ($i = 0; $i < count($arr_tables); $i++) {
            print "Table " . $i . ": ";
            print "<b>";
            print $arr_tables[$i];
            print "</b>";
            print "<br />";
        }
        print "<br />";
        print "<br />";
        print "<b>Round 1:</b>";
        print "<table border=0>";
        for ($i = 0; $i < count($arr_tables); $i++) {
            $arrays[$i] = $arr_table_players[$i]->getArrPlayer();
            print "<tr>";
            for ($j = 0; $j < count($arrays[$i]); $j++) {
                print "<td>";
                print $arrays[$i][$j];
                print "</td>";
            }
            print "</tr>";
        }
        print "</table>";
    }

    public
    function printGame2(array $arrays)
    {
        $arr_tables = $this->getArrayTables();
        print "<table border=0>";
        for ($i = 0; $i < count($arr_tables); $i++) {
            print "<tr>";
            for ($j = 0; $j < count($arrays[$i]); $j++) {
                print "<td>";
                print $arrays[$i][$j];
                print "</td>";
            }
            print "</tr>";
        }
        print "</table>";
    }

    public
    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}