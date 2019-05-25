<?php

namespace App\Services;

class OrmService
{

    /**
     * This is supposedly our Database!.
     */
    protected $data;

    /**
     * OrmService constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * Search an item based on parameters.
     *
     * @param string $type Author or Article.
     * @param array $filters Array of parameters in the form field => value.
     *
     * @return array Array of items.
     */
    public function search(string $type, array $filters): array
    {
        if (!isset($this->data[$type])) {
            return [];
        }

        $items = [];
        foreach ($this->data[$type] as $id => $item) {
            if ($this->getItemFound($item, $filters)) {
                $items[$id] = $item;
            }
        }

        return $items;
    }

    /**
     * Get if item is correct according to filters.
     *
     * @param array $item Author or Article array.
     * @param array $filters Current search filters.
     *
     * @return bool True if item is correct.
     */
    private function getItemFound(array $item, array $filters)
    {
        foreach ($filters as $field => $value) {
            if (!isset($item[$field])) {
                return false;
            }

            if ($item[$field] != $value) {
                return false;
            }
        }

        return true;
    }

    /**
     * Deletes an item from the array based on type and id.
     *
     * @param string $type Author or Article.
     * @param int $id ID of the item.
     *
     * @return bool True if found and deleted.
     */
    public function delete(string $type, int $id): bool
    {
        if (count($this->get($type, $id)) === 0) {
            return false;
        }

        unset($this->data[$type][$id]);

        return true;
    }

    /**
     * Get specific item.
     *
     * @param string $type Author or Article.
     * @param int $id ID of the item.
     *
     * @return array|false Array of item.
     */
    public function get(string $type, int $id): array
    {
        if (!isset($this->data[$type][$id])) {
            return [];
        }

        return $this->data[$type][$id];
    }

    /**
     * Save an item.
     *
     * @param string $type Type of item.
     * @param array $values Values to save.
     *
     * @return array Array of values.
     */
    public function save(string $type, array $values): array
    {
        if ($values['id'] == 0) {
            $values['id'] = $this->getUniqueId($type);
        }

        $this->data[$type][$values['id']] = $values;
        $this->data[$type][$values['id']]['id'] = $values['id'];

        return $values;
    }

    /**
     * Find a unique ID for a new item.
     *
     * @param string $type Item type.
     *
     * @return int Unique ID.
     */
    private function getUniqueId(string $type): int
    {
        do {
            $id = mt_rand(1, 10000);
        } while (isset($this->data[$type][$id]));

        return $id;
    }

}
