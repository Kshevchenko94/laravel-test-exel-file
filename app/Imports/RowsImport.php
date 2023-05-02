<?php

namespace App\Imports;

use App\Models\Row;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\{RemembersChunkOffset,
    RemembersRowNumber,
    ToModel,
    WithBatchInserts,
    WithChunkReading,
    WithHeadingRow,
    WithUpsertColumns,
    WithUpserts};

class RowsImport implements
    ToModel,
    WithChunkReading,
    WithHeadingRow,
    ShouldQueue,
    WithUpsertColumns,
    WithBatchInserts,
    WithUpserts
{
    use RemembersChunkOffset, RemembersRowNumber;

    /**
     * @var int
     */
    private static int $total = 1;

    /**
     * @param array $row
     * @return Row|null
     */
    public function model(array $row): ?Row
    {
        if (!isset($row['name'])) {
            return null;
        }

        $date = Date::excelToDateTimeObject($row['date'])->format("Y-m-d");

        Cache::add('row_' . $this->getRowNumber(), static::$total++);

        return new Row([
            'name' => $row['name'],
            'date' => $date,
        ]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function upsertColumns(): array
    {
        return ['name', 'date'];
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return string[]
     */
    public function uniqueBy(): array
    {
        return ['name', 'date'];
    }
}
