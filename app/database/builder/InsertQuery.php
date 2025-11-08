<?php

namespace app\database\builder;

use app\database\Connection;

class InsertQuery
{
    private string $table;
    private array $FieldsAndValues = [];
    public static function table(string $table): self
    {
        $self = new self;
        $self->table = $table;
        return $self;
    }
    private function createQuery(): string
    {
        $fields = implode(',', array_keys($this->FieldsAndValues));
        $placeHolder = ':' . implode(',:', array_keys($this->FieldsAndValues));
        return "insert into $this->table ($fields) values ($placeHolder); ";
    }
    private function execute(string $query): bool
    {
        $con = Connection::connection();
        $prepare = $con->prepare($query);
        return $prepare->execute($this->FieldsAndValues);
    }
    public function save(array $FieldAndValues): bool
    {
        $this->FieldsAndValues = $FieldAndValues;
        $query = $this->createQuery();
        try {
            return $this->execute($query);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}