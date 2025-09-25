<?php

namespace App\Repository\Admin;

use App\Abstract\BaseRepositoryImplementation;
use App\ApiHelper\ApiResponseCodes;
use App\ApiHelper\ApiResponseHelper;
use App\ApiHelper\Result;
use App\Http\Resources\TableResource;
use App\Interfaces\Admin\TableInterface;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableRepository extends BaseRepositoryImplementation implements TableInterface
{
    public function model()
    {
        return Table::class;
    }

    public function getTables()
    {
        $table = $this->get();
        $table = TableResource::collection($table);

        return ApiResponseHelper::sendResponse(new Result($table, 'get tables'));

    }

    public function storeTable($data)
    {
        $user = Auth::user();
        $uuid = Str::uuid();
        $table = $this->create(array_merge($data, ['unique_id' => $uuid, 'restaurant_id' => $user->id]));
        $link = 'http://192.168.1.102:3000/menu?restaurant_id='.$user->id.'&branch_id='.$data['branch_id'].'&table_id='.$table->id;
        $fileName = 'asset/QR/table'.$table->id.'.svg';
        $qrCode = QrCode::format('svg')
            ->size(500)
            ->generate($link);
        $path = public_path($fileName);
        if (! file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }
        file_put_contents($path, $qrCode);
        $table = $this->updateById($table->id, ['Qr_code_path' => $fileName]);

        return ApiResponseHelper::sendResponse(new Result($table, 'table created'), ApiResponseCodes::CREATED);

    }

    public function updateTable($id, $data)
    {

        $user = Auth::user();
        $uuid = Table::find($id);
        $filePath = "qrcodes/table_{$uuid->unique_id}.png";

        $updatedData = array_merge($data, ['Qr_code_path' => "/storage/{$filePath}"]);
        $table = $this->updateById($id, $updatedData);
        $qrData = "{$user->id}|{$table->branch_id}|{$table->id}";
        $qr = QrCode::generate($qrData);
        Storage::disk('local')->put($filePath, $qr);

        return ApiResponseHelper::sendResponse(new Result($table, 'table updated'), ApiResponseCodes::CREATED);
    }

    public function deleteTable($id)
    {
        $table = $this->deleteById($id);

        return ApiResponseHelper::sendMessageResponse('table deleted');
    }

    public function active($id)
    {
        $table = Table::find($id);
        if ($table) {
            $table->active = ! $table->active;
            $table->save();

            return true;
        } else {
            return false;
        }

    }
}
