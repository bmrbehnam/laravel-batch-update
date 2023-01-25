<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait BatchUpdateTrait
{
    private string|null $conditionKey;

    /**
     * Update Multi Rows By One Query
     * @param array $data
     * @param null $conditionKey
     * @return int
     */
    public static function batchUpdate(array $data, $conditionKey = null): int
    {
        return (new self)->runQuery($data, $conditionKey);
    }

    /**
     * @throws \Exception
     */
    private function runQuery($data, $conditionKey = null): int
    {
        if (empty($data))
            return 0;

        $this->conditionKey = $conditionKey;

        if (is_null($this->conditionKey)) {
            $this->conditionKey = $this->primaryKey;
        }

        return DB::update(
            $this->makeQuery($data)
        );
    }

    /**
     * @param array $data
     * @return string
     * @throws \Exception
     */
    private function makeQuery(array $data): string
    {
        $conditions = [];
        foreach ($data as $items) {

            if (!isset($items[$this->conditionKey])) {
                throw new \Exception('Your Condition Key Not Exist On Model Fields');
            }

            $conditions [] = "'" . $items[$this->conditionKey] . "'";
        }
        $updateFields = $this->caseBuilder($data, $conditions);

        return "UPDATE {$this->getTable()} SET " . implode(",", $updateFields) . " WHERE $this->conditionKey IN(" . implode(",", $conditions) . ");";
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
            if ($fieldName == $this->conditionKey)
                continue;

            $case = 'CASE ';
            foreach ($ids as $key => $id) {
                $value = $data[$key][$fieldName];
                $case .= "WHEN $this->conditionKey = $id THEN '$value' ";
            }
            $case .= "ELSE $fieldName END";
            $updateFields [] = "$fieldName = $case";
        }
        return $updateFields;
    }
}
