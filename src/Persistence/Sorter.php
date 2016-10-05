<?php
namespace PenPaper\Persistence;

class Sorter
{
    public function sort(&$array, array $orderBy = null)
    {
        if (is_null($orderBy)) {
            return sort($array);
        }
        $orderBy = $this->processOrderBy($orderBy);
        return usort($array, function ($a, $b) use ($orderBy) {
            return $this->innerSort($a, $b, $orderBy);
        });
    }

    private function processOrderBy(array $orderBy = null)
    {
        if (!is_array($orderBy)) {
            $orderBy = [$orderBy];
        }
        foreach ($orderBy as $k => $sort) {
            if (is_string($sort)) {
                $sort = preg_replace('!\s+!', ' ', $sort);
                $parts = explode(' ', $sort);
                $type = strtolower($parts[0]);
                if (0 !== strcmp('int', $type)) {
                    $type = 'string';
                }
                $path = explode('.', $parts[1]);
                if (
                    isset($parts[2]) &&
                    0 === strcmp('DESC', strtoupper(trim($parts[2])))
                ) {
                    $order = 'DESC';
                } else {
                    $order = 'ASC';
                }
                $orderBy[$k] = [$type, $path, $order];
            }
        }
        return $orderBy;
    }

    private function innerSort($a, $b, array $orderBy)
    {
        $sort = array_shift($orderBy);
        if (is_null($sort)) {
            return 0;
        }

        $aVal = $a;
        $bVal = $b;

        foreach ($sort[1] as $field) {
            if (isset($aVal[$field])) {
                $aVal = $aVal[$field];
            } else {
                $aVal = [];
            }
            if (isset($bVal[$field])) {
                $bVal = $bVal[$field];
            } else {
                $bVal = [];
            }
        }

        if (0 === strcmp('DESC', $sort[2])) {
            $tmp = $aVal;
            $aVal = $bVal;
            $bVal = $tmp;
            unset($tmp);
        }

        if (0 === strcmp('int', $sort[0])) {
            $aVal = intval($aVal);
            $bVal = intval($bVal);

            if ($aVal === $bVal) {
                $cmp = $this->innerSort($a, $b, $orderBy);
            } else {
                $cmp = ($aVal < $bVal) ? -1 : 1;
            }
        } elseif (0 === strcmp('string', $sort[0])) {
            $aVal = strtolower(strval($aVal));
            $bVal = strtolower(strval($bVal));

            if (0 === strcmp($aVal, $bVal)) {
                $cmp = $this->innerSort($a, $b, $orderBy);
            } else {
                $cmp = strcmp($aVal, $bVal);
            }
        }

        return $cmp;
    }
}
