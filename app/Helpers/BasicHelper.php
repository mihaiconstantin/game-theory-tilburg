<?php

namespace App\Helpers;


use App\Models\Study;


class BasicHelper
{

    /**
     * Generate a random string of a given length.
     *
     * @param int $length
     * @return string
     */
    public static function userCode(int $length = 10) : string
    {
        return str_random($length);
    }


    /**
     * Randomly assigns the user to one of the conditions specified in the study configuration.
     *
     * @param string $studyName
     * @return string
     */
    public static function randomAssign(string $studyName) : string
    {
        $conditions = explode(',',
            preg_replace(
                '/\s+/',
                '',
                Study::getColumnsByName($studyName, ['condition_set'])['condition_set']
                )
            );

        return $conditions[array_rand($conditions)];
    }


    /**
     * Reindex the keys of an array to start at 1 instead of 0
     * and respect the order.
     *
     * @param array $array
     * @return array
     */
    public static function reindexArray(array $array) : array
    {
        return array_combine(range(1, count($array)), $array);
    }


    /**
     * Parse and return the right side of a chain (i.e., index 1).
     *
     * @param string $chain
     * @return array
     */
    public static function parseChainRight(string $chain) : array
    {
        return array_map(function($n) {
            return explode('#', $n)[1];
        }, explode(';', $chain));
    }


    /**
     * Parse and return the left side of a chain (i.e., index 0).
     *
     * @param string $chain
     * @return array
     */
    public static function parseChainLeft(string $chain) : array
    {
        return array_map(function($n) {
            return explode('#', $n)[0];
        }, explode(';', $chain));
    }


    /**
     * Count how many phases did the user played in total, for the
     * appropriate context. These numbers should also match the
     * numbers of rows in the data_game_phases table.
     *
     * @param $context
     * @return int
     */
    public static function totalPhasesPlayed($context) : int
    {
        $phases_played = 0;

        foreach (session('storage.data_' . $context) as $game_number => $phases_values)
        {
            foreach ($phases_values as $phase_number => $phase_value)
            {
                if ($phase_value['user_choice'] != null)
                {
                    $phases_played++;
                }
            }
        }


        return (int) $phases_played;
    }

}