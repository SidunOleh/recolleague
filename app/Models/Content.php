<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    use HasFactory;

    protected $table = 'content';

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    public static function saveText(string $key, string $value)
    {
        self::updateOrCreate([
            'key' => $key,
            'type' => 'text',
        ], [
            'value' => $value,
        ]);
    }

    public static function saveFile(string $key, UploadedFile $value)
    {
        $path = self::saveFileInStorage($value);

        self::updateOrCreate([
            'key' => $key,
            'type' => 'attachment',
        ], [
            'value' => $path,
        ]);
    }

    private static function saveFileInStorage(UploadedFile $value): string
    {
        $path = Storage::putFileAs(
            '/attachments',
            $value,
            md5($value->getClientOriginalName() . time()) . '.' . $value->getClientOriginalExtension()
        );

        return $path;
    }

    public static function saveArray(string $key, array $value)
    {
        $array = self::prepareArray($value);

        self::updateOrCreate([
            'key' => $key,
            'type' => 'array',
        ], [
            'value' => serialize($array),
        ]);
    }

    private static function prepareArray(array $array): array
    {
        $preparedArray = [];
        foreach ($array as $key => $value) {
            if (is_string($value)) {
                $preparedArray[$key] = $value;
            }
            if ($value instanceof UploadedFile) {
                $preparedArray[$key] = self::saveFileInStorage($value);
            }
            if (is_array($value)) {
                $preparedArray[$key] = self::prepareArray($value);
            }
        }

        return $preparedArray;
    }

    public static function getFormatted()
    {
        $content = [];
        foreach (self::all() as $item) {
            $content[$item->key] = $item->type == 'array'
                ? unserialize($item->value)
                : $item->value;
        }

        return $content;
    }
}
