<?php

namespace App\Repository;

use App\Abstract\BaseRepositoryImplementationForMoreThanModel;
use App\Http\Requests\AuthRequest;
use App\Interfaces\AuthInterface;
use App\Models\Admin;
use App\Models\Restaurant;
use App\Models\User;
use App\Statuses\UserStatus;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends BaseRepositoryImplementationForMoreThanModel implements AuthInterface
{
    public function loginRestaurant(AuthRequest $request)
    {
        $restaurant = $this->getByColumn(Restaurant::class, 'email', $request->email);
        if (! $restaurant || ! Hash::check($request->password, $restaurant->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = $restaurant->createToken('MyApp', [UserStatus::ADMIN])->plainTextToken;

        return $this->createNewToken($token, $restaurant);

    }

    public function loginEmployee($request)
    {
        $employee = $this->getByColumn(User::class, 'email', $request->email);
        if (! $employee || ! Hash::check($request->password, $employee->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $employee =  $this->updateById(User::class, $employee->id, ['deviceKey' => $request->deviceKey]);
        $token = $employee->createToken('MyApp', [$employee->user_type])->plainTextToken;

        return $this->createNewToken($token, $employee);
    }

    public function loginAdmin(AuthRequest $request)
    {
        $employee = $this->getByColumn(Admin::class, 'email', $request->email);
        if (! $employee || ! Hash::check($request->password, $employee->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $token = $employee->createToken('MyApp', [UserStatus::SUPER_ADMIN])->plainTextToken;

        return $this->createNewToken($token, $employee);
    }

    protected function createNewToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ]);
    }
}
