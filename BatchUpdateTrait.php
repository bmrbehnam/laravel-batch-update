<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait BatchUpdateTrait
{
    /**
     * Update Multi Rows By One Query
     * @param array $data
     * @return int
     */
    public static function batchUpdate(array $data): int
    {
        return (new self)->runQuery($data);
    }

    private function runQuery($data): int
    {
        return DB::update(
            $this->makeQuery($data)
        );
    }

    /**
     * @param array $data
     * @return string
     */
    private function makeQuery(array $data): string
    {
        $ids = [];
        foreach ($data as $items) {
            $ids [] = $items[$this->primaryKey];
        }
        $updateFields = $this->caseBuilder($data, $ids);

        return "UPDATE {$this->getTable()} SET " . implode(",", $updateFields) . " WHERE $this->primaryKey IN(" . implode(",", $ids) . ");";
    }

    /**
     * @param array $data
     * @param array $ids
     * @return array
     */
    private function caseBuilder(array $data, array $ids): array
    {
        $updateFields = [];
        foreach (last($data) as $fieldName => $fieldValue) {
            if ($fieldName == $this->primaryKey)
                continue;

            $case = 'CASE ';
            foreach ($ids as $key => $id) {
                $value = $data[$key][$fieldName];
                $case .= "WHEN $this->primaryKey = $id THEN $value ";
            }
            $case .= "ELSE `$fieldName` END";
            $updateFields [] = "$fieldName = $case";
        }
        return $updateFields;
    }
}
