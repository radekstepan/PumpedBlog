<?php if (!defined('FARI')) die();

class Blog {

    public static function getArchive($month, $isAuthenticated) {
        // escape
        $month = Fari_Escape::text($month);
        // parse month and year passed
        list ($month, $year) = explode('-', $month);

        $months = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september',
            'october', 'november', 'december');
        $monthPosition = array_search($month, $months) + 1;
        if (!empty($monthPosition)) { // we have ourselves the month number
            $low = mktime(1, 1, 1, $monthPosition, 1, $year);
            $high = mktime(23, 59, 59, $monthPosition, date('t', $low), $year);

            return (!$isAuthenticated) ?
            Fari_Db::select('articles', '*',
                "published >= '$low' AND published <= '$high' AND status = 1", 'published DESC') :
            Fari_Db::select('articles', '*',
                "published >= '$low' AND published <= '$high' AND status != 2", 'published DESC');
        }
        return;
    }
}