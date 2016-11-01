<?php
namespace PenPaper\Persistence;

class CreditMerger
{
    public function merge(&$credits, $id)
    {
        $original = [];
        foreach (array_keys($credits) as $i) {
            $credit = $credits[$i];
            $key = implode(':', [$credit['creator_id'], $credit[$id]]);
            if (isset($original[$key])) {
                $o = $original[$key];
                $credits[$o]['credit']['credit'] .= ', ' . $credits[$i]['credit']['credit'];
                unset($credits[$i]);
            } else {
                $original[$key] = $i;
            }
        }
        $credits = array_values($credits);
    }
}
