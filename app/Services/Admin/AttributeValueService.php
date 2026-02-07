<?php

namespace App\Services\Admin;

use app\Models\AttributeValue;
use illuminate\support\facades\DB;

class AttributeValueService
{
    public function create(array $data): AttributeValue
    {
        return DB::transaction(function () use ($data) {
            $value = new AttributeValue;
            $value->fill($data);
            $value->save();

            return $value;

        });
    }
    public function update(AttributeValue $value, array $data): AttributeValue
    {
        return DB::transaction(function () use ($value, $data) {
            $value->update($data);
            $value->save();
            return $value;
        });
    }
    public function destroy(AttributeValue $value): void
    {
        DB::transaction(
            function () use ($value) {
                 $value->delete();                 
            });

    }
}
